<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jamaah;
use App\User;
use App\LogActivity;
use App\MasterNotifikasi;
use Auth;
use Carbon\Carbon;
use Excel;
use DB;
class ImportJamaahController extends Controller
{
 
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
       
    public function downloadExcel($type)
    {
        $data = Jamaah::get()->toArray();
        return Excel::create('data_jamaah', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importExcelJamaah(Request $request)
    {
        if($request->hasFile('import_file_jamaah')){
            Excel::load($request->file('import_file_jamaah')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['id'] = $row['id'];
                    $data['id_umrah'] = $row['id_umrah'];
                    $id_umrah = $row['id_umrah'];
                    $data['id_jamaah'] = $row['id_jamaah'];
                    $id_jamaah = $row['id_jamaah'];
                    $data['tgl_daftar'] = $row['tgl_daftar'];
                    $data['nama'] = $row['nama'];
                    $data['tgl_berangkat'] = $row['tgl_berangkat'];
                    $data['tgl_pulang'] = $row['tgl_pulang'];
                    $data['marketing'] = $row['marketing'];
                    $id_marketing = $row['marketing'];
                    $data['staff'] = $row['staff'];
                    $data['no_telp'] = $row['no_telp'];
                    // $data['marketing_fee'] = $row['marketing_fee'];
                    // $data['koordinator'] = $row['koordinator'];
                    // $data['koordinator_fee'] = $row['koordinator_fee'];
                    // $data['top'] = $row['top'];
                    // $data['top_fee'] = $row['top_fee'];
                    // $data['diskon_marketing'] = $row['diskon_marketing'];
                    $data['status'] = $row['status'];
                    $data['tgl_transfer'] = $row['tgl_transfer'];
                    $data['periode'] = $row['periode'];
                    if ($data['tgl_transfer'] != null) {
                        // $agents = User::where('device_token', '!=', null)->get();
                        $now = Carbon::now();
                        $year = $now->year;
                        $month = $now->month;
                        $day = $now->day;

                        $jamaahs = Jamaah::where('tgl_transfer', '=', $now->format('Y').'-'.$now->format('m').'-'.$now->format('d'))->where('marketing', $row['marketing'])->where('koordinator', $row['koordinator'])->where('top', $row['top'])->get();

                        $totalJamaahBerangkat = count($jamaahs);
                        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                        foreach ($jamaahs as $in) {

                            $recepientMarketing = User::where('id', $in->marketing)->first();
                            $recepientKoordinator = User::where('id', $in->koordinator)->first();
                            $recepientTop = User::where('id', $in->top)->first();
                            $token = array();
                            $token = [
                                $recepientMarketing['device_token'],
                                $recepientKoordinator['device_token'],
                                $recepientTop['device_token']
                            ];
                            
                            $notification = [
                                'body' => 'Komisi sudah transfer, cek notifikasi!',
                                'bodyKoordinator' => 'Komisi dari agen '. $in->anggota->nama .' sudah di transfer, silahkan kontak koordinator anda untuk verifikasi!',
                                'bodyTop' => 'Komisi dari agen '. $in->anggota->nama .' sudah di transfer!',
                                'sound' => true,
                            ];


                            $sendNotifyMarketing = MasterNotifikasi::create([
                                                                    'anggota_id' => $in->marketing,
                                                                    'pesan' => $notification['body'],
                                                                    'status' => 'delivered'
                                                                    ]);

                            $sendNotifyKoordinator = MasterNotifikasi::create([
                                                                    'anggota_id' => $in->koordinator,
                                                                    'pesan' => $notification['bodyKoordinator'],
                                                                    'status' => 'delivered'
                                                                    ]);

                            $sendNotifyTop = MasterNotifikasi::create([
                                                                    'anggota_id' => $in->top,
                                                                    'pesan' => $notification['bodyTop'],
                                                                    'status' => 'delivered'
                                                                    ]);
                            
                            $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

                            $fcmNotification = [
                                'registration_ids' => $token, //multple token array
                                // 'to'        => $token, //single token
                                'notification' => $notification,
                                'data' => $extraNotificationData
                            ];

                            $headers = [
                                'Authorization: key=AIzaSyBd3fkYDybtqT7RmEkz8-nm6FbnSkW1tkA',
                                'Content-Type: application/json'
                            ];


                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                            $result = curl_exec($ch);
                            curl_close($ch);


                            // return response()->json($result);
                        }
                    }
                    // Jika data tidak kosong
                    if(!empty($data)) {
                        // Cari di data Jamaah yang id nya sama
                        $validator = Jamaah::where('id', $data['id'])->first();

                        //Referensi uang yang ditransfer kantor
                        $reference = 2250000;
                        $referencePromo = 1200000;
                        $top_ref = 250000;
                        $top_promo = 100000;

                        //Assign value id marketing untuk dicari di tabel User
                        $anggota_id = $data['marketing'];

                        //Jika ditemukan yang id nya sama dari validator
                        if($validator){
                            //Update Data

                            //Cari di tabel User yang id nya sama seperti $anggota_id
                            $findKoordinator = User::find($anggota_id);
                            $findDiskon = DB::table('master_pendaftaran')->where('id_jamaah', $id_jamaah)->first();

                            if ($row['marketing_fee'] == "PROMO") {
                                $promo = true;
                            }else{
                                $promo = false;
                            }

                            $k = $findKoordinator['koordinator'];

                            // $ref = $reference - $refdiskon;
                            if ($k == "SM000" ) {
                                if($findDiskon){
                                    $d = $findDiskon->diskon_marketing;

                                    if ($promo) {
                                        $data['marketing_fee'] = $referencePromo - 100000 - $d;
                                        $data['koordinator'] = 'SM000';
                                        $data['koordinator_fee'] = 0;
                                        $data['top'] = 'SM000';
                                        $data['top_fee'] = 0;
                                        $data['diskon_marketing'] = $d;    
                                    }else{
                                        $data['marketing_fee'] = $reference - $d;
                                        $data['koordinator'] = 'SM000';
                                        $data['koordinator_fee'] = 0;
                                        $data['top'] = 'SM000';
                                        $data['top_fee'] = 0;
                                        $data['diskon_marketing'] = $d;
                                    }
                                    
                                }else{

                                    if ($promo) {
                                        $data['marketing_fee'] = $referencePromo - 100000;
                                        $data['koordinator'] = 'SM000';
                                        $data['koordinator_fee'] = 0;
                                        $data['top'] = 'SM000';
                                        $data['top_fee'] = 0;
                                        $data['diskon_marketing'] = 0;
                                    }else{
                                        $data['marketing_fee'] = $reference;
                                        $data['koordinator'] = 'SM000';
                                        $data['koordinator_fee'] = 0;
                                        $data['top'] = 'SM000';
                                        $data['top_fee'] = 0;
                                        $data['diskon_marketing'] = 0;
                                    }
                                    
                                }

                                DB::table('jamaah')->where('id', $data['id'])->update($data);
                            }else if($k == "SM140"){
                                // $totalLevel2 = $findKoordinator->fee_reguler - $refdiskon - ($ref - $findKoordinator->fee_reguler - $refdiskon);
                                if($findDiskon){
                                    $d = $findDiskon->diskon_marketing;

                                    if ($promo) {
                                        $totalLevel2 = $referencePromo - $findKoordinator['fee_promo'];

                                        $data['marketing_fee'] = $findKoordinator['fee_promo'] - $d;
                                        $data['koordinator'] = $findKoordinator['koordinator'];
                                        $data['koordinator_fee'] = $totalLevel2;
                                        $data['top'] = 'SM140';
                                        $data['top_fee'] = $totalLevel2;
                                        $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                    }else{
                                        $totalLevel2 = $reference - $findKoordinator['fee_reguler'];

                                        $data['marketing_fee'] = $findKoordinator['fee_reguler'] - $d;
                                        $data['koordinator'] = $findKoordinator['koordinator'];
                                        $data['koordinator_fee'] = $totalLevel2;
                                        $data['top'] = 'SM140';
                                        $data['top_fee'] = $totalLevel2;
                                        $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                    }
                                    
                                }else{
                                    if ($promo) {
                                        $totalLevel2 = $referencePromo - $findKoordinator['fee_promo'];

                                        $data['marketing_fee'] = $findKoordinator['fee_promo'];
                                        $data['koordinator'] = $findKoordinator['koordinator'];
                                        $data['koordinator_fee'] = $totalLevel2;
                                        $data['top'] = 'SM140';
                                        $data['top_fee'] = $totalLevel2;
                                        $data['diskon_marketing'] = 0;
                                    }else{
                                        $totalLevel2 = $reference - $findKoordinator['fee_reguler'];

                                        $data['marketing_fee'] = $findKoordinator['fee_reguler'];
                                        $data['koordinator'] = $findKoordinator['koordinator'];
                                        $data['koordinator_fee'] = $totalLevel2;
                                        $data['top'] = 'SM140';
                                        $data['top_fee'] = $totalLevel2;
                                        $data['diskon_marketing'] = 0;
                                    }
                                    
                                }

                                DB::table('jamaah')->where('id', $data['id'])->update($data);
                            }else{
                                if($findDiskon){
                                    $d = $findDiskon->diskon_marketing;

                                    if ($promo) {
                                        $totalLevel3 = $referencePromo - ($findKoordinator['fee_promo'] + $top_promo);

                                        $data['marketing_fee'] = $findKoordinator['fee_promo'] - $d;
                                        $data['koordinator'] = $findKoordinator['koordinator'];
                                        $data['koordinator_fee'] = $totalLevel3;
                                        $data['top'] = 'SM140';  
                                        $data['top_fee'] = $top_promo;
                                        $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                    }else{
                                        $totalLevel3 = $reference - ($findKoordinator['fee_reguler'] + $top_ref);

                                        $data['marketing_fee'] = $findKoordinator['fee_reguler'] - $d;
                                        $data['koordinator'] = $findKoordinator['koordinator'];
                                        $data['koordinator_fee'] = $totalLevel3;
                                        $data['top'] = 'SM140';  
                                        $data['top_fee'] = $top_ref;
                                        $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                    }
                                    
                                }else{
                                    if ($promo) {
                                        $totalLevel3 = $referencePromo - ($findKoordinator['fee_promo'] + $top_promo);

                                        $data['marketing_fee'] = $findKoordinator['fee_promo'];
                                        $data['koordinator'] = $findKoordinator['koordinator'];
                                        $data['koordinator_fee'] = $totalLevel3;
                                        $data['top'] = 'SM140';  
                                        $data['top_fee'] = $top_promo;
                                        $data['diskon_marketing'] = 0;
                                    }else{
                                        $totalLevel3 = $reference - ($findKoordinator['fee_reguler'] + $top_ref);

                                        $data['marketing_fee'] = $findKoordinator['fee_reguler'];
                                        $data['koordinator'] = $findKoordinator['koordinator'];
                                        $data['koordinator_fee'] = $totalLevel3;
                                        $data['top'] = 'SM140';  
                                        $data['top_fee'] = $top_ref;
                                        $data['diskon_marketing'] = 0;
                                    }
                                    
                                }

                                DB::table('jamaah')->where('id', $data['id'])->update($data);
                            }
                        }else {
                            //Buat baru

                            //Cari di tabel User yang id nya sama seperti $anggota_id
                            $findKoordinator = User::find($anggota_id);
                            $findDiskon = DB::table('master_pendaftaran')->where('id_jamaah', $id_jamaah)->first();

                            if ($row['marketing_fee'] == "PROMO") {
                                $promo = true;
                            }else{
                                $promo = false;
                            }

                            $k = $findKoordinator->koordinator;

                            // $ref = $reference - $refdiskon;
                            if ($k == "SM000" ) {
                                if($findDiskon){
                                    $d = $findDiskon->diskon_marketing;

                                    if ($promo) {
                                        $data['marketing_fee'] = $referencePromo - 100000 - $d;
                                        $data['koordinator'] = 'SM000';
                                        $data['koordinator_fee'] = 0;
                                        $data['top'] = 'SM000';
                                        $data['top_fee'] = 0;
                                        $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                    }else{
                                        $data['marketing_fee'] = $reference - $d;
                                        $data['koordinator'] = 'SM000';
                                        $data['koordinator_fee'] = 0;
                                        $data['top'] = 'SM000';
                                        $data['top_fee'] = 0;
                                        $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                    }

                                    
                                }else{
                                    if ($promo) {
                                        $data['marketing_fee'] = $referencePromo - 100000;
                                        $data['koordinator'] = 'SM000';
                                        $data['koordinator_fee'] = 0;
                                        $data['top'] = 'SM000';
                                        $data['top_fee'] = 0;
                                        $data['diskon_marketing'] = 0;
                                    }else{
                                        $data['marketing_fee'] = $reference;
                                        $data['koordinator'] = 'SM000';
                                        $data['koordinator_fee'] = 0;
                                        $data['top'] = 'SM000';
                                        $data['top_fee'] = 0;
                                        $data['diskon_marketing'] = 0;
                                    }
                                    
                                }

                                DB::table('jamaah')->insert($data);
                            }else if($k == "SM140"){
                                // $totalLevel2 = $findKoordinator->fee_reguler - $refdiskon - ($ref - $findKoordinator->fee_reguler - $refdiskon);
                                if($findDiskon){
                                    $d = $findDiskon->diskon_marketing;

                                    if ($promo) {
                                        $totalLevel2 = $referencePromo - $findKoordinator->fee_promo;

                                        $data['marketing_fee'] = $findKoordinator->fee_promo - $d;
                                        $data['koordinator'] = $findKoordinator->koordinator;
                                        $data['koordinator_fee'] = $totalLevel2;
                                        $data['top'] = 'SM140';
                                        $data['top_fee'] = $totalLevel2;
                                        $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                    }else{
                                        $totalLevel2 = $reference - $findKoordinator->fee_reguler;

                                        $data['marketing_fee'] = $findKoordinator->fee_reguler - $d;
                                        $data['koordinator'] = $findKoordinator->koordinator;
                                        $data['koordinator_fee'] = $totalLevel2;
                                        $data['top'] = 'SM140';
                                        $data['top_fee'] = $totalLevel2;
                                        $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                    }

                                    
                                }else{

                                    if ($promo) {
                                        $totalLevel2 = $referencePromo - $findKoordinator->fee_promo;

                                        $data['marketing_fee'] = $findKoordinator->fee_promo;
                                        $data['koordinator'] = $findKoordinator->koordinator;
                                        $data['koordinator_fee'] = $totalLevel2;
                                        $data['top'] = 'SM140';
                                        $data['top_fee'] = $totalLevel2;
                                        $data['diskon_marketing'] = 0;
                                    }else{
                                        $totalLevel2 = $reference - $findKoordinator->fee_reguler;

                                        $data['marketing_fee'] = $findKoordinator->fee_reguler;
                                        $data['koordinator'] = $findKoordinator->koordinator;
                                        $data['koordinator_fee'] = $totalLevel2;
                                        $data['top'] = 'SM140';
                                        $data['top_fee'] = $totalLevel2;
                                        $data['diskon_marketing'] = 0;
                                    }
                                    
                                }

                                DB::table('jamaah')->insert($data);              
                            }else{
                                if($findDiskon){
                                    $d = $findDiskon->diskon_marketing;

                                    if ($promo) {
                                        $totalLevel3 = $referencePromo - ($findKoordinator->fee_promo + $top_promo);

                                        $data['marketing_fee'] = $findKoordinator->fee_promo - $d;
                                        $data['koordinator'] = $findKoordinator->koordinator;
                                        $data['koordinator_fee'] = $totalLevel3;
                                        $data['top'] = 'SM140';  
                                        $data['top_fee'] = $top_promo;
                                        $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                    }else{
                                        $totalLevel3 = $reference - ($findKoordinator->fee_reguler + $top_ref);

                                        $data['marketing_fee'] = $findKoordinator->fee_reguler - $d;
                                        $data['koordinator'] = $findKoordinator->koordinator;
                                        $data['koordinator_fee'] = $totalLevel3;
                                        $data['top'] = 'SM140';  
                                        $data['top_fee'] = $top_ref;
                                        $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                    }

                                    
                                }else{
                                    if ($promo) {
                                        $totalLevel3 = $referencePromo - ($findKoordinator->fee_promo + $top_promo);

                                        $data['marketing_fee'] = $findKoordinator->fee_promo;
                                        $data['koordinator'] = $findKoordinator->koordinator;
                                        $data['koordinator_fee'] = $totalLevel3;
                                        $data['top'] = 'SM140';  
                                        $data['top_fee'] = $top_promo;
                                        $data['diskon_marketing'] = 0;
                                    }else{
                                        $totalLevel3 = $reference - ($findKoordinator->fee_reguler + $top_ref);

                                        $data['marketing_fee'] = $findKoordinator->fee_reguler;
                                        $data['koordinator'] = $findKoordinator->koordinator;
                                        $data['koordinator_fee'] = $totalLevel3;
                                        $data['top'] = 'SM140';  
                                        $data['top_fee'] = $top_ref;
                                        $data['diskon_marketing'] = 0;
                                    }
                                    
                                }

                                DB::table('jamaah')->insert($data);
                            }
                            // END PEMBATAS
                            // Session::put('message', 'Your file is succesfully imported!');
                        }
                    }
                }
            });
        }
        return back();
    }
}

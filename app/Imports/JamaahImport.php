<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Jamaah;
use App\User;
use App\LogActivity;
use App\Periode;
use App\MasterNotifikasi;
use Auth;
use Carbon\Carbon;
use DB;

class JamaahImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $errors = [];
        $periode = Periode::where('status_periode', 'active')->first();
        foreach ($collection as $row) {
            $data['id'] = $row['id'];
            $data['id_umrah'] = $row['id_umrah'];
            $id_umrah = $row['id_umrah'];
            $data['id_jamaah'] = $row['id_jamaah'];
            $id_jamaah = $row['id_jamaah'];
            $data['tgl_daftar'] = date("Y-m-d",mktime(0,0,0,1,$row['tgl_daftar']-1,1900));
            $data['nama'] = $row['nama'];
            $data['tgl_berangkat'] = date("Y-m-d",mktime(0,0,0,1,$row['tgl_berangkat']-1,1900));
            $data['tgl_pulang'] = date("Y-m-d",mktime(0,0,0,1,$row['tgl_pulang']-1,1900));
            $data['marketing'] = $row['marketing'];
            $id_marketing = $row['marketing'];
            $data['staff'] = $row['staff'];
            $data['no_telp'] = $row['no_telp'];
            $data['status'] = $row['status'];
            $data['tgl_transfer'] = $row['tgl_transfer'] == null ?  null : date("Y-m-d",mktime(0,0,0,1,$row['tgl_transfer']-1,1900));
            $data['periode'] = $row['periode'];
            $getdiskon = $row['diskon_marketing'];
            // Jika data dari excel tidak kosong
            //Assign value id marketing untuk dicari di tabel User
            $anggota_id = $data['marketing'];
            
            if(isset($data)) {
                if ($anggota_id) {
                    // Cari di data Jamaah yang id nya sama
                    $validator = Jamaah::where('id', $data['id'])->first();

                    //Referensi uang yang ditransfer kantor
                    $reference = 2250000;
                    $referencePromo = 1200000;
                    $top_ref = 250000;
                    $top_promo = 100000;

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
                                    $data['marketing_fee'] = $referencePromo - 100000 - $getdiskon;
                                    $data['koordinator'] = 'SM000';
                                    $data['koordinator_fee'] = 0;
                                    $data['top'] = 'SM000';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $getdiskon;
                                }else{
                                    $data['marketing_fee'] = $reference - $getdiskon;
                                    $data['koordinator'] = 'SM000';
                                    $data['koordinator_fee'] = 0;
                                    $data['top'] = 'SM000';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $getdiskon;
                                }

                            }

                            DB::table('jamaah')->where('id', $data['id'])->update($data);
                        }else if($k == "SM140"){
                            // $totalLevel2 = $findKoordinator->fee_reguler - $refdiskon - ($ref - $findKoordinator->fee_reguler - $refdiskon);
                            if($findDiskon){
                                $d = $findDiskon->diskon_marketing;

                                if ($promo) {
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $findKoordinator['fee_promo'] - $d;
                                    $data['koordinator'] = $findKoordinator['koordinator'];
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                }else{
                                    $totalLevel2 = $reference - $findKoordinator['fee_reguler'];

                                    $data['marketing_fee'] = $findKoordinator['fee_reguler'] - $d;
                                    $data['koordinator'] = $findKoordinator['koordinator'];
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                }

                            }else{
                                if ($promo) {
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $findKoordinator['fee_promo'] - $getdiskon;
                                    $data['koordinator'] = $findKoordinator['koordinator'];
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $getdiskon;
                                }else{
                                    $totalLevel2 = $reference - $findKoordinator['fee_reguler'];

                                    $data['marketing_fee'] = $findKoordinator['fee_reguler'] - $getdiskon;
                                    $data['koordinator'] = $findKoordinator['koordinator'];
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $getdiskon;
                                }

                            }

                            DB::table('jamaah')->where('id', $data['id'])->update($data);
                        }else{
                            //JIKA BUKAN PA ARI
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
                                    $data['marketing_fee'] = $findKoordinator['fee_promo'] - $getdiskon;
                                    $data['koordinator'] = $findKoordinator['koordinator'];
                                    $data['koordinator_fee'] = $totalLevel3;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = $top_promo;
                                    $data['diskon_marketing'] = $getdiskon;
                                }else{
                                    $totalLevel3 = $reference - ($findKoordinator['fee_reguler'] + $top_ref);

                                    $data['marketing_fee'] = $findKoordinator['fee_reguler'] - $getdiskon;
                                    $data['koordinator'] = $findKoordinator['koordinator'];
                                    $data['koordinator_fee'] = $totalLevel3;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = $top_ref;
                                    $data['diskon_marketing'] = $getdiskon;
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
                                    $data['marketing_fee'] = $referencePromo - 100000 - $getdiskon;
                                    $data['koordinator'] = 'SM000';
                                    $data['koordinator_fee'] = 0;
                                    $data['top'] = 'SM000';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $getdiskon;
                                }else{
                                    $data['marketing_fee'] = $reference - $getdiskon;
                                    $data['koordinator'] = 'SM000';
                                    $data['koordinator_fee'] = 0;
                                    $data['top'] = 'SM000';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $getdiskon;
                                }

                            }

                            DB::table('jamaah')->insert($data);
                        }else if($k == "SM140"){
                            // $totalLevel2 = $findKoordinator->fee_reguler - $refdiskon - ($ref - $findKoordinator->fee_reguler - $refdiskon);
                            if($findDiskon){
                                $d = $findDiskon->diskon_marketing;

                                if ($promo) {
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $findKoordinator->fee_promo - $d;
                                    $data['koordinator'] = $findKoordinator->koordinator;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                }else{
                                    $totalLevel2 = $reference - $findKoordinator->fee_reguler;

                                    $data['marketing_fee'] = $findKoordinator->fee_reguler - $d;
                                    $data['koordinator'] = $findKoordinator->koordinator;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon->diskon_marketing;
                                }


                            }else{

                                if ($promo) {
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $findKoordinator->fee_promo - $getdiskon;
                                    $data['koordinator'] = $findKoordinator->koordinator;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $getdiskon;
                                }else{
                                    $totalLevel2 = $reference - $findKoordinator->fee_reguler;

                                    $data['marketing_fee'] = $findKoordinator->fee_reguler - $getdiskon;
                                    $data['koordinator'] = $findKoordinator->koordinator;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $getdiskon;
                                }

                            }

                            DB::table('jamaah')->insert($data);
                        }else{
                            //JIKA BUKAN PA ARI
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

                                    $data['marketing_fee'] = $findKoordinator->fee_promo - $getdiskon;
                                    $data['koordinator'] = $findKoordinator->koordinator;
                                    $data['koordinator_fee'] = $totalLevel3;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = $top_promo;
                                    $data['diskon_marketing'] = $getdiskon;
                                }else{
                                    $totalLevel3 = $reference - ($findKoordinator->fee_reguler + $top_ref);

                                    $data['marketing_fee'] = $findKoordinator->fee_reguler - $getdiskon;
                                    $data['koordinator'] = $findKoordinator->koordinator;
                                    $data['koordinator_fee'] = $totalLevel3;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = $top_ref;
                                    $data['diskon_marketing'] = $getdiskon;
                                }

                            }

                            DB::table('jamaah')->insert($data);
                        }
                        // END PEMBATAS
                    }
                    if ($data['tgl_transfer'] != null ) {
                        $now = Carbon::now();
                        $year = $now->year;
                        $month = $now->month;
                        $day = $now->day;

                        // $jamaahs = Jamaah::where('tgl_transfer', '=', $now->format('Y').'-'.$now->format('m').'-'.$now->format('d'))->where('marketing', $row['marketing'])->where('koordinator', $row['koordinator'])->where('top', $row['top'])->get();

                        // $totalJamaahBerangkat = count($jamaahs);
                        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

                        // Get ID relationship
                        $siMarketing = User::where('id', $data['marketing'])->first();
                        $siKoordinator = User::where('id', $data['koordinator'])->first();
                        $siTop = User::where('id', $data['top'])->first();
                    

                        $recepientMarketing = User::where('id', $data['marketing'])->first();
                        $recepientKoordinator = User::where('id', $data['koordinator'])->first();
                        $recepientTop = User::where('id', $data['top'])->first();
                        $token = array();
                        $token = [
                            $recepientMarketing['device_token'],
                            $recepientKoordinator['device_token'],
                            $recepientTop['device_token']
                        ];

                        $notification = [
                            'title' => 'Komisi',
                            'body' => 'Komisi sudah transfer, cek di aplikasi!',
                            'bodyMarketing' => 'Closing jamaah ('. $data['nama'] .') berhasil, anda mendapatkan komisi sebesar Rp. '. $data['marketing_fee'],
                            'bodyKoordinator' => 'Agen '. $siMarketing->nama .' telah closing jamaah, anda mendapatkan komisi sebesar Rp. '. $data['koordinator_fee'] .', silahkan kontak koordinator anda untuk verifikasi!',
                            'bodyTop' => 'Komisi sudah di transfer, anda mendapatkan TOP FEE sebesar Rp.'. $data['top_fee'],
                            'priority' => 'high',
                            'sound' => true,
                        ];


                        $sendNotifyMarketing = MasterNotifikasi::create([
                                                                'anggota_id' => $data['marketing'],
                                                                'pesan' => $notification['bodyMarketing'],
                                                                'status' => 'delivered'
                                                                ]);

                        $sendNotifyKoordinator = MasterNotifikasi::create([
                                                                'anggota_id' => $data['koordinator'],
                                                                'pesan' => $notification['bodyKoordinator'],
                                                                'status' => 'delivered'
                                                                ]);

                        $sendNotifyTop = MasterNotifikasi::create([
                                                                'anggota_id' => $data['top'],
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
            }else{
                return redirect()->back()->with('messageError', 'Terjadi kesalahan, cek lagi isi file dalam excel tersebut atau data kosong.');
            }
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}

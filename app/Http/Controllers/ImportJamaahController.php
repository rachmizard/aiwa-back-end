<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jamaah;
use App\User;
use App\LogActivity;
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

                    $idmarketing = $row['id_marketing'];
                    $id_umrah = $row['id_umrah'];
                    $id_jamaah = $row['id_jamaah'];
                    
                    $data['id'] = $row['id'];
                    $data['id_umrah'] = $row['id_umrah'];
                    $data['id_jamaah'] = $row['id_jamaah'];
                    $data['tgl_daftar'] = $row['tgl_daftar'];
                    $data['nama'] = $row['nama'];
                    $data['tgl_berangkat'] = $row['tgl_berangkat'];
                    $data['tgl_pulang'] = $row['tgl_pulang'];
                    $data['marketing'] = $row['id_marketing'];
                    $data['staff'] = $row['staff'];
                    $data['marketing_fee'] = $row['marketing_fee'];
                    $data['koordinator'] = $row['id_koordinator'];
                    $data['koordinator_fee'] = $row['koordinator_fee'];
                    $data['top'] = $row['top'];
                    $data['top_fee'] = $row['top_fee'];
                    $data['status'] = $row['status'];

                    if(!empty($data)) {
                        $validator = Jamaah::where('id', $data['id'])->first();
                        if($validator){
                            DB::table('jamaah')->where('id', $data['id'])->update($data);
                            // Session::put('message', 'Your file is succesfully updated!');
                        }else {
                            $reference = 2250000;
                            $anggota_id = $idmarketing;
                            $findKoordinator = User::where('id', $anggota_id)->first();
                            $findDiskonByMaster = DB::table('master_pendaftaran')->where('id_umrah', $id_umrah)->where('id_jamaah', $id_jamaah)->where('id_marketing', $anggota_id)->first();

                            $refdiskon = $findDiskonByMaster->diskon_marketing;
                            $ref = $reference - $refdiskon;
                            if ($findKoordinator['koordinator'] == 0 ) {
                                $data['marketing_fee'] = $ref;
                                $data['koordinator'] = 0;
                                $data['koordinator_fee'] = 0;
                                $data['top'] = 'SM140';
                                $data['top_fee'] = $ref;
                                $data['diskon_marketing'] = $refdiskon;
                                DB::table('jamaah')->insert($data);
                            }else if($findKoordinator['koordinator'] == 'SM140'){
                                $totalLevel2 = $findKoordinator->fee_reguler - $refdiskon - ($ref - $findKoordinator->fee_reguler - $refdiskon);
                                $data['marketing_fee'] = $findKoordinator->fee_reguler - $refdiskon;
                                $data['koordinator'] = $findKoordinator->koordinator;
                                $data['koordinator_fee'] = $totalLevel2;
                                $data['top'] = 'SM140';
                                $data['top_fee'] = $totalLevel2;
                                $data['diskon_marketing'] = $refdiskon;
                                DB::table('jamaah')->insert($data);              
                            }else{
                                $totalLevel3 = $ref - ($findKoordinator->fee_reguler - $refdiskon + 250000);
                                $data['marketing_fee'] = $findKoordinator->fee_reguler - $refdiskon;
                                $data['koordinator'] = $findKoordinator->koordinator;
                                $data['koordinator_fee'] = $totalLevel3;
                                $data['top'] = 'SM140';  
                                $data['top_fee'] = 250000;
                                $data['diskon_marketing'] = $refdiskon;
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

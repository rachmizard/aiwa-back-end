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

                    $idmarketing = $row['marketing'];
                    
                    $data['id'] = $row['id'];
                    $data['id_umrah'] = $row['id_umrah'];
                    $data['tgl_daftar'] = $row['tgl_daftar'];
                    $data['nama'] = $row['nama'];
                    $data['tgl_berangkat'] = $row['tgl_berangkat'];
                    $data['tgl_pulang'] = $row['tgl_pulang'];
                    $data['marketing'] = $row['marketing'];
                    $data['staff'] = $row['staff'];
                    $data['marketing_fee'] = $row['marketing_fee'];
                    $data['koordinator'] = $row['koordinator'];
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
                            $findKoordinator = User::find($anggota_id);
                            if ($findKoordinator->koordinator == 0 ) {
                                $data['marketing_fee'] = $reference;
                                $data['koordinator'] = 0;
                                $data['koordinator_fee'] = 0;
                                $data['top'] = 1;
                                $data['top_fee'] = $reference;
                                DB::table('jamaah')->insert($data);
                            }else if($findKoordinator->koordinator == 1){
                                $totalLevel2 = $reference - $findKoordinator->fee_reguler;
                                $data['marketing_fee'] = $findKoordinator->fee_reguler;
                                $data['koordinator'] = $findKoordinator->koordinator;
                                $data['koordinator_fee'] = $totalLevel2;
                                $data['top'] = 1;
                                $data['top_fee'] = $totalLevel2;  
                                DB::table('jamaah')->insert($data);              
                            }else{
                                $totalLevel3 = $reference - ($findKoordinator->fee_reguler + 250000);
                                $data['marketing_fee'] = $findKoordinator->fee_reguler;
                                $data['koordinator'] = $findKoordinator->koordinator;
                                $data['koordinator_fee'] = $totalLevel3;
                                $data['top'] = 1;
                                $data['top_fee'] = 250000;    
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

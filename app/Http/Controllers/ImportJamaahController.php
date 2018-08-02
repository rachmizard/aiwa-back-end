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
                    $data['id_jamaah'] = $row['id_jamaah'];
                    $data['tgl_daftar'] = $row['tgl_daftar'];
                    $data['nama'] = $row['nama'];
                    $data['tgl_berangkat'] = $row['tgl_berangkat'];
                    $data['tgl_pulang'] = $row['tgl_pulang'];
                    $data['maskapai'] = $row['maskapai'];
                    $data['marketing'] = $row['marketing'];
                    $data['staff'] = $row['staff'];
                    $data['no_telp'] = $row['no_telp'];
                    $data['bulan_daftar'] = $row['bulan_daftar'];
                    $data['bulan_berangkat'] = $row['bulan_berangkat'];
                    $data['bulan_pulang'] = $row['bulan_pulang'];
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
                            DB::table('jamaah')->insert($data);
                            // Session::put('message', 'Your file is succesfully imported!');
                        }
                    }
                }
            });
        }
        return back();
    }
}

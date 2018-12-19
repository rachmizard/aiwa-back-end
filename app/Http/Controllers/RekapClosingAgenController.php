<?php

namespace App\Http\Controllers;

use App\Http\Resources\RekapClosingAgenResource;
use App\Jamaah;
use App\User;
use App\Master_Jadwal;
use App\Rekap;
use App\Periode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapClosingExport;
use DB;

class RekapClosingAgenController extends Controller
{

    public function exportClosing(Request $request)
    {
        ini_set('max_execution_time', 600);
        $periode = $request->periode;
        $start = $request->start;
        $end = $request->end;
        DB::table('rekap_jamaah')->where('periode', $periode)->delete();
        $anggotas = User::where('status', 1)->get();
        foreach ($anggotas as $anggota) {
            $data['anggota_id'] = $anggota->id;
            $data['total'] = Jamaah::where('marketing', $anggota->id)->where('periode', $periode)->count();
            $data['periode'] = $periode;
            DB::table('rekap_jamaah')->insert($data);
        }
        return Excel::download(new RekapClosingExport($periode, $start, $end), 'rekap_closing_jamaah_'. $periode .'_'. $start .'_'. $end .'.xlsx');
    }

    public function contoh()
    {
    	return RekapClosingAgenResource::collection(User::all());
    }

    public function sinkron()
    {
        // disable query log
        DB::disableQueryLog();
        // INi akan mengambil master periode yang aktif
        $periode = Periode::where('status_periode', 'active')->value('judul');
        // Insert Total into rekap_jamaah Table
        DB::table('rekap_jamaah')->where('periode', $periode)->delete();
        DB::table('total_rekap_per_tanggal')->where('periode', $periode)->delete();
        $anggotas = User::where('status', 1)->get();
        $data = array();
        foreach ($anggotas as $anggota) {
            $data['anggota_id'] = $anggota->id;
            $data['total'] = Jamaah::where('marketing', $anggota->id)->where('periode', $periode)->count();
            $data['periode'] = $periode;
            DB::table('rekap_jamaah')->insert($data);
        }


        // DB::table('rekap_jamaah')->where('periode', $periode)->delete();
        // $anggotas = User::where('status', 1)->get();
        // $master_jadwals = Master_Jadwal::where('periode', $periode)->get();
        // $datapertanggal = array();
        // foreach ($anggotas as $anggota) {
        //     $data['anggota_id'] = $anggota->id;
        //     $data['total'] = Jamaah::where('marketing', $anggota->id)->where('periode', $periode)->count();
        //     $data['periode'] = $periode;
        //     DB::table('rekap_jamaah')->insert($data);   
        //     foreach ($master_jadwals as $master_jadwal) {
        //         $datapertanggal['tgl_berangkat'] = $master_jadwal->tgl_berangkat;
        //         $datapertanggal['anggota_id'] = $anggota->id;
        //         $datapertanggal['total'] = DB::table('jamaah')->where('marketing', $anggota->id)->where('tgl_berangkat', $master_jadwal->tgl_berangkat)->count();
        //         $datapertanggal['periode'] = $periode;
        //         // Insert total per/date into total_rekap_per_tanggal 
        //         DB::table('total_rekap_per_tanggal')->insert($datapertanggal);
        //     }
        // }


        return redirect()->back()->with('message', 'Sinkron rekap berhasil di lakukan!');
    }
}

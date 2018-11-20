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
        // INi akan mengambil master periode yang aktif
        $periode = Periode::where('status_periode', 'active')->value('judul');
        DB::table('rekap_jamaah')->where('periode', $periode)->delete();
        $anggotas = User::where('status', 1)->get();
        foreach ($anggotas as $anggota) {
            $data['anggota_id'] = $anggota->id;
            $data['total'] = Jamaah::where('marketing', $anggota->id)->where('periode', $periode)->count();
            $data['periode'] = $periode;
            DB::table('rekap_jamaah')->insert($data);
        }
        return redirect()->back()->with('message', 'Sinkron rekap berhasil di lakukan!');
    }
}

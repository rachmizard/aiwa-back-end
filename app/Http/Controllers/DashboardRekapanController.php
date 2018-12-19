<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jamaah;
use App\Rekap;
use App\Master_Jadwal;
use App\Http\Resources\DashboardRekapanResource;
use App\Http\Resources\AgenWithRekapResource;
use App\Http\Resources\TotalByTglBerangkatResource;
use DB;

class DashboardRekapanController extends Controller
{
    public function getJadwalUnique(Request $request)
    {
    	$tgl_berangkat = array();
        $jadwal_pikasebeuleun = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->where('periode', $request->requestPeriode)->whereBetween('tgl_berangkat', [$request->requestStartDate, $request->requestEndDate])->get();
        return TotalByTglBerangkatResource::collection($jadwal_pikasebeuleun)->unique('tgl_berangkat');
    }

    public function getAllAgents(Request $request)
    {
    	$all_agen = Rekap::with('anggota')->orderBy('total', 'DESC')->where('periode', $request->requestPeriode)->get();
    	// return response()->json(['data' => $all_agen]);
        return AgenWithRekapResource::collection($all_agen);
    }

    public function countRekapan(Request $request)
    {
    	$tgl_berangkat = array();
        $periode = $request->requestPeriode;
        $start = $request->requestStartDate;
        $end = $request->requestEndDate;
        $jadwal_pikasebeuleun = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->where('periode', $periode)->whereBetween('tgl_berangkat', [$start, $end])->get();
        // foreach ($jadwal_pikasebeuleun as $value) {
        //     $tgl_berangkat[] = $value->tgl_berangkat;
        // }
        foreach ($jadwal_pikasebeuleun as $value) {
            $tgl_berangkat[] = $value->tgl_berangkat;
        }

        $unique_data = array_unique($tgl_berangkat);
    	$countRekapan = array();
    	$all_agens = Rekap::orderBy('total', 'DESC')->where('periode', $periode)->get();
        		foreach ($unique_data as $on) {
                    foreach ($all_agens as $agen) {
                        $countRekapan[] = DB::table('total_rekap_per_tanggal')
                                            ->where('anggota_id', $agen->anggota_id)
                                            ->whereBetween('tgl_berangkat', [$on, $on])
                                            ->where('periode', $periode)
                                            ->first();
                    }
        		}

    	// // dd($unique_data);
    	return response()->json(['data' => $countRekapan]);
        // return DashboardRekapanResource::collection(Rekap::orderBy('total', 'DESC')->where('periode', $periode)->get());

    }

    public function getTotalByParams(Request $request)
    {
        $periode = Periode::where('status_periode', 'active')->value('judul');
        return DB::table('total_rekap_per_tanggal')->where('anggota_id', $request->anggota_id)
                                                   ->where('tgl_berangkat', $request->tgl_berangkat)
                                                   ->where('periode', $periode)->get();
    }

    public function countTotalByBetween(Request $request)
    {
        $countTotalByBetween['total'] = Jamaah::where('marketing', $request->anggota_id)->where('periode', $request->periode)->whereBetween('tgl_berangkat', [$request->start, $request->end])->count();
        return response()->json(['response' => $countTotalByBetween]);
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Master_Jadwal;
use App\Jamaah;
use App\Rekap;
use DB;

class DashboardRekapanResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            // 'anggota_id' => $this->anggota_id,
            // // 'tgl_berangkat' => $this->tgl_berangkat($request->requestStartDate, $request->requestEndDate),
            // 'tgl_berangkat' => $this->tgl_berangkat,
            // 'total' => $this->total($this->anggota_id, $request->requestPeriode, $request->requestStartDate, $request->requestEndDate)
            // $this->total => $this->total($this->anggota_id, $request->requestPeriode, $request->requestStartDate, $request->requestEndDate)
        ];
    }

    public function total($anggota_id, $requestPeriode, $requestStartDate, $requestEndDate)
    {
        
        // $tgl_berangkat = array();
        // $jadwal_pikasebeuleun = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->where('periode', $requestPeriode)->whereBetween('tgl_berangkat', [$requestStartDate, $requestEndDate])->get();
        // foreach ($jadwal_pikasebeuleun as $value) {
        //     $tgl_berangkat[] = $value->tgl_berangkat;
        // }
        // $unique_data = array_unique($tgl_berangkat);
        // $countRekapan = array();
        // $all_agens = Rekap::with('anggota')->orderBy('total', 'DESC')->where('periode', $requestPeriode)->get();

        //     foreach ($all_agens as $value) {    
        //         foreach ($unique_data as $on) {
        //             $countRekapan[] = DB::table('total_rekap_per_tanggal')->where('anggota_id', $value->anggota_id)->whereDate('tgl_berangkat', $on)->where('periode', $requestPeriode)->(); 
        //         }
        //     }

        // // return $countRekapan;

        // $total_rekap_per_tanggals = DB::table('total_rekap_per_tanggal')->where('anggota_id', $this->anggota_id)->where('periode', $requestPeriode)->whereBetween('tgl_berangkat', [$requestStartDate, $requestEndDate])->get();

        // $countRekapan = array();
        // foreach ($total_rekap_per_tanggals as $value) {
        //     $countRekapan[] = $value->total;
        // }

        // return $countRekapan;
    }
}

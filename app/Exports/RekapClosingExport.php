<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Master_Jadwal;
use App\User;
use App\Jamaah;
use App\Rekap;
use App\Http\Resources\RekapClosingAgenResource;

class RekapClosingExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $periode)
    {
    	$this->periode = $periode;
    }

    public function view(): View
    {
        $users = User::pluck('id')->toArray();
        $datas = Jamaah::where('periode', $this->periode)->get();
        $list_agen = Rekap::orderBy('total', 'DESC')->where('periode', $this->periode)->get();
        $sum_total = Rekap::where('periode', $this->periode)->sum('total');
        $this_periode = $this->periode;
        $jadwal = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->where('periode', $this->periode)->get();
        return view('jamaah.rekap', ['list_agen' => $list_agen, 'jadwal' => $jadwal, 'users' => $users, 'datas' => $datas, 'this_periode' => $this_periode, 'sum_total' => $sum_total]);
    }
}

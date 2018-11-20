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
    public function __construct(int $periode, $start, $end)
    {
        $this->periode = $periode;
        $this->start = $start;
    	$this->end = $end;
    }

    public function view(): View
    {
        $users = User::pluck('id')->toArray();
        $datas = Jamaah::where('periode', $this->periode)->get();
        $list_agen = Rekap::orderBy('total', 'DESC')->where('periode', $this->periode)->get();
        $this_periode = $this->periode;
        $jadwal = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->where('periode', $this_periode)->whereBetween('tgl_berangkat', [$this->start, $this->end])->get();

        $tgl_berangkat = array();
        foreach ($jadwal as $value) {
            $tgl_berangkat[] = $value->tgl_berangkat;
        }
        $unique_data = array_unique($tgl_berangkat);
        $count = array();
        $total_by_periode = array();
        $total_by_between = Jamaah::where('periode', $this_periode)->whereBetween('tgl_berangkat', [$this->start, $this->end])->count();
        $start = $this->start;
        $end = $this->end;
        return view('jamaah.rekap', ['list_agen' => $list_agen, 'unique_data' => $unique_data, 'users' => $users, 'datas' => $datas, 'this_periode' => $this_periode, 'count' => $count, 'total_by_periode' => $total_by_periode, 'total_by_between' => $total_by_between, 'start' => $start, 'end' => $end]);
    }
}

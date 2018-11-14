<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Master_Jadwal;
use App\User;
use App\Jamaah;
use App\Http\Resources\RekapClosingAgenResource;

class RekapClosingExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $users = User::pluck('id')->toArray();
        $datas = Jamaah::where('periode', '1440')->get();
        $list_agen = User::where('status', 1)->get();
        $jadwal = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->get();
        return view('jamaah.rekap', ['list_agen' => $list_agen, 'jadwal' => $jadwal, 'users' => $users, 'datas' => $datas]);
    }
}

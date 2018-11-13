<?php

namespace App\Http\Controllers;

use App\Http\Resources\RekapClosingAgenResource;
use App\Jamaah;
use App\User;
use App\Master_Jadwal;
use Illuminate\Http\Request;
use Excel;


class RekapClosingAgenController extends Controller
{

    public function exportClosing()
    {
    	$data = Master_Jadwal::get();
    	$agents = User::where('status', 1)->get()->toArray();
    	$countTotal = RekapClosingAgenResource::collection(User::all());
    	$totalCount = count($countTotal);
        return Excel::create('laravelcode', function($excel) use ($data, $agents, $countTotal, $totalCount) {
            $excel->sheet('mySheet', function($sheet) use ($data, $agents, $countTotal, $totalCount)
            {
                $sheet->loadView('jamaah.rekap', array('jadwals' => $data, 'agents' => $agents, 'count' => $countTotal, 'itung' => $totalCount));
            });
        })->download('xlsx');
    }

    public function contoh()
    {
    	return RekapClosingAgenResource::collection(User::all());
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\RekapClosingAgenResource;
use App\Jamaah;
use App\User;
use App\Master_Jadwal;
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
        return Excel::download(new RekapClosingExport($periode), 'rekap_closing_jamaah_'. $periode .'.xlsx');
    }

    public function contoh()
    {
    	return RekapClosingAgenResource::collection(User::all());
    }
}

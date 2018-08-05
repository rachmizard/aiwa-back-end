<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jamaah;
use App\User;
use Response;
use Excel;

class DownloadFormatExcelController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function downloadFormatJamaah(Request $request, $type)
    {
    	$data = User::get()->toArray();
        return Excel::create('format_jamaah', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

}

<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jamaah;
use App\User;
use App\LogActivity;
use App\Periode;
use App\MasterNotifikasi;
use Auth;
use Carbon\Carbon;
use App\Imports\JamaahImport;
use App\Exports\DownloadSemuaJamaahExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ImportJamaahController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function downloadExcel()
    {
        return Excel::download(new DownloadSemuaJamaahExport, 'data_jamaah_all.xlsx');
    }

    public function importExcelJamaah(Request $request)
    {
        Excel::import(new JamaahImport, request()->file('import_file_jamaah'));
        return redirect()->back();
    }
}

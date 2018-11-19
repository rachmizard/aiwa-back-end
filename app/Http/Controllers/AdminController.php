<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Exports\ExportAgen;
use App\Exports\ImportAgen;
use App\Admin;
use App\Periode;
use Carbon\Carbon;
use App\LogActivity;
use App\User;
use App\Rekap;
use App\Jamaah;
use App\Master_Jadwal;
use App\Prospek;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use fcm;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $totalAgen = User::where('status', '=', '1')->get();
        $totalProspek = Prospek::all();
        $periodes = Periode::all();
        // Chart Query
        if ($request->periode && $request->agen) {
        $selectRequest = $request->agen;
                //  $now = Carbon::now();
                // $year = $now->year;
                // $month = $now->month;
                // $day = $now->day;
                // $tahunNow = Carbon::create($year, $month, $day);
                // $period = Periode::whereBetween('start', [$tahunNow->copy()->startOfYear(), $tahunNow->copy()->endOfYear()])->first();

                // Start Script Chart Graph by Period
                $getIdPeriode = Periode::where('judul', '=', $request->input('periode'))->first();
                $varJay = Periode::find($getIdPeriode->id);
                $startDateJing = $varJay->start;
                $endDateJing = $varJay->end;
                $idPeriode = $varJay->id;
                $totalJamaah = Jamaah::where('marketing', $request->agen)->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->get();
                $totalJamaahChart = Jamaah::where('marketing', $request->agen)->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->count();
                // Mulai perhitungan potensi
                // Ini proses pengambilan data marketing fee nya 
                $ambilMarketingFeePotensi = Jamaah::where('marketing', $request->agen)->where('status', '=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('marketing_fee');
                // Ini proses pengambilan data koordinator fee nya 
                $ambilKoordinatorFeePotensi = Jamaah::where('koordinator', $request->agen)->where('status', '=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('koordinator_fee');
                // Ini proses pengambilan data top fee nya
                $ambilTopFeePotensi = Jamaah::where('top', $request->agen)->where('status', '=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('top_fee');
                // Penjumlahan hasil pengambilan data di atas
                $sumofPotensi = $ambilMarketingFeePotensi + $ambilKoordinatorFeePotensi + $ambilTopFeePotensi;
                // Akhir Perhitungan potensi

                // Mulai perhitungan komisi
                $ambilMarketingFeeKomisi = Jamaah::where('marketing', $request->agen)->where('status', '!=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('marketing_fee');
                // Ini proses pengambilan data koordinator fee nya 
                $ambilKoordinatorFeeKomisi = Jamaah::where('koordinator', $request->agen)->where('status', '!=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('koordinator_fee');
                // Ini proses pengambilan data top fee nya
                $ambilTopFeeKomisi = Jamaah::where('top', $request->agen)->where('status', '!=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('top_fee');
                // Penjumlahan hasil pengambilan data di atas
                $sumofKomisi = $ambilMarketingFeeKomisi  + $ambilKoordinatorFeeKomisi + $ambilTopFeeKomisi;
                // Akhirt perhitungan komisi

                // Chart Prospek
                $stats = Prospek::whereBetween('created_at', [$startDateJing, $endDateJing])
                ->groupBy('month')
                ->orderBy('month', 'DESC')
                ->get([
                    DB::raw('DATE_FORMAT(created_at, "%M") as month'),
                    DB::raw('COUNT(*) as value')
                ])
                ->toJSON();

                $totalProspekChart = Prospek::where('anggota_id', $request->agen)->whereBetween('created_at', [$startDateJing, $endDateJing])->count();

                // Chart Jamaah
                $statsJamaahJanuary = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '1')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahFebruary = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '2')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahMarch = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '3')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahApril = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '4')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahMei = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '5')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahJune = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '6')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahJuly = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '7')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahAugust = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '8')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahSeptember = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '9')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahOctober = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '10')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahNovember = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '11')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahDesember = Jamaah::where('marketing', $request->agen)->whereMonth('tgl_berangkat', '12')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                // ->groupBy(['month', 'number_month'])
                // ->orderBy('number_month')
                // ->get([
                //     DB::raw('DATE_FORMAT(created_at, "%M") as month'),
                //     DB::raw('MONTH(tgl_berangkat) as number_month'),
                //     DB::raw('COUNT(*) as value')
                // ])
                // ->toJSON();

                // Chart Prospek

                $statsProspekJanuary = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '1')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekFebruary = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '2')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekMarch = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '3')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekApril = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '4')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekMei = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '5')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekJune = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '6')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekJuly = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '7')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekAugust = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '8')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekSeptember = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '9')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekOctober = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '10')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekNovember = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '11')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekDesember = Prospek::where('anggota_id', $request->agen)->whereMonth('created_at', '12')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();


                $jadwals = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->where('periode', Periode::where('status_periode', 'active')->value('judul'))->get();
            
                if ($request->input('periodeRekap')) {
                    $requestPeriode = $request->input('periodeRekap');
                }else{
                    $requestPeriode = Periode::where('status_periode', 'active')->value('judul');
                }

                if($request->input('start')){
                    $requestStartDate = $request->input('start');
                }else{
                    $requestStartDate = '';
                } 

                if($request->input('end')){
                    $requestEndDate = $request->input('end');
                }else{
                    $requestEndDate = '';
                }

                if($request->input('menampilkan')){
                    $requestMenampilkan = $request->input('menampilkan');
                }else{
                    $requestMenampilkan = 5;
                }
                $users = User::pluck('id')->toArray();
                $datas = Jamaah::where('periode', $requestPeriode)->get();
                $list_agen = Rekap::orderBy('total', 'DESC')->where('periode', $requestPeriode)->get();
                $all_agen = Rekap::orderBy('total', 'DESC')->where('periode', $requestPeriode)->get();
                $this_periode = '1440';
                $jadwal_pikasebeuleun = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->where('periode', $requestPeriode)->whereBetween('tgl_berangkat', [$requestStartDate, $requestEndDate])->get();
                $count = array();
                $total_by_periode = array();
                $total_by_between = Jamaah::where('periode', $requestPeriode)->whereBetween('tgl_berangkat', [$requestStartDate, $requestEndDate])->count();
                $start = $requestStartDate;
                $end = $requestEndDate;

                return view('home', compact('totalAgen', 'totalJamaah', 'totalProspek', 'sumofPotensi', 'sumofKomisi', 'periodes', 'totalJamaahChart', 'stats', 'statsJamaah', 'totalProspekChart', 'idPeriode', 'varJay', 'statsJamaahJanuary', 'statsJamaahFebruary', 'statsJamaahMarch', 'statsJamaahApril', 'statsJamaahMei', 'statsJamaahJune', 'statsJamaahJuly', 'statsJamaahAugust', 'statsJamaahSeptember' ,'statsJamaahOctober', 'statsJamaahNovember', 'statsJamaahDesember', 'statsProspekJanuary', 'statsProspekFebruary', 'statsProspekMarch', 'statsProspekApril', 'statsProspekMei', 'statsProspekJune', 'statsProspekJuly', 'statsProspekAugust', 'statsProspekSeptember', 'statsProspekOctober', 'statsProspekNovember', 'statsProspekDesember', 'selectRequest', 'jadwals', 'users', 'datas', 'list_agen', 'this_periode', 'jadwal_pikasebeuleun', 'count', 'total_by_periode', 'total_by_between', 'start', 'end', 'all_agen', 'requestPeriode', 'requestStartDate', 'requestEndDate', 'requestMenampilkan'));  
            }else{
                $selectRequest = 'SM140';
                $now = Carbon::now();
                $year = $now->year;
                $month = $now->month;
                $day = $now->day;
                $tahunNow = Carbon::create($year, $month, $day);
                $period = Periode::whereBetween('start', [$tahunNow->copy()->startOfYear(), $tahunNow->copy()->endOfYear()])->first();
                $idPeriode = $period->id;
                $varJay = Periode::find($period->id);
                $startDateJing = $varJay->start;
                $endDateJing = $varJay->end;
                $totalJamaah = Jamaah::where('marketing', 'SM140')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->get();
                $totalJamaahChart = Jamaah::where('marketing', 'SM140')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->count();


                // Mulai perhitungan potensi
                // Ini proses pengambilan data marketing fee nya 
                $ambilMarketingFeePotensi = Jamaah::where('marketing', 'SM140')->where('status', '=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('marketing_fee');
                // Ini proses pengambilan data koordinator fee nya 
                $ambilKoordinatorFeePotensi = Jamaah::where('koordinator', 'SM140')->where('status', '=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('koordinator_fee');
                // Ini proses pengambilan data top fee nya
                $ambilTopFeePotensi = Jamaah::where('top', 'SM140')->where('status', '=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('top_fee');
                // Penjumlahan hasil pengambilan data di atas
                $sumofPotensi = $ambilMarketingFeePotensi  + $ambilKoordinatorFeePotensi + $ambilTopFeePotensi;
                // Akhir Perhitungan potensi

                // Mulai perhitungan komisi
                $ambilMarketingFeeKomisi = Jamaah::where('marketing', 'SM140')->where('status', '!=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('marketing_fee');
                // Ini proses pengambilan data koordinator fee nya 
                $ambilKoordinatorFeeKomisi = Jamaah::where('koordinator', 'SM140')->where('status', '!=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('koordinator_fee');
                // Ini proses pengambilan data top fee nya
                $ambilTopFeeKomisi = Jamaah::where('top', 'SM140')->where('status', '!=', 'POTENSI')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->where('periode', $varJay->judul)->sum('top_fee');
                // Penjumlahan hasil pengambilan data di atas
                $sumofKomisi = $ambilMarketingFeeKomisi  + $ambilKoordinatorFeeKomisi + $ambilTopFeeKomisi;
                // Akhirt perhitungan komisi

                // Chart Prospek
                $stats = Prospek::whereBetween('created_at', [$startDateJing, $endDateJing])
                ->groupBy('month')
                ->orderBy('month', 'DESC')
                ->get([
                    DB::raw('DATE_FORMAT(created_at, "%M") as month'),
                    DB::raw('COUNT(*) as value')
                ])
                ->toJSON();

                $totalProspekChart = Prospek::where('anggota_id', 'SM140')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();

                // Chart Jamaah
                $statsJamaahJanuary = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '1')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahFebruary = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '2')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahMarch = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '3')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahApril = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '4')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahMei = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '5')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahJune = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '6')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahJuly = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '7')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahAugust = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '8')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahSeptember = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '9')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahOctober = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '10')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahNovember = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '11')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();
                $statsJamaahDesember = Jamaah::where('marketing', 'SM140')->whereMonth('tgl_berangkat', '12')->whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])->count();

                // $statsJamaah = Jamaah::whereBetween('tgl_berangkat', [$startDateJing, $endDateJing])
                // ->groupBy(['month', 'number_month'])
                // ->orderBy('number_month')
                // ->get([
                //     DB::raw('DATE_FORMAT(created_at, "%M") as month'),
                //     DB::raw('MONTH(tgl_berangkat) as number_month'),
                //     DB::raw('COUNT(*) as value')
                // ])
                // ->toJSON();

                // Chart Prospek

                $statsProspekJanuary = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '1')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekFebruary = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '2')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekMarch = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '3')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekApril = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '4')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekMei = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '5')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekJune = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '6')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekJuly = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '7')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekAugust = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '8')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekSeptember = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '9')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekOctober = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '10')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekNovember = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '11')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekDesember = Prospek::where('anggota_id', 'SM140')->whereMonth('created_at', '12')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();


                $jadwals = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->where('periode', Periode::where('status_periode', 'active')->value('judul'))->get();
            
                if ($request->input('periodeRekap')) {
                    $requestPeriode = $request->input('periodeRekap');
                }else{
                    $requestPeriode = Periode::where('status_periode', 'active')->value('judul');
                }

                if($request->input('start')){
                    $requestStartDate = $request->input('start');
                }else{
                    $requestStartDate = '';
                } 

                if($request->input('end')){
                    $requestEndDate = $request->input('end');
                }else{
                    $requestEndDate = '';
                }

                if($request->input('menampilkan')){
                    $requestMenampilkan = $request->input('menampilkan');
                }else{
                    $requestMenampilkan = '';
                    if ($request->input('menampilkan') == 0) {
                      $requestMenampilkan = $request->input('menampilkan');  
                    }else{
                      $requestMenampilkan = 5;
                    }
                }
                $users = User::pluck('id')->toArray();
                $datas = Jamaah::where('periode', $requestPeriode)->get();
                $list_agen = Rekap::orderBy('total', 'DESC')->where('periode', $requestPeriode)->get();
                $all_agen = Rekap::orderBy('total', 'DESC')->where('periode', $requestPeriode)->get();
                $this_periode = '1440';
                $jadwal_pikasebeuleun = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->where('periode', $requestPeriode)->whereBetween('tgl_berangkat', [$requestStartDate, $requestEndDate])->get();
                $count = array();
                $total_by_periode = array();
                $total_by_between = Jamaah::where('periode', $requestPeriode)->whereBetween('tgl_berangkat', [$requestStartDate, $requestEndDate])->count();
                $start = $requestStartDate;
                $end = $requestEndDate;

                return view('home', compact('totalAgen', 'totalJamaah', 'totalProspek', 'sumofPotensi', 'sumofKomisi', 'periodes', 'totalJamaahChart', 'stats', 'statsJamaah', 'totalProspekChart', 'idPeriode', 'varJay', 'statsJamaahJanuary', 'statsJamaahFebruary', 'statsJamaahMarch', 'statsJamaahApril', 'statsJamaahMei', 'statsJamaahJune', 'statsJamaahJuly', 'statsJamaahAugust', 'statsJamaahSeptember' ,'statsJamaahOctober', 'statsJamaahNovember', 'statsJamaahDesember', 'statsProspekJanuary', 'statsProspekFebruary', 'statsProspekMarch', 'statsProspekApril', 'statsProspekMei', 'statsProspekJune', 'statsProspekJuly', 'statsProspekAugust', 'statsProspekSeptember', 'statsProspekOctober', 'statsProspekNovember', 'statsProspekDesember', 'selectRequest', 'jadwals', 'users', 'datas', 'list_agen', 'this_periode', 'jadwal_pikasebeuleun', 'count', 'total_by_periode', 'total_by_between', 'start', 'end', 'all_agen', 'requestPeriode', 'requestStartDate', 'requestEndDate', 'requestMenampilkan'));   
            }
    }

    public function sendNotify($token)
    {
        $dt = Carbon::create(2018, 8, 8, 3);
        $dt->addMinutes('5');
        $timeEnd = Carbon::now();
        // $now = Carbon::create('');
        // $now->addSeconds('8');
        if ($timeEnd > $dt) {
            
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            $token = $token;
            

            $notification = [
                'body' => 'Anda mendapatkan komisi, cek segera!',
                'sound' => true,
            ];
            
            $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

            $fcmNotification = [
                //'registration_ids' => $tokenList, //multple token array
                'to'        => $token, //single token
                'notification' => $notification,
                'data' => $extraNotificationData
            ];

            $headers = [
                'Authorization: key=AIzaSyBd3fkYDybtqT7RmEkz8-nm6FbnSkW1tkA',
                'Content-Type: application/json'
            ];


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
            $result = curl_exec($ch);
            curl_close($ch);


            return response()->json($result);
        }else{
            return 'wait until '. $dt;
        }
    }

    public function approval()
    {
        Auth()->guard('admin')->user()->unreadNotifications->markAsRead();
        return view('approval.index');
    }
    /**
    * For upload
    **/

    public function showImportForm(Request $request)
    {
        return view('agen.import');
    }

    // Export Coding
    public function downloadExcel($type)
    {
        return Excel::download(new ExportAgen, 'data_agen_all.xlsx');
    }

    // Import COding
    public function importExcel(Request $request)
    {
        Excel::import(new ImportAgen, request()->file('import_file'));
        return redirect()->route('aiwa.anggota');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function logout(Request $request)
    {
            Carbon::setLocale(config('app.locale'));
        // send a log
        LogActivity::create([
            'subjek' => 'Logout dari website.',
            'user_id' => Auth::guard('admin')->user()->id,
            'tanggal' => Carbon::now()
        ]);
        $userActivity = Admin::find(Auth::guard('admin')->user()->id);
        $userActivity->last_login = Carbon::now();
        $userActivity->save();
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route( 'admin.login' );
    }
}

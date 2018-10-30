<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Jamaah;
use App\Periode;
use DB;
use App\Admin;
use App\Http\Resources\JadwalResource;
use App\Master_Jadwal;
use Yajra\Datatables\Datatables;

class JadwalController extends Controller
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
            // $now = Carbon::now();
            // $year = $now->year;
            // $month = $now->month;
            // $day = $now->day;
            // $tahunNow = Carbon::create($year, $month, $day);
            // $period = Periode::whereBetween('start', [$tahunNow->copy()->startOfYear(), $tahunNow->copy()->endOfYear()])->first();
            // if ($request->periode) {
            //     // Get Periode Model
            //     $periodes = Periode::orderBy('created_at', 'DESC')->get();
            //     $url = 'http://115.124.86.218/aiw/jadwal/'.$request->periode;
            //     $json = file_get_contents($url);
            //     $jadwals = collect(json_decode($json, true));
            //     try {
            //         $test = $jadwals['data'];
            //         $count = count($test);
            //         $itungPaket = $jadwals['data'][0]['jadwal'][0]['paket'];
            //         $countPaket = count($itungPaket);
            //     }catch (Exception $e) {
            //         throw new \App\Exceptions\CustomException($e);
            //     }
            //     return view('jadwal.index', compact('jadwals', 'test', 'count','countPaket', 'periodes'));
            // }else{
            //     // Get Periode Model
            //     $periodes = Periode::orderBy('created_at', 'DESC')->get();
            //     $url = 'http://115.124.86.218/aiw/jadwal/'.$period->judul;
            //     $json = file_get_contents($url);
            //     $jadwals = collect(json_decode($json, true));
            //     $test = $jadwals['data'];
            //     $count = count($test);
            //     $itungPaket = $jadwals['data'][0]['jadwal'][0]['paket'];
            //     $countPaket = count($itungPaket);
            //     return view('jadwal.index', compact('jadwals', 'test', 'count','countPaket', 'periodes'));
            // }
                $jadwals = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->get();
                $count = count($jadwals);

                return view('jadwal.index', compact('jadwals', 'test', 'count','countPaket', 'periodes'));

    }

    public function jadwalJson(Datatables $datatables)
    {
          $var = Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->get();
          return $datatables->of($var)
          ->addColumn('action', function($action){
            return '<a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#paket'. $action->id_jadwal .'">Lihat Paket</a>
            <a class="btn btn-sm btn-success" href="'. $action->itinerary .'">Download Itinerary</a>';
          })
          ->editColumn('tgl_berangkat', function($check){
            if ($check->promo == '1') {
              return Carbon::parse($check->tgl_berangkat)->format('d/m/Y') . ' <span class="badge badge-sm bg-success">P</span>';
            }else{
              return Carbon::parse($check->tgl_berangkat)->format('d/m/Y');
            }
          })
          ->editColumn('tgl_pulang', function($check){
              return Carbon::parse($check->tgl_pulang)->format('d/m/Y');
          })
          ->editColumn('tgl_manasik', function($check){
              return Carbon::parse($check->tgl_manasik)->format('d/m/Y');
          })
          ->editColumn('jml_hari', function($check){
              return $check->jml_hari. ' hari';
          })
          ->rawColumns(['action', 'tgl_berangkat', 'tgl_pulang', 'tgl_manasik'])
          ->make(true);
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
}

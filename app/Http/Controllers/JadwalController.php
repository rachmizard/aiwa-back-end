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
                $periodes = Periode::all();

                return view('jadwal.index', compact('jadwals', 'test', 'count','countPaket', 'periodes'));

    }

    public function jadwalJson(Request $request)
    {
          $var = Master_Jadwal::select([
            'id_jadwal',
            'promo',
            'tgl_berangkat',
            'jam_berangkat',
            'rute_berangkat',
            'pesawat_berangkat',
            'tgl_pulang',
            'jam_pulang',
            'rute_pulang',
            'pesawat_pulang',
            'maskapai',
            'jml_hari',
            'seat_total',
            'seat_terpakai',
            'sisa',
            'passpor',
            'moffa',
            'visa',
            'status',
            'tgl_manasik',
            'jam_manasik',
            'itinerary',
            'paket'
          ]);
          return Datatables::of($var)
          ->addColumn('action', function($action){
            return '<a class="btn btn-sm btn-info" data-toggle="modal" data-target="#paket'. $action->id_jadwal .'">Lihat Paket</a>
            <a class="btn btn-sm btn-success" href="'. $action->itinerary .'">Download Itinerary</a>';
          })
          ->editColumn('tgl_berangkat', function($check){
            if ($check->promo == '1') {
              return $check->tgl_berangkat . ' <span class="badge badge-sm bg-success">P</span>';
            }else{
              return $check->tgl_berangkat;
            }
          })
          ->editColumn('status', function($check){
              if ($check->status === 'AVAILABLE') {
                return '<span class="label bg-success label-sm">AVAILABLE</span>';
              }elseif($check->status === 'SOLD OUT') {
                return '<span class="label label-default label-sm">SOLD OUT</span>';
              }
          })
          ->filter(function($query) use ($request){
            if (request()->get('periodeJadwal')) {
              if (request()->get('periodeJadwal') == 'All') {
                return $query->select('master_jadwals.*');
              }
              return $query->where('periode', request()->get('periodeJadwal'))->get();
            }
          }, true)
          ->rawColumns(['action', 'tgl_berangkat', 'tgl_pulang', 'tgl_manasik', 'status'])
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

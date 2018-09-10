<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Jamaah;
use App\Periode;
use DB;
use App\Admin;

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
            $now = Carbon::now();
            $year = $now->year;
            $month = $now->month;
            $day = $now->day;
            $tahunNow = Carbon::create($year, $month, $day);
            $period = Periode::whereBetween('start', [$tahunNow->copy()->startOfYear(), $tahunNow->copy()->endOfYear()])->first();
            if ($request->periode) {
                // Get Periode Model
                $periodes = Periode::orderBy('created_at', 'DESC')->get();
                $url = 'http://115.124.86.218/aiw/jadwal/'.$request->periode;
                $json = file_get_contents($url);
                $jadwals = collect(json_decode($json, true));
                $test = $jadwals['data'];
                $count = count($test);
                $itungPaket = $jadwals['data'][0]['jadwal'][0]['paket'];
                $countPaket = count($itungPaket);
                return view('jadwal.index', compact('jadwals', 'test', 'count','countPaket', 'periodes'));
            }else{
                // Get Periode Model
                $periodes = Periode::orderBy('created_at', 'DESC')->get();
                $url = 'http://115.124.86.218/aiw/jadwal/'.$period->judul;
                $json = file_get_contents($url);
                $jadwals = collect(json_decode($json, true));
                $test = $jadwals['data'];
                $count = count($test);
                $itungPaket = $jadwals['data'][0]['jadwal'][0]['paket'];
                $countPaket = count($itungPaket);
                return view('jadwal.index', compact('jadwals', 'test', 'count','countPaket', 'periodes'));
            }
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

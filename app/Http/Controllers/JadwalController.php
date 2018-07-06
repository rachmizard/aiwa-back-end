<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $url = 'http://115.124.86.218/aiw/jadwal/1440';
        $json = file_get_contents($url);
        $jadwals = collect(json_decode($json, true));
        
        // dd($jadwals['data'][1]['jadwal']); // Ieu bisa
        // return view('test-api', compact('jadwals'));
        $test = $jadwals['data'];
        $count = count($test);
        $itungPaket = $jadwals['data'][0]['jadwal'][0]['paket'];
        $countPaket = count($itungPaket);
        // for ($i=0; $i < $countPaket ; $i++) { 
        //     foreach ($jadwals['data'][$i] as $key) {
        //         dd($key);
        //     }
        // }
        // $itungPaket = $jadwals['data'][0]['jadwal'][0]['paket'];
        // foreach ($itungPaket as $hasilPaket) {
        //     // dd($hasilPaket['kamar']);
        // }
        return view('jadwal.index', compact('jadwals', 'test', 'count','countPaket'));
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

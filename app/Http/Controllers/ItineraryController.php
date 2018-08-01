<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterItinerary;
use Yajra\Datatables\Datatables;

class ItineraryController extends Controller
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
        return view('itinerary.index', compact('jadwals', 'test', 'count','countPaket'));
    }

    public function getData(){
        return Datatables::of(MasterItinerary::all())->addColumn('action', function($itinerary){
             return '
                <a href="'. route('master-itinerary.edit', $itinerary->id) .'" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                <a href="'. route('master-itinerary.destroy', $itinerary->id) .'" class="btn btn-sm btn-danger" onclick="confirm("Anda yakin?")"><i class="fa fa-trash"></i> Hapus</a>'
                    ;
                })
        ->editColumn('link', function($itinerary){
            return '<a href="'. $itinerary->link .'">'. str_limit($itinerary->link, 20) .'</a>';
        })
        ->editColumn('detailjadwal_id', function($itinerary){
            return '<p>'. date('d-M-Y', strtotime($itinerary->detailjadwal_id)) .'</p>';
        })
        ->rawColumns(['link', 'action', 'detailjadwal_id'])
        ->toJson();
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
        $itinerary = MasterItinerary::create($request->all());
        return redirect()->back()->with('message', 'Itinerary has been added!');
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
        
        $url = 'http://115.124.86.218/aiw/jadwal/1440';
        $json = file_get_contents($url);
        $jadwals = collect(json_decode($json, true));
        $test = $jadwals['data'];
        $count = count($test);
        $itungPaket = $jadwals['data'][0]['jadwal'][0]['paket'];
        $countPaket = count($itungPaket);
        $itinerary = MasterItinerary::findOrFail($id);
        
        return view('itinerary.edit', compact('jadwals', 'test', 'count','countPaket', 'itinerary'));
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
        $itinerary = MasterItinerary::findOrFail($id);
        $itinerary->update($request->all());
        return redirect()->back()->with('message', 'Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MasterItinerary::destroy($id);
        return redirect()->back()->with('message', 'Itinerary has been deleted!');
    }
}

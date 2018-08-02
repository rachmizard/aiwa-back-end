<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jamaah;
use App\User;
use App\Http\Resources\JamaahResource;
use App\Http\Resources\CountOfMarketingFeeResource;
use DB;

class JamaahControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Jamaah $jamaah)
    {
        return JamaahResource::collection(Jamaah::with('anggota')->paginate(25));
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

    public function retrieveByAgen(Request $request, $id)
    {
        return JamaahResource::collection(Jamaah::where('marketing', $id)->get());
    }

    public function feeByAgenPotensi(Request $request, $id)
    {
        $countFee = DB::table('jamaah')->where(['marketing' => $id, 'status' => 'POTENSI'])->sum('marketing_fee');
        return response()->json($countFee);
    }

    public function retrieveByKoordinator(Request $request, $id)
    {
        return JamaahResource::collection(Jamaah::where('koordinator', $id)->get());
    }

    public function feeByKoordinatorFeePotensi(Request $request, $id)
    {
        $countFeeByKoordinator = DB::table('jamaah')->where('koordinator', $id)->where('status', '=', 'POTENSI')->sum('koordinator_fee');
        return response()->json($countFeeByKoordinator);
    }

    public function feeByAgenKomisi(Request $request, $id)
    {
        $countFeeByAgenKomisi = DB::table('jamaah')->where('marketing', $id)->where('status', '!=', 'POTENSI')->sum('marketing_fee');
        return response()->json($countFeeByAgenKomisi);   
    }

    public function feeByKoordinatorKomisi(Request $request, $id)
    {
        $countFeeByKoordinatorKomisi = DB::table('jamaah')->where('koordinator', $id)->where('status', '!=', 'POTENSI')->sum('koordinator_fee');
        return response()->json($countFeeByKoordinatorKomisi);   
    }

    public function koordinatorPotensi(Request $request, $id)
    {
        return JamaahResource::collection(Jamaah::where('koordinator', $id)->where('status', '=', 'POTENSI')->get());
    }

    public function koordinatorKomisi(Request $request, $id)
    {
        return JamaahResource::collection(Jamaah::where('koordinator', $id)->where('status', '!=', 'POTENSI')->get());
    }

    public function agenPotensi(Request $request, $id)
    {
        return JamaahResource::collection(Jamaah::where('marketing', $id)->where('status', '=', 'POTENSI')->get());
    }

    public function agenKomisi(Request $request, $id)
    {
        return JamaahResource::collection(Jamaah::where('marketing', $id)->where('status', '!=', 'POTENSI')->get());        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $jamaah = $request->isMethod('put') ? Jamaah::findOrFail($request->id) : new Jamaah;
        // $jamaah->id_umrah = $request->input('id_umrah');
        // $jamaah->id_jamaah = $request->input('id_jamaah');
        // $jamaah->tgl_daftar = $request->input('tgl_daftar');
        // $jamaah->nama = $request->input('nama');
        // $jamaah->tgl_berangkat = $request->input('tgl_berangkat');
        // $jamaah->tgl_pulang = $request->input('tgl_pulang');
        // $jamaah->maskapai = $request->input('maskapai');
        // $jamaah->marketing = $request->input('marketing');
        // $jamaah->staff = $request->input('staff');
        // $jamaah->no_telp = $request->input('no_telp');
        // $jamaah->fee = $request->input('fee');
        // $jamaah->jumlah_fee = $request->input('jumlah_fee');
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

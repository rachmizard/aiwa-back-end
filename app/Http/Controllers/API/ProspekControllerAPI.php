<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prospek;
use App\User;
use App\Http\Resources\ProspekResource;
use Validator;
class ProspekControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProspekResource::collection(Prospek::with('prospek')->paginate(25));
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
        $validator = Validator::make($request->all(), [
            'anggota_id' => 'required',
            'pic' => 'required',
            'no_telp' => 'required',
            'jml_dewasa' => 'required',
            'jml_infant' => 'required',
            'jml_balita' => 'required',
            'jml_visa' => 'required',
            'jml_balita_kasur' => 'required',
            'tgl_keberangkatan' => 'required',
            'jenis' => 'required',
            'dobel' => 'required',
            'triple' => 'required',
            'quard' => 'required',
            'passport' => 'required',
            'meningitis' => 'required',
            'pas_foto' => 'required',
            'buku_nikah' => 'required',
            'fc_akta' => 'required',
            'perlengkapan' => 'required',
            'visa_progresif' => 'required',
            'diskon' => 'required',
            'keterangan' => 'required',
            'tanggal_followup' => 'required',
            'pembayaran' => 'required',

        ]);
        $prospek = $request->isMethod('put') ? Prospek::findOrFail($request->id) : new Prospek;
        $prospek->anggota_id = $request->input('anggota_id');
        $prospek->pic = $request->input('pic');
        $prospek->no_telp = $request->input('no_telp');
        $prospek->jml_dewasa = $request->input('jml_dewasa');
        $prospek->jml_infant = $request->input('jml_infant');
        $prospek->jml_balita = $request->input('jml_balita');
        $prospek->tgl_keberangkatan = $request->input('tgl_keberangkatan');
        $prospek->jenis = $request->input('jenis');
        $prospek->dobel = $request->input('dobel');
        $prospek->triple = $request->input('triple');
        $prospek->quard = $request->input('quard');
        $prospek->passport = $request->input('passport');
        $prospek->meningitis = $request->input('meningitis');
        $prospek->pas_foto = $request->input('pas_foto');
        $prospek->buku_nikah = $request->input('buku_nikah');
        $prospek->fc_akta = $request->input('fc_akta');
        $prospek->perlengkapan = $request->input('perlengkapan');
        $prospek->visa_progresif = $request->input('visa_progresif');
        $prospek->diskon = $request->input('diskon');
        $prospek->keterangan = $request->input('keterangan');
        $prospek->tanggal_followup = $request->input('tanggal_followup');
        $prospek->pembayaran = $request->input('pembayaran');
        if ($prospek->save()) {
            return response()->json(['success' => 'Berhasil di tambahkan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // $prospek = Prospek::findOrFail($request->id);
        return new ProspekResource(Prospek::findOrFail($request->id));
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
        $prospek = $request->isMethod('put') ? Prospek::findOrFail($request->id) : new Prospek;
        $prospek->anggota_id = $request->input('anggota_id');
        $prospek->pic = $request->input('pic');
        $prospek->no_telp = $request->input('no_telp');
        $prospek->jml_dewasa = $request->input('jml_dewasa');
        $prospek->jml_infant = $request->input('jml_infant');
        $prospek->jml_balita = $request->input('jml_balita');
        $prospek->tgl_keberangkatan = $request->input('tgl_keberangkatan');
        $prospek->jenis = $request->input('jenis');
        $prospek->dobel = $request->input('dobel');
        $prospek->triple = $request->input('triple');
        $prospek->quard = $request->input('quard');
        $prospek->passport = $request->input('passport');
        $prospek->meningitis = $request->input('meningitis');
        $prospek->pas_foto = $request->input('pas_foto');
        $prospek->buku_nikah = $request->input('buku_nikah');
        $prospek->fc_akta = $request->input('fc_akta');
        $prospek->perlengkapan = $request->input('perlengkapan');
        $prospek->visa_progresif = $request->input('visa_progresif');
        $prospek->diskon = $request->input('diskon');
        $prospek->keterangan = $request->input('keterangan');
        $prospek->tanggal_followup = $request->input('tanggal_followup');
        $prospek->pembayaran = $request->input('pembayaran');
        if ($prospek->save()) {
            return response()->json(['success' => 'Berhasil di edit!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $prospek = Prospek::findOrFail($request->id);
        if ($prospek->delete()) {
            return response()->json(['success' => 'Berhasil di hapus!']);
        }
    }
}

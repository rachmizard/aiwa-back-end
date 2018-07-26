<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Anggota;
use App\Http\Resources\AgenResource;
use Hash;

class AgenControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AgenResource::collection(User::paginate(25));
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
        $agent = $request->isMethod('put') ? User::findOrFail($request->id) : new User;
        $agent->nama = $request->input('nama');
        $agent->email = $request->input('email');
        $agent->username = $request->input('username');
        $agent->password = Hash::make($request->input('password'));
        $agent->jenis_kelamin = $request->input('jenis_kelamin');
        $agent->no_ktp = $request->input('no_ktp');
        $agent->alamat = $request->input('alamat');
        $agent->no_telp = $request->input('no_telp');
        $agent->status = $request->input('status');
        $agent->koordinator = $request->input('koordinator');
        if ($agent->save()) {
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
        return new AgenResource(User::findOrFail($request->id));
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
        $agent = $request->isMethod('put') ? User::findOrFail($request->id) : new User;
        $agent->nama = $request->input('nama');
        $agent->email = $request->input('email');
        $agent->username = $request->input('username');
        $agent->password = $request->input('password');
        $agent->jenis_kelamin = $request->input('jenis_kelamin');
        $agent->no_ktp = $request->input('no_ktp');
        $agent->alamat = $request->input('alamat');
        $agent->no_telp = $request->input('no_telp');
        $agent->status = $request->input('status');
        $agent->koordinator = $request->input('koordinator');
        if ($agent->save()) {
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
        $agent = User::findOrFail($request->id);
        if ($agent->delete()) {
            return response()->json(['success' => 'Berhasil di hapus']);
        }
    }
}

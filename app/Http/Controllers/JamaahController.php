<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jamaah;
use App\Anggota;
use Yajra\Datatables\Datatables;
class JamaahController extends Controller
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
        $jamaah = Jamaah::where('status', 'lunas')->get();
        return view('jamaah.index', compact('jamaah'));
    }

    // get data by serverside
    public function getData()
    {
        // $jamaah =  Jamaah::select('id', 'anggota_id', 'nama', 'alamat', 'no_telp', 'jenis_kelamin', 'status');
        // return Datatables::of($jamaah)->make(true);
         $jamaah = Jamaah::with('anggota')->select('jamaah.*');
          return Datatables::of($jamaah)->addColumn('action', function($jamaah){
             return '
                <a href="jamaah/'. $jamaah->id .'/edit" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                <a href="'. route('aiwa.jamaah.delete', $jamaah->id) .'" class="btn btn-sm btn-danger" onclick="alert(Anda yakin?)"><i class="fa fa-trash"></i> Hapus</a>'
                    ;
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota = Anggota::all();
        return view('jamaah.add', compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tambah = Jamaah::create($request->all());
        return redirect()->route('aiwa.jamaah')->with('message', 'Berhasil di tambahkan jamaah!');
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
    public function edit(Request $request, $id)
    {
        $edit = Jamaah::find($id);
        $anggota = Anggota::all();
        return view('jamaah.edit', compact('edit', 'anggota'));
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
        $jamaah = Jamaah::find($id);
        $jamaah->update($request->all()); 
        return redirect()->route('aiwa.jamaah')->with('message', 'Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jamaah = Jamaah::find($id);
        $jamaah->delete();
        return redirect()->route('aiwa.jamaah')->with([
            'message' => 'ID '.$jamaah->id. ' berhasil di hapus',
        ]);
    }
}

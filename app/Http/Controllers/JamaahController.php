<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jamaah;
use App\User;
use Yajra\Datatables\Datatables;
use App\LogActivity;
use Auth;
use Carbon\Carbon;
use Excel;
use DB;
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
        // $jamaah = Jamaah::where('status', 'lunas')->get();
        $agents = \App\User::all();
        return view('jamaah.index', compact('agents'));
    }

    // get data by serverside
    public function getData(Request $request)
    {
        // $jamaah =  Jamaah::select('id', 'anggota_id', 'nama', 'alamat', 'no_telp', 'jenis_kelamin', 'status');
        // return Datatables::of($jamaah)->make(true);
         $jamaah = Jamaah::with('anggota')->select('jamaah.*');
          return Datatables::of($jamaah)->addColumn('action', function($jamaah){
             return '
                <a href="jamaah/'. $jamaah->id .'/edit" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                <a href="'. route('aiwa.jamaah.delete', $jamaah->id) .'" class="btn btn-sm btn-danger" onclick="alert(Anda yakin?)"><i class="fa fa-trash"></i> Hapus</a>'
                    ;
                })
          ->editColumn('tgl_daftar', function($jamaah){
            return date('d-M-Y', strtotime($jamaah->tgl_daftar));
          })
          ->editColumn('tgl_berangkat', function($jamaah){
            return date('d-M-Y', strtotime($jamaah->tgl_berangkat));
          })
          ->editColumn('tgl_pulang', function($jamaah){
            return date('d-M-Y', strtotime($jamaah->tgl_pulang));
          })
          ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function showImportForm()
    // {
    //     return view('agen')
    // }

    public function create()
    {
        $anggota = User::all();
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
        $itung = count($tambah);
        LogActivity::create([
            'subjek' => 'Menambahkan '. $itung .' data di table jamaah.',
            'user_id' => Auth::guard('admin')->user()->id,
            'tanggal' => Carbon::now()
        ]);

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
        $jamaah = Jamaah::find($id);
        $agents = User::all();
        return view('jamaah.edit', compact('jamaah', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $jamaah = Jamaah::find($id);
    //     LogActivity::create([
    //         'subjek' => 'Mengedit data di table jamaah.',
    //         'user_id' => Auth::guard('admin')->user()->id,
    //         'tanggal' => Carbon::now()
    //     ]);
    //     $jamaah->update($request->all()); 
    //     return redirect()->route('aiwa.jamaah')->with('message', 'Berhasil di edit!');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jamaah = Jamaah::find($id);
        LogActivity::create([
            'subjek' => 'Menghapus data di table jamaah.',
            'user_id' => Auth::guard('admin')->user()->id,
            'tanggal' => Carbon::now()
        ]);
        $jamaah->delete();
        return redirect()->route('aiwa.jamaah')->with([
            'message' => 'ID '.$jamaah->id. ' berhasil di hapus',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospek;
use App\Anggota;
use Yajra\Datatables\Datatables;
use DB;

class ProspekController extends Controller
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
        $agents = \App\User::all();
        $prospeks = Prospek::orderBy('id', 'DESC')->get();
        return view('prospek.index', compact('agents', 'prospeks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData()
    {
         $prospeks = Prospek::orderBy('id', 'DESC')->with('anggota')->select('prospeks.*');
          return Datatables::of($prospeks)->addColumn('action', function($prospeks){
             return '
                <a href="#" data-toggle="modal" data-target="#editProspek'. $prospeks->id .'" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                <a href="'. route('aiwa.prospek.delete', $prospeks->id) .'" class="btn btn-sm btn-danger" onclick="alert(Anda yakin?)"><i class="fa fa-trash"></i> Hapus</a>'
                    ;
                })
          ->addColumn('qty', function($prospeks){
                $jml_dewasa = $prospeks->jml_dewasa;
                $jml_balita = $prospeks->jml_balita;
                $jml_infant = $prospeks->jml_infant;
                $total = $jml_dewasa+$jml_balita+$jml_infant;
                return $total;
          })
          ->rawColumns(['qty', 'action'])
          ->make(true);
    }

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
        $prospek = Prospek::findOrFail($id);
        $prospek->tanggal_followup = $request->tanggal_followup;
        $prospek->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prospek = Prospek::findOrFail($id);
        $prospeks->delete();
        return redirect()->back();
    }
}

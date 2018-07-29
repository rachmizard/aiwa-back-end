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
    
    public function index()
    {
        $agents = \App\User::all();
        $prospeks = Prospek::all();
        return view('prospek.index', compact('agents', 'prospeks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData()
    {
         $prospeks = Prospek::with('anggota')->select('prospeks.*');
          return Datatables::of($prospeks)->addColumn('action', function($prospeks){
             return '
                <a href="'. route('aiwa.prospek.edit-form', $prospeks->id) .'" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                <a href="'. route('aiwa.prospek.delete', $prospeks->id) .'" class="btn btn-sm btn-danger" onclick="alert(Anda yakin?)"><i class="fa fa-trash"></i> Hapus</a>'
                    ;
                })
          ->addColumn('qty', function($prospeks){
                $jml_dewasa = $prospeks->jml_dewasa;
                $jml_balita = $prospeks->jml_balita;
                $jml_infant = $prospeks->jml_infant;
                $total = $jml_dewasa+$jml_balita+$jml_infant;
                return '
                        <a href="#" data-toggle="modal" data-target=".detailQtyProspek'. $prospeks->id .'" class="btn btn-md btn-info">'. $total .'</a>
                ';
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

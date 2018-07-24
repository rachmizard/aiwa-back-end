<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterBrosur;
use Yajra\Datatables\Datatables;

class MasterBrosurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brosurs = MasterBrosur::all();
        return view('brosur.index', compact('brosurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function getData(Request $request)
    {
         $brosurs = MasterBrosur::all();
         return Datatables::of($brosurs)->addColumn('action', function($brosur)
         {
            return '
                <a href="master-brosur/'. $brosur->id .'/edit" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                <a href="'. route('master-brosur.destroy', $brosur->id) .'" class="btn btn-sm btn-danger" onclick="alert(Anda yakin?)"><i class="fa fa-trash"></i> Hapus</a>';
         })
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

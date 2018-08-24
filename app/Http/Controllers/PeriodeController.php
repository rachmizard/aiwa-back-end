<?php

namespace App\Http\Controllers;

use App\Periode;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodes = Periode::all();   
        return view('periode.index', compact('periodes'));
    }

    public function getData(Datatables $datatables)
    {
        $var = Periode::all();
        return $datatables->of($var)
        ->addColumn('action', function($periode){
            return '
            <div class="btn-group">
                    <a href="#" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <input type="hidden" id="id" value="'. $periode->id .'">
                    <form action="'. route('aiwa.master-periode.destroy', $periode->id) .'" method="POST">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <button type="submit" onclick="confirmBtn()" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    </form>
            </div>
                    ';
        })
        ->make(true);
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
        $periode = new Periode();
        $periode->judul = $request->judul;
        $periode->start = $request->start;
        $periode->end = $request->end;
        $periode->save();
        return response()->json($periode);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show(Periode $periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function edit(Periode $periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periode $periode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();
        return redirect()->back()->with('message', 'Berhasil di hapus!');
    }
}

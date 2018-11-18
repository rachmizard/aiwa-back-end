<?php

namespace App\Http\Controllers;

use App\Periode;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use DB;

class PeriodeController extends Controller
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
        $periodes = Periode::orderBy('judul', 'DESC')->get();   
        return view('periode.index', compact('periodes'));
    }

    public function getData(Datatables $datatables)
    {
        $var = Periode::orderBy('judul', 'DESC')->get();
        return $datatables->of($var)
        ->addColumn('action', function($periode){
            return '
                <button data-toggle="modal" data-target="#editPeriodeModal" data-id="'. $periode->id .'" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button>
                <form method="POST" action="'. route('aiwa.master-periode.active', $periode->id) .'">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-spinner fa-spin"></i> Aktifkan periode ini</button> 
                </form>
                <input type="hidden" id="id" value="'. $periode->id .'">
                <form action="'. route('aiwa.master-periode.destroy', $periode->id) .'" method="POST">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <button type="submit" onclick="confirmBtn()" class="btn btn-sm btn-danger" title="Hapus"><i class="fa fa-trash"></i></button>
                </form>
                    ';
        })
        ->addColumn('status_periode', function($periode){
            return $periode->status_periode == 'active' ? '<h4 class="text-center"></i">
                <i class="fa fa-check text-success text-center"></i>
            </h4>' : '
                <h4 class="text-center">
                    <i class="ion-android-close"></i>
                </h4>
            ';
        })
        ->rawColumns(['action', 'status_periode'])
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
        $periode->status_periode = 'non-active';
        $periode->save();
        return response()->json($periode);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Periode::find($id);
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
    public function update(Request $request, $id)
    {
        $periode = Periode::findOrFail($id);
        $periode->update($request->all());
        return back();
    }

    public function active(Request $request, $id)
    {
        $getDefault = DB::table('master_periode')->where('status_periode', 'active')->get();
        foreach ($getDefault as $value) {
            if ($value->status_periode == 'active') {
                DB::table('master_periode')->where('id', $value->id)->update(['status_periode' => 'false']);
            }
        }
        DB::table('master_periode')->where('id', $id)->update(['status_periode' => 'active']);
        return back();
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

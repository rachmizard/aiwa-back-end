<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sapaan;
use Yajra\Datatables\Datatables;

class SapaanController extends Controller
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
        return view('sapaan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // load datatable
    public function getData(Datatables $datatables)
    {
        $sapaans = Sapaan::all();
        return $datatables->of($sapaans)
        ->addColumn('action', function($sapaan){
            return '<a href="#" data-toggle="modal" data-target="#sapaanModal'. $sapaan->id .'" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="'. route('aiwa.master-sapaan.destroy', $sapaan->id) .'" method="POST">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <button type="submit" onclick="confirmBtn()" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    </form>
                    ';
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
        $sapaan = Sapaan::create(['text_sapaan' => $request->text_sapaan]);
        return response()->json($sapaan);
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
        $sapaan = Sapaan::findOrFail($id);
        $sapaan->delete();
        return redirect()->back()->with('message', 'Sapaan ID: '. $sapaan->id . ' berhasil di hapus');
    }
}

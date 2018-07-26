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

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

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
        $brosur = MasterBrosur::create($request->all());
        return redirect()->back()->with('message', 'Berhasil di tambakan!');
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
        $edit = MasterBrosur::findOrFail($id);
        $brosurs = MasterBrosur::all();
        return view('brosur.edit', compact('edit', 'brosurs'));
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
        $brosur = MasterBrosur::findOrFail($id);
        $brosur->update($request->all());
        return redirect()->back()->with('message', 'Berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brosur = MasterBrosur::findOrFail($id);
        $brosur->delete();
        return redirect()->back()->with('message', 'Berhasil di hapus!');
    }
}

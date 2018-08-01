<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterVoucher;
use Yajra\Datatables\Datatables;

class MasterVoucherController extends Controller
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
        $voucher = MasterVoucher::all();
        return view('voucher.index', compact('voucher'));
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
        $voucher = MasterVoucher::create($request->all());
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
        $edit = MasterVoucher::findOrFail($id);
        $voucher = MasterVoucher::all();
        return view('voucher.edit', compact('edit', 'voucher'));
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
        $voucher = MasterVoucher::findOrFail($id);
        $voucher->update($request->all());
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
        $voucher = MasterVoucher::findOrFail($id);
        $voucher->delete();
        return redirect()->back()->with('message', 'Berhasil di hapus!');
    }
}

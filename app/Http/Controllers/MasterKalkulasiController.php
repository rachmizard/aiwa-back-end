<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterKalkulasi;
use App\LogActivity;
use Yajra\Datatables\Datatables;
use Auth;
use Carbon\Carbon;

class MasterKalkulasiController extends Controller
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
        // $kalkulasi = MasterKalkulasi::all();
        // return view('kalkulasi.index', compact('kalkulasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData()
    {
        $kalkulasi = MasterKalkulasi::all();
         return Datatables::of($kalkulasi)->addColumn('action', function($kalkulasi)
         {
            return '
                <a href="'. route('master-kalkulasi.edit', $kalkulasi->id) .'" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                <a href="'. route('master-hotel.destroy', $kalkulasi->id) .'" class="btn btn-sm btn-danger" onclick="alert(Anda yakin?)"><i class="fa fa-trash"></i> Hapus</a>';
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
        $kalkulasi = MasterKalkulasi::create($request->all());
        if ($kalkulasi) {
            $itung = count($kalkulasi);
            LogActivity::create([
                'subjek' => 'Menambahkan '. $itung .' data di table kalkuklasi.',
                'user_id' => Auth::guard('admin')->user()->id,
                'tanggal' => Carbon::now()
            ]);
            return redirect()->back()->with('message', 'Kalkulasi berhasil di tambahkan');
        }
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
    public function edit()
    {   
        $kalkulasi = MasterKalkulasi::find(1);
        return view('kalkulasi.index', compact('kalkulasi'));
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
        $kalkulasi = MasterKalkulasi::find($id);
        $kalkulasi->update([
                        'harga_default' => $request->harga_default,
                        'harga_promo' => $request->harga_promo,
                        'harga_infant' => $request->harga_infant,
                        'harga_full' => $request->harga_full,
                        'diskon_balita_uhud' => $request->diskon_balita_uhud,
                        'diskon_balita_nur' => $request->diskon_balita_nur,
                        'diskon_balita_rhm' => $request->diskon_balita_rhm,
                        'harga_visa' => $request->harga_visa
                    ]);
        if ($kalkulasi) {
            $itung = count($kalkulasi);
            LogActivity::create([
                'subjek' => 'Mengedit '. $itung .' data di table kalkuklasi.',
                'user_id' => Auth::guard('admin')->user()->id,
                'tanggal' => Carbon::now()
            ]);
            return redirect()->back()->with('message', 'Kalkulasi berhasil di edit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kalkulasi = MasterKalkulasi::findOrFail($id);
        if ($kalkulasi->delete()) {
            $itung = count($kalkulasi);
            LogActivity::create([
                'subjek' => 'Menghapus '. $itung .' data di table kalkuklasi.',
                'user_id' => Auth::guard('admin')->user()->id,
                'tanggal' => Carbon::now()
            ]);
            return redirect()->back()->with('message', 'Kalkulasi di hapus!');
        }
    }
}

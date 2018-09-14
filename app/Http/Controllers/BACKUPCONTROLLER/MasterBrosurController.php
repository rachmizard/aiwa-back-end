<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterBrosur;
use Yajra\Datatables\Datatables;
use App\LogActivity;
use Auth;
use Carbon\Carbon;

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
        $uploadedFile = $request->file('file_brosur');        
        $name = rand(111,9999) . '.' . $uploadedFile->getClientOriginalExtension();
        $loc = public_path('/storage/brosur/');
        $path = $uploadedFile->move($loc, $name);
        $file = MasterBrosur::create([
            'file_brosur' => $name,
            'description' => $request->description
        ]);
        if ($file) { 
        $itung = count($file);
        LogActivity::create([
            'subjek' => 'Menambahkan '. $itung .' data di table Brosur.',
            'user_id' => Auth::guard('admin')->user()->id,
            'tanggal' => Carbon::now()
        ]);
            return redirect()->back()->with('message', 'Brosur Berhasil ditambahkan!');
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
        if ($request->file('file_brosur')) {
            $uploadedFile = $request->file('file_brosur');        
            $name = rand(111,9999) . '.' . $uploadedFile->getClientOriginalExtension();
            $loc = public_path('/storage/brosur/');
            $path = $uploadedFile->move($loc, $name);
            $brosur->update([
                    'file_brosur' => $name,
                    'description' => $request->description,
            ]);
            if ($brosur) {
                LogActivity::create([
                    'subjek' => 'Mengedit data di table Brosur.',
                    'user_id' => Auth::guard('admin')->user()->id,
                    'tanggal' => Carbon::now()
                ]);
                return redirect()->back()->with('message', 'Berhasil di edit!');
            }else{
                return redirect()->back()->with('messageError', 'Ooops something error!');
            }
        }else{
            $brosur->update([
                    'file_brosur' => $request->old_file_brosur,
                    'description' => $request->description,
            ]);
            if ($brosur) {
                LogActivity::create([
                    'subjek' => 'Mengedit data di table Brosur.',
                    'user_id' => Auth::guard('admin')->user()->id,
                    'tanggal' => Carbon::now()
                ]);
                return redirect()->back()->with('message', 'Berhasil di edit!');
            }else{
                return redirect()->back()->with('messageError', 'Ooops something error!');
            }
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
        $brosur = MasterBrosur::findOrFail($id);
        $brosur->delete();
        return redirect()->back()->with('message', 'Berhasil di hapus!');
    }
}

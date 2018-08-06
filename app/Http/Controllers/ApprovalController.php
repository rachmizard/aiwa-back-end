<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = User::where('status', '=', '0')->get();
         return Datatables::of($agents)->addColumn('action', function($agents)
         {
            return '
                <form class="form-group" action="'. route('aiwa.approved', $agents->id) .'" method="POST">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="PUT">
                    <button id="confirm" onclick="confirmBtn()" class="btn btn-sm btn-success" type="submit"><i class="fa fa-check"></i>Approve</button>
                    </form>
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
        $approveStatus = 1;
        $agen = User::findOrFail($id);
        if ($agen->update(['status' => $approveStatus])) {
            return redirect()->back()->with('message', 'Akun berhasil di approved (Agen '. $agen->nama .')');
        }else{
            return redirect()->back()->with('messageError', 'Terjadi masalah di server!');
        }


    }

    public function unapproved(Request $request, $id)
    {
        $approveStatus = 0;
        $agen = User::findOrFail($id);
        if ($agen->update(['status' => $approveStatus])) {
            return redirect()->back();
        }else{
            return redirect()->back()->with('messageError', 'Terjadi masalah di server!');
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
        //
    }
}

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

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $agentagen = User::where('status', '=', '0')->get();
        Auth()->guard('admin')->user()->unreadNotifications->where('type', '=', 'App\Notifications\ApproveAgenNotification')->markAsRead();
        return view('approval.index', compact('agentagen'));
    }

    public function getData()
    {
        $agents = User::where('status', '=', '0')->get();
         return Datatables::of($agents)->addColumn('action', function($agents)
         {
            return '
                    <a href="#" data-toggle="modal" data-target="#approveModal'. $agents->id .'" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Approve</a>
                    <a href="'. route('aiwa.destroy', $agents->id) .'" class="btn btn-sm btn-danger" onclick="confirmBtn()"><i class="fa fa-trash"></i> Hapus</a>

                ';
         })
         ->make(true);
         // <form class="form-group" action="'. route('aiwa.approved', $agents->id) .'" method="POST">
         //            <input type="hidden" name="_token" value="'. csrf_token() .'">
         //            <input type="hidden" name="_method" value="PUT">
         //            <button id="confirm" onclick="confirmBtn()" class="btn btn-sm btn-success" type="submit"><i class="fa fa-check"></i>Approve</button>
         //            </form>
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
        // $approveStatus = 1;
        $agen = User::findOrFail($id);
        $validator = User::where('id', $request->id)->get();
        if (count($validator) > 0) {
            return redirect()->back()->with('messageError', 'ID sudah ada!');
        }else{
            $agen->update(['id' => $request->id, 'status' => $request->status]);
            return redirect()->back()->with('message', 'Akun berhasil di approved (Agen '. $agen->nama .')');
        }


    }

    public function unapproved(Request $request, $id)
    {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $statusNow = 0;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $agen = User::findOrFail($id);
        if ($agen->update(['id' => $randomString, 'status' => $statusNow])) {
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
        $agen = User::findOrFail($id);
        $agent->delete();
        return redirect()->back()->with('message', 'Akun di hapus!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterBroadcast;
use App\User;
use Carbon\Carbon;
use App\MasterNotifikasi;
use DB;
use Notifications;
use Illuminate\Support\Facades\Validator;
use App\Notifications\BroadcastNotification;

class MasterBroadcastController extends Controller
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
        return view('broadcast.index');
    }

    public function toAgen(Request $request)
    {
        $users = User::where('status', '=', 1)->get();
        return view('broadcast.broadcastagen', compact('users'));
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
        $this->validate($request, [
            'judul' => 'required|string|max:30'
        ]);

        $agents = DB::table('users')->where('device_token', '!=', null)->get();
        $when = Carbon::now()->addSecond();
        $broadcast = User::find('BR001');
        $broadcast->notify((new BroadcastNotification($broadcast, $request->judul, $request->pesan))->delay($when));
        if ($broadcast) {
            foreach ($agents as $key => $value) {
                MasterNotifikasi::create([
                                    'anggota_id' => $value->id,
                                    'pesan' => $request->pesan,
                                    'status' => 'delivered'
                                ]);
            }
        }
        return redirect()->back()->with('message', 'Broadcast terkirim ke '. count($agents) .' agen!') ;
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

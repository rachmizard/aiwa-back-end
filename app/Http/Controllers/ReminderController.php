<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reminder;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $followup = Reminder::where('notifikasi', 'followup')->first();
        $jamaahBerangkat = Reminder::where('notifikasi', 'jamaah_berangkat')->first();
        $jamaahPulang = Reminder::where('notifikasi', 'jamaah_pulang')->first();
        $sinkronisasi = Reminder::where('notifikasi', 'sinkronisasi')->first();
        return view('reminder.index', compact('followup', 'jamaahBerangkat', 'jamaahPulang', 'sinkronisasi'));
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
        $updateCron = Reminder::find($id);
        $updateCron->update(['cron' => $request->cron]);
        return redirect()->back()->with('message', 'Penjadwalan notifikasi berhasil di set!');
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

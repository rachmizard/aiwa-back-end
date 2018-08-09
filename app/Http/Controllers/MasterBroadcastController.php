<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterBroadcast;
use App\User;
use Carbon\Carbon;
use App\MasterNotifikasi;

class MasterBroadcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $agents = \App\User::where('device_token', '!=', null)->get();
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        foreach ($agents as $agent) {
            $token = $agent->device_token;
                    
                    $notification = [
                        'body' => $request->pesan,
                        'sound' => true,
                    ];
                    
                    $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

                    $fcmNotification = [
                        // 'registration_ids' => $token, //multple token array
                        'to'        => $token, //single token
                        'notification' => $notification,
                        'data' => $extraNotificationData
                    ];

                    $headers = [
                        'Authorization: key=AIzaSyBd3fkYDybtqT7RmEkz8-nm6FbnSkW1tkA',
                        'Content-Type: application/json'
                    ];


                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);


                    $sendNotify = MasterNotifikasi::create(['anggota_id' => $agent->id,
                                                            'pesan' => $notification['body'],
                                                            'status' => 'delivered'
                                                            ]);


                    // return response()->json($result);
        }

        return redirect()->back()->with('message', 'Broadcast terkirim!');
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

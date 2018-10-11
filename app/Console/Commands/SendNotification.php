<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Notifications\Notification;
use App\User;
use App\Prospek;
use Faker\Factory;
use Carbon\Carbon;
use App\MasterNotifikasi;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendnotify:followup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Follow up successfully sent!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
            // $agents = User::where('device_token', '!=', null)->get();
            $now = Carbon::now();
            $year = $now->year;
            $month = $now->month;
            $day = $now->day;
            $prospeks = Prospek::where('tanggal_followup', '=', $day.'/'.$month.'/'.$year)->where('pembayaran', '=', 'BELUM')->get();
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            foreach ($prospeks as $prospek) {

                $recepient = User::where('id', $prospek->anggota_id)->first();
                $token = $recepient->device_token;
                
                $notification = [
                    'title' => 'Waktunya Follow Up!',
                    'priority' => 'high',
                    'body' => $recepient->nama .' segera Follow Up jamaah atas nama '. $prospek->pic,
                    'sound' => true,
                ];


                $sendNotify = MasterNotifikasi::create([
                                                        'anggota_id' => $prospek->anggota_id,
                                                        'pesan' => $notification['body'],
                                                        'status' => 'delivered'
                                                        ]);
                
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


                // return response()->json($result);
            }
    }

// public function handle()
//     {
//             $prospeks = Prospek::where('tanggal_followup', '=', '8/8/2018')->get();
//             $agentssss = User::where('device_token', '!=', null)->get();
//             $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
//             foreach ($prospeks as $prospek) {
//                 $agents = User::where('id', $prospek->anggota_id)->get();\

//                 if (Carbon::now() == $prospek->tanggal_followup) {
                    
//                     foreach ($agents as $agent) {
//                         $token = $agent->device_token;

//                         $notification = [
//                             'body' => $agent->nama .'mendapatkan komisi, cek segera!',
//                             'sound' => true,
//                         ];
                        
//                         $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

//                         $fcmNotification = [
//                             // 'registration_ids' => $token, //multple token array
//                             'to'        => $token, //single token
//                             'notification' => $notification,
//                             'data' => $extraNotificationData
//                         ];

//                         $headers = [
//                             'Authorization: key=AIzaSyBd3fkYDybtqT7RmEkz8-nm6FbnSkW1tkA',
//                             'Content-Type: application/json'
//                         ];


//                         $ch = curl_init();
//                         curl_setopt($ch, CURLOPT_URL,$fcmUrl);
//                         curl_setopt($ch, CURLOPT_POST, true);
//                         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//                         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//                         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
//                         $result = curl_exec($ch);
//                         curl_close($ch);


//                         // return response()->json($result);
//                     }
//                 }
//             }
//     }
// }

}

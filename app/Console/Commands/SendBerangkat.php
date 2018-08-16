<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Jamaah;
use Faker\Factory;
use Carbon\Carbon;
use App\MasterNotifikasi;
use DB;

class SendBerangkat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendnotify:berangkat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sapaan jamaah berangkat hari ini berhasil di kirim';

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
            $jamaah = Jamaah::where('tgl_berangkat', '=', $day.'/'.$month.'/'.$year)->get();
            $totalJamaahBerangkat = count($jamaah);
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            foreach ($jamaah as $in) {

                $recepient = User::where('id', $in->marketing)->first();
                $token = $recepient->device_token;
                
                $notification = [
                    'body' => $in->nama .' jamaah akan berangkat pada tanggal '. $in->tgl_berangkat .' (sekarang)',
                    'sound' => true,
                ];


                $sendNotify = MasterNotifikasi::create([
                                                        'anggota_id' => $in->marketing,
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
}

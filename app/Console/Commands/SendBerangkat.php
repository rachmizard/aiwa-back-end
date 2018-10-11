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
        $now = Carbon\Carbon::now();
        $now->addDays(3);
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;
        $hariH = Carbon\Carbon::now();
        $ref = App\Jamaah::where('tgl_berangkat', $hariH->format('Y-m-d'))->orWhere('tgl_berangkat', $now->format('Y-m-d'))->get(); // Get all of jamaah and inspect them
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        foreach ($ref as $in) {
            if ($in->tgl_berangkat == $hariH->format('Y-m-d')) {
                $recepient = App\User::where('id', $in->marketing)->first();
                $token = $recepient->device_token;
                $notification = [
                    'title' => 'Keberangkatan Jamaah ('. date("d M Y", strtotime($in->tgl_berangkat)) .')',
                    'body' => 'Jamaah '. $in->nama .' akan berangkat pada tanggal '. date('d M Y', strtotime($in->tgl_berangkat)) .' (Hari ini)',
                    'priority' => 'high',
                    'sound' => true,
                ];
                $sendNotify = App\MasterNotifikasi::create([
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
            }else{
                $recepient = App\User::where('id', $in->marketing)->first();
                $token = $recepient->device_token;
                $notification = [
                    'title' => 'Keberangkatan Jamaah H-3',
                    'priority' => 'high',
                    'body' => 'Persiapan Jamaah '. $in->nama .' akan berangkat pada tanggal '. date('d M Y', strtotime($in->tgl_berangkat)),
                    'sound' => true,
                ];
                $sendNotify = App\MasterNotifikasi::create([
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
            }
        }
    }
}

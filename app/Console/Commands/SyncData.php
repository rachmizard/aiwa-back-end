<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Admin;
use App\User;
use App\Sinkronisasi;
use App\MasterNotifikasi;
use Notification;
use App\Notifications\SyncWeeklyNotification;

class SyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:pendaftaran';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi Berhasil!';

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
        $validator = Sinkronisasi::where('status', 'selected')->first();
        $url = 'http://115.124.86.218/aiw/pendaftaran/'.$validator->tahun;
        $json = file_get_contents($url);
        $diskons = collect(json_decode($json, true));
        
        // dd($diskons['data'][1]['jadwal']); // Ieu bisa
        // return view('test-api', compact('diskons'));
        $test = $diskons['data'];
        $count = count($test);

        for ($i=0; $i < $count ; $i++) { 
            foreach ($diskons['data'][$i]['pendaftaran'] as $key => $diskon) {
                $data['tgl_pendaftaran'] = $diskon['tgl_pendaftaran'];
                $data['id_umrah'] = $diskon['id_umrah'];
                $data['id_jamaah'] = $diskon['id_jamaah'];
                $data['nama_jamaah'] = $diskon['nama_jamaah'];
                $data['tgl_keberangkatan'] = $diskon['tgl_keberangkatan'];
                $data['staf_kantor'] = $diskon['staf_kantor'];
                $data['id_marketing'] = $diskon['id_marketing'];
                $data['diskon_kantor'] = $diskon['diskon_kantor'];
                $data['diskon_marketing'] = $diskon['diskon_marketing'];
                $data['fee_koordinator'] = $diskon['fee_koordinator'];
                $data['fee_marketing'] = $diskon['fee_marketing'];
                $validator = DB::table('master_pendaftaran')->where('id_jamaah', '=', $diskon['id_jamaah'])->first();
                if ($validator) {
                    DB::table('master_pendaftaran')->where('id', $validator->id)->update($data);
                }else{
                    DB::table('master_pendaftaran')->insert($data);
                //     DB::table('master_pendaftaran')->insert([   
                //     'tgl_pendaftaran' => $diskon['tgl_pendaftaran'],
                //     'id_umrah' => $diskon['id_umrah'],
                //     'id_jamaah' => $diskon['id_jamaah'],
                //     'nama_jamaah' => $diskon['nama_jamaah'],
                //     'tgl_keberangkatan' => $diskon['tgl_keberangkatan'],
                //     'staf_kantor' => $diskon['staf_kantor'],
                //     'id_marketing' => $diskon['id_marketing'],
                //     'diskon_kantor' => $diskon['diskon_kantor'],
                //     'diskon_marketing' => $diskon['diskon_marketing'],
                //     'fee_koordinator' => $diskon['fee_koordinator'],
                //     'fee_marketing' => $diskon['fee_marketing']
                // ]);
                }
            }
        }
        // $now = Carbon::now();
            // $year = $now->year;
            // $month = $now->month;
            // $day = $now->day;

            // It will be sent to database notification 
            $message = 'Just test';
            $admin = Admin::find(1);
            $admin->notify(new SyncWeeklyNotification($message));
            $pakAri = User::where('id', '=', 'SM140')->first();

            // Send push notification to Pak Ari
                $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                $recepient = User::find($pakAri->id);
                $token = $recepient->device_token;
                
                $notification = [
                    'body' => 'Sinkronisasi data jamaah kantor berhasil di lakukan',
                    'sound' => true,
                ];


                $sendNotify = MasterNotifikasi::create([
                                                        'anggota_id' => $recepient->id,
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

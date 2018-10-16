<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/testCron', function(){

        $followup = DB::table('master_reminder')->where('notifikasi', 'followup')->first();
        $jamaahBerangkat = DB::table('master_reminder')->where('notifikasi', 'jamaah_berangkat')->first();
        $jamaahPulang = DB::table('master_reminder')->where('notifikasi', 'jamaah_pulang')->first();
        $sinkronisasi = DB::table('master_reminder')->where('notifikasi', 'sinkronisasi')->first();

        echo 'ini '. $followup->cron .'<br>';
        echo 'ini '. $jamaahBerangkat->cron .'<br>';
        echo 'ini '. $jamaahPulang->cron .'<br>';
        echo 'ini '. $sinkronisasi->cron .'<br>';
});

Route::get('/diskonkantor', function(){
    
        $url = 'http://115.124.86.218/aiw/pendaftaran/1440';
        $json = file_get_contents($url);
        $diskons = collect(json_decode($json, true));
        
        // dd($diskons['data'][1]['jadwal']); // Ieu bisa
        // return view('test-api', compact('diskons'));
        $test = $diskons['data'];
        $count = count($test);
        // $itungPaket = $diskons['data'][0]['jadwal'][0]['paket'];
        // $countPaket = count($test);
        echo "<a href='/api/sync'>Sync to database</a>";
        echo $count;
        echo "<table border='1'>
                    <tr>
                            <td>Pax</td>
                            <td>Tgl Daftar</td>
                            <td>Id Umrah</td>
                            <td>Id Jamaah</td>
                            <td>Tgl Keberangkatan</td>
                            <td>Nama jamaah</td>
                            <td>Staff</td>
                            <td>Id Marketing</td>
                            <td>Diskon Kantor</td>
                            <td>Diskon Marketing</td>
                            <td>Fee koordinator</td>
                            <td>Fee marketing</td>
                    </tr>";
        for ($i=0; $i < $count ; $i++) { 
            $itung = count($diskons['data'][$i]['pendaftaran']);
            foreach($diskons['data'][$i]['pendaftaran'] as $key => $diskon)
                {
                    
                    echo "
                    <tr>
                        <td>". $itung ."</td>
                        <td>". $diskon['tgl_pendaftaran'] ."</td>
                        <td>". $diskon['id_umrah'] ."</td>
                        <td>". $diskon['id_jamaah'] ."</td>
                        <td>". $diskon['tgl_keberangkatan'] ."</td>
                        <td>". $diskon['nama_jamaah'] ."</td>
                        <td>". $diskon['staf_kantor'] ."</td>
                        <td>". $diskon['id_marketing'] ."</td>
                        <td>". $diskon['diskon_kantor'] ."</td>
                        <td>". $diskon['diskon_marketing'] ."</td>
                        <td>". $diskon['fee_koordinator'] ."</td>
                        <td>". $diskon['fee_marketing'] ."</td>
                    </tr>";   
                }
        }
        echo "</table>";

        // $itungPaket = $diskons['data'][0]['jadwal'][0]['paket']; 
        // for ($i=0; $i < $count ; $i++) { 
        //     foreach ($diskons['data'][$i]['pendaftaran'] as $key => $diskon) {
        //         echo json_encode($i);
        //         echo json_encode($diskon['id_marketing']);
        //         echo json_encode($diskon['diskon_marketing']);
        //         echo json_encode($diskon['diskon_kantor']);
        //     }
        // }
});

// Latihan Diskon
Route::get('/sync', function(){
        $url = 'http://115.124.86.218/aiw/pendaftaran/1440';
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
        return redirect()->back();

});

//test api jadwal
Route::get('/test-api', 'API\JadwalController@test');

// // List users 
// Route::get('users', 'UserController@index');

// // list users by id
// Route::get('users/{id}', 'UserController@show');

// // post users
// Route::post('users', 'UserController@store');
// Route::delete('users/delete/{id}', 'UserController@destroy');

// Agen/Anggota API Route
Route::get('/agen', 'API\AgenControllerAPI@index');
Route::post('/agen', 'API\Auth\AnggotaControllerAPI@register');
Route::post('/agen/login', 'API\Auth\AnggotaControllerAPI@login');
Route::get('/agen/{id}/show', 'API\AgenControllerAPI@show');
Route::put('/agen/{id}/edit', 'API\AgenControllerAPI@update');
Route::post('/agen/{id}/updatephoto', 'API\AgenControllerAPI@profile');
// Route::post('/post', 'API\AgenControllerAPI@profile');
Route::delete('/agen/{id}/delete', 'API\AgenControllerAPI@destroy');
Route::get('/agen/{id}/subagen', 'API\AgenControllerAPI@retrieveMySubAgen');

// Agen Retrieving by approved's account.
Route::get('/agen/approved', 'API\AgenControllerAPI@retrieveByApproved');

// Jamaah API Route
Route::get('/jamaah', 'API\JamaahControllerAPI@index');
Route::post('/jamaah', 'API\JamaahControllerAPI@store');
Route::get('/jamaah/{id}/agen/{tahun}/periode', 'API\JamaahControllerAPI@retrieveByAgen');
Route::get('/jamaah/{id}/agenfee/potensi/{tahun}/periode', 'API\JamaahControllerAPI@feeByAgenPotensi');
Route::get('/jamaah/{id}/agenfee/komisi/{tahun}/periode', 'API\JamaahControllerAPI@feeByAgenKomisi');
Route::get('/jamaah/{id}/koordinatorfee/potensi/{tahun}/periode', 'API\JamaahControllerAPI@feeByKoordinatorFeePotensi');
Route::get('/jamaah/{id}/koordinatorfee/komisi/{tahun}/periode', 'API\JamaahControllerAPI@feeByKoordinatorKomisi');
Route::get('/jamaah/{id}/koordinator', 'API\JamaahControllerAPI@retrieveByKoordinator');

Route::get('/jamaah/{id}/koordinator/potensi/{tahun}/periode', 'API\JamaahControllerAPI@koordinatorPotensi');
Route::get('/jamaah/{id}/koordinator/komisi/{tahun}/periode', 'API\JamaahControllerAPI@koordinatorKomisi');
Route::get('/jamaah/{id}/agen/potensi/{tahun}/periode', 'API\JamaahControllerAPI@agenPotensi');
Route::get('/jamaah/{id}/agen/komisi/{tahun}/periode', 'API\JamaahControllerAPI@agenKomisi');
Route::get('/jamaah/{id}/agen/total/{tahun}/periode', 'API\JamaahControllerAPI@totalJamaahByAgen');
Route::get('/jamaah/{id}/agen/berangkat/{tahun}/periode', 'API\JamaahControllerAPI@retrieveJamaahBerangkatByAgen');
Route::get('/jamaah/{id}/agen/pulang/{tahun}/periode', 'API\JamaahControllerAPI@retrieveJamaahPulangByAgen');
Route::get('/jamaah/{id}/agen/bulan/{tahun}/periode', 'API\JamaahControllerAPI@totalJamaahByTheMonth');
Route::get('/jamaah/{id}/agenfee/bulan/{tahun}/periode', 'API\JamaahControllerAPI@feeAgenByTheMonth');
Route::get('/jamaah/{id}/koordinatorfee/bulan/{tahun}/periode', 'API\JamaahControllerAPI@feeByKoordinatorFeeKomisi');
Route::get('/jamaah/totalByPeriode/{idperiode}', 'API\JamaahControllerAPI@totalByPeriode');



// Prospek API Route
Route::get('/prospek', 'API\ProspekControllerAPI@index');
Route::get('/prospek/{id}/agen', 'API\ProspekControllerAPI@retrieveByAgen');
Route::post('/prospek', 'API\ProspekControllerAPI@store');
Route::get('/prospek/{id}/show', 'API\ProspekControllerAPI@show');
Route::delete('/prospek/{id}/delete', 'API\ProspekControllerAPI@destroy');
Route::put('/prospek/{id}/edit', 'API\ProspekControllerAPI@update');
Route::put('/prospek/{id}/bayar', 'API\ProspekControllerAPI@bayar');
Route::get('/prospek/{id}/agen/total', 'API\ProspekControllerAPI@totalProspekByAgen');
// Route::get('/prospek/{id}/koordinator/total', 'API\ProspekControllerAPI@totalProspekByKoordinator');

// Kalkulasi API Route
Route::get('/kalkulasi', 'API\MasterKalkulasiControllerAPI@index');
Route::put('/kalkulasi/{id}/edit', 'API\MasterKalkulasiControllerAPI@update');

// Master Brosur API Route with resource
// Route::resource('brosur', 'API\MasterBrosurControllerAPI'); // DEPRECIATED

// FAQ's Route
Route::get('/faq', 'API\FAQControllerAPI@index');

// Galleriess' Route
Route::get('/gallery', 'API\GalleryControllerAPI@index');
Route::get('/gallery/dashboard', 'API\GalleryControllerAPI@retrieveByDashboard');
Route::get('/gallery/foto', 'API\GalleryControllerAPI@retrieveByFoto');
Route::get('/gallery/video', 'API\GalleryControllerAPI@retrieveByVideo');

// Hotel's API's Route 
Route::get('/hotel/{kota}', 'API\MasterHotelControllerAPI@retrieveHotelByKota');
Route::get('/hotel/{id}/show', 'API\MasterHotelControllerAPI@retrieveHotelByKotaDetail');
Route::get('/hotel/{id}/foto', 'API\MasterHotelControllerAPI@retrieveFotoByHotel');
Route::get('/hotel/{id}/video', 'API\MasterHotelControllerAPI@retrieveVideoByHotel');

// Master Notifikasi's API Route
Route::get('/notif/{id}/delivered', 'API\MasterNotifikasiControllerAPI@retrieveByDelivered');
Route::get('/notif/{id}/read', 'API\MasterNotifikasiControllerAPI@retrieveByRead');
Route::put('/notif/{id}/edit', 'API\MasterNotifikasiControllerAPI@markAsRead');
Route::put('/notif/{id}/clear', 'API\MasterNotifikasiControllerAPI@markAsReadAll');

// Master Periode API
Route::get('/periode', 'API\PeriodeControllerAPI@index');

// Master Sapaan API
Route::get('/sapaan', 'API\SapaanControllerAPI@index');

// Login API
Route::post('login', 'API\Auth\AnggotaControllerAPI@login');
Route::post('register', 'API\Auth\AnggotaControllerAPI@register');

// Check Auth
Route::post('details', 'API\Auth\AnggotaControllerAPI@details');


// Logout
Route::post('logout', 'API\Auth\AnggotaControllerAPI@logout');

Route::group(['middleware' => 'auth:api'], function(){
});

// Reset Password API

Route::post('/password/email', 'API\Auth\ForgotPasswordControllerAPI@getResetToken');
Route::post('/password/reset', 'API\Auth\ResetPasswordControllerAPI@reset');

// // TEST ROUTE
// Route::get('/test', function(){
//     // $ambilAgen = App\Jamaah::where('marketing', 'SM312')->where('status', '=', 'KOMISI')->where('periode', '1440')->get();
//     // Ini proses pengambilan data marketing fee nya 
//     $ambilMarketingFeePotensi = App\Jamaah::where('marketing', 'SM312')->where('status', '=', 'KOMISI')->where('periode', '1440')->sum('marketing_fee');
//     // Ini proses pengambilan data koordinator fee nya 
//     $ambilKoordinatorFeePotensi = App\Jamaah::where('marketing', 'SM312')->where('status', '=', 'KOMISI')->where('periode', '1440')->sum('koordinator_fee');
//     // Ini proses pengambilan data top fee nya
//     $ambilTopFeePotensi = App\Jamaah::where('marketing', 'SM312')->where('status', '=', 'KOMISI')->where('periode', '1440')->sum('top_fee');
//     // Penjumlahan hasil pengambilan data di atas
//      echo $sumofPotensi = $ambilMarketingFeePotensi + $ambilKoordinatorFeePotensi + $ambilTopFeePotensi;
//     // Akhir Perhitungan potensi
// });

Route::get('/indit', function(){
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
                'body' => 'Jamaah '. $in->nama .' akan berangkat pada tanggal '. date('d M Y', strtotime($in->tgl_berangkat)) .' (Hari ini)',
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
                'body' => 'Persiapan Jamaah '. $in->nama .' akan berangkat pada tanggal '. date('d M Y', strtotime($in->tgl_berangkat)) .' (H-3)',
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
});


Route::get('/balik', function(){
    
    $now = Carbon\Carbon::now();
    $now->addDays(3);
    $year = $now->year;
    $month = $now->month;
    $day = $now->day;
    $hariH = Carbon\Carbon::now();      
    $ref = App\Jamaah::where('tgl_pulang', $hariH->format('Y-m-d'))->orWhere('tgl_pulang', $now->format('Y-m-d'))->get(); // Get all of jamaah and inspect them
    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    foreach ($ref as $in) {
        if ($in->tgl_pulang == $hariH->format('Y-m-d')) {
            $recepient = App\User::where('id', $in->marketing)->first();
            $token = $recepient->device_token;
            $notification = [
                'title' => 'Kepulangan Jamaah',
                'body' => 'Jamaah '. $in->nama .' akan pulang kembali ke tanah air pada tanggal '. date('d M Y', strtotime($in->tgl_pulang)) .' (Hari ini)',
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
                'title' => 'Kepulangan Jamaah',
                'body' => 'Persiapan Jamaah '. $in->nama .' akan berpulang ke tanah air pada tanggal '. date('d M Y', strtotime($in->tgl_pulang)) .' (H-3)',
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
});

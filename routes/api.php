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
                DB::table('master_pendaftaran')->insert([   
                    'tgl_pendaftaran' => $diskon['tgl_pendaftaran'],
                    'id_umrah' => $diskon['id_umrah'],
                    'id_jamaah' => $diskon['id_jamaah'],
                    'nama_jamaah' => $diskon['nama_jamaah'],
                    'tgl_keberangkatan' => $diskon['tgl_keberangkatan'],
                    'staf_kantor' => $diskon['staf_kantor'],
                    'id_marketing' => $diskon['id_marketing'],
                    'diskon_kantor' => $diskon['diskon_kantor'],
                    'diskon_marketing' => $diskon['diskon_marketing'],
                    'fee_koordinator' => $diskon['fee_koordinator'],
                    'fee_marketing' => $diskon['fee_marketing']
                ]);
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
Route::get('/jamaah/{id}/koordinator', 'API\JamaahControllerAPI@retrieveByKoordinator');
Route::get('/jamaah/{id}/koordinatorfee/potensi', 'API\JamaahControllerAPI@feeByKoordinatorFeePotensi');
Route::get('/jamaah/{id}/agenfee/komisi', 'API\JamaahControllerAPI@feeByAgenKomisi');
Route::get('/jamaah/{id}/koordinatorfee/komisi', 'API\JamaahControllerAPI@feeByKoordinatorKomisi');

Route::get('/jamaah/{id}/koordinator/potensi', 'API\JamaahControllerAPI@koordinatorPotensi');
Route::get('/jamaah/{id}/koordinator/komisi', 'API\JamaahControllerAPI@koordinatorKomisi');
Route::get('/jamaah/{id}/agen/potensi', 'API\JamaahControllerAPI@agenPotensi');
Route::get('/jamaah/{id}/agen/komisi', 'API\JamaahControllerAPI@agenKomisi');
Route::get('/jamaah/{id}/agen/total', 'API\JamaahControllerAPI@totalJamaahByAgen');
Route::get('/jamaah/{id}/agen/berangkat/{tahun}/periode', 'API\JamaahControllerAPI@retrieveJamaahBerangkatByAgen');
Route::get('/jamaah/{id}/agen/pulang/{tahun}/periode', 'API\JamaahControllerAPI@retrieveJamaahPulangByAgen');



// Prospek API Route
Route::get('/prospek', 'API\ProspekControllerAPI@index');
Route::get('/prospek/{id}/agen', 'API\ProspekControllerAPI@retrieveByAgen');
Route::post('/prospek', 'API\ProspekControllerAPI@store');
Route::get('/prospek/{id}/show', 'API\ProspekControllerAPI@show');
Route::delete('/prospek/{id}/delete', 'API\ProspekControllerAPI@destroy');
Route::put('/prospek/{id}/edit', 'API\ProspekControllerAPI@update');
Route::put('/prospek/{id}/bayar', 'API\ProspekControllerAPI@bayar');
Route::get('/prospek/{id}/agen/total', 'API\ProspekControllerAPI@totalProspekByAgen');

// Kalkulasi API Route
Route::get('/kalkulasi', 'API\MasterKalkulasiControllerAPI@index');
Route::put('/kalkulasi/{id}/edit', 'API\MasterKalkulasiControllerAPI@update');

// Master Brosur API Route with resource
// Route::resource('brosur', 'API\MasterBrosurControllerAPI'); // DEPRECIATED

// FAQ's Route
Route::get('/faq', 'API\FAQControllerAPI@index');

// Galleriess' Route
Route::get('/gallery', 'API\GalleryControllerAPI@index');
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

// Master Periode API
Route::get('/periode', 'API\PeriodeControllerAPI@index');

// Master Sapaan API
Route::get('/sapaan', 'API\SapaanControllerAPI@index');

// Login API
Route::post('login', 'API\Auth\AnggotaControllerAPI@login');
Route::post('register', 'API\Auth\AnggotaControllerAPI@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'API\Auth\AnggotaControllerAPI@details');
});

// Reset Password API

Route::post('/password/email', 'API\Auth\ForgotPasswordControllerAPI@getResetToken');
Route::post('/password/reset', 'API\Auth\ResetPasswordControllerAPI@reset');


Route::get('/indit', function(){
	$now = Carbon\Carbon::now();
            $year = $now->year;
            $month = $now->month;
            $day = $now->day;
            $jamaah = \App\Jamaah::where('tgl_berangkat', '=', $day.'/'.$month.'/'.$year)->get();
            $totalJamaahBerangkat = count($jamaah);
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            foreach ($jamaah as $in) {

                $recepient = \App\User::find($in->marketing);
                $token = $recepient->device_token;
                
                $notification = [
                    'body' => $in->nama .' akan berangkat hari ini '. $in->tgl_berangkat,
                    'sound' => true,
                ];


                $sendNotify = \App\MasterNotifikasi::create([
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
	
});


Route::get('/balik', function(){
    $now = Carbon\Carbon::now();
            $year = $now->year;
            $month = $now->month;
            $day = $now->day;
            $jamaah = \App\Jamaah::where('tgl_pulang', '=', $day.'/'.$month.'/'.$year)->get();
            $totalJamaahBerangkat = count($jamaah);
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            foreach ($jamaah as $in) {

                $recepient = \App\User::find($in->marketing);
                $token = $recepient->device_token;
                
                $notification = [
                    'body' => $in->nama .' akan pulang hari ini '. $in->tgl_pulang,
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
    
});

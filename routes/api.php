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
Route::get('/jamaah/{id}/agen', 'API\JamaahControllerAPI@retrieveByAgen');
Route::get('/jamaah/{id}/agenfee/potensi', 'API\JamaahControllerAPI@feeByAgenPotensi');
Route::get('/jamaah/{id}/koordinator', 'API\JamaahControllerAPI@retrieveByKoordinator');
Route::get('/jamaah/{id}/koordinatorfee/potensi', 'API\JamaahControllerAPI@feeByKoordinatorFeePotensi');
Route::get('/jamaah/{id}/agenfee/komisi', 'API\JamaahControllerAPI@feeByAgenKomisi');
Route::get('/jamaah/{id}/koordinatorfee/komisi', 'API\JamaahControllerAPI@feeByKoordinatorKomisi');

Route::get('/jamaah/{id}/koordinator/potensi', 'API\JamaahControllerAPI@koordinatorPotensi');
Route::get('/jamaah/{id}/koordinator/komisi', 'API\JamaahControllerAPI@koordinatorKomisi');
Route::get('/jamaah/{id}/agen/potensi', 'API\JamaahControllerAPI@agenPotensi');
Route::get('/jamaah/{id}/agen/komisi', 'API\JamaahControllerAPI@agenKomisi');

Route::get('/jamaah/{id}/agen/total', 'API\JamaahControllerAPI@totalJamaahByAgen');
Route::get('/prospek/{id}/agen/total', 'API\ProspekControllerAPI@totalProspekByAgen');


// Prospek API Route
Route::get('/prospek', 'API\ProspekControllerAPI@index');
Route::get('/prospek/{id}/agen', 'API\ProspekControllerAPI@retrieveByAgen');
Route::post('/prospek', 'API\ProspekControllerAPI@store');
Route::get('/prospek/{id}/show', 'API\ProspekControllerAPI@show');
Route::delete('/prospek/{id}/delete', 'API\ProspekControllerAPI@destroy');
Route::put('/prospek/{id}/edit', 'API\ProspekControllerAPI@update');
Route::put('/prospek/{id}/bayar', 'API\ProspekControllerAPI@bayar');

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

// Login API
Route::post('login', 'API\Auth\AnggotaControllerAPI@login');
Route::post('register', 'API\Auth\AnggotaControllerAPI@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'API\Auth\AnggotaControllerAPI@details');
});

// Reset Password API

Route::post('/password/email', 'API\Auth\ForgotPasswordControllerAPI@getResetToken');
Route::post('/password/reset', 'API\Auth\ResetPasswordControllerAPI@reset');


Route::get('/get', function(){
	$agents = App\User::where('device_token', '!=', null)->get();
    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
	foreach ($agents as $agent) {
		$token = $agent->device_token;
                
                $notification = [
                    'body' => 'Asd345',
                    'sound' => true,
                ];


                // $sendNotify = MasterNotifikasi::create([
                //                                         'anggota_id' => $agent->anggota_id,
                //                                         'pesan' => $notification['body'],
                //                                         'status' => 'delivered'
                //                                         ]);
                
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

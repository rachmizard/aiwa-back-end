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

// List users 
Route::get('users', 'UserController@index');

// list users by id
Route::get('users/{id}', 'UserController@show');

// post users
Route::post('users', 'UserController@store');

Route::delete('users/delete/{id}', 'UserController@destroy');

// Jamaah API Route
Route::get('/jamaah', 'API\JamaahControllerAPI@index');
Route::post('/jamaah', 'API\JamaahControllerAPI@store');

// Prospek API Route
Route::get('/prospek', 'API\ProspekControllerAPI@index');
Route::post('/prospek', 'API\ProspekControllerAPI@store');
Route::get('/prospek/{id}/show', 'API\ProspekControllerAPI@show');
Route::delete('/prospek/{id}/delete', 'API\ProspekControllerAPI@destroy');

Route::post('login', 'API\Auth\AnggotaControllerAPI@login');
Route::post('register', 'API\Auth\AnggotaControllerAPI@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'API\Auth\AnggotaControllerAPI@details');
});

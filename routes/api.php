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

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

// Route::group(['middleware' => 'web'], function(){
// 	Route::get('/jamaah', 'JamaahController@index');
// 	Route::get('/jamaah/{id}', 'JamaahController@show');
// 	Route::post('/jamaah/insert', 'JamaahController@store');
// });

Auth::routes();
// Admin Login
Route::get('/home', 'HomeController@index');
  Route::prefix('admin')->group(function() {
    Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminLoginController@login')->name('admin.login.submit');
    Route::get('/createadmin', 'AdminLoginController@create');
    Route::post('/create', 'AdminLoginController@store')->name('admin.register.submit');
    Route::post('/logout', 'AdminController@logout')->name('admin.logout')->middleware('auth:admin');
    Route::get('/', 'AdminController@index')->name('admin.dashboard')->middleware('auth:admin')->middleware('auth:admin');
  });

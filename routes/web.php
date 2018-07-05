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


Route::prefix('aiwa')->group(function(){
	Auth::routes();
	Route::get('/home', 'HomeController@index')->name('aiwa.home');
	Route::get('/jamaah', 'JamaahController@index')->name('aiwa.jamaah');
	Route::get('/jamaah/tambah', 'JamaahController@create')->name('aiwa.jamaah.add');
	Route::post('/jamaah', 'JamaahController@store')->name('aiwa.jamaah.store');
	Route::get('/caljam', 'JamaahController@indexCalJam')->name('aiwa.caljam');
});


// for backup
  Route::prefix('admin')->group(function() {
  	// Login & logout's area
    Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'AdminController@logout')->name('admin.logout')->middleware('auth:admin');
    // end login's area
    // create admin's area
    Route::get('/createadmin', 'AdminLoginController@create');
    Route::post('/create', 'AdminLoginController@store')->name('admin.register.submit');
    // end create admin's area 

    // after logged-in it'll be get an authenticated.
    Route::get('/', 'AdminController@index')->name('admin.dashboard')->middleware('auth:admin')->middleware('auth:admin');

    // Route::get('/');
  });


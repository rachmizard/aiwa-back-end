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
})->middleware('auth:admin');

Route::get('/send/{token}', 'AdminController@sendNotify');
// Route::group(['middleware' => 'web'], function(){
// 	Route::get('/jamaah', 'JamaahController@index');
// 	Route::get('/jamaah/{id}', 'JamaahController@show');
// 	Route::post('/jamaah/insert', 'JamaahController@store');
// });


// Route::prefix('aiwa')->group(function(){
	Auth::routes();
// 	Route::get('/home', 'HomeController@index')->name('aiwa.home');
// 	Route::get('/jamaah', 'JamaahController@index')->name('aiwa.jamaah');
// 	Route::get('/jamaah/tambah', 'JamaahController@create')->name('aiwa.jamaah.add');
// 	Route::post('/jamaah', 'JamaahController@store')->name('aiwa.jamaah.store');
// 	Route::get('/caljam', 'JamaahController@indexCalJam')->name('aiwa.caljam');
// });


// for backup
  Route::prefix('admin')->group(function() {
  	// Login & logout's area
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'AdminController@logout')->name('admin.logout')->middleware('auth:admin');
    // end login's area

    Route::get('/profile', 'AdminProfileController@index')->name('aiwa.admin.profile');

    // Reset Password's area
    // Password Reset Routes...
    //admin password reset routes
    Route::post('password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/reset','Auth\AdminResetPasswordController@reset');
    Route::get('password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    // end Reset Password's area

    // create admin's area
    Route::get('/createadmin', 'AdminLoginController@create')->name('admin.register');
    Route::post('/create', 'AdminLoginController@store')->name('admin.register.submit');
    // end create admin's area 

    // after logged-in it'll be get an authenticated.
    Route::get('/home', 'AdminController@index')->name('admin.dashboard')->middleware('auth:admin')->middleware('auth:admin');
    
    // Jamaah
    Route::get('/jamaah', 'JamaahController@index')->name('aiwa.jamaah');
    Route::get('/jamaah/tambah', 'JamaahController@create')->name('aiwa.jamaah.add');
    Route::post('/jamaah', 'JamaahController@store')->name('aiwa.jamaah.store');
    Route::get('/jamaah/{id}/edit', 'JamaahController@edit')->name('aiwa.jamaah.edit-form');
    Route::post('/jamaah/{id}', 'JamaahController@update')->name('aiwa.jamaah.update'); // Will be continued!
    Route::get('/jamaah/{id}/edit', 'JamaahController@edit')->name('aiwa.jamaah.put');
    Route::get('/jamaah/{id}/delete', 'JamaahController@destroy')->name('aiwa.jamaah.delete');
    Route::get('/jamaah/loadTableJamaah', 'JamaahController@getData')->name('aiwa.jamaah.load');
    // End of Jamaah

    // Import Jamaah Excel
    Route::post('/jamaah/import', 'ImportJamaahController@importExcelJamaah')->name('aiwa.jamaah.store.import');
    Route::get('/jamaah/download/{type}', 'ImportJamaahController@downloadExcel')->name('aiwa.jamaah.download');
    Route::get('/jamaah/download/format/csv', 'DownloadFormatExcelController@downloadFormatJamaah')->name('aiwa.jamaah.format.download');
    // End Import Jamaah

    // Agen
    Route::get('agenjamaah', 'AgenController@index')->name('aiwa.anggota');
    Route::get('agenjamaah/loadTableAnggota', 'AgenController@getData')->name('aiwa.anggota.load');
    Route::put('agenjamaah/{id}/edit', 'AgenController@update')->name('aiwa.anggota.update');
    // End of agen

    // Import agen account
    Route::get('agenjamaah/import', 'AdminController@showImportForm')->name('aiwa.anggota.import');
    Route::post('agenjamaah/import/process', 'AdminController@importExcel')->name('aiwa.anggota.store.import');


    // Export Agen
Route::get('agenjamaah/downloadExcel/{type}', 'AdminController@downloadExcel')->name('aiwa.anggota.download.excel');

    // Prospek / Caljam
    Route::get('prospek', 'ProspekController@index')->name('aiwa.prospek');
    Route::post('prospek', 'ProspekController@store')->name('aiwa.prospek.store');
    Route::get('prospek/{id}/edit', 'ProspekController@edit')->name('aiwa.prospek.edit-form');
    Route::post('prospek/{id}', 'ProspekController@update')->name('aiwa.prospek.update');
    Route::get('prospek/{id}/delete', 'ProspekController@destroy')->name('aiwa.prospek.delete');
    Route::get('prospek/loadTableProspek', 'ProspekController@getData')->name('aiwa.prospek.load');
    // End

    // Master Itinerary
    Route::resource('master-itinerary', 'ItineraryController');
    Route::get('master-itinerary/{id}/delete', 'ItineraryController@destroy')->name('master-itinerary.destroy');
    Route::get('getMasterItineraryData', 'ItineraryController@getData')->name('aiwa.master-itinerary.load');
    // End Master Itinerary

    // Master Hotel
    Route::get('master-hotel', 'HotelController@index')->name('aiwa.master-hotel');
    Route::get('master-hotel/loadTableHotel', 'HotelController@getData')->name('aiwa.master-hotel.load.table');
    Route::get('master-hotel/tambah', 'HotelController@create')->name('aiwa.master-hotel.add');
    Route::post('master-hotel/tambah', 'HotelController@store')->name('aiwa.master-hotel.store');
    Route::get('master-hotel/{id}/edit', 'HotelController@edit')->name('aiwa.master-hotel.edit-form');
    Route::put('master-hotel/{id}', 'HotelController@update')->name('aiwa.master-hotel.update');
    // End Master Hotel

    // Master Brosur
    // Route::resource('master-brosur', 'MasterBrosurController'); // DEPRECIATED
    // Route::get('master-brosur/loadBrosur', 'MasterBrosurController@getData');// DEPRECIATED
    // End Master Brosur
      
    // Master Voucher
    // Route::resource('master-voucher', 'MasterVoucherController'); // DEPRECIATED
    // Route::get('master-voucher/loadBrosur', 'MasterVoucherController@getData'); // DEPRECIATED
    // End Master Voucher

    Route::resource('faq', 'FAQController');
    Route::get('faq/loadFaq', 'FAQController@getDataFuckersPlease');

    // Master Gallery
    Route::get('master-gallery', 'GalleryController@index')->name('aiwa.master-gallery');
    Route::post('master-gallery', 'GalleryController@store')->name('aiwa.master-gallery.store');
    Route::get('master-gallery/{id}/edit', 'GalleryController@edit')->name('aiwa.master-gallery.edit');
    Route::post('master-gallery/{id}/edit', 'GalleryController@update')->name('aiwa.master-gallery.update');
    Route::post('master-gallery/{id}/delete', 'GalleryController@destroy')->name('aiwa.master-gallery.destroy');
    Route::get('master-gallery/loadTableGallery', 'GalleryController@getData')->name('aiwa.master-gallery.load');
    Route::get('master-gallery/hotels', 'GalleryController@indexGalleryHotel')->name('aiwa.master-gallery.index.hotel');
    Route::get('master-gallery/hotels/loadTableGalleryHotel', 'GalleryController@getDataGalleryHotel')->name('aiwa.master-gallery.load.hotel');
    // End Master Gallery

    Route::get('master-kalkulasi', 'MasterKalkulasiController@edit')->name('aiwa.master-kalkulasi');
    Route::post('master-kalkulasi/{id}', 'MasterKalkulasiController@update')->name('aiwa.master-kalkulasi.update');
    Route::get('master-kalkulasi/loadTableKalkulasi', 'MasterKalkulasiController@getData')->name('aiwa.master-kalkulasi.load');

    // Log Activity
    Route::get('log-activity', 'LogActivityController@index')->name('aiwa.log-activity');
    // End Log

    Route::get('approval', 'AdminController@approval')->name('aiwa.approval');
    Route::get('approval/loadTableApproval', 'ApprovalController@index')->name('aiwa.approval.load');
    Route::put('approval/{id}/approve', 'ApprovalController@update')->name('aiwa.approved');
    Route::put('approval/{id}/unapproved', 'ApprovalController@unapproved')->name('aiwa.unapproved');

    // Retrieving API of Jadwal
    Route::get('master-jadwal', 'JadwalController@index')->name('aiwa.master-jadwal');
    // End
    Route::resource('master-broadcast', 'MasterBroadcastController');
    Route::get('sendtoagen', 'MasterBroadcastController@toAgen')->name('aiwa.master-broadcast.toagen');
    Route::post('sendtoagen/all', 'MasterBroadcastController@sendtoAllAgen')->name('master-broadcast.store.sendtoagen');

  });

Route::get('/download', function(){
    return redirect('https://drive.google.com/open?id=1lU1VFBiBRI5MDjpzAFXtBMx55E9FTYc2');
});

// SECRET ROUTE!

Route::get('/faker/agents',function(){
    $faker = Faker\Factory::create();

        $limit = 50;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([ //,
                'nama' => $faker->name,
                'no_ktp' => rand(0,100),
                'jenis_kelamin' => 'L',
                'alamat' => $faker->address,
                'no_telp' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'username' => $faker->username,
                'password' => bcrypt('baguvix'),
                'status' => '1',
                'koordinator' => $faker->name,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ]);
        }
});

Route::get('/faker/hotels',function(){
    $faker = Faker\Factory::create();

        $limit = 800;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('master_hotels')->insert([ //,
                'file' => $faker->name,
                'kota' => $faker->address,
                'nama' => $faker->name,
                'lokasi_map' => $faker->address,
                'skor' => rand(0,100)
            ]);
        }

        return redirect()->route('aiwa.master-hotel')->with('message', $limit.' data hotel has been automatically added!');
});

Route::get('/faker/prospeks',function(){
    $faker = Faker\Factory::create();

        $limit = 20;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('prospeks')->insert([ //,
                'anggota_id' => rand(0,10),
                'pic' => $faker->name,
                'no_telp' => rand(0,100),
                'jml_dewasa' => rand(0,5),
                'jml_infant' => rand(0,5),
                'jml_balita' => rand(0,5),
                'tgl_keberangkatan' => $faker->date,
                'jenis' => 'quard',
                'double' => 'ya',
                'triple' => 'ya',
                'quard' => 'ya',
                'passport' => 'ya',
                'meningitis' => 'ya',
                'pas_foto' => 'ya',
                'buku_nikah' => 'ya',
                'fc_akta' => 'ya',
                'visa_progresif' => 'ya',
                'diskon' => rand(0,100),
                'keterangan' => 'Nunggu konfirmasi',
                'tanggal_followup' => $faker->date,
                'pembayaran' => rand(0,100)
            ]);
        }

        return redirect()->back()->with('message', $limit.' data prospeks has been automatically added!');
});

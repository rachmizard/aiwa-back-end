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

// Just Test Route

Route::get('/', function () {
    return view('welcome');
});

// Read Notification
Route::get('readAllNotifications', function(){
    Auth()->guard('admin')->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('read.all.notification');

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
  Route::group(['prefix' => 'admin',  'middleware' => ['revalidate', 'session_timeout', 'is_admin']], function() {
    Route::get('notification', function(){
        Auth()->guard('admin')->user()->unreadNotifications->markAsRead();
        return view('notifications.index');
    })->name('admin.notification');

    Route::get('notification/{id}/delete', function($id){
        $notification = Auth()->guard('admin')->user()->readNotifications->where('id', $id)->first();
        $notification->delete();
        return redirect()->back();
    })->name('admin.delete.notification');

    Route::get('notification/deleteAll', function(){
        // Auth()->guard('admin')->user()->readNotifications->where('');
        // $notification->delete();
        DB::table('notifications')->select('notifications.*')->delete();
        return redirect()->back();
    })->name('admin.deleteall.notification');

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
    Route::get('/home', 'AdminController@index')->name('admin.dashboard');

    // Jamaah
    Route::get('/jamaah', 'JamaahController@index')->name('aiwa.jamaah');
    Route::get('/jamaah/tambah', 'JamaahController@create')->name('aiwa.jamaah.add');
    Route::post('/jamaah', 'JamaahController@store')->name('aiwa.jamaah.store');
    Route::get('/jamaah/{id}/edit', 'JamaahController@edit')->name('aiwa.jamaah.edit-form');
    Route::post('/jamaah/{id}/updatecuy', 'JamaahController@update')->name('aiwa.jamaah.updatecuy'); // Will be continued!
    Route::any('/jamaah/detail/export', 'JamaahController@detailJamaah')->name('aiwa.jamaah.detail');
    Route::get('/jamaah/{id}/delete', 'JamaahController@destroy')->name('aiwa.jamaah.delete');
    Route::post('/jamaah/deleteCheckbox', 'JamaahController@destroyMultiple')->name('aiwa.jamaah.delete.checkbox');

    Route::post('/jamaah/download/filter', 'JamaahController@downloadFilter')->name('aiwa.jamaah.downloadFilter');

    Route::get('/jamaah/loadTableJamaah', 'JamaahController@getData')->name('aiwa.jamaah.load');
    // End of Jamaah

    // Import Jamaah Excel
    Route::post('/jamaah/import', 'ImportJamaahController@importExcelJamaah')->name('aiwa.jamaah.store.import');
    Route::get('/jamaah/download/xlsx', 'ImportJamaahController@downloadExcel')->name('aiwa.jamaah.download');
    Route::get('/jamaah/download/format/xlsx', 'DownloadFormatExcelController@downloadFormatJamaah')->name('aiwa.jamaah.format.download');
    // End Import Jamaah

    // Rekap Closing Jamaah
    Route::get('/jamaah/rekap/closing/', 'RekapClosingAgenController@exportClosing')->name('aiwa.jamaah.rekap.exportClosing');
    Route::get('/jamaah/rekap/contoh/', 'RekapClosingAgenController@contoh')->name('aiwa.jamaah.rekap.contoh');
    Route::get('/jamaah/rekap/sinkron/', 'RekapClosingAgenController@sinkron')->name('aiwa.jamaah.rekap.sinkron');
    // End Rekap Closing

    // Agen
    Route::get('agenjamaah', 'AgenController@index')->name('aiwa.anggota');
    Route::get('agenjamaah/detail/export', function(Request $request){
        $agens = App\User::where('status', '=', 1)->get();
        return view('agen.detail', compact('agens'));
    })->name('aiwa.agen.detail');
    Route::get('agenjamaah/loadTableAnggota', 'AgenController@getData')->name('aiwa.anggota.load');
    Route::get('agenjamaah/{id}/edit', 'AgenController@edit')->name('aiwa.anggota.edit');
    Route::put('agenjamaah/{id}', 'AgenController@update')->name('aiwa.anggota.update');
    Route::put('agenjamaah/{id}/editaccount', 'AgenController@updateAkun')->name('aiwa.anggota.updateaccount');
    // End of agen

    // Import agen account
    Route::get('agenjamaah/import', 'AdminController@showImportForm')->name('aiwa.anggota.import');
    Route::post('agenjamaah/import/process', 'AdminController@importExcel')->name('aiwa.anggota.store.import');


    // Export Agen
Route::get('agenjamaah/downloadExcel/{type}', 'AgenController@downloadExcel')->name('aiwa.anggota.download.excel');

    // Prospek / Caljam
    Route::get('prospek', 'ProspekController@index')->name('aiwa.prospek');
    Route::post('prospek', 'ProspekController@store')->name('aiwa.prospek.store');
    Route::get('prospek/{id}/edit', 'ProspekController@edit')->name('aiwa.prospek.edit-form');
    Route::post('prospek/{id}', 'ProspekController@update')->name('aiwa.prospek.update');
    Route::post('prospek/{id}/delete', 'ProspekController@destroy')->name('aiwa.prospek.delete');
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
    Route::put('master-hotel/{id}/archive', 'HotelController@archive')->name('aiwa.master-hotel.archive');
    // Arsip Hotel
    Route::get('master-hotel/hotels/arsip', 'HotelController@indexArsipHotel')->name('aiwa.master-hotel.index.arsip');
    Route::get('master-hotel/loadTableHotel/arsip', 'HotelController@getDataArsipHotel')->name('aiwa.master-hotel.load.arsip');
    Route::put('master-hotel/{id}/unarchived', function($id){
        DB::table('master_hotels')->where('id', $id)->update(['status' => 'used']);
        $galleryHotels = DB::table('master_galleries')->where('judul', $id)->where('status', '=', 'archived')->get();
        foreach ($galleryHotels as $in) {
            DB::table('master_galleries')->where('id', $in->id)->update(['status' => 'used']);
        }
        return back();
    })->name('aiwa.master-hotel.unarchived');
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
    Route::get('master-gallery/{id}/edit/hotel', 'GalleryController@editHotel')->name('aiwa.master-gallery.edit.hotel');
    Route::post('master-gallery/{id}/edit', 'GalleryController@update')->name('aiwa.master-gallery.update');
    Route::post('master-gallery/{id}/delete', 'GalleryController@destroy')->name('aiwa.master-gallery.destroy');
    Route::get('master-gallery/loadTableGallery', 'GalleryController@getData')->name('aiwa.master-gallery.load');
    // Master Gallery Hotel
    Route::get('master-gallery/hotels', 'GalleryController@indexGalleryHotel')->name('aiwa.master-gallery.index.hotel');
    Route::get('master-gallery/hotels/loadTableGalleryHotel', 'GalleryController@getDataGalleryHotel')->name('aiwa.master-gallery.load.hotel');
    Route::put('master-gallery/hotels/{id}/archive', 'GalleryController@archive')->name('aiwa.master-gallery.archive');
    // End Master Gallery

    Route::get('master-kalkulasi', 'MasterKalkulasiController@edit')->name('aiwa.master-kalkulasi');
    Route::post('master-kalkulasi/{id}', 'MasterKalkulasiController@update')->name('aiwa.master-kalkulasi.update');
    Route::get('master-kalkulasi/loadTableKalkulasi', 'MasterKalkulasiController@getData')->name('aiwa.master-kalkulasi.load');

    // Log Activity
    Route::get('log-activity', 'LogActivityController@index')->name('aiwa.log-activity');
    // End Log

    Route::get('approval', 'ApprovalController@index')->name('aiwa.approval');
    Route::get('approval/loadTableApproval', 'ApprovalController@getData')->name('aiwa.approval.load');
    Route::put('approval/{id}/approve', 'ApprovalController@update')->name('aiwa.approved');
    Route::put('approval/{id}/unapproved', 'ApprovalController@unapproved')->name('aiwa.unapproved');
    Route::get('approval/{id}/destroy', 'ApprovalController@destroy')->name('aiwa.destroy');

    // Retrieving API of Jadwal
    Route::get('master-jadwal', 'JadwalController@index')->name('aiwa.master-jadwal');
    Route::get('master-jadwal/jadwalJson', 'JadwalController@jadwalJson')->name('aiwa.master-jadwal.jadwalJson');
    // End
    Route::resource('master-broadcast', 'MasterBroadcastController');
    Route::get('sendtoagen', 'MasterBroadcastController@toAgen')->name('aiwa.master-broadcast.toagen');
    Route::post('sendtoagen/all', 'MasterBroadcastController@store')->name('master-broadcast.store.sendtoagen');

    // Master Periode Route
    Route::get('master-periode', 'PeriodeController@index')->name('aiwa.master-periode.index');
    Route::get('master-periode/loadTablePeriode', 'PeriodeController@getData')->name('aiwa.master-periode.load');
    Route::post('master-periode/store', 'PeriodeController@store')->name('aiwa.master-periode.store');
    Route::post('master-periode/{id}/delete', 'PeriodeController@destroy')->name('aiwa.master-periode.destroy');
    Route::get('master-periode/{id}/show', 'PeriodeController@show')->name('aiwa.master-periode.show');
    Route::put('master-periode/{id}/update', 'PeriodeController@update')->name('aiwa.master-periode.update');
    Route::post('master-periode/{id}/active', 'PeriodeController@active')->name('aiwa.master-periode.active');

    // Master Sapaan
    Route::get('master-sapaan', 'SapaanController@index')->name('aiwa.master-sapaan.index');
    Route::get('master-sapaan/loadTableSapaan', 'SapaanController@getData')->name('aiwa.master-sapaan.load');
    Route::post('master-sapaan/store', 'SapaanController@store')->name('aiwa.master-sapaan.store');
    Route::put('master-sapaan/{id}/edit', 'SapaanController@update')->name('aiwa.master-sapaan.update');
    Route::post('master-sapaan/{id}/delete', 'SapaanController@destroy')->name('aiwa.master-sapaan.destroy');

    // Master Reminder
    Route::resource('master-reminder', 'ReminderController');

    // Master Sinkronisasi
    Route::get('master-sinkronisasi', 'SinkronisasiController@index')->name('aiwa.master-sinkronisasi.index');
    Route::post('master-sinkronisasi/store', 'SinkronisasiController@store')->name('aiwa.master-sinkronisasi.store');
    Route::post('master-sinkronisasi/{id}/select', 'SinkronisasiController@selected')->name('aiwa.master-sinkronisasi.selected');
    Route::put('master-sinkronisasi/{id}', 'SinkronisasiController@update')->name('aiwa.master-sinkronisasi.update');
    Route::get('master-sinkronisasi/{id}/show', 'SinkronisasiController@show')->name('aiwa.master-sinkronisasi.show');
    Route::delete('master-sinkronisasi/{id}/delete', 'SinkronisasiController@destroy')->name('aiwa.master-sinkronisasi.destroy');
    Route::get('master-sinkronisasi/loadDataSinkronisasi', 'SinkronisasiController@arjayEdan')->name('aiwa.master-sinkronisasi.load');

    // Dashboard Rekapan //
    Route::get('getJadwalUnique', 'DashboardRekapanController@getJadwalUnique')->name('aiwa.getJadwalUnique');
    Route::get('getAllAgents', 'DashboardRekapanController@getAllAgents')->name('aiwa.getAllAgents');
    Route::get('countRekapan', 'DashboardRekapanController@countRekapan')->name('aiwa.countRekapan');
    Route::get('getTotalByParams', 'DashboardRekapanController@getTotalByParams')->name('aiwa.getTotalByParams');
    Route::get('countTotalByBetween', 'DashboardRekapanController@countTotalByBetween')->name('aiwa.countTotalByBetween');
    // End Dashboard Rekapan //

    });

// Download apps
Route::get('/download', function(){
    return redirect('https://drive.google.com/open?id=126M6gsJIMpbjPfOlcw9Ph2Gn36M4C9QF');
});

Route::get('/download/format/jamaah/format_jamaah_official.xlsx', function(){
    return response()->download(storage_path('app/public/files/format_jamaah_official.xlsx'));
})->name('jamaah.download.format');

Route::get('/download/format/agen/format_agen_official.xlsx', function(){
    return response()->download(storage_path('app/public/files/format_agen_official.xlsx'));
})->name('agen.download.format');

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

Route::get('rekap/{start}/{end}/{paginate}', function($start, $end, $paginate){
        $users = App\User::pluck('id')->toArray();
        $datas = App\Jamaah::where('periode', '1440')->get();
        $list_agen = App\Rekap::orderBy('total', 'DESC')->where('periode', '1440')->paginate($paginate);
        $this_periode = '1440';
        $jadwal = App\Master_Jadwal::orderBy('tgl_berangkat', 'ASC')->where('periode', '1440')->whereBetween('tgl_berangkat', [$start, $end])->get();
        $count = array();
        $total_by_periode = array();
        $total_by_between = App\Jamaah::where('periode', $this_periode)->whereBetween('tgl_berangkat', [$start, $end])->count();
        $tgl_berangkat = array();
        foreach ($jadwal as $value) {
          $tgl_berangkat[] = $value->tgl_berangkat;
        }
        $unique_data = array_unique($tgl_berangkat);
    echo "<table border='1'>";
    echo " <tr>";
    echo " <td>KODE</td>";
    echo " <td>NAMA MARKETING</td>";
    echo " <td>TOTAL</td>";
            foreach ($unique_data as $val) {
                echo"<td> ". Carbon\Carbon::parse($val)->format('d-M-Y') ."</td>";
            }
            echo "</tr>";
        foreach ($list_agen as $value) {
            $total_by_periode = App\Jamaah::where('marketing', $value->anggota->id)->where('periode', $this_periode)->whereBetween('tgl_berangkat', [$start, $end])->count();
            echo "<tr>";
            echo "<td> ". $value->anggota->id ."</td>";
            echo "<td> ". $value->anggota->nama ."</td>";
            echo "<td> ". $total_by_periode ."</td>";
            foreach($unique_data as $in){
                $count[] = App\Jamaah::where('marketing', $value->anggota->id)->where('tgl_berangkat', $in)->where('periode', $this_periode)->count();
                if ($count[0] == 0) {
                    echo "<td></td>";
                }else{
                    echo "<td> ". App\Jamaah::where('marketing', $value->anggota->id)->where('tgl_berangkat', $in)->where('periode', $this_periode)->count() ."</td>";
                }
            }
        }
echo "            </tr>";
echo "            <tr>";
echo "                <td colspan='2'>GRAND TOTAL</td>";
echo "                <td colspan>". $total_by_between ."</td>";
                    foreach ($unique_data as $in) {
                        echo "<td>". App\Jamaah::where('tgl_berangkat', $in)->where('periode', $this_periode)->count() ."</td>";
                    }
echo "            </tr>";
echo "        </table>
". $list_agen->links() ."";
});
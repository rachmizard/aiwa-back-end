<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Sinkronisasi;
use App\Master_Jadwal;
use DB;

class SyncJadwal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:jadwal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

      // Truncate the table
      $requestJadwal = Master_Jadwal::where('periode', $validator['tahun'])->pluck('id_jadwal')->toArray();
      $delete = Master_Jadwal::whereIn('id_jadwal', $requestJadwal)->delete();
      $url = 'http://115.124.86.218/aiw/jadwal/'. $validator['tahun'];
      $json = file_get_contents($url);
      $jadwals = collect(json_decode($json, true));

      // dd($jadwals['data'][1]['jadwal']); // Ieu bisa
      // return view('test-api', compact('jadwals'));
      $test = $jadwals['data'];
      $count = count($test);
      if (!empty($test)) {
          for ($i=0; $i < $count ; $i++) {
              foreach ($jadwals['data'][$i]['jadwal'] as $key => $diskon) {
                  $data['id_jadwal'] = $diskon['id'];
                  $data['promo'] = $diskon['promo'];
                  $data['tgl_berangkat'] = $diskon['tgl_berangkat'];
                  $data['jam_berangkat'] = $diskon['jam_berangkat'];
                  $data['rute_berangkat'] = $diskon['rute_berangkat'];
                  $data['pesawat_berangkat'] = $diskon['pesawat_berangkat'];
                  $data['tgl_pulang'] = $diskon['tgl_pulang'];
                  $data['jam_pulang'] = $diskon['jam_pulang'];
                  $data['rute_pulang'] = $diskon['rute_pulang'];
                  $data['pesawat_pulang'] = $diskon['pesawat_pulang'];
                  $data['maskapai'] = $diskon['maskapai'];
                  $data['jml_hari'] = $diskon['jml_hari'];
                  $data['seat_total'] = $diskon['seat_total'];
                  $data['seat_terpakai'] = $diskon['seat_terpakai'];
                  $data['sisa'] = $diskon['sisa'];
                  $data['passpor'] = $diskon['passpor'];
                  $data['moffa'] = $diskon['moffa'];
                  $data['visa'] = $diskon['visa'];
                  $data['status'] = $diskon['status'];
                  $data['tgl_manasik'] = $diskon['tgl_manasik'];
                  $data['jam_manasik'] = $diskon['jam_manasik'];
                  $data['itinerary'] = $diskon['itinerary'];
                  $data['paket'] = json_encode($diskon['paket']);
                  $data['periode'] = $validator['tahun'];
                  $validator = DB::table('master_jadwals')->where('id_jadwal', '=', $diskon['id'])->first();
                  if ($validator) {
                      DB::table('master_jadwals')->where('id_jadwal', $validator->id)->update($data);
                  }else{
                      DB::table('master_jadwals')->insert($data);
                  }
              }
          }
      }
    }
}

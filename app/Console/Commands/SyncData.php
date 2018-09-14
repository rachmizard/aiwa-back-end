<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Sinkronisasi;
use Carbon\Carbon;
use DB;
use App\Admin;
use App\User;
use App\Jamaah;
use App\MasterNotifikasi;
use Notification;
use App\Notifications\SyncWeeklyNotification;

class SyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:pendaftaran';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi Berhasil!';

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
     
        // Star Syncron
        $validator = Sinkronisasi::where('status', 'selected')->first();
        $url = 'http://115.124.86.218/aiw/pendaftaran/'.$validator->tahun;
        $json = file_get_contents($url);
        $diskons = collect(json_decode($json, true));

        // dd($diskons['data'][1]['jadwal']); // Ieu bisa
        // return view('test-api', compact('diskons'));
        $test = $diskons['data'];
        $count = count($test);
        $wadahPeriode = $validator->tahun;

        for ($i=0; $i < $count ; $i++) {
            foreach ($diskons['data'][$i]['pendaftaran'] as $key => $diskon) {
                // Validator of master pendaftaran
                $validator = DB::table('master_pendaftaran')->where('id_jamaah', '=', $diskon['id_jamaah'])->first();
                // Validator of agen AIWA
                // $validatorMarketing = DB::table('users')->where('id', $data['id_marketing'])->first();
                // beres jing
                //Referensi uang yang ditransfer kantor
                $reference = 2250000;
                $top_ref = 250000;

                //Assign value id marketing untuk dicari di tabel User
                $anggota_id = $diskon['id_marketing'];
                $id_jamaah = $diskon['id_jamaah'];
                $data['id_umrah'] = $diskon['id_umrah'];
                $data['id_jamaah'] = $diskon['id_jamaah'];
                $data['tgl_daftar'] = $diskon['tgl_pendaftaran'];
                $data['nama'] = $diskon['nama_jamaah'];
                // $data['tgl_berangkat'] = date('d/m/Y', strtotime($diskon['tgl_keberangkatan']));
                // $data['tgl_pulang'] = date('d/m/Y', strtotime($diskon['tgl_kepulangan']));
                $data['tgl_berangkat'] = $diskon['tgl_keberangkatan'];
                $data['tgl_pulang'] = $diskon['tgl_kepulangan'];
                $data['marketing'] = $diskon['id_marketing'];
                $data['staff'] = $diskon['staf_kantor'];
                $data['promo'] = $diskon['promo'];

                $validatorB = Jamaah::where('id_jamaah', $diskon['id_jamaah'])->first();

                //TABEL MASTER PENDAFTARAN
                if ($validator) {
                    //UPDATE MASTER PENDAFTARAN
                    DB::table('master_pendaftaran')->where('id', $validator->id)->update([
                        'tgl_pendaftaran' => $diskon['tgl_pendaftaran'],
                        'id_umrah' => $diskon['id_umrah'],
                        'id_jamaah' => $diskon['id_jamaah'],
                        'nama_jamaah' => $diskon['nama_jamaah'],
                        'tgl_keberangkatan' => $diskon['tgl_keberangkatan'],
                        'tgl_kepulangan' => $diskon['tgl_kepulangan'],
                        'staf_kantor' => $diskon['staf_kantor'],
                        'id_marketing' => $diskon['id_marketing'],
                        'diskon_kantor' => $diskon['diskon_kantor'],
                        'diskon_marketing' => $diskon['diskon_marketing'],
                        'fee_koordinator' => $diskon['fee_koordinator'],
                        'promo' => $diskon['promo'],
                        'fee_marketing' => $diskon['fee_marketing']
                    ]);
                }else{
                    //BUAT BARU MASTER PENDAFTARAN
                    DB::table('master_pendaftaran')->insert([
                        'tgl_pendaftaran' => $diskon['tgl_pendaftaran'],
                        'id_umrah' => $diskon['id_umrah'],
                        'id_jamaah' => $diskon['id_jamaah'],
                        'nama_jamaah' => $diskon['nama_jamaah'],
                        'tgl_keberangkatan' => $diskon['tgl_keberangkatan'],
                        'tgl_kepulangan' => $diskon['tgl_kepulangan'],
                        'staf_kantor' => $diskon['staf_kantor'],
                        'id_marketing' => $diskon['id_marketing'],
                        'diskon_kantor' => $diskon['diskon_kantor'],
                        'diskon_marketing' => $diskon['diskon_marketing'],
                        'fee_koordinator' => $diskon['fee_koordinator'],
                        'promo' => $diskon['promo'],
                        'fee_marketing' => $diskon['fee_marketing']
                    ]);
                }
                // Selesai

                //TABEL JAMAAH
                if($validatorB){
                     //Update Data

                    //Cari di tabel User yang id nya sama seperti $anggota_id
                    $findKoordinator = User::find($diskon['id_marketing']);
                    $findDiskon = $diskon['diskon_marketing'];

                    //Promo
                    if($data['promo'] == "1"){
                        $promo = true;
                        $reference = 1200000;
                        $top_ref = 100000;
                        $k = $findKoordinator['koordinator'];
                        $f = $findKoordinator['fee_promo'];
                    }else{
                        $promo = false;
                        $reference = 2250000;
                        $top_ref = 250000;
                        $k = $findKoordinator['koordinator'];
                        $f = $findKoordinator['fee_reguler'];
                    }

                    if ($k == "SM000" ) {
                        //Jika PA ARI
                        if($findDiskon){
                            $d = $findDiskon;

                            if ($diskon['fee_marketing'] != 0) {
                                $data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
                                $data['koordinator'] = 'SM000';
                                $data['koordinator_fee'] = 0;
                                $data['top'] = 'SM000';
                                $data['top_fee'] = 0;
                                $data['diskon_marketing'] = $findDiskon;

                                $data['status'] = "KOMISI";
                            }else{
                                $data['marketing_fee'] = $f - $diskon['diskon_marketing'];
                                $data['koordinator'] = 'SM000';
                                $data['koordinator_fee'] = 0;
                                $data['top'] = 'SM000';
                                $data['top_fee'] = 0;
                                $data['diskon_marketing'] = $findDiskon;

                                $data['status'] = "POTENSI";
                            }
                        }else{
                            if ($diskon['fee_marketing'] != 0) {
                                $data['marketing_fee'] = $diskon['fee_marketing'];
                                $data['koordinator'] = 'SM000';
                                $data['koordinator_fee'] = 0;
                                $data['top'] = 'SM000';
                                $data['top_fee'] = 0;
                                $data['diskon_marketing'] = 0;

                                $data['status'] = "KOMISI";
                            }else{
                                $data['marketing_fee'] = $f;
                                $data['koordinator'] = 'SM000';
                                $data['koordinator_fee'] = 0;
                                $data['top'] = 'SM000';
                                $data['top_fee'] = 0;
                                $data['diskon_marketing'] = 0;

                                $data['status'] = "POTENSI";
                            }
                        }

                        DB::table('jamaah')->where('id', $validatorB['id'])->update([
                            'id_umrah' => $data['id_umrah'],
                            'id_jamaah' => $data['id_jamaah'],
                            'tgl_daftar' => $data['tgl_daftar'],
                            'nama' => $data['nama'],
                            'tgl_berangkat' => $data['tgl_berangkat'],
                            'tgl_pulang' => $data['tgl_pulang'],
                            'marketing' => $data['marketing'],
                            'staff' => $data['staff'],
                            // 'no_telp' => $data['no_telp'],
                            'marketing_fee' => $data['marketing_fee'],
                            'diskon_marketing' => $data['diskon_marketing'],
                            'koordinator' => $data['koordinator'],
                            'koordinator_fee' => $data['koordinator_fee'],
                            'top' => $data['top'],
                            'top_fee' => $data['top_fee'],
                            'status' => $data['status'],
                            'periode' => $wadahPeriode
                        ]);
                    }else if($k == "SM140"){
                        //JIKA KOORDINATORNYA PA ARI
                        if($findDiskon){
                            //JIKA ADA DISKON DARI SCRAPING
                            $d = $findDiskon;

                            if ($promo) {
                                //JIKA PROMO
                                if ($diskon['fee_marketing'] != 0) {
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon;

                                    $data['status'] = "KOMISI";
                                }else{
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $f - $diskon['diskon_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon;

                                    $data['status'] = "POTENSI";
                                }
                            }else{
                                //JIKA TIDAK PROMO
                                if ($diskon['fee_marketing'] != 0) {
                                    $totalLevel2 = $reference - $diskon['fee_marketing'];

                                    $data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon;

                                    $data['status'] = "KOMISI";
                                }else{
                                    $totalLevel2 = $reference - $f;

                                    $data['marketing_fee'] = $f - $diskon['diskon_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon;

                                    $data['status'] = "POTENSI";
                                }
                            }

                        }else{
                            //JIKA TIDAK ADA DISKON DARI SCRAPING

                            if ($promo) {
                                if ($diskon['fee_marketing'] != 0) {
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $diskon['fee_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = 0;

                                    $data['status'] = "KOMISI";
                                }else{
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $f;
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = 0;

                                    $data['status'] = "POTENSI";
                                }
                            }else{
                                if ($diskon['fee_marketing'] != 0) {
                                    $totalLevel2 = $reference - $diskon['fee_marketing'];

                                    $data['marketing_fee'] = $diskon['fee_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = 0;

                                    $data['status'] = "KOMISI";
                                }else{
                                    $totalLevel2 = $reference - $f;

                                    $data['marketing_fee'] = $f;
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = 0;

                                    $data['status'] = "POTENSI";
                                }
                            }

                        }

                        DB::table('jamaah')->where('id', $validatorB['id'])->update([
                            'id_umrah' => $data['id_umrah'],
                            'id_jamaah' => $data['id_jamaah'],
                            'tgl_daftar' => $data['tgl_daftar'],
                            'nama' => $data['nama'],
                            'tgl_berangkat' => $data['tgl_berangkat'],
                            'tgl_pulang' => $data['tgl_pulang'],
                            'marketing' => $data['marketing'],
                            'staff' => $data['staff'],
                            // 'no_telp' => $data['no_telp'],
                            'marketing_fee' => $data['marketing_fee'],
                            'diskon_marketing' => $data['diskon_marketing'],
                            'koordinator' => $data['koordinator'],
                            'koordinator_fee' => $data['koordinator_fee'],
                            'top' => $data['top'],
                            'top_fee' => $data['top_fee'],
                            'status' => $data['status'],
                            'periode' => $wadahPeriode
                        ]);
                    }else{
                        //JIKA KOORDINATORNYA SELAIN PA ARI
                        if($findDiskon){
                            //JIKA ADA DISKON DARI SCRAPING
                            $d = $findDiskon;

                            if ($diskon['fee_marketing'] != 0) {
                                $totalLevel3 = $reference - ($diskon['fee_marketing'] + $top_ref);

                                $data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
                                $data['koordinator'] = $k;
                                $data['koordinator_fee'] = $totalLevel3;
                                $data['top'] = 'SM140';
                                $data['top_fee'] = $top_ref;
                                $data['diskon_marketing'] = $findDiskon;

                                $data['status'] = "KOMISI";
                            }else{
                                $totalLevel3 = $reference - ($f + $top_ref);

                                $data['marketing_fee'] = $f - $diskon['diskon_marketing'];
                                $data['koordinator'] = $k;
                                $data['koordinator_fee'] = $totalLevel3;
                                $data['top'] = 'SM140';
                                $data['top_fee'] = $top_ref;
                                $data['diskon_marketing'] = $findDiskon;

                                $data['status'] = "POTENSI";
                            }
                        }else{
                            //JIKA TIDAK ADA DISKON DARI SCRAPING
                            if ($diskon['fee_marketing'] != 0) {
                                $totalLevel3 = $reference - ($diskon['fee_marketing'] + $top_ref);

                                $data['marketing_fee'] = $diskon['fee_marketing'];
                                $data['koordinator'] = $k;
                                $data['koordinator_fee'] = $totalLevel3;
                                $data['top'] = 'SM140';
                                $data['top_fee'] = $top_ref;
                                $data['diskon_marketing'] = 0;

                                $data['status'] = "KOMISI";
                            }else{
                                $totalLevel3 = $reference - ($f + $top_ref);

                                $data['marketing_fee'] = $f;
                                $data['koordinator'] = $k;
                                $data['koordinator_fee'] = $totalLevel3;
                                $data['top'] = 'SM140';
                                $data['top_fee'] = $top_ref;
                                $data['diskon_marketing'] = 0;

                                $data['status'] = "POTENSI";
                            }
                        }

                        DB::table('jamaah')->where('id', $validatorB['id'])->update([
                            'id_umrah' => $data['id_umrah'],
                            'id_jamaah' => $data['id_jamaah'],
                            'tgl_daftar' => $data['tgl_daftar'],
                            'nama' => $data['nama'],
                            'tgl_berangkat' => $data['tgl_berangkat'],
                            'tgl_pulang' => $data['tgl_pulang'],
                            'marketing' => $data['marketing'],
                            'staff' => $data['staff'],
                            // 'no_telp' => $data['no_telp'],
                            'marketing_fee' => $data['marketing_fee'],
                            'diskon_marketing' => $data['diskon_marketing'],
                            'koordinator' => $data['koordinator'],
                            'koordinator_fee' => $data['koordinator_fee'],
                            'top' => $data['top'],
                            'top_fee' => $data['top_fee'],
                            'status' => $data['status'],
                            'periode' => $wadahPeriode
                        ]);
                    }
                }else{
                    //Buat baru

                    //Cari di tabel User yang id nya sama seperti $anggota_id
                    $findKoordinator = User::find($diskon['id_marketing']);
                    $findDiskon = $diskon['diskon_marketing'];

                    //Promo
                    if($data['promo'] == "1"){
                        $promo = true;
                        $reference = 1200000;
                        $top_ref = 100000;
                        $k = $findKoordinator['koordinator'];
                        $f = $findKoordinator['fee_promo'];
                    }else{
                        $promo = false;
                        $reference = 2250000;
                        $top_ref = 250000;
                        $k = $findKoordinator['koordinator'];
                        $f = $findKoordinator['fee_reguler'];
                    }

                    if ($k == "SM000" ) {
                        if($findDiskon){
                            $d = $findDiskon;

                            if ($diskon['fee_marketing'] != 0) {
                                $data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
                                $data['koordinator'] = 'SM000';
                                $data['koordinator_fee'] = 0;
                                $data['top'] = 'SM000';
                                $data['top_fee'] = 0;
                                $data['diskon_marketing'] = $findDiskon;

                                $data['status'] = "KOMISI";
                            }else{
                                $data['marketing_fee'] = $f - $diskon['diskon_marketing'];
                                $data['koordinator'] = 'SM000';
                                $data['koordinator_fee'] = 0;
                                $data['top'] = 'SM000';
                                $data['top_fee'] = 0;
                                $data['diskon_marketing'] = $findDiskon;

                                $data['status'] = "POTENSI";
                            }
                        }else{
                            if ($diskon['fee_marketing'] != 0) {
                                $data['marketing_fee'] = $diskon['fee_marketing'];
                                $data['koordinator'] = 'SM000';
                                $data['koordinator_fee'] = 0;
                                $data['top'] = 'SM000';
                                $data['top_fee'] = 0;
                                $data['diskon_marketing'] = 0;

                                $data['status'] = "KOMISI";
                            }else{
                                $data['marketing_fee'] = $f;
                                $data['koordinator'] = 'SM000';
                                $data['koordinator_fee'] = 0;
                                $data['top'] = 'SM000';
                                $data['top_fee'] = 0;
                                $data['diskon_marketing'] = 0;

                                $data['status'] = "POTENSI";
                            }
                        }

                        DB::table('jamaah')->insert([
                            'id_umrah' => $data['id_umrah'],
                            'id_jamaah' => $data['id_jamaah'],
                            'tgl_daftar' => $data['tgl_daftar'],
                            'nama' => $data['nama'],
                            'tgl_berangkat' => $data['tgl_berangkat'],
                            'tgl_pulang' => $data['tgl_pulang'],
                            'marketing' => $data['marketing'],
                            'staff' => $data['staff'],
                            // 'no_telp' => $data['no_telp'],
                            'marketing_fee' => $data['marketing_fee'],
                            'diskon_marketing' => $data['diskon_marketing'],
                            'koordinator' => $data['koordinator'],
                            'koordinator_fee' => $data['koordinator_fee'],
                            'top' => $data['top'],
                            'top_fee' => $data['top_fee'],
                            'status' => $data['status'],
                            'periode' => $wadahPeriode
                        ]);
                    }else if($k == "SM140"){
                        if($findDiskon){
                            $d = $findDiskon;

                            if ($promo) {
                                if ($diskon['fee_marketing'] != 0) {
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon;

                                    $data['status'] = "KOMISI";
                                }else{
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $f - $diskon['diskon_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon;

                                    $data['status'] = "POTENSI";
                                }
                            }else{
                                if ($diskon['fee_marketing'] != 0) {
                                    $totalLevel2 = $reference - $diskon['fee_marketing'];

                                    $data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon;

                                    $data['status'] = "KOMISI";
                                }else{
                                    $totalLevel2 = $reference - $f;

                                    $data['marketing_fee'] = $f - $diskon['diskon_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = $findDiskon;

                                    $data['status'] = "POTENSI";
                                }
                            }

                        }else{

                            if ($promo) {
                                if ($diskon['fee_marketing'] != 0) {
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $diskon['fee_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = 0;

                                    $data['status'] = "KOMISI";
                                }else{
                                    $totalLevel2 = 100000;

                                    $data['marketing_fee'] = $f;
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = 0;

                                    $data['status'] = "POTENSI";
                                }
                            }else{
                                if ($diskon['fee_marketing'] != 0) {
                                    $totalLevel2 = $reference - $diskon['fee_marketing'];

                                    $data['marketing_fee'] = $diskon['fee_marketing'];
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = 0;

                                    $data['status'] = "KOMISI";
                                }else{
                                    $totalLevel2 = $reference - $f;

                                    $data['marketing_fee'] = $f;
                                    $data['koordinator'] = $k;
                                    $data['koordinator_fee'] = $totalLevel2;
                                    $data['top'] = 'SM140';
                                    $data['top_fee'] = 0;
                                    $data['diskon_marketing'] = 0;

                                    $data['status'] = "POTENSI";
                                }
                            }

                        }

                        DB::table('jamaah')->insert([
                            'id_umrah' => $data['id_umrah'],
                            'id_jamaah' => $data['id_jamaah'],
                            'tgl_daftar' => $data['tgl_daftar'],
                            'nama' => $data['nama'],
                            'tgl_berangkat' => $data['tgl_berangkat'],
                            'tgl_pulang' => $data['tgl_pulang'],
                            'marketing' => $data['marketing'],
                            'staff' => $data['staff'],
                            // 'no_telp' => $data['no_telp'],
                            'marketing_fee' => $data['marketing_fee'],
                            'diskon_marketing' => $data['diskon_marketing'],
                            'koordinator' => $data['koordinator'],
                            'koordinator_fee' => $data['koordinator_fee'],
                            'top' => $data['top'],
                            'top_fee' => $data['top_fee'],
                            'status' => $data['status'],
                            'periode' => $wadahPeriode
                        ]);
                    }else{
                        // JIKA SELAIN PA ARI
                        if($findDiskon){
                            $d = $findDiskon;

                            if ($diskon['fee_marketing'] != 0) {
                                $totalLevel3 = $reference - ($diskon['fee_marketing'] + $top_ref);

                                $data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
                                $data['koordinator'] = $k;
                                $data['koordinator_fee'] = $totalLevel3;
                                $data['top'] = 'SM140';
                                $data['top_fee'] = $top_ref;
                                $data['diskon_marketing'] = $findDiskon;

                                $data['status'] = "KOMISI";
                            }else{
                                $totalLevel3 = $reference - ($f + $top_ref);

                                $data['marketing_fee'] = $f - $diskon['diskon_marketing'];
                                $data['koordinator'] = $k;
                                $data['koordinator_fee'] = $totalLevel3;
                                $data['top'] = 'SM140';
                                $data['top_fee'] = $top_ref;
                                $data['diskon_marketing'] = $findDiskon;

                                $data['status'] = "POTENSI";
                            }
                        }else{
                            if ($diskon['fee_marketing'] != 0) {
                                $totalLevel3 = $reference - ($diskon['fee_marketing'] + $top_ref);

                                $data['marketing_fee'] = $diskon['fee_marketing'];
                                $data['koordinator'] = $k;
                                $data['koordinator_fee'] = $totalLevel3;
                                $data['top'] = 'SM140';
                                $data['top_fee'] = $top_ref;
                                $data['diskon_marketing'] = 0;

                                $data['status'] = "KOMISI";
                            }else{
                                $totalLevel3 = $reference - ($f + $top_ref);

                                $data['marketing_fee'] = $f;
                                $data['koordinator'] = $k;
                                $data['koordinator_fee'] = $totalLevel3;
                                $data['top'] = 'SM140';
                                $data['top_fee'] = $top_ref;
                                $data['diskon_marketing'] = 0;

                                $data['status'] = "POTENSI";
                            }
                        }

                        DB::table('jamaah')->insert([
                            'id_umrah' => $data['id_umrah'],
                            'id_jamaah' => $data['id_jamaah'],
                            'tgl_daftar' => $data['tgl_daftar'],
                            'nama' => $data['nama'],
                            'tgl_berangkat' => $data['tgl_berangkat'],
                            'tgl_pulang' => $data['tgl_pulang'],
                            'marketing' => $data['marketing'],
                            'staff' => $data['staff'],
                            // 'no_telp' => $data['no_telp'],
                            'marketing_fee' => $data['marketing_fee'],
                            'diskon_marketing' => $data['diskon_marketing'],
                            'koordinator' => $data['koordinator'],
                            'koordinator_fee' => $data['koordinator_fee'],
                            'top' => $data['top'],
                            'top_fee' => $data['top_fee'],
                            'status' => $data['status'],
                            'periode' => $wadahPeriode
                        ]);
                    }
                }
            }
        }
        // $now = Carbon::now();
        // $year = $now->year;
        // $month = $now->month;
        // $day = $now->day;

        // It will be sent to database notification
        $message = 'Just test';
        $admin = Admin::find(1);
        $admin->notify(new SyncWeeklyNotification($message));
        $pakAri = User::where('id', '=', 'SM140')->first();

        // Send push notification to Pak Ari
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $recepient = User::find($pakAri->id);
        $token = $recepient->device_token;

        $notification = [
            'body' => 'Sinkronisasi data jamaah kantor berhasil di lakukan',
            'sound' => true,
        ];


        $sendNotify = MasterNotifikasi::create([
                                                'anggota_id' => $recepient->id,
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

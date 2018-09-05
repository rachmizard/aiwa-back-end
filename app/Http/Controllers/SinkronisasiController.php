<?php

namespace App\Http\Controllers;

use App\Sinkronisasi;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use DB;
use App\Admin;
use App\User;
use App\Jamaah;
use App\MasterNotifikasi;
use Notification;
use App\Notifications\SyncWeeklyNotification;

class SinkronisasiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$sinkronisasis = Sinkronisasi::all();
    	return view('sinkronisasi.index', compact('sinkronisasis'));
    }

    public function arjayEdan(Datatables $datatables)
    {

    	$query = DB::table('master_sinkronisasi');
        return $datatables->of($query)
        ->addColumn('action', function($gg){
            return '
            <div class="btn-group">
                    <form action="'. route('aiwa.master-sinkronisasi.destroy', $gg->id) .'" method="POST">
                    '. csrf_field() .' '. method_field('DELETE') .'
                    <a href="#" data-toggle="modal" data-target="#editModal'. $gg->id .'" class="btn btn-info tooltip-btn" data-toggle="tooltip" data-placement="right" data-original-title="Edit" title="Edit"><i class="fa fa-edit"></i></a>
                    <input type="hidden" id="id" value="'. $gg->id .'">
                    <button type="submit" onclick="confirmBtn()" class="btn btn-danger tooltip-btn" data-toggle="tooltip" data-placement="right" data-original-title="Hapus" title="Hapus"><i class="fa fa-trash"></i></button>
                    </form>
            </div>';
        })
        ->editColumn('status', function($gg){
        	return $gg->status == 'selected' ? '<h3 class="text-center"></i">
                <i class="fa fa-check text-success text-center"></i>
            </h3>' : '
                <h3 class="text-center">
                    <i class="ion-android-close"></i>
                </h3>
            ';
        })
        ->rawColumns(['action', 'status'])
        ->make(true);
    }

    public function store(Request $request)
    {
    	$sinkronisasi = Sinkronisasi::create([
    		'tahun' => $request->tahun,
    		'status' => 'no'
    	]);
    	return response()->json($sinkronisasi);
    }

    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {
    	
    }


    public function selected(Request $request, $id)
    {
    	$getDefault = Sinkronisasi::where('status', 'selected')->get();
    	foreach ($getDefault as $value) {
    		if ($value->status == 'selected') {
	    		$data = Sinkronisasi::find($value->id);
	    		$data->status = 'no';
	    		$data->update();
    		}
    	}
    	$sinkronisasi = Sinkronisasi::find($id);
    	$sinkronisasi->status = 'selected';
    	$sinkronisasi->update();

    	// Start Syncron

    	$validator = Sinkronisasi::where('status', 'selected')->first();
        $url = 'http://115.124.86.218/aiw/pendaftaran/'.$validator->tahun;
        $json = file_get_contents($url);
        $diskons = collect(json_decode($json, true));
        
        // dd($diskons['data'][1]['jadwal']); // Ieu bisa
        // return view('test-api', compact('diskons'));
        $test = $diskons['data'];
        $count = count($test);

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
                $data['tgl_berangkat'] = date('d/m/Y', strtotime($diskon['tgl_keberangkatan']));
                $data['tgl_pulang'] = date('d/m/Y', strtotime($diskon['tgl_kepulangan']));
                $data['marketing'] = $diskon['id_marketing'];
                $data['staff'] = $diskon['staf_kantor'];

 				$validatorB = Jamaah::where('id_jamaah', $diskon['id_jamaah'])->first();

                if ($validator) {
                	// Update
                    DB::table('master_pendaftaran')->where('id', $validator->id)->update([   
	                    'tgl_pendaftaran' => $diskon['tgl_pendaftaran'],
	                    'id_umrah' => $diskon['id_umrah'],
	                    'id_jamaah' => $diskon['id_jamaah'],
	                    'nama_jamaah' => $diskon['nama_jamaah'],
                        'tgl_keberangkatan' => date('d/m/Y', strtotime($diskon['tgl_keberangkatan'])),
	                    'tgl_kepulangan' => date('d/m/Y', strtotime($diskon['tgl_kepulangan'])),
	                    'staf_kantor' => $diskon['staf_kantor'],
	                    'id_marketing' => $diskon['id_marketing'],
	                    'diskon_kantor' => $diskon['diskon_kantor'],
	                    'diskon_marketing' => $diskon['diskon_marketing'],
	                    'fee_koordinator' => $diskon['fee_koordinator'],
	                    'fee_marketing' => $diskon['fee_marketing']
	                ]);
                }else{
                    // DB::table('master_pendaftaran')->insert($data);
                    DB::table('master_pendaftaran')->insert([   
	                    'tgl_pendaftaran' => $diskon['tgl_pendaftaran'],
	                    'id_umrah' => $diskon['id_umrah'],
	                    'id_jamaah' => $diskon['id_jamaah'],
	                    'nama_jamaah' => $diskon['nama_jamaah'],
                        'tgl_keberangkatan' => date('d/m/Y', strtotime($diskon['tgl_keberangkatan'])),
	                    'tgl_kepulangan' => date('d/m/Y', strtotime($diskon['tgl_kepulangan'])),
	                    'staf_kantor' => $diskon['staf_kantor'],
	                    'id_marketing' => $diskon['id_marketing'],
	                    'diskon_kantor' => $diskon['diskon_kantor'],
	                    'diskon_marketing' => $diskon['diskon_marketing'],
	                    'fee_koordinator' => $diskon['fee_koordinator'],
	                    'fee_marketing' => $diskon['fee_marketing']
            		]);
                }
                // Selesai

                if($validatorB){
                	 //Update Data

                    //Cari di tabel User yang id nya sama seperti $anggota_id
                    $findKoordinator = User::find($diskon['id_marketing']);
                    $findDiskon = $diskon['diskon_marketing'];

                    $k = $findKoordinator['koordinator'];
                    $f = $findKoordinator['fee_reguler'];

                    // $ref = $reference - $refdiskon;
                    if ($k == "SM000" ) {
                        if($findDiskon){
                            $d = $findDiskon;

                            if ($diskon['fee_marketing'] != 0) {
                            	$data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
	                            $data['koordinator'] = 'SM000';
	                            $data['koordinator_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
	                            $data['diskon_marketing'] = $findDiskon;

	                            $data['status'] = "KOMISI";
                            }else{
                            	$data['marketing_fee'] = $f - $diskon['diskon_marketing'];
	                            $data['koordinator'] = 'SM000';
	                            $data['koordinator_fee'] = $f - $diskon['diskon_marketing'];
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $f - $diskon['diskon_marketing'];
	                            $data['diskon_marketing'] = $findDiskon;

	                            $data['status'] = "POTENSI";
                            }
                        }else{
                            if ($diskon['fee_marketing'] != 0) {
                            	$data['marketing_fee'] = $diskon['fee_marketing'];
	                            $data['koordinator'] = 'SM000';
	                            $data['koordinator_fee'] = $diskon['fee_marketing'];
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $diskon['fee_marketing'];
	                            $data['diskon_marketing'] = 0;

	                            $data['status'] = "KOMISI";
                            }else{
                            	$data['marketing_fee'] = $f;
	                            $data['koordinator'] = 'SM000';
	                            $data['koordinator_fee'] = $f;
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $f;
	                            $data['diskon_marketing'] = 0;

	                            $data['status'] = "POTENSI";
                            }
                        }

                        // DB::table('jamaah')->where('id', $data['id'])->update($data);
                        DB::table('jamaah')->where('id', $validatorB['id'])->update([   
		                    'id_umrah' => $data['id_umrah'],
		                    'id_jamaah' => $data['id_jamaah'],
		                    'tgl_daftar' => $data['tgl_daftar'],
		                    'nama' => $data['nama'],
		                    'tgl_berangkat' => $data['tgl_berangkat'],
		                    'tgl_pulang' => $data['tgl_pulang'],
		                    'marketing' => $data['marketing'],
		                    'staff' => $data['staff'],
		                    'no_telp' => $data['no_telp'],
		                    'marketing_fee' => $data['marketing_fee'],
		                    'diskon_marketing' => $data['diskon_marketing'],
		                    'koordinator' => $data['koordinator'],
		                    'koordinator_fee' => $data['koordinator_fee'],
		                    'top' => $data['top'],
		                    'top_fee' => $data['top_fee'],
		                    'status' => $data['status'],
	            		]);
                    }else if($k == "SM140"){
                        // $totalLevel2 = $findKoordinator->fee_reguler - $refdiskon - ($ref - $findKoordinator->fee_reguler - $refdiskon);
                        if($findDiskon){
                            $d = $findDiskon;

                            if ($diskon['fee_marketing'] != 0) {
                            	$totalLevel2 = $reference - $diskon['fee_marketing'];

                            	$data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
	                            $data['koordinator'] = $k;
	                            $data['koordinator_fee'] = $totalLevel2;
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $totalLevel2;
	                            $data['diskon_marketing'] = $findDiskon;

	                            $data['status'] = "KOMISI";
                            }else{
                            	$totalLevel2 = $reference - $f;

                            	$data['marketing_fee'] = $f - $diskon['diskon_marketing'];
	                            $data['koordinator'] = $k;
	                            $data['koordinator_fee'] = $totalLevel2;
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $totalLevel2;
	                            $data['diskon_marketing'] = $findDiskon;

	                            $data['status'] = "POTENSI";
                            }
                        }else{
                            if ($diskon['fee_marketing'] != 0) {
                            	$totalLevel2 = $reference - $diskon['fee_marketing'];

                            	$data['marketing_fee'] = $diskon['fee_marketing'];
	                            $data['koordinator'] = $k;
	                            $data['koordinator_fee'] = $totalLevel2;
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $totalLevel2;
	                            $data['diskon_marketing'] = 0;

	                            $data['status'] = "KOMISI";
                            }else{
                            	$totalLevel2 = $reference - $f;

                            	$data['marketing_fee'] = $f;
	                            $data['koordinator'] = $k;
	                            $data['koordinator_fee'] = $totalLevel2;
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $totalLevel2;
	                            $data['diskon_marketing'] = 0;

	                            $data['status'] = "POTENSI";
                            }
                        }

                        // DB::table('jamaah')->where('id', $data['id'])->update($data);
                        DB::table('jamaah')->where('id', $validatorB['id'])->update([   
		                    'id_umrah' => $data['id_umrah'],
		                    'id_jamaah' => $data['id_jamaah'],
		                    'tgl_daftar' => $data['tgl_daftar'],
		                    'nama' => $data['nama'],
		                    'tgl_berangkat' => $data['tgl_berangkat'],
		                    'tgl_pulang' => $data['tgl_pulang'],
		                    'marketing' => $data['marketing'],
		                    'staff' => $data['staff'],
		                    'no_telp' => $data['no_telp'],
		                    'marketing_fee' => $data['marketing_fee'],
		                    'diskon_marketing' => $data['diskon_marketing'],
		                    'koordinator' => $data['koordinator'],
		                    'koordinator_fee' => $data['koordinator_fee'],
		                    'top' => $data['top'],
		                    'top_fee' => $data['top_fee'],
		                    'status' => $data['status'],
	            		]);
                    }else{
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

                        // DB::table('jamaah')->where('id', $data['id'])->update($data);
                        DB::table('jamaah')->where('id', $validatorB['id'])->update([   
		                    'id_umrah' => $data['id_umrah'],
		                    'id_jamaah' => $data['id_jamaah'],
		                    'tgl_daftar' => $data['tgl_daftar'],
		                    'nama' => $data['nama'],
		                    'tgl_berangkat' => $data['tgl_berangkat'],
		                    'tgl_pulang' => $data['tgl_pulang'],
		                    'marketing' => $data['marketing'],
		                    'staff' => $data['staff'],
		                    'no_telp' => $data['no_telp'],
		                    'marketing_fee' => $data['marketing_fee'],
		                    'diskon_marketing' => $data['diskon_marketing'],
		                    'koordinator' => $data['koordinator'],
		                    'koordinator_fee' => $data['koordinator_fee'],
		                    'top' => $data['top'],
		                    'top_fee' => $data['top_fee'],
		                    'status' => $data['status'],
	            		]);
                    }
                }else{
                	//Buat baru

                    //Cari di tabel User yang id nya sama seperti $anggota_id
                    $findKoordinator = User::find($diskon['id_marketing']);
                    $findDiskon = $diskon['diskon_marketing'];

                    // $k = $findKoordinator->koordinator;
                    $k = $findKoordinator['koordinator'];
                    $f = $findKoordinator['fee_reguler'];

                    // $ref = $reference - $refdiskon;
                    if ($k == "SM000" ) {
                        if($findDiskon){
                            $d = $findDiskon;

                            if ($diskon['fee_marketing'] != 0) {
                            	$data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
	                            $data['koordinator'] = 'SM000';
	                            $data['koordinator_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
	                            $data['diskon_marketing'] = $findDiskon;

	                            $data['status'] = "KOMISI";
                            }else{
                            	$data['marketing_fee'] = $f - $diskon['diskon_marketing'];
	                            $data['koordinator'] = 'SM000';
	                            $data['koordinator_fee'] = $f - $diskon['diskon_marketing'];
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $f - $diskon['diskon_marketing'];
	                            $data['diskon_marketing'] = $findDiskon;

	                            $data['status'] = "POTENSI";
                            }
                        }else{
                            if ($diskon['fee_marketing'] != 0) {
                            	$data['marketing_fee'] = $diskon['fee_marketing'];
	                            $data['koordinator'] = 'SM000';
	                            $data['koordinator_fee'] = $diskon['fee_marketing'];
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $diskon['fee_marketing'];
	                            $data['diskon_marketing'] = 0;

	                            $data['status'] = "KOMISI";
                            }else{
                            	$data['marketing_fee'] = $f;
	                            $data['koordinator'] = 'SM000';
	                            $data['koordinator_fee'] = $f;
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $f;
	                            $data['diskon_marketing'] = 0;

	                            $data['status'] = "POTENSI";
                            }
                        }

                        // DB::table('jamaah')->insert($data);
                        DB::table('jamaah')->insert([   
		                    'id_umrah' => $data['id_umrah'],
		                    'id_jamaah' => $data['id_jamaah'],
		                    'tgl_daftar' => $data['tgl_daftar'],
		                    'nama' => $data['nama'],
		                    'tgl_berangkat' => $data['tgl_berangkat'],
		                    'tgl_pulang' => $data['tgl_pulang'],
		                    'marketing' => $data['marketing'],
		                    'staff' => $data['staff'],
		                    'no_telp' => $data['no_telp'],
		                    'marketing_fee' => $data['marketing_fee'],
		                    'diskon_marketing' => $data['diskon_marketing'],
		                    'koordinator' => $data['koordinator'],
		                    'koordinator_fee' => $data['koordinator_fee'],
		                    'top' => $data['top'],
		                    'top_fee' => $data['top_fee'],
		                    'status' => $data['status'],
	            		]);
                    }else if($k == "SM140"){
                        // $totalLevel2 = $findKoordinator->fee_reguler - $refdiskon - ($ref - $findKoordinator->fee_reguler - $refdiskon);
                        if($findDiskon){
                            $d = $findDiskon;

                            if ($diskon['fee_marketing'] != 0) {
                            	$totalLevel2 = $reference - $diskon['fee_marketing'];

                            	$data['marketing_fee'] = $diskon['fee_marketing'] - $diskon['diskon_marketing'];
	                            $data['koordinator'] = $k;
	                            $data['koordinator_fee'] = $totalLevel2;
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $totalLevel2;
	                            $data['diskon_marketing'] = $findDiskon;

	                            $data['status'] = "KOMISI";
                            }else{
                            	$totalLevel2 = $reference - $f;

                            	$data['marketing_fee'] = $f - $diskon['diskon_marketing'];
	                            $data['koordinator'] = $k;
	                            $data['koordinator_fee'] = $totalLevel2;
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $totalLevel2;
	                            $data['diskon_marketing'] = $findDiskon;

	                            $data['status'] = "POTENSI";
                            }
                        }else{
                            if ($diskon['fee_marketing'] != 0) {
                            	$totalLevel2 = $reference - $diskon['fee_marketing'];

                            	$data['marketing_fee'] = $diskon['fee_marketing'];
	                            $data['koordinator'] = $k;
	                            $data['koordinator_fee'] = $totalLevel2;
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $totalLevel2;
	                            $data['diskon_marketing'] = 0;

	                            $data['status'] = "KOMISI";
                            }else{
                            	$totalLevel2 = $reference - $f;

                            	$data['marketing_fee'] = $f;
	                            $data['koordinator'] = $k;
	                            $data['koordinator_fee'] = $totalLevel2;
	                            $data['top'] = 'SM140';
	                            $data['top_fee'] = $totalLevel2;
	                            $data['diskon_marketing'] = 0;

	                            $data['status'] = "POTENSI";
                            }
                        }

                        // DB::table('jamaah')->insert($data);              
                        DB::table('jamaah')->insert([   
		                    'id_umrah' => $data['id_umrah'],
		                    'id_jamaah' => $data['id_jamaah'],
		                    'tgl_daftar' => $data['tgl_daftar'],
		                    'nama' => $data['nama'],
		                    'tgl_berangkat' => $data['tgl_berangkat'],
		                    'tgl_pulang' => $data['tgl_pulang'],
		                    'marketing' => $data['marketing'],
		                    'staff' => $data['staff'],
		                    'no_telp' => $data['no_telp'],
		                    'marketing_fee' => $data['marketing_fee'],
		                    'diskon_marketing' => $data['diskon_marketing'],
		                    'koordinator' => $data['koordinator'],
		                    'koordinator_fee' => $data['koordinator_fee'],
		                    'top' => $data['top'],
		                    'top_fee' => $data['top_fee'],
		                    'status' => $data['status'],
	            		]);
                    }else{
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

                        // DB::table('jamaah')->insert($data);
                        DB::table('jamaah')->insert([   
		                    'id_umrah' => $data['id_umrah'],
		                    'id_jamaah' => $data['id_jamaah'],
		                    'tgl_daftar' => $data['tgl_daftar'],
		                    'nama' => $data['nama'],
		                    'tgl_berangkat' => $data['tgl_berangkat'],
		                    'tgl_pulang' => $data['tgl_pulang'],
		                    'marketing' => $data['marketing'],
		                    'staff' => $data['staff'],
		                    'no_telp' => $data['no_telp'],
		                    'marketing_fee' => $data['marketing_fee'],
		                    'diskon_marketing' => $data['diskon_marketing'],
		                    'koordinator' => $data['koordinator'],
		                    'koordinator_fee' => $data['koordinator_fee'],
		                    'top' => $data['top'],
		                    'top_fee' => $data['top_fee'],
		                    'status' => $data['status'],
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

    	return back()->with('message', 'Sinkronisasi tahun '. $sinkronisasi->tahun .' akan di proses');
    }

    public function destroy($id)
    {
    	$sinkronisasi = Sinkronisasi::findOrFail($id);
    	$sinkronisasi->delete();
    	return back();
    }

}

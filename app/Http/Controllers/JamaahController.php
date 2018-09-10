<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jamaah;
use App\User;
use Yajra\Datatables\Datatables;
use App\LogActivity;
use Auth;
use App\Periode;
use Carbon\Carbon;
use App\MasterNotifikasi;
use Excel;
use DB;
class JamaahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // $jamaah = Jamaah::where('status', 'lunas')->get();
        $agents = \App\User::where('status', '=', '1')->get();
        $jamaah = Jamaah::all();
        $periodes = Periode::orderBy('id', 'DESC')->get();
        return view('jamaah.index', compact('agents', 'jamaah', 'periodes'));
    }

    // get data by serverside
    public function getData(Request $request, Datatables $datatables)
    {
        // $jamaah =  Jamaah::select('id', 'anggota_id', 'nama', 'alamat', 'no_telp', 'jenis_kelamin', 'status');
        // return Datatables::of($jamaah)->make(true);
         $jamaah = Jamaah::with('anggota')->select('jamaah.*');
          return $datatables->eloquent($jamaah)->addColumn('action', function($jamaah){
             return '
                <a href="jamaah/'. $jamaah->id .'/edit" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                <a href="'. route('aiwa.jamaah.delete', $jamaah->id) .'" class="btn btn-sm btn-danger" onclick="alert(Anda yakin?)"><i class="fa fa-trash"></i> Hapus</a>'
                    ;
                })
          ->filter(function($query) use ($request){
            $period = Periode::find($request->get('periode'));
            $filter = Periode::whereBetween('tgl_berangkat', [$period->start, $period->end]);
            return $filter;
          })
          ->rawColumns(['action'])
          ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function showImportForm()
    // {
    //     return view('agen')
    // }

    public function create()
    {
        $anggota = User::all();
        return view('jamaah.add', compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tambah = Jamaah::create($request->all());
        $itung = count($tambah);
        LogActivity::create([
            'subjek' => 'Menambahkan '. $itung .' data di table jamaah.',
            'user_id' => Auth::guard('admin')->user()->id,
            'tanggal' => Carbon::now()
        ]);

        return redirect()->route('aiwa.jamaah')->with('message', 'Berhasil di tambahkan jamaah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function detailJamaah()
    {
        return view('jamaah.detail', 'jamaah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $jamaah = Jamaah::find($id);
        $agents = User::where('status', '=', 1)->get();
        return view('jamaah.edit', compact('jamaah', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jamaah = Jamaah::find($id);
        $jamaah->update($request->all()); 
        if ($request->tgl_transfer) {
            // $agents = User::where('device_token', '!=', null)->get();
            $now = Carbon::now();
            $year = $now->year;
            $month = $now->month;
            $day = $now->day;

            $jamaahs = Jamaah::where('tgl_transfer', '=', $now->format('Y').'-'.$now->format('m').'-'.$now->format('d'))->where('marketing', $jamaah->marketing)->where('koordinator', $jamaah->koordinator)->where('top', $jamaah->top)->get();

            $totalJamaahBerangkat = count($jamaahs);
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            foreach ($jamaahs as $in) {

                $recepientMarketing = User::where('id', $in->marketing)->first();
                $recepientKoordinator = User::where('id', $in->koordinator)->first();
                $recepientTop = User::where('id', $in->top)->first();
                $token = array();
                $token = [
                    $recepientMarketing['device_token'],
                    $recepientKoordinator['device_token'],
                    $recepientTop['device_token']
                ];
                
                $notification = [
                    'body' => 'Komisi sudah transfer, cek notifikasi!',
                    'bodyKoordinator' => 'Komisi dari agen '. $in->anggota->nama .' sudah di transfer, silahkan kontak koordinator anda untuk verifikasi!',
                    'bodyTop' => 'Komisi dari agen '. $in->anggota->nama .' sudah di transfer!',
                    'sound' => true,
                ];


                $sendNotifyMarketing = MasterNotifikasi::create([
                                                        'anggota_id' => $in->marketing,
                                                        'pesan' => $notification['body'],
                                                        'status' => 'delivered'
                                                        ]);

                $sendNotifyKoordinator = MasterNotifikasi::create([
                                                        'anggota_id' => $in->koordinator,
                                                        'pesan' => $notification['bodyKoordinator'],
                                                        'status' => 'delivered'
                                                        ]);

                $sendNotifyTop = MasterNotifikasi::create([
                                                        'anggota_id' => $in->top,
                                                        'pesan' => $notification['bodyTop'],
                                                        'status' => 'delivered'
                                                        ]);
                
                $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

                $fcmNotification = [
                    'registration_ids' => $token, //multple token array
                    // 'to'        => $token, //single token
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
        }
        LogActivity::create([
            'subjek' => 'Mengedit data di table jamaah.',
            'user_id' => Auth::guard('admin')->user()->id,
            'tanggal' => Carbon::now()
        ]);
        return redirect()->route('aiwa.jamaah')->with('message', 'Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jamaah = Jamaah::find($id);
        LogActivity::create([
            'subjek' => 'Menghapus data di table jamaah.',
            'user_id' => Auth::guard('admin')->user()->id,
            'tanggal' => Carbon::now()
        ]);
        $jamaah->delete();
        return redirect()->route('aiwa.jamaah')->with([
            'message' => 'ID '.$jamaah->id. ' berhasil di hapus',
        ]);
    }
}

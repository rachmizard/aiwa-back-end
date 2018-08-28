<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Admin;
use App\Periode;
use Carbon\Carbon;
use App\LogActivity;
use App\User;
use App\Jamaah;
use App\Prospek;
use Excel;
use DB;
use fcm;

class AdminController extends Controller
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

    public function index(Request $request)
    {
        $totalAgen = User::where('status', '=', '1')->get();
        $totalJamaah = Jamaah::all();
        $totalProspek = Prospek::all();
        $sumofPotensi = Jamaah::where('status', '=', 'POTENSI')->sum('marketing_fee');
        $sumofKomisi = Jamaah::where('status', '=', 'KOM')->sum('marketing_fee');
        $periodes = Periode::all();
        // Chart Query
        if ($request->periode) {
                //  $now = Carbon::now();
                // $year = $now->year;
                // $month = $now->month;
                // $day = $now->day;
                // $tahunNow = Carbon::create($year, $month, $day);
                // $period = Periode::whereBetween('start', [$tahunNow->copy()->startOfYear(), $tahunNow->copy()->endOfYear()])->first();
                $getIdPeriode = Periode::where('judul', '=', $request->input('periode'))->first();
                $varJay = Periode::find($getIdPeriode->id);
                $startDateJing = $varJay->start;
                $endDateJing = $varJay->end;
                $idPeriode = $varJay->id;
                $totalJamaahChart = Jamaah::whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();

                // Chart Prospek
                $stats = Prospek::whereBetween('created_at', [$startDateJing, $endDateJing])
                ->groupBy('month')
                ->orderBy('month', 'DESC')
                ->get([
                    DB::raw('DATE_FORMAT(created_at, "%M") as month'),
                    DB::raw('COUNT(*) as value')
                ])
                ->toJSON();

                $totalProspekChart = Prospek::whereBetween('created_at', [$startDateJing, $endDateJing])->count();

                // Chart Jamaah
                $statsJamaahJanuary = Jamaah::whereMonth('tgl_daftar', '1')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahFebruary = Jamaah::whereMonth('tgl_daftar', '2')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahMarch = Jamaah::whereMonth('tgl_daftar', '3')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahApril = Jamaah::whereMonth('tgl_daftar', '4')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahMei = Jamaah::whereMonth('tgl_daftar', '5')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahJune = Jamaah::whereMonth('tgl_daftar', '6')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahJuly = Jamaah::whereMonth('tgl_daftar', '7')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahAugust = Jamaah::whereMonth('tgl_daftar', '8')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahSeptember = Jamaah::whereMonth('tgl_daftar', '9')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahOctober = Jamaah::whereMonth('tgl_daftar', '10')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahNovember = Jamaah::whereMonth('tgl_daftar', '11')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahDesember = Jamaah::whereMonth('tgl_daftar', '12')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                // ->groupBy(['month', 'number_month'])
                // ->orderBy('number_month')
                // ->get([
                //     DB::raw('DATE_FORMAT(created_at, "%M") as month'),
                //     DB::raw('MONTH(tgl_daftar) as number_month'),
                //     DB::raw('COUNT(*) as value')
                // ])
                // ->toJSON();

                // Chart Prospek

                $statsProspekJanuary = User::whereMonth('created_at', '1')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekFebruary = User::whereMonth('created_at', '2')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekMarch = User::whereMonth('created_at', '3')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekApril = User::whereMonth('created_at', '4')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekMei = User::whereMonth('created_at', '5')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekJune = User::whereMonth('created_at', '6')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekJuly = User::whereMonth('created_at', '7')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekAugust = User::whereMonth('created_at', '8')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekSeptember = User::whereMonth('created_at', '9')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekOctober = User::whereMonth('created_at', '10')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekNovember = User::whereMonth('created_at', '11')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekDesember = User::whereMonth('created_at', '12')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();

                return view('home', compact('totalAgen', 'totalJamaah', 'totalProspek', 'sumofPotensi', 'sumofKomisi', 'periodes', 'totalJamaahChart', 'stats', 'statsJamaah', 'totalProspekChart', 'idPeriode', 'varJay', 'statsJamaahJanuary', 'statsJamaahFebruary', 'statsJamaahMarch', 'statsJamaahApril', 'statsJamaahMei', 'statsJamaahJune', 'statsJamaahJuly', 'statsJamaahAugust', 'statsJamaahSeptember' ,'statsJamaahOctober', 'statsJamaahNovember', 'statsJamaahDesember', 'statsProspekJanuary', 'statsProspekFebruary', 'statsProspekMarch', 'statsProspekApril', 'statsProspekMei', 'statsProspekJune', 'statsProspekJuly', 'statsProspekAugust', 'statsProspekSeptember', 'statsProspekOctober', 'statsProspekNovember', 'statsProspekDesember'));   
            }else{
                $now = Carbon::now();
                $year = $now->year;
                $month = $now->month;
                $day = $now->day;
                $tahunNow = Carbon::create($year, $month, $day);
                $period = Periode::whereBetween('start', [$tahunNow->copy()->startOfYear(), $tahunNow->copy()->endOfYear()])->first();
                $idPeriode = $period->id;
                $varJay = Periode::find($period->id);
                $startDateJing = $varJay->start;
                $endDateJing = $varJay->end;
                $totalJamaahChart = Jamaah::whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();

                // Chart Prospek
                $stats = Prospek::whereBetween('created_at', [$startDateJing, $endDateJing])
                ->groupBy('month')
                ->orderBy('month', 'DESC')
                ->get([
                    DB::raw('DATE_FORMAT(created_at, "%M") as month'),
                    DB::raw('COUNT(*) as value')
                ])
                ->toJSON();

                $totalProspekChart = Prospek::whereBetween('created_at', [$startDateJing, $endDateJing])->count();

                // Chart Jamaah
                $statsJamaahJanuary = Jamaah::whereMonth('tgl_daftar', '1')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahFebruary = Jamaah::whereMonth('tgl_daftar', '2')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahMarch = Jamaah::whereMonth('tgl_daftar', '3')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahApril = Jamaah::whereMonth('tgl_daftar', '4')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahMei = Jamaah::whereMonth('tgl_daftar', '5')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahJune = Jamaah::whereMonth('tgl_daftar', '6')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahJuly = Jamaah::whereMonth('tgl_daftar', '7')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahAugust = Jamaah::whereMonth('tgl_daftar', '8')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahSeptember = Jamaah::whereMonth('tgl_daftar', '9')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahOctober = Jamaah::whereMonth('tgl_daftar', '10')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahNovember = Jamaah::whereMonth('tgl_daftar', '11')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
                $statsJamaahDesember = Jamaah::whereMonth('tgl_daftar', '12')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();

                // $statsJamaah = Jamaah::whereBetween('tgl_daftar', [$startDateJing, $endDateJing])
                // ->groupBy(['month', 'number_month'])
                // ->orderBy('number_month')
                // ->get([
                //     DB::raw('DATE_FORMAT(created_at, "%M") as month'),
                //     DB::raw('MONTH(tgl_daftar) as number_month'),
                //     DB::raw('COUNT(*) as value')
                // ])
                // ->toJSON();

                // Chart Prospek

                $statsProspekJanuary = User::whereMonth('created_at', '1')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekFebruary = User::whereMonth('created_at', '2')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekMarch = User::whereMonth('created_at', '3')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekApril = User::whereMonth('created_at', '4')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekMei = User::whereMonth('created_at', '5')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekJune = User::whereMonth('created_at', '6')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekJuly = User::whereMonth('created_at', '7')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekAugust = User::whereMonth('created_at', '8')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekSeptember = User::whereMonth('created_at', '9')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekOctober = User::whereMonth('created_at', '10')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekNovember = User::whereMonth('created_at', '11')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();
                $statsProspekDesember = User::whereMonth('created_at', '12')->whereBetween('created_at', [$startDateJing, $endDateJing])->count();

                return view('home', compact('totalAgen', 'totalJamaah', 'totalProspek', 'sumofPotensi', 'sumofKomisi', 'periodes', 'totalJamaahChart', 'stats', 'statsJamaah', 'totalProspekChart', 'idPeriode', 'varJay', 'statsJamaahJanuary', 'statsJamaahFebruary', 'statsJamaahMarch', 'statsJamaahApril', 'statsJamaahMei', 'statsJamaahJune', 'statsJamaahJuly', 'statsJamaahAugust', 'statsJamaahSeptember' ,'statsJamaahOctober', 'statsJamaahNovember', 'statsJamaahDesember', 'statsProspekJanuary', 'statsProspekFebruary', 'statsProspekMarch', 'statsProspekApril', 'statsProspekMei', 'statsProspekJune', 'statsProspekJuly', 'statsProspekAugust', 'statsProspekSeptember', 'statsProspekOctober', 'statsProspekNovember', 'statsProspekDesember'));   
            }
    }

    public function sendNotify($token)
    {
        $dt = Carbon::create(2018, 8, 8, 3);
        $dt->addMinutes('5');
        $timeEnd = Carbon::now();
        // $now = Carbon::create('');
        // $now->addSeconds('8');
        if ($timeEnd > $dt) {
            
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            $token = $token;
            

            $notification = [
                'body' => 'Anda mendapatkan komisi, cek segera!',
                'sound' => true,
            ];
            
            $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

            $fcmNotification = [
                //'registration_ids' => $tokenList, //multple token array
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


            return response()->json($result);
        }else{
            return 'wait until '. $dt;
        }
    }

    public function approval()
    {
        Auth()->guard('admin')->user()->unreadNotifications->markAsRead();
        return view('approval.index');
    }
    /**
    * For upload
    **/

    public function showImportForm(Request $request)
    {
        return view('agen.import');
    }

    // Export Coding
    public function downloadExcel($type)
    {
        $data = User::get()->toArray();
        return Excel::create('data_agen', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    // Import COding
    public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['id'] = $row['id'];
                    $data['nama'] = $row['nama'];
                    $data['email'] = $row['email'];
                    $data['username'] = $row['username'];
                    $data['password'] = bcrypt('aiwa');
                    $data['jenis_kelamin'] = $row['jenis_kelamin'];
                    $data['no_ktp'] = $row['no_ktp'];
                    $data['alamat'] = $row['domisili'];
                    $data['no_telp'] = $row['no_telp'];
                    $data['status'] = 1;
                    $data['koordinator'] = $row['koordinator'];
                    $data['bank'] = $row['bank'];
                    $data['no_rekening'] = $row['no_rekening'];
                    $data['fee_reguler'] = $row['fee_reguler'];
                    $data['fee_promo'] = $row['fee_promo'];
                    $data['nama_rek_beda'] = $row['nama_rek_beda'];
                    $data['website'] = $row['website'];

                    if(!empty($data)) {
                        $validator = User::where('id', $data['id'])->first();
                        if($validator){
                            DB::table('users')->where('id', $data['id'])->update($data);
                            // Session::put('message', 'Your file is succesfully updated!');
                        }else {
                            DB::table('users')->insert($data);
                            // Session::put('message', 'Your file is succesfully imported!');
                        }
                    }
                }
            });
        }
        return redirect()->route('aiwa.anggota');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function logout(Request $request)
    {
            Carbon::setLocale(config('app.locale'));
        // send a log
        LogActivity::create([
            'subjek' => 'Logout dari website.',
            'user_id' => Auth::guard('admin')->user()->id,
            'tanggal' => Carbon::now()
        ]);
        $userActivity = Admin::find(Auth::guard('admin')->user()->id);
        $userActivity->last_login = Carbon::now();
        $userActivity->save();
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route( 'admin.login' );
    }
}

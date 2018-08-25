<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jamaah;
use App\User;
use App\Periode;
use App\Http\Resources\JamaahResource;
use App\Http\Resources\CountOfMarketingFeeResource;
use DB;
use Carbon\Carbon;

class JamaahControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Jamaah $jamaah)
    {
        return JamaahResource::collection(Jamaah::orderBy('id', 'DESC')->with('anggota')->paginate(25));
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

    public function retrieveByAgen(Request $request, $id, $tahun)
    {   
        $varJay = Periode::where('judul', $tahun)->first();
        $startDateJing = $varJay['start'];
        $endDateJing = $varJay['end'];
        return JamaahResource::collection(Jamaah::orderBy('id', 'DESC')->where('marketing', $id)->whereBetween('created_at', [$startDateJing, $endDateJing])->get());
    }

    public function feeByAgenPotensi(Request $request, $id, $tahun)
    {
        $varJay = Periode::where('judul', $tahun)->first();
        $startDateJing = $varJay['start'];
        $endDateJing = $varJay['end'];
        $countFee = DB::table('jamaah')->where(['marketing' => $id, 'status' => 'POTENSI'])->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->sum('marketing_fee');
         $success['nama'] =  'potensi';
         $success['total'] =  $countFee;
        return response()->json(['response' => $success]); 
    }

    public function retrieveByKoordinator(Request $request, $id)
    {
        return JamaahResource::collection(Jamaah::where('koordinator', $id)->get());
    }

    public function feeByKoordinatorFeePotensi(Request $request, $id)
    {
        $countFeeByKoordinator = DB::table('jamaah')->where('koordinator', $id)->where('status', '=', 'POTENSI')->sum('koordinator_fee');
         $success['nama'] =  'potensi';
         $success['total'] =  $countFeeByKoordinator;
        return response()->json(['response' => $success]);  
    }

    public function feeByAgenKomisi(Request $request, $id, $tahun)
    {
        $varJay = Periode::where('judul', $tahun)->first();
        $startDateJing = $varJay['start'];
        $endDateJing = $varJay['end'];
        $countFeeByAgenKomisi = DB::table('jamaah')->where('marketing', $id)->where('status', '!=', 'POTENSI')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->sum('marketing_fee');
         $success['nama'] =  'komisi';
         $success['total'] =  $countFeeByAgenKomisi;
        return response()->json(['response' => $success]);   
    }

    public function feeByKoordinatorKomisi(Request $request, $id)
    {
        $countFeeByKoordinatorKomisi = DB::table('jamaah')->where('koordinator', $id)->where('status', '!=', 'POTENSI')->sum('koordinator_fee');
         $success['nama'] =  'komisi';
         $success['total'] =  $countFeeByKoordinatorKomisi;
        return response()->json(['response' => $success]); 
    }

    public function koordinatorPotensi(Request $request, $id)
    {
        return JamaahResource::collection(Jamaah::where('koordinator', $id)->where('status', '=', 'POTENSI')->paginate(10));
    }

    public function koordinatorKomisi(Request $request, $id)
    {
        return JamaahResource::collection(Jamaah::where('koordinator', $id)->where('status', '!=', 'POTENSI')->paginate(10));
    }

    public function agenPotensi(Request $request, $id)
    {
        return JamaahResource::collection(Jamaah::where('marketing', $id)->where('status', '=', 'POTENSI')->paginate(2));
    }

    public function agenKomisi(Request $request, $id)
    {
        return JamaahResource::collection(Jamaah::where('marketing', $id)->where('status', '!=', 'POTENSI')->paginate(2));        
    }

    public function totalJamaahByAgen(Request $request, $id, $tahun)
    {
        $varJay = Periode::where('judul', $tahun)->first();
        $startDateJing = $varJay['start'];
        $endDateJing = $varJay['end'];
        $countTotalJamaahByAgen = DB::table('jamaah')->where('marketing', $id)->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
        $success['nama'] =  'jamaah';
        $success['total'] =  $countTotalJamaahByAgen;
        return response()->json(['response' => $success]);
    }

    public function totalJamaahByTheMonth(Request $request, $id, $tahun)
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;

        $varJay = Periode::where('judul', $tahun)->first();
        $startDateJing = $varJay['start'];
        $endDateJing = $varJay['end'];
        // Count of each month
        $countJanuary = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar', '01')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $countFebruary = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar', '02')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $countMarch = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar','03')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $countApril = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar','04')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $countMei = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar','05')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $countJune = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar', '06')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $countJuly = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar', '07')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $countAugust = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar', '08')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $countSeptember = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar', '09')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $countOctober = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar', '10')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $countNovember = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar', '11')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $countDecember = DB::table('jamaah')->where('marketing', $id)->whereMonth('tgl_daftar', '12')->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->get();
        $success['january'] =  $countJanuary->count();
        $success['february'] =  $countFebruary->count();
        $success['march'] =  $countMarch->count();
        $success['april'] =  $countApril->count();
        $success['mei'] =  $countMei->count();
        $success['june'] =  $countJune->count();
        $success['july'] =  $countJuly->count();
        $success['august'] =  $countAugust->count();
        $success['september'] =  $countSeptember->count();
        $success['october'] =  $countOctober->count();
        $success['november'] =  $countNovember->count();
        $success['december'] =  $countDecember->count();
        return response()->json(['response' => $success]);

    }

    // public function totalJamaahByKoordinator(Request $request, $id, $tahun)
    // {
    //     $varJay = Periode::where('judul', $tahun)->first();
    //     $startDateJing = $varJay['start'];
    //     $endDateJing = $varJay['end'];
    //     $validator = User::where('status', '=', 1)->where('koordinator', $id)->first();
    //     $countTotalJamaahByKoordinator = DB::table('jamaah')->where('marketing', $validator['id'])->whereBetween('tgl_daftar', [$startDateJing, $endDateJing])->count();
    //     $success['nama'] =  '';
    //     $success['total'] =  $countTotalJamaahByKoordinator;
    //     return response()->json(['response' => $success]);

    // }

    public function retrieveJamaahBerangkatByAgen(Request $request, $id, $tahun)
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;
        $varJay = Periode::where('judul', $tahun)->first();
        $startDateJing = $varJay['start'];
        $endDateJing = $varJay['end'];
        return $retrieveJamaahBerangkatByAgen = JamaahResource::collection(Jamaah::where('marketing', $id)->where('tgl_berangkat', '=', $day.'/'.$month.'/'.$year)->whereBetween('created_at', [$startDateJing, $endDateJing])->get());
    }

    public function retrieveJamaahPulangByAgen(Request $request, $id, $tahun)
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;
        $varJay = Periode::where('judul', $tahun)->first();
        $startDateJing = $varJay['start'];
        $endDateJing = $varJay['end'];
        return $retrieveJamaahBerangkatByAgen = JamaahResource::collection(Jamaah::where('marketing', $id)->where('tgl_pulang', '=', $day.'/'.$month.'/'.$year)->whereBetween('created_at', [$startDateJing, $endDateJing])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $jamaah = $request->isMethod('put') ? Jamaah::findOrFail($request->id) : new Jamaah;
        // $jamaah->id_umrah = $request->input('id_umrah');
        // $jamaah->id_jamaah = $request->input('id_jamaah');
        // $jamaah->tgl_daftar = $request->input('tgl_daftar');
        // $jamaah->nama = $request->input('nama');
        // $jamaah->tgl_berangkat = $request->input('tgl_berangkat');
        // $jamaah->tgl_pulang = $request->input('tgl_pulang');
        // $jamaah->maskapai = $request->input('maskapai');
        // $jamaah->marketing = $request->input('marketing');
        // $jamaah->staff = $request->input('staff');
        // $jamaah->no_telp = $request->input('no_telp');
        // $jamaah->fee = $request->input('fee');
        // $jamaah->jumlah_fee = $request->input('jumlah_fee');
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
}

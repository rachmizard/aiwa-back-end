<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospek;
use App\Anggota;
use App\Periode;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;

class ProspekController extends Controller
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
        $agents = \App\User::where('status', '=', '1')->get();
        $prospeks = Prospek::all();
        $periodes = Periode::all();
        // Read notification
        Auth()->guard('admin')->user()->unreadNotifications->where('type', 'App\Notifications\ProspekNewNotification')->markAsRead();
        return view('prospek.index', compact('agents', 'prospeks', 'periodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData(Request $request)
    {
         $prospeks = Prospek::with('anggota')->select('prospeks.*');
         return Datatables::of($prospeks)
         ->addColumn('action', function($prospeks){
             return '
                    <a href="#" data-toggle="modal" data-target="#editProspek'. $prospeks->id .'" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit Follow Up</a>
                    <input type="hidden" name="idProspek" value="'. $prospeks->id .'">
                    <form action="'. route('aiwa.prospek.delete', $prospeks->id) .'" method="POST">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <button type="submit" onclick="confirmBtn()" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                    </form>
                ';
                })
          ->addColumn('qty', function($prospeks){
                $jml_dewasa = $prospeks->jml_dewasa;
                $jml_balita = $prospeks->jml_balita;
                $jml_infant = $prospeks->jml_infant;
                $total = $jml_dewasa+$jml_balita+$jml_infant;
                return $total;
          })
          ->editColumn('tgl_keberangkatan', function($query){
                $date=date_create($query->tgl_keberangkatan);
                return date_format($date, 'd/m/Y');
          })
          ->editColumn('pembayaran', function($query){
                if ($query->pembayaran == '1') {
                    return '<i class="fa fa-check text-success"></i> SUDAH';
                }else if($query->pembayaran == 'BELUM'){
                    return 'BELUM DP';
                }
          })
          ->editColumn('created_at', function($query){
                return $query->created_at ? with(new Carbon($query->created_at))->format('d/m/Y') : '';
          })
          ->filter(function($query) use ($request){
                $validatorDateRange = Periode::find($request->get('periode'));
                $dateStart = $validatorDateRange->start;
                $dateEnd = $validatorDateRange->end;
                if($request->has('pic') && $request->has('pembayaran') && $request->has('anggota_id') && $request->has('periode'))
                {
                    if ($request->get('anggota_id') == 'semua') {
                        if ($request->has('pembayaran')) {
                            return $query->where('pembayaran', 'LIKE', ''. $request->get('pembayaran') .'')->whereBetween('created_at', [$dateStart, $dateEnd])->get();
                        }else{
                            return $query->select('prospeks.*')->whereBetween('created_at', [$dateStart, $dateEnd])->get();
                        }
                    }else{
                        return $query->where('pic', 'LIKE', '%'. $request->get('pic') .'%')->where('pembayaran', 'LIKE', '%'. $request->get('pembayaran') .'%')->where('anggota_id', 'LIKE', '%'. $request->get('anggota_id') .'%')->whereBetween('created_at', [$dateStart, $dateEnd])->get();
                    }
                }
          })
          ->rawColumns(['qty', 'pembayaran', 'action'])
          ->make(true);
    }

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
        $prospek = Prospek::findOrFail($id);
        $prospek->tanggal_followup = $request->tanggal_followup;
        $prospek->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prospek = Prospek::findOrFail($id);
        $prospek->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;

class AgenController extends Controller
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
        $agens = User::where('status', '=', 1)->get();
        return view('agen.index', compact('agens'));
    }

    public function getData(Request $request)
    {
        $agents = User::with('agent')->where('status', '=', '1')->get();
         return Datatables::of($agents)->addColumn('action', function($agents)
         {
            return '
                <a href="#" data-toggle="modal" data-target="#detailAgen'. $agents->id .'" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> Edit</a>
                <form class="form-group" action="'. route('aiwa.unapproved', $agents->id) .'" method="POST">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="PUT">
                    <button id="confirm" onclick="confirmBtn()" class="btn btn-sm btn-danger" type="submit"><i class="fa fa-cross"></i>Batal Approve</button>
                    </form>
                    ';
         })
         ->addColumn('foto', function($agents)
         {
            if ($agents->foto != null) {       
                return '<img src="/storage/images/'. $agents->foto .'" width="50" height="50" alt="">';
            }else{
                return '<img src="/storage/images/default.png" width="50" height="50" alt="">';
            }
         })
         ->rawColumns(['action', 'foto'])
         ->make(true);
    }

    public function filter(Request $request)
    {

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
        $agen = User::findOrFail($id);
        $agen->password = bcrypt($request->password);
        $agen->update($request->all());
        return redirect()->back();
    }

    public function updateAkun(Request $request, $id)
    {
        $agen = User::findOrFail($id);
        // $validator = User::where('id', $request->id)->get();
        // $agen->id = $request->old_id;
        if ($request->id) {
            if (count(User::where('id', $request->id)->get()) > 0) {
                return redirect()->back()->with('messageError', 'ID sudah ada!');
            }else{
                $agen->id = $request->id;
                $agen->update($request->except(['id', 'password']));
                return redirect()->back()->with('message', 'Jika ada kesalahan pada sistem/error, disarankan ID di kembalikan ke semula');
            }
        }else if($request->password){
            $agen->id = $request->old_id;
            $agen->password = bcrypt($request->password);
            $agen->update($request->except(['id','password']));
            return redirect()->back();   
        }else{
            $agen->id = $request->old_id;
            // $agen->password = bcrypt($request->password);
            $agen->update($request->only(['username','email', 'status']));
            return redirect()->back();   
        }
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

<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Admin;
use Carbon\Carbon;
use App\LogActivity;
use App\User;
use Excel;
use DB;

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

    public function index()
    {
        return view('home');
    }

    public function approval()
    {
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
                    // $data['email'] = $row['email'];
                    // $data['username'] = $row['username'];
                    // $data['password'] = bcrypt('testpassword123');
                    // $data['jenis_kelamin'] = $row['jenis_kelamin'];
                    // $data['no_ktp'] = $row['no_ktp'];
                    $data['alamat'] = $row['alamat'];
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
        return back();
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

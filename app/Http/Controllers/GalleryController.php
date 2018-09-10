<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterGallery;
use App\LogActivity;
use Yajra\Datatables\Datatables;
use Auth;
use App\Master_Hotel;
use Carbon\Carbon;

class GalleryController extends Controller
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
        return view('gallery.index', compact('hotels'));
    }

    public function indexGalleryHotel()
    {
        $hotels = Master_Hotel::orderBy('id', 'DESC')->where('status', '!=', 'archived')->get();
        return view('gallery.hotel', compact('hotels'));
    }

    public function getDataGalleryHotel()
    {
        $galleries = MasterGallery::with('hotel')->whereRaw("tipe != 'foto' AND tipe != 'video' AND status != 'archived' ")->get();
        return Datatables::of($galleries)
        ->addColumn('action', function($galleries)
        {
            return '<a class="btn btn-sm btn-info" href="'. route('aiwa.master-gallery.edit.hotel', $galleries->id) .'">Edit</a>
                    <form class="form-group" action="'. route('aiwa.master-gallery.archive', $galleries->id) .'" method="POST">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="PUT">
                    <button id="confirm" onclick="confirmBtn()" class="btn btn-sm btn-danger" type="submit"><i class="ion-android-archive"></i> Archive</button>
                    </form>
                    ';
        })
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData()
    {
        $galleries = MasterGallery::where('status', '!=', 'archived')->where('tipe', '!=', 'foto_hotel')->where('tipe', '!=', 'video_hotel')->get();
        return Datatables::of($galleries)
        ->addColumn('action', function($galleries)
        {
            return '<a class="btn btn-sm btn-info" href="'. route('aiwa.master-gallery.edit', $galleries->id) .'">Edit</a>
                    <form class="form-group" action="'. route('aiwa.master-gallery.destroy', $galleries->id) .'" method="POST">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="POST">
                    <button id="confirm" onclick="confirmBtn()" class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-trash"></i>Delete</button>
                    </form>
                    ';
        })
        ->make(true);
    }

// <form class="form-group" action="'. route('aiwa.master-gallery.archive', $galleries->id) .'" method="POST">
//                     <input type="hidden" name="_token" value="'. csrf_token() .'">
//                     <input type="hidden" name="_method" value="PUT">
//                     <button id="confirm" onclick="confirmBtn()" class="btn btn-sm btn-danger" type="submit"><i class="ion-android-archive"></i> Archive</button>
//                     </form>
    
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
        $uploadedFile = $request->file('file');        
        $name = rand(111,9999) . '.' . $uploadedFile->getClientOriginalExtension();
        $loc = public_path('/storage/gallery/');
        $path = $uploadedFile->move($loc, $name);
        $file = MasterGallery::create([
            'file' => $name,
            'judul' => $request->judul,
            'tanggal' => Carbon::now(),
            'deskripsi' => $request->deskripsi,
            'tipe' => $request->tipe
        ]);
        if ($file) { 
        $itung = count($file);
        LogActivity::create([
            'subjek' => 'Menambahkan '. $itung .' data di table Gallery.',
            'user_id' => Auth::guard('admin')->user()->id,
            'tanggal' => Carbon::now()
        ]);
            return redirect()->back()->with('message', 'Gallery Berhasil ditambahkan!');
        }
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
        $gallery = MasterGallery::findOrFail($id);
        return view('gallery.edit', compact('gallery'));
    }


    public function editHotel($id)
    {
        $gallery = MasterGallery::findOrFail($id);
        $hotels = Master_Hotel::orderBy('id', 'DESC')->where('status', '!=', 'archived')->get();
        return view('gallery.edit-hotel', compact('gallery', 'hotels'));
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
        $gallery = MasterGallery::findOrFail($id);
        if ($request->file('file')) {
            $uploadedFile = $request->file('file');        
            $name = rand(111,9999) . '.' . $uploadedFile->getClientOriginalExtension();
            $loc = public_path('/storage/gallery/');
            $path = $uploadedFile->move($loc, $name);
            $gallery->update([
                    'file' => $name,
                    'judul' => $request->judul,
                    'tanggal' => $request->tanggal,
                    'deskripsi' => $request->deskripsi,
                    'tipe' => $request->tipe
            ]);
            if ($gallery) {
                LogActivity::create([
                    'subjek' => 'Mengedit data di table Gallery.',
                    'user_id' => Auth::guard('admin')->user()->id,
                    'tanggal' => Carbon::now()
                ]);
                return redirect()->back()->with('message', 'Berhasil di edit!');
            }else{
                return redirect()->back()->with('messageError', 'Ooops something error!');
            }
        }else{
            $gallery->update([
                'file' => $request->old_file_name,
                'judul' => $request->judul,
                'tanggal' => $request->tanggal,
                'deskripsi' => $request->deskripsi,
                'tipe' => $request->tipe
            ]);
            if ($gallery) {
                LogActivity::create([
                    'subjek' => 'Mengedit data di table Gallery.',
                    'user_id' => Auth::guard('admin')->user()->id,
                    'tanggal' => Carbon::now()
                ]);
                return redirect()->back()->with('message', 'Berhasil di edit!');
            }else{
                return redirect()->back()->with('messageError', 'Ooops something error!');
            }
        }
        // if ($gallery->update($request->all())) { 
        //     $itung = count($gallery);
        //     LogActivity::create([
        //         'subjek' => 'Mengedit '. $itung .' data di table Gallery.',
        //         'user_id' => Auth::guard('admin')->user()->id,
        //         'tanggal' => Carbon::now()
        //     ]);
        //     return redirect()->back()->with('message', 'Gallery Berhasil diedit!');
        // }else{
        //     return redirect()->back()->with('messageError', 'Error!');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function archive($id)
    {
        $updateStatus = MasterGallery::find($id);
        $updateStatus->update(['status' => 'archived']);
        return redirect()->back()->with('message', 'Berhasil di simpan di arsip!');
    }

    public function destroy($id)
    {
        $gallery = MasterGallery::findOrFail($id);
        if ($gallery->delete()) {
            $itung = count($gallery);
            LogActivity::create([
                'subjek' => 'Menghapus '. $itung .' data di table Gallery.',
                'user_id' => Auth::guard('admin')->user()->id,
                'tanggal' => Carbon::now()
            ]);
            return redirect()->back()->with('message', 'Berhasil di hapus!');
        }else{
            return redirect()->back()->with('messageError', 'Ooops something error!');
        }
    }
}

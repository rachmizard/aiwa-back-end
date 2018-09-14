<?php

namespace App\Http\Controllers;

use App\Master_Hotel;
use App\MasterGallery;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class HotelController extends Controller
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
        $hotels = Master_Hotel::where('status', '!=', 'archived')->get();
        return view('hotel.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData(Request $request)
    {
        $hotels = Master_Hotel::where('status', '!=', 'archived')->get();
         return Datatables::of($hotels)->addColumn('action', function($hotels)
         {
            return '
                <a href="'. route('aiwa.master-hotel.edit-form', $hotels->id) .'" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                    <form class="form-group" action="'. route('aiwa.master-hotel.archive', $hotels->id) .'" method="POST">
                    '. csrf_field() .' '. method_field("PUT") .'
                    <button id="confirm" onclick="confirmBtn()" class="btn btn-sm btn-danger" type="submit"><i class="ion-android-archive"></i> Archive</button>
                    </form>';
         })
         ->make(true);
    }

    public function indexArsipHotel()
    {
        $hotels = Master_Hotel::orderBy('id', 'DESC')->where('status', '=', 'archived')->get();
        return view('hotel.arsip', compact('hotels'));
    }

    public function getDataArsipHotel(Request $request)
    {
        $galleries = Master_Hotel::where('status', '=', 'archived')->get();
        return Datatables::of($galleries)
        ->addColumn('action', function($galleries)
        {
            return '<form class="form-group" action="'. route('aiwa.master-hotel.unarchived', $galleries->id) .'" method="POST">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="PUT">
                    <button id="confirm" onclick="confirmBtn()" class="btn btn-sm btn-success" type="submit"><i class="fa fa-upload"></i> Batal Arsip</button>
                    </form>
                    ';
        })
        ->make(true);
    }

    public function create()
    {
        return view('hotel.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hotel = Master_Hotel::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Master_Hotel::findOrFail($id);
        return view('hotel.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hotel = Master_Hotel::findOrFail($id);
        $hotel->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $hotel = Master_Hotel::findOrFail($id);
        $galleryHotels = MasterGallery::where('judul', $id)->get();
        $hotel->update(['status' => 'archived']);
        foreach ($galleryHotels as $in) {
            $updateStatus = MasterGallery::where('id', $in->id)->update(['status' => 'archived']);
        }
        return redirect()->route('aiwa.master-hotel');
    }
}

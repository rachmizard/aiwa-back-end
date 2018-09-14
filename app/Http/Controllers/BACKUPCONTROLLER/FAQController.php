<?php

namespace App\Http\Controllers;

use App\FAQ;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FAQController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $faqs = FAQ::all();
        return view('faq.index', compact('faqs'));
    }

    // public function getDataFuckersPlease()
    // {
    //      return Datatables::of(FAQ::all())->addColumn('action', function($faqs)
    //      {
    //         return '
    //             <a href="'. route('faq.edit', $faqs->id) .'" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit</a>
    //             <a onclick="event.preventDefault();
    //                  document.getElementById("delete-form").submit();" href="#" class="btn btn-sm btn-danger">Hapus</a>
    //             <form id="delete-form" action="{{ route("faq.destroy", '. $faqs->id .') }}" method="POST" style="display: none;">
    //                 <input type="hidden" name="_token" value="'. csrf_token() .'">
    //                 <input type="hidden" name="_method" value="DELETE">
    //             </form>
    //             ';
    //      })
    //      ->make(true);
    // }

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
        $faq = FAQ::create($request->all());
        return redirect()->back()->with('message', 'Berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function show(FAQ $fAQ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = FAQ::findOrFail($id);
        return view('faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $faq = FAQ::findOrFail($id);
        $faq->update(['judul' => $request->judul, 'jawaban' => $request->jawaban]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function destroy(FAQ $fAQ)
    {
        //
    }
}

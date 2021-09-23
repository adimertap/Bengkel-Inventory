<?php

namespace App\Http\Controllers\Inventory\DetailSparepart;

use App\Http\Controllers\Controller;
use App\Model\Inventory\DetailSparepart\DetailSparepart as DetailSparepartDetailSparepart;
// use App\Model\Inventory\DetailSparepart\DetailSparepart as DetailSparepartDetailSparepart;
use App\Model\Inventory\Kelolastock\DetailSparepart;
use App\Model\Inventory\Gallery;
use App\Model\Inventory\Kelolastock\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DetailSparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailsparepart = DetailSparepartDetailSparepart::with('Sparepart','Gudang')->get();
        $today = Carbon::now()->isoFormat('dddd');
        $tanggal_tahun = Carbon::now()->format('j F Y');
      

        return view('pages.inventory.detailsparepart.index',compact('detailsparepart','today','tanggal_tahun'));


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

    public function gallery(Request $request, $id_detail_sparepart)
    {
        $detailsparepart = DetailSparepartDetailSparepart::findorFail($id_detail_sparepart);
        $gallery = Gallery::with('Detailsparepart')
            ->where('id_detail_sparepart', $id_detail_sparepart)
            ->get();

        return view('pages.inventory.detailsparepart.gallery')->with([
            'detailsparepart' => $detailsparepart,
            'gallery' => $gallery,
        ]);
    }
}

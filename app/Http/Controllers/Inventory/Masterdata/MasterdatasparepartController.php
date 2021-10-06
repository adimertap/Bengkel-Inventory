<?php

namespace App\Http\Controllers\Inventory\Masterdata;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\Galleryrequest;
use App\Http\Requests\Inventory\Masterdata\Spareparteditrequest as MasterdataSpareparteditrequest;
use App\Http\Requests\Inventory\Masterdata\Sparepartrequest as MasterdataSparepartrequest;
use App\Http\Requests\Inventory\Spareparteditrequest;
use App\Http\Requests\Inventory\Sparepartrequest;
use App\Model\Inventory\Gallery;
use App\Model\Inventory\Hargasparepart;
use App\Model\Inventory\Jenissparepart;
use App\Model\Inventory\Kemasan;
use App\Model\Inventory\Konversi;
use App\Model\Inventory\Merksparepart;
use App\Model\Inventory\Rak;
use App\Model\Inventory\Sparepart;
use App\Model\Inventory\Supplier;
use App\Model\SingleSignOn\JenisBengkel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MasterdatasparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sparepart = Sparepart::with([
            'Jenissparepart', 'Merksparepart', 'Konversi', 'Kemasan', 'JenisBengkel'
        ])->where('status_sparepart','=','Aktif')->where('id_jenis_bengkel','=',Auth::user()->Bengkel->id_jenis_bengkel)->get();
        

        // Sparepart Dikelompokan Berdasarkan Fungsinya

        // $sparepartmobil = Sparepart::with([
        //     'Jenissparepart', 'Merksparepart', 'Konversi', 'Kemasan'
        // ])->where('status_sparepart','=','Aktif')->join('tb_inventory_master_jenis_sparepart', 'tb_inventory_master_sparepart.id_jenis_sparepart', 'tb_inventory_master_jenis_sparepart.id_jenis_sparepart')
        // ->where('fungsi', '=', 'MOBIL')->get();
        

        return view('pages.inventory.masterdata.sparepart.sparepart', compact('sparepart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_sparepart = Jenissparepart::where('status_jenis','=','Aktif')->get();
        $merk_sparepart = Merksparepart::where('status_merk','=','Aktif')->get();
        $konversi = Konversi::get();
        $kemasan = Kemasan::get();
        $jenis_bengkel = JenisBengkel::get();

        $id = Sparepart::getId();
        foreach ($id as $value);
        $idlama = $value->id_sparepart;
        $idbaru = $idlama + 1;
        $blt = date('m');

        $kode_sparepart = 'SP-' . $blt . '/' . $idbaru;


        return view('pages.inventory.masterdata.sparepart.create', compact('jenis_bengkel','jenis_sparepart', 'merk_sparepart', 'konversi', 'kode_sparepart', 'kemasan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterdataSparepartrequest $request)
    {

        $id = Sparepart::getId();
        foreach ($id as $value);
        $idlama = $value->id_sparepart;
        $idbaru = $idlama + 1;
        $blt = date('m');

        $kode_sparepart = 'SP-' . $blt . '/' . $idbaru;

        if (Auth::user()->Bengkel->id_jenis_bengkel == '1'){
            $sparepart = new Sparepart;
            $sparepart->id_jenis_sparepart = $request->id_jenis_sparepart;
            $sparepart->id_merk = $request->id_merk;
            $sparepart->id_konversi = $request->id_konversi;
            $sparepart->kode_sparepart = $kode_sparepart;
            $sparepart->nama_sparepart = $request->nama_sparepart;
            $sparepart->id_kemasan = $request->id_kemasan;
            $sparepart->dimensi_berat = $request->dimensi_berat;
            $sparepart->slug = Str::slug($request->nama_sparepart);
            $sparepart->lifetime = $request->lifetime;
            $sparepart->jenis_barang = $request->jenis_barang;
            $sparepart->status_sparepart = 'Diajukan';
            $sparepart->id_jenis_bengkel = '1';
            $sparepart->save();
        }else if(Auth::user()->Bengkel->id_jenis_bengkel == '2'){
            $sparepart = new Sparepart;
            $sparepart->id_jenis_sparepart = $request->id_jenis_sparepart;
            $sparepart->id_merk = $request->id_merk;
            $sparepart->id_konversi = $request->id_konversi;
            $sparepart->kode_sparepart = $kode_sparepart;
            $sparepart->nama_sparepart = $request->nama_sparepart;
            $sparepart->id_kemasan = $request->id_kemasan;
            $sparepart->dimensi_berat = $request->dimensi_berat;
            $sparepart->slug = Str::slug($request->nama_sparepart);
            $sparepart->lifetime = $request->lifetime;
            $sparepart->jenis_barang = $request->jenis_barang;
            $sparepart->status_sparepart = 'Diajukan';
            $sparepart->id_jenis_bengkel = '2';
            $sparepart->save();
        }

        

        return redirect()->route('sparepart.index')->with('messageberhasil', 'Data Sparepart Berhasil diajukan - Mohon ditunggu untuk Approval Data');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_sparepart)
    {
        $sparepart = Sparepart::findOrFail($id_sparepart);

        return view('pages.inventory.masterdata.sparepart.detail', [
            'item' => $sparepart,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_sparepart)
    {
        $item = Sparepart::findOrFail($id_sparepart);
        $jenis_sparepart = Jenissparepart::where('status_jenis','=','Aktif')->get();
        $merk_sparepart = Merksparepart::where('status_merk','=','Aktif')->get();
        $konversi = Konversi::where('status_konversi','=','Aktif')->get();
        $kemasan = Kemasan::where('status_kemasan','=','Aktif')->get();

        return view('pages.inventory.masterdata.sparepart.edit', [
            'item' => $item,
            'jenis_sparepart' => $jenis_sparepart,
            'merk_sparepart' => $merk_sparepart,
            'konversi' => $konversi,
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MasterdataSpareparteditrequest $request, $id_sparepart)
    {

        $sparepart = Sparepart::findOrFail($id_sparepart);
        $sparepart->id_jenis_sparepart = $request->id_jenis_sparepart;
        $sparepart->id_merk = $request->id_merk;
        $sparepart->id_konversi = $request->id_konversi;
        $sparepart->id_rak = $request->id_rak;
        $sparepart->id_supplier = $request->id_supplier;
        $sparepart->kode_sparepart = $request->kode_sparepart;
        $sparepart->nama_sparepart = $request->nama_sparepart;
        $sparepart->stock_min = $request->stock_min;
        $sparepart->id_kemasan = $request->id_kemasan;
        $sparepart->berat_sparepart = $request->berat_sparepart;
        $sparepart->keterangan = $request->keterangan;

        // $sparepart->update();
        // $data = $request->all();

        $sparepart->save();

        return redirect()->route('sparepart.index')->with('messageberhasil', 'Data Sparepart Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_sparepart)
    {
        $sparepart = Sparepart::findOrFail($id_sparepart);
        Gallery::where('id_sparepart', $id_sparepart)->delete();
        $sparepart->delete();

        return redirect()->back()->with('messagehapus', 'Data Sparepart Berhasil dihapus');
    }

    public function gallery(Request $request, $id_sparepart)
    {
        $sparepart = Sparepart::findorFail($id_sparepart);
        $gallery = Gallery::with('sparepart')
            ->where('id_sparepart', $id_sparepart)
            ->get();

        return view('pages.inventory.masterdata.sparepart.gallery')->with([
            'sparepart' => $sparepart,
            'gallery' => $gallery,
        ]);
    }

    public function getmerk($id)
    {
        $merk = Merksparepart::where('id_jenis_sparepart', '=', $id)->pluck('merk_sparepart', 'id_merk');
        // return $merk;
        return json_encode($merk);
    }
}

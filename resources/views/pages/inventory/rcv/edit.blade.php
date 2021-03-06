@extends('layouts.Admin.admininventory')

@section('content')
{{-- HEADER --}}
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon" style="color: white"><i class="fas fa-dolly-flatbed"></i>
                            </div>
                            <div class="page-header-subtitle" style="color: white">Tambah Data Penerimaan</div>
                        </h1>
                        <div class="small">
                            <span class="font-weight-500">Receiving</span>
                            · Tambah · Data
                            <span class="font-weight-500 text-primary" id="id_rcv_tes"
                                style="display:none">{{ $rcv->id_rcv }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-xl-auto">
                        <a href="{{ route('Rcv.index')}}" class="btn btn-sm btn-light text-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-n10">
        <div class="row">
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-header">Detail Formulir Pembelian
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Rcv.store') }}" id="form1" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="small mb-1" for="kode_rcv">Kode Receiving</label>
                                <input class="form-control" id="kode_rcv" type="text" name="kode_rcv"
                                    placeholder="Input Kode Receiving" value="{{ $rcv->kode_rcv }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="id_pegawai">Pegawai</label>
                                <input class="form-control" id="id_pegawai" type="text" name="id_pegawai"
                                    placeholder="Input Kode Receiving" value="{{ Auth::user()->pegawai->nama_pegawai }}"
                                    readonly>
                                @error('id_pegawai')<div class="text-danger small mb-1">{{ $message }}
                                </div> @enderror
                            </div>
                            <div class="form-group">
                                <label class="small mb-1 mr-1" for="tanggal_rcv">Tanggal Receive</label><span
                                    class="mr-4 mb-3" style="color: red">*</span>
                                <input class="form-control" id="tanggal_rcv" type="date" name="tanggal_rcv"
                                    placeholder="Input Tanggal Receive" value="{{ $rcv->tanggal_rcv }}"
                                    class="form-control @error('tanggal_rcv') is-invalid @enderror" />
                                @error('tanggal_rcv')<div class="text-danger small mb-1">{{ $message }}
                                </div> @enderror
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="kode_po">Kode PO</label>
                                <input class="form-control" id="kode_po" type="text" name="kode_po"
                                    placeholder="Kode PO" value="{{ $rcv->PO->kode_po }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="id_supplier">Supplier</label>
                                <input class="form-control" id="id_supplier" type="text" name="id_supplier"
                                    placeholder="Supplier" value="{{ $rcv->Supplier->nama_supplier }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1 mr-1" for="no_do">Nomor DO</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <input class="form-control" id="no_do" type="text" name="no_do"
                                    placeholder="Input Nomor Delivery Order" value="{{ $rcv->no_do }}">
                            </div>

                            <div class="form-group text-right">
                                <hr>
                                <a href="{{ route('Rcv.index') }}" class="btn btn-sm btn-light">Kembali</a>
                                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal"
                                    data-target="#Modalsumbit">Simpan</button>
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card mb-4">
                    <div class="card card-header-actions">
                        <div class="card-header ">List Sparepart
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info alert-icon" role="alert">
                            <div class="alert-icon-aside">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div class="alert-icon-content">
                                <h5 class="alert-heading" class="small">Sparepart</h5>
                                Info Sparepart Pembelian
                            </div>
                        </div>
                        <div class="datatable">
                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-hover dataTable" id="dataTable"
                                            width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                            style="width: 100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 20px;">No</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 30px;">Kode</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 170px;">Sparepart</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Start date: activate to sort column ascending"
                                                        style="width: 40px;">Merk</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Salary: activate to sort column ascending"
                                                        style="width: 20px;">Jumlah dipesan</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Salary: activate to sort column ascending"
                                                        style="width: 40px;">Kemasan</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Salary: activate to sort column ascending"
                                                        style="width: 40px;">Harga Beli</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Actions: activate to sort column ascending"
                                                        style="width: 20px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($rcv->PO->Detailsparepart as $item)
                                                <tr id="item-{{ $item->id_sparepart }}" role="row" class="odd">
                                                    <th scope="row" class="small" class="sorting_1">
                                                        {{ $loop->iteration}}</th>
                                                    <td class="kode_sparepart">{{ $item->kode_sparepart }}</td>
                                                    <td class="nama_sparepart">{{ $item->nama_sparepart }}</td>
                                                    <td class="merk_sparepart">{{ $item->Merksparepart->merk_sparepart }}</td>
                                                    <td class="text-center qty">{{ $item->pivot->qty }}
                                                    </td>
                                                    <td class="satuan">{{ $item->Kemasan->nama_kemasan }}</td>
                                                    <td>@if ($item->pivot->harga_satuan == '')
                                                        <div class="small text-muted d-none d-md-block">Tidak ada
                                                            data
                                                        </div>
                                                        @else
                                                        <div class="harga_beli">
                                                            Rp.{{ number_format($item->pivot->harga_satuan,2,',','.') }}
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button id="{{ $item->kode_sparepart }}-button"
                                                            class="btn btn-success btn-datatable" type="button"
                                                            data-toggle="modal"
                                                            data-target="#Modaltambah-{{ $item->id_sparepart }}">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                @empty

                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="card">
            <div class="card card-header-actions">
                <div class="card-header ">Detail Penerimaan Sparepart
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" id="alertsparepartkosong" role="alert" style="display:none"> <i
                        class="fas fa-times"></i>
                    Error! Anda belum menambahkan sparepart!
                    <button class="close" type="button" onclick="$(this).parent().hide()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="datatable">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable" id="dataTablekonfirmasi"
                                    width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                    style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 20px;">
                                                No</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 50px;">
                                                Kode</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 100px;">
                                                Sparepart</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 40px;">
                                                Jumlah PO</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 40px;">
                                                Jumlah Rcv</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 80px;">
                                                Harga Beli</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 80px;">
                                                Keterangan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 80px;">
                                                Gudang</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 40px;">
                                                Stok Min</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 60px;">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id='konfirmasi'>
                                        @forelse ($rcv->Detailrcv as $sparepart )
                                        <tr id="gas-{{ $sparepart->id_sparepart }}" role="row" class="odd">
                                            <td></td>
                                            <td class="kode_sparepartedit"><span id="{{ $sparepart->kode_sparepart }}">{{ $sparepart->kode_sparepart }}</span></td>
                                            <td class="nama_sparepartedit"><span id="{{ $sparepart->id_sparepart }}">{{ $sparepart->nama_sparepart }}</span></td>
                                            <td class="qtypoedit">{{ $sparepart->pivot->qty_po }}</td>
                                            <td class="qtyrcvedit">{{ $sparepart->pivot->qty_rcv }}</td>
                                            <td class="total_hargaedit">Rp {{ number_format($sparepart->pivot->harga_diterima,2,',','.')}}</td>
                                            <td class="keterangan_edit">{{ $sparepart->pivot->keterangan }}</td>
                                            <td class="nama_gudangedit"><span id="{{ $sparepart->pivot->id_gudang }}">{{ $sparepart->pivot->nama_gudang }}</span></td>
                                            <td class="stok_minedit">{{ $sparepart->pivot->stok_min }}</td>
                                            <td></td>
                                        </tr>
                                        @empty

                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
</main>


{{-- MODAL TAMBAH QTY SPAREPART --}}
@forelse ($rcv->PO->Detailsparepart as $item)
<div class="modal fade" id="Modaltambah-{{ $item->id_sparepart }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">Form Receiving</h5>
                <button class="close" type="button" data-dismiss="modal" id="buttonclose-{{ $item->id_sparepart }}" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="" method="POST" id="form-{{ $item->id_sparepart }}" class="d-inline">
                <div class="modal-body">
                    <h6>Detail Pesanan</h6>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="d-flex flex-column font-weight-bold">
                                <div class="small mb-2">
                                    <span class="font-weight-500 text-primary">{{ $item->nama_sparepart }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label class="small text-muted line-height-normal">
                                Qty Pesanan: {{ $item->pivot->qty }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="small mb-1 mr-1" for="qty_rcv">Quantity Receive</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control" name="qty_rcv" type="number" id="qty_rcv" min="1"
                                placeholder="Input Quantity Rcv" value="{{ $item->qty_rcv }}"></input>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="harga_diterima">Harga diterima</label>
                            <input class="form-control harga_diterima" name="harga_diterima" type="number" min="1000"
                                placeholder="Input Harga Beli diterima" value="{{ $item->pivot->harga_satuan }}">
                            </input>
                            <div class="small text-primary">Harga (IDR):
                                <span id="detailhargaditerima"
                                    class="detailhargaditerima">Rp.{{ number_format($item->pivot->harga_satuan,2,',','.')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small mb-1" for="keterangan">Masukan Keterangan Penerimaan</label>
                        <textarea class="form-control" name="keterangan" type="text" id="keterangan"
                            placeholder="Input Keterangan diterima">{{ $item->keterangan }}</textarea>
                    </div>

                    @if ($item->Detailsparepart == ''| $item->Detailsparepart == null )
                    <hr>
                    <div class="small mb-2">
                        <span class="font-weight-500 text-dark">Penempatan Sparepart</span>
                    </div>
                    
                        <div class="form-group">
                            <label class="small mb-1 mr-1" for="id_gudang">Pilih Gudang</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <select class="form-control" name="id_gudang" id="id_gudang-{{ $item->id_sparepart }}">
                                <option value="" holder>Pilih Gudang</option>
                                @foreach ($gudang as $gudangs)
                                <option value="{{ $gudangs->id_gudang }}">
                                    {{ $gudangs->nama_gudang }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="small mb-1 mr-1" for="merk">Pilih Rak</label><span
                                class="mr-4 mb-3" style="color: red">*</span>
                            <select class="form-control" name="id_rak" id="id_rak"
                                class="form-control @error('id_rak') is-invalid @enderror">
                                <option value="" holder>Pilih Rak</option>
                            </select>
                            <span class="small" style="font-size: 13px"
                                style="color: rgb(117, 114, 114)">(Pilih gudang terlebih
                                dahulu)</span>
                            @error('id_rak')<div class="text-danger small mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small mb-1 mr-1" for="stok_min">Stok Minimum</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control" name="stok_min" type="number" id="stok_min" min="1"
                                placeholder="Input Stok Minimum" value="{{ old('stok_min') }}"></input>
                        </div>
                    </div>

                    @else
                    <hr>
                    <div class="small mb-2">
                        <span class="font-weight-500 text-dark">Penempatan Sparepart</span>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="small mb-1 mr-1" for="id_gudang">Pilih Gudang</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <select class="form-control" name="id_gudang" id="id_gudang-{{ $item->id_sparepart }}">
                                <option value="{{ $item->Detailsparepart->Gudang->id_gudang }}" holder>
                                    {{ $item->Detailsparepart->Gudang->nama_gudang }}</option>
                                @foreach ($gudang as $gudangs)
                                <option value="{{ $gudangs->id_gudang }}">
                                    {{ $gudangs->nama_gudang }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small mb-1 mr-1" for="stok_min">Stok Minimum</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control" name="stok_min" type="number" id="stok_min" min="1"
                                placeholder="Input Stok Minimum" value="{{ $item->Detailsparepart->stok_min }}"></input>
                        </div>
                    </div>
                    <span class="small text-muted line-height-normal"><span class="small">Penempatan Sebelumnya :
                            {{ $item->Detailsparepart->Gudang->nama_gudang }}</span></span>

                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" onclick="konfirmsparepart(event,{{ $item->id_sparepart }})"
                        type="button">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@empty
@endforelse


@forelse ($rcv->PO->Detailsparepart as $sparepart)
<div class="modal fade" id="Modalsumbit" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success-soft">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Form Penerimaan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">Apakah Form Receiving yang Anda inputkan sudah benar?</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button" data-dismiss="modal"
                    onclick="tambahrcv(event,{{ $rcv->PO->Detailsparepart }},{{ $rcv->id_rcv }})">Ya Sudah!</button>
            </div>
        </div>
    </div>
</div>
@empty
@endforelse

<template id="template_delete_button">
    <button class="btn btn-danger btn-datatable" onclick="hapussparepart(this)" type="button">
        <i class="fas fa-trash"></i>
    </button>
    <button class="btn btn-primary btn-datatable" onclick="editsparepart(this)" type="button">
        <i class="fas fa-edit"></i>
    </button>
</template>

<template id="template_add_button">
    <button class="btn btn-success btn-datatable" type="button" data-toggle="modal" data-target="#Modaltambah">
        <i class="fas fa-plus"></i>
    </button>
</template>

<script>
    function tambahrcv(event, sparepart, id_rcv) {
        event.preventDefault()
        var form1 = $('#form1')
        var kode_rcv = form1.find('input[name="kode_rcv"]').val()
        var kode_po = form1.find('input[name="kode_po"]').val()
        var no_do = form1.find('input[name="no_do"]').val()
        var id_supplier = $('#id_supplier').val()
        var id_pegawai = form1.find('input[name="id_pegawai"]').val()
        var tanggal_rcv = form1.find('input[name="tanggal_rcv"]').val()
        var dataform2 = []
        var _token = form1.find('input[name="_token"]').val()

        var datasparepart = $('#konfirmasi').children()
        for (let index = 0; index < datasparepart.length; index++) {
            var children = $(datasparepart[index]).children()

            // Validasi Table Kosong
            var validasichildren = children.children()

            // ID SPAREPART
            var td = children[2]
            var span = $(td).children()[0]
            var id_sparepart = $(span).attr('id')

            var tdqty_po = children[4]
            var qty_po = $(tdqty_po).html()

            var tdqty_rcv = children[4]
            var qty_rcv = $(tdqty_rcv).html()

            var tdharga_diterima = children[5]
            var harga_diterima_tes = $(tdharga_diterima).html()
            var harga_diterima = harga_diterima_tes.replace('Rp', '').replace('&nbsp;', '')
                .replace('.', '').replace('.', '').replace(',00', '').trim()

            var total_harga = qty_rcv * harga_diterima

            var tdketerangan = children[6]
            var keterangan = $(tdketerangan).html()

            var td = children[7]
            var span = $(td).children()[0]
            var id_gudang = $(span).attr('id')

            var tdnamagudang = children[6]
            var nama_gudang = $(tdnamagudang).html()

            var tdstok_min = children[8]
            var stok_min = $(tdstok_min).html()

            var obj = {
                id_sparepart: id_sparepart,
                id_rcv: id_rcv,
                qty_rcv: qty_rcv,
                qty_po: qty_po,
                keterangan: keterangan,
                harga_diterima: harga_diterima,
                total_harga: total_harga,
                id_gudang: id_gudang,
                nama_gudang: nama_gudang,
                stok_min: stok_min
            }
            dataform2.push(obj)
        }

        if (dataform2.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Anda Belum Memilih Sparepart!',
            })
        } else {
            var sweet_loader =
                '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
            var data = {
                _token: _token,
                kode_rcv: kode_rcv,
                kode_po: kode_po,
                id_supplier: id_supplier,
                id_pegawai: id_pegawai,
                tanggal_rcv: tanggal_rcv,
                sparepart: dataform2
            }

            $.ajax({
                method: 'put',
                url: '/inventory/receiving/' + id_rcv,
                data: data,
                beforeSend: function () {
                    swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Data Pembelian Sedang Diproses...',
                        showConfirmButton: false,
                        onRender: function () {
                            // there will only ever be one sweet alert open.
                            $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },
                success: function (response) {
                    swal.fire({
                        icon: 'success',
                        showConfirmButton: false,
                        html: '<h5>Success!</h5>'
                    });
                    window.location.href = '/inventory/receiving'

                },
                error: function (response) {
                    swal.fire({
                        icon: 'error',
                        html: '<h5>Error!</h5>'
                    });
                }
            });
        }
    }

    function konfirmsparepart(event, id_sparepart) {
        var form = $('#form-' + id_sparepart)
        var qty_rcv = form.find('input[name="qty_rcv"]').val()
        var harga_diterima = form.find('input[name="harga_diterima"]').val()
        var harga_diterima_fix = new Intl.NumberFormat('id', {
            style: 'currency',
            currency: 'IDR'
        }).format(harga_diterima)
        var keterangan = form.find('textarea[name="keterangan"]').val()
        var id_gudang = form.find('select[name=id_gudang]').val()
        var id_gudang2 = form.find('select[name=id_gudang]').text()
        var nama_gudang = $(`#id_gudang-${id_sparepart} :selected`).text().trim();
        var stok_min = form.find('input[name=stok_min]').val()

        if (qty_rcv == 0 | qty_rcv == '' | harga_diterima == 0 | harga_diterima == '' | id_gudang ==
            'Pilih Gudang' | id_gudang == '' | stok_min == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terdapat Field Data Kosong!',
            })
        } else {
            var data = $('#item-' + id_sparepart)
            var qty = $(data.find('.qty')[0]).text()

            // Kondisi tidak boleh melebihi qty po
            if (parseInt(qty_rcv) > parseInt(qty)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Qty Rcv tidak boleh melebihi Qty PO!',
                })

            } else {
                var kode_sparepart = $(data.find('.kode_sparepart')[0]).text()
                var nama_sparepart = $(data.find('.nama_sparepart')[0]).text()
                var jenis_sparepart = $(data.find('.jenis_sparepart')[0]).text()
                var merk_sparepart = $(data.find('.merk_sparepart')[0]).text()
                var satuan = $(data.find('.satuan')[0]).text()
                var qty = $(data.find('.qty')[0]).text()
                var harga_beli = $(data.find('.harga_beli')[0]).text()
                var template = $($('#template_delete_button').html())
                var table = $('#dataTablekonfirmasi').DataTable()
                var row = $(`#${$.escapeSelector(kode_sparepart.trim())}`).parent().parent()
                table.row(row).remove().draw();

                $('#dataTablekonfirmasi').DataTable().row.add([
                    nama_sparepart, `<span id=${kode_sparepart}>${kode_sparepart}</span>`, `<span id=${id_sparepart}>${nama_sparepart}</span>`,
                    qty, qty_rcv, harga_diterima_fix, keterangan, `<span id=${id_gudang}>${nama_gudang}</span>`, stok_min
                ]).draw();

                $(`#buttonclose-${id_sparepart}`).click()

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Menambahkan Data Sparepart'
                })

            }
        }
    }

    function hapussparepart(element, id_sparepart) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var table = $('#dataTablekonfirmasi').DataTable()
                var row = $(element).parent().parent()
                table.row(row).remove().draw();
                var table = $('#dataTable').DataTable()
            }
        })
    
    }

    function editsparepart(element) {
        var table = $('#dataTablekonfirmasi').DataTable()
        var row = $(element).parent().parent()
        var children = $(row).children()[1]
        var kode = $($(children).children()[0]).html().trim()
        $(`#${$.escapeSelector(kode)}-button`).trigger('click');
    }

    $(document).ready(function () {
        $('.harga_diterima').each(function () {
            $(this).on('input', function () {
                var harga = $(this).val()
                var harga_fix = new Intl.NumberFormat('id', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(harga)

                var harga_paling_fix = $(this).parent().find('.detailhargaditerima')
                $(harga_paling_fix).html(harga_fix);
            })
        })

        var template = $('#template_delete_button').html()
        $('#dataTablekonfirmasi').DataTable({
            "columnDefs": [{
                    "targets": -1,
                    "data": null,
                    "defaultContent": template
                },
                {
                    "targets": 0,
                    "data": null,
                    'render': function (data, type, row, meta) {
                        return meta.row + 1
                    }
                }
            ]
        });
    });

</script>


@endsection

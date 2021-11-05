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
                            <div class="page-header-icon" style="color: white"><i class="fas fa-truck-loading"></i>
                            </div>
                            <div class="page-header-subtitle" style="color: white">Tambah Data Retur</div>
                        </h1>
                        <div class="small">
                            <span class="font-weight-500">Retur</span>
                            · Tambah · Data
                            <span class="font-weight-500 text-primary" id="id_bengkel"
                                style="display:none">{{ Auth::user()->bengkel->id_bengkel}}</span>
                        </div>
                    </div>
                    <div class="col-12 col-xl-auto">
                        <a href="{{ route('retur.index') }}" class="btn btn-sm btn-light text-primary">Kembali</a>
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
                        <form action="{{ route('retur.store') }}" id="form1" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="small mb-1" for="kode_retur">Kode Retur</label>
                                <input class="form-control" id="kode_retur" type="text" name="kode_retur"
                                    placeholder="Input Kode Retur" value="{{ $kode_retur }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="id_supplier">Supplier</label>
                                <input class="form-control" id="id_supplier" type="text" name="id_supplier"
                                    placeholder="Supplier" value="{{ $retur->Supplier->nama_supplier }}" readonly>
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
                                <label class="small mb-1" for="tanggal_retur">Tanggal Retur</label>
                                <input class="form-control" id="tanggal_retur" type="date" name="tanggal_retur"
                                    placeholder="Input Tanggal Receive" value="{{ $retur->tanggal_retur }}"
                                    class="form-control @error('tanggal_retur') is-invalid @enderror" />
                                @error('tanggal_retur')<div class="text-danger small mb-1">{{ $message }}
                                </div> @enderror
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="notelp">No. Telephone</label>
                                <input class="form-control" id="detailtelp" type="text" name="notelp"
                                    placeholder="Supplier" value="{{ $retur->Supplier->telephone }}" readonly>
                            </div>
                            <div class="form-group text-right">
                                <hr>
                                <a href="{{ route('retur.index') }}" class="btn btn-sm btn-light">Kembali</a>
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
                                <h5 class="alert-heading" class="small">Sparepart Info</h5>
                                Sparepart Retur Pembelian
                            </div>
                        </div>
                        <div class="datatable">
                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-hover dataTable"
                                            id="dataTableSparepart" width="100%" cellspacing="0" role="grid"
                                            aria-describedby="dataTable_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 20px;">No</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 60px;">Kode</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 150px;">Nama Sparepart</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 50px;">Jenis Sparepart</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Start date: activate to sort column ascending"
                                                        style="width: 50px;">Merk</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Salary: activate to sort column ascending"
                                                        style="width: 20px;">Satuan</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Salary: activate to sort column ascending"
                                                        style="width: 20px;">Kemasan</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Actions: activate to sort column ascending"
                                                        style="width: 20px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($detailsparepart as $item)
                                                <tr id="item-{{ $item->sparepart->id_sparepart }}" role="row"
                                                    class="odd">
                                                    <th scope="row" class="small" class="sorting_1">
                                                        {{ $loop->iteration}}</th>
                                                    <td class="kode_sparepart">
                                                        {{ $item->sparepart->kode_sparepart }}</td>
                                                    <td class="nama_sparepart">
                                                        {{ $item->sparepart->nama_sparepart }}</td>
                                                    <td class="jenis_sparepart">
                                                        {{ $item->sparepart->Jenissparepart->jenis_sparepart }}
                                                    </td>
                                                    <td class="merk_sparepart">
                                                        {{ $item->sparepart->Merksparepart->merk_sparepart }}</td>
                                                    <td class="satuan">{{ $item->sparepart->Konversi->satuan }}
                                                    </td>
                                                    <td class="text-center kemasan">
                                                        {{ $item->sparepart->Kemasan->nama_kemasan }}
                                                    </td>
                                                    <td>
                                                        <button id="{{ $item->sparepart->kode_sparepart }}-button"
                                                            class="btn btn-success btn-datatable" type="button"
                                                            data-toggle="modal"
                                                            data-target="#Modaltambah-{{ $item->sparepart->id_sparepart }}">
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
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card card-header-actions">
                <div class="card-header ">Detail Retur Sparepart
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
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 50px;">
                                                Kode Sparepart</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 90px;">
                                                Sparepart</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 70px;">
                                                Merk Sparepart</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 40px;">
                                                Satuan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 40px;">
                                                Jumlah Retur</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 150px;">
                                                Keterangan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 60px;">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id='konfirmasi'>
                                        @forelse ($retur->Detailretur as $sparepart)
                                        <tr id="gas-{{ $sparepart->id_sparepart }}" role="row" class="odd">
                                            <td></td>
                                            <td class="kode_sparepartedit"><span id="{{ $sparepart->kode_sparepart }}">{{ $sparepart->kode_sparepart }}</span></td>
                                            <td class="nama_sparepartedit"><span id="{{ $sparepart->id_sparepart }}">{{ $sparepart->nama_sparepart }}</span></td>
                                            <td class="merk_sparepartedit">{{ $sparepart->Merksparepart->merk_sparepart }}</td>
                                            <td class="satuan_edit">{{ $sparepart->Konversi->satuan }}</td>
                                            <td class="qty_retur_edit">{{ $sparepart->pivot->qty_retur }}</td>
                                            <td class="keterangan_retur_edit">{{ $sparepart->pivot->keterangan_retur }}
                                            </td>
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
    </div>
</main>

{{-- MODAL TAMBAH QTY SPAREPART --}}
@forelse ($detailsparepart as $item)
<div class="modal fade" id="Modaltambah-{{ $item->sparepart->id_sparepart }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">Detail Receiving</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" id="buttonclose-{{ $item->sparepart->id_sparepart }}"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="" method="POST" id="form-{{ $item->sparepart->id_sparepart }}" class="d-inline">
                <div class="modal-body">
                    <div class="small mb-2">
                        <span class="font-weight-500 text-primary">{{ $item->sparepart->nama_sparepart }}</span>
                    </div>
                    <hr class="my-4">
                    <div class="form-group">
                        <label class="small mb-1 mr-1" for="qty_retur">Masukan Quantity Retur</label><span class="mr-4 mb-3"
                        style="color: red">*</span>
                        <input class="form-control" name="qty_retur" type="number" id="qty_retur" min="1"
                            placeholder="Input Quantity Retur" value="{{ $item->qty_retur }}"></input>
                    </div>
                    <div class="form-group">
                        <label class="small mb-1 mr-1" for="keterangan_retur">Masukan Keterangan Retur</label><span class="mr-4 mb-3"
                        style="color: red">*</span>
                        <textarea class="form-control" name="keterangan_retur" type="text" id="keterangan_retur"
                            placeholder="Input Keterangan Retur">{{ $item->keterangan_retur }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-success"
                        onclick="konfirmsparepart(event,{{ $item->sparepart->id_sparepart }})" type="button"
                        >Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@empty
@endforelse


@forelse ($sparepart as $item)
<div class="modal fade" id="Modalsumbit" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success-soft">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Formulir Retur</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">Apakah Form Retur dengan kode {{ $kode_retur }} yang Anda inputkan sudah
                    benar?</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button"
                    onclick="tambahretur(event,{{ $detailsparepart }},{{ $retur->id_retur }})" data-dismiss="modal">Ya Sudah!</button>
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
    function tambahretur(event, sparepart, id_retur) {
        event.preventDefault()
        var form1 = $('#form1')
        var kode_retur = form1.find('input[name="kode_retur"]').val()
        var id_supplier = $('#id_supplier').val()
        var id_pegawai = form1.find('input[name="id_pegawai"]').val()
        var tanggal_retur = form1.find('input[name="tanggal_retur"]').val()
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

            // JUMLAH REAL
            var tdqty = children[5]
            var qty_retur = $(tdqty).html()

            var tdketerangan = children[6]
            var keterangan_retur = $(tdketerangan).html()

            var obj = {
                id_sparepart: id_sparepart,
                id_retur: id_retur,
                qty_retur: qty_retur,
                keterangan_retur: keterangan_retur,
            }
            dataform2.push(obj)
            // console.log(obj)
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
                kode_retur: kode_retur,
                id_supplier: id_supplier,
                tanggal_retur: tanggal_retur,
                sparepart: dataform2
            }

           

            $.ajax({
                method: 'put',
                url: '/inventory/retur/' + id_retur,
                data: data,
                beforeSend: function () {
                    swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Data Retur Sedang Diproses...',
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
                    window.location.href = '/inventory/retur'

                },
                error: function (response) {
                    console.log(response)
                    swal.fire({
                        icon: 'error',
                        html: '<h5>Error!</h5>'
                    });
                }
            });
        }

        // dataTablekonfirmasi
    }

    $(document).ready(function () {
        var table = $('#dataTableSparepart').DataTable({
            "pageLength": 5,
            "lengthMenu": [
                [5, 10, 20, -1],
                [5, 10, 20, ]
            ]
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

    })

    function konfirmsparepart(event, id_sparepart) {
        var form = $('#form-' + id_sparepart)
        var qty_retur = form.find('input[name="qty_retur"]').val()
        var keterangan_retur = form.find('textarea[name="keterangan_retur"]').val()

        if (qty_retur == 0 | qty_retur == '' | keterangan_retur == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terdapat Field Data Kosong!',
            })
        } else {
            var data = $('#item-' + id_sparepart)
            var nama_sparepart = $(data.find('.nama_sparepart')[0]).text()
            var kode_sparepart = $(data.find('.kode_sparepart')[0]).text()
            var jenis_sparepart = $(data.find('.jenis_sparepart')[0]).text()
            var merk_sparepart = $(data.find('.merk_sparepart')[0]).text()
            var satuan = $(data.find('.satuan')[0]).text()
            var template = $($('#template_delete_button').html())
            var table = $('#dataTablekonfirmasi').DataTable()
            var row = $(`#${$.escapeSelector(kode_sparepart.trim())}`).parent().parent()
            table.row(row).remove().draw();

            $('#dataTablekonfirmasi').DataTable().row.add([
                nama_sparepart, `<span id=${kode_sparepart}>${kode_sparepart}</span>`, `<span id=${id_sparepart}>${nama_sparepart}</span>`,
                merk_sparepart, satuan, qty_retur, keterangan_retur
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

    function hapussparepart(element) {
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
        console.log(children)
        var kode = $($(children).children()[0]).html().trim()
        $(`#${$.escapeSelector(kode)}-button`).trigger('click');
    }

</script>
@endsection

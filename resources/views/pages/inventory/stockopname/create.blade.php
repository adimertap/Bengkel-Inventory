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
                            <div class="page-header-subtitle" style="color: white">Tambah Data Opname</div>
                        </h1>
                        <div class="small">
                            <span class="font-weight-500">Stock Opname</span>
                            · Tambah · Data
                        </div>
                        <span class="font-weight-500 text-primary" id="id_bengkel"
                            style="display:none">{{ Auth::user()->bengkel->id_bengkel}}</span>
                    </div>
                    <div class="col-12 col-xl-auto">
                        <a href="{{ route('Opname.index') }}" class="btn btn-sm btn-light text-primary">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger" id="alertsparepartkosong" role="alert" style="display:none"> <i
                    class="fas fa-times"></i>
                Error! Anda belum menambahkan sparepart!
                <button class="close" type="button" onclick="$(this).parent().hide()" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    </header>


    <div class="container-fluid mt-n10">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">Detail Formulir Opname
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Opname.store') }}" id="form1" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="kode_opname">Kode Opname</label>
                                    <input class="form-control" id="kode_opname" type="text" name="kode_opname"
                                        placeholder="Input Kode Opname" value="{{ $opname->kode_opname }}" readonly />
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="id_pegawai">Pegawai</label>
                                    <input class="form-control" id="id_pegawai" type="text" name="id_pegawai"
                                        value="{{ Auth::user()->pegawai->nama_pegawai }}" readonly />
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="approve">Approval</label>
                                    <input class="form-control" id="approve" type="text" name="approve" value="Pending"
                                        readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="kode_opname">Lokasi Gudang</label>
                                    <input class="form-control" id="kode_opname" type="text" name="kode_opname"
                                        placeholder="Input Kode Opname" value="{{ $opname->Gudang->nama_gudang }}"
                                        readonly />
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <hr>
                                <a href="{{ route('Opname.index') }}" class="btn btn-sm btn-light">Kembali</a>
                                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal"
                                    data-target="#Modalsumbit">Simpan</button>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">

                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;"
                                src="/backend/src/assets/img/freepik/opname.png" alt="">
                        </div>
                        <div class="text-center">
                            <p style="text-align: center">Pilih <span class="font-weight-bold text-primary">Sparepart
                                </span> untuk
                                melakukan pengecekan jumlah. Selisih akan otomatis terisi jika stok real diinputkan
                        </div>
                    </div>
                </div>
            </div>


        </div>



        <div class="card mb-4">
            <div class="card card-header-actions">
                <div class="card-header ">List Sparepart
                </div>
            </div>
            <div class="card-body">

                <div class="datatable">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable" id="dataTableSparepart"
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
                                                style="width: 60px;">Kode</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 70px;">Nama Sparepart</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 50px;">Merk</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 80px;">Stock Real</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 50px;">Selisih</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 20px;">Satuan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 60px;">Keterangan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 20px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($opname->Gudang->Sparepart as $item)
                                        <tr id="item-{{ $item->id_detail_sparepart }}" role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                            <td class="kode_sparepart">{{ $item->Sparepart->kode_sparepart }}</td>
                                            <td class="nama_sparepart">{{ $item->Sparepart->nama_sparepart }}</td>
                                            <td class="merk_sparepart">
                                                {{ $item->Sparepart->Merksparepart->merk_sparepart }}</td>
                                            <td><input class="form-control form-control-sm"
                                                    id="stock-real-{{ $item->id_detail_sparepart }}"
                                                    onchange="calculateSelisih({{ $item->id_detail_sparepart }}, {{ $item->qty_stok }})"
                                                    type="number" placeholder="Input Stock Real" min="1"/>
                                            </td>
                                            <td><input class="form-control form-control-sm"
                                                    id="selisih-{{ $item->id_detail_sparepart }}" type="text"
                                                    disabled />
                                            </td>
                                            <td class="satuan">{{ $item->Sparepart->Konversi->satuan }}</td>
                                            <td><input class="form-control form-control-sm"
                                                    id="keterangan-{{ $item->id_detail_sparepart }}" type="text"
                                                    placeholder="Input Keterangan" />
                                            </td>
                                            <td> <button class="btn btn-success btn-datatable"
                                                    onclick="konfirmsparepart(event, {{ $item->id_detail_sparepart }})"
                                                    type="button" data-dismiss="modal"><i
                                                        class="fas fa-plus"></i></button></td>
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


    <div class="container-fluid">
        <div class="card">
            <div class="card card-header-actions">
                <div class="card-header ">Detail Opname Sparepart
                </div>
            </div>
            <div class="card-body">
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
                                                style="width: 80px;">
                                                Kode</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 180px;">
                                                Nama Sparepart</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 70px;">
                                                Merk</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 40px;">
                                                Satuan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 40px;">
                                                Stock Real</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 40px;">
                                                Selisih</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 20px;">
                                                Keterangan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 100px;">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id='konfirmasi'>
                                        @forelse ($opname->Detailsparepart as $sparepart )
                                        <tr id="item-{{ $sparepart->id_detail_sparepart }}" role="row" class="odd">
                                            <td></td>
                                            <td class="kode_sparepartedit"><span
                                                    id="{{ $sparepart->id_detail_sparepart }}"></span>{{ $sparepart->Sparepart->kode_sparepart }}
                                            </td>
                                            <td class="nama_sparepartedit">{{ $sparepart->Sparepart->nama_sparepart }}
                                            </td>
                                            <td class="merk_sparepartedit">
                                                {{ $sparepart->Sparepart->Merksparepart->merk_sparepart }}</td>
                                            <td class="kemasan_edit">{{ $sparepart->Sparepart->Konversi->satuan }}</td>
                                            <td class="jumlahreal_edit">{{ $sparepart->pivot->jumlah_real }}</td>
                                            <td class="selisih_edit">{{ $sparepart->pivot->selisih }}</td>
                                            <td class="keterangan_edit">{{ $sparepart->pivot->keterangan_detail }}</td>
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
    </div>
</main>

@forelse ($detailsparepart as $item)
<div class="modal fade" id="Modalsumbit" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success-soft">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Form Opname</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">Apakah Form yang Anda inputkan sudah benar?

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button"
                    onclick="tambahsparepart(event,{{ $opname->Gudang->Sparepart }},{{ $opname->id_opname }})">Ya
                    Sudah!</button>
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
</template>

<template id="template_add_button">
    <button class="btn btn-success btn-datatable" type="button" data-toggle="modal" data-target="#Modaltambah">
        <i class="fas fa-plus"></i>
    </button>
</template>

<script>
    function calculateSelisih(id_detail_sparepart, stock) {
        var jumlah_real = $(`#stock-real-${id_detail_sparepart}`).val()
        var selisih = parseInt(stock) - (parseInt(jumlah_real) | 0)
        $(`#selisih-${id_detail_sparepart}`).val(selisih)
    }

    function tambahsparepart(event, sparepart, id_opname) {
        event.preventDefault()
        var form1 = $('#form1')
        var kode_opname = form1.find('input[name="kode_opname"]').val()
        var id_pegawai = $('#id_pegawai').val()
        var tanggal_opname = form1.find('input[name="tanggal_opname"]').val()
        var dataform2 = []
        var _token = form1.find('input[name="_token"]').val()

        var datasparepart = $('#konfirmasi').children()
        for (let index = 0; index < datasparepart.length; index++) {
            var children = $(datasparepart[index]).children()

            // Validasi Table Kosong
            var validasichildren = children.children()

            // ID SPAREPART
            var td = children[1]
            var span = $(td).children()[0]
            var id_detail_sparepart = $(span).attr('id')

            // JUMLAH REAL
            var tdjumlahreal = children[5]
            var jumlah_real = $(tdjumlahreal).html()

            // Selisih
            var tdselisih = children[6]
            var selisih = $(tdselisih).html()

            // Keterangan
            var tdketerangan = children[7]
            var keterangan_detail = $(tdketerangan).html()


            var obj = {
                id_detail_sparepart: id_detail_sparepart,
                jumlah_real: jumlah_real,
                selisih: selisih,
                keterangan_detail: keterangan_detail,
                id_opname: id_opname
            }
            dataform2.push(obj)
            // console.log(obj)
        }

        if (validasichildren[0] == undefined) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Anda Belum Memilih Sparepart!',
            })
        }else {
            var sweet_loader =
                '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';

            var data = {
                _token: _token,
                id_pegawai: id_pegawai,
                sparepart: dataform2
            }
            console.log(data)

            $.ajax({
                method: 'put',
                url: '/inventory/Opname/' + id_opname,
                data: data,
                beforeSend: function () {
                    swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Data Opname Sedang Diproses...',
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
                    window.location.href = '/inventory/Opname'

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
    }

    function konfirmsparepart(event, id_detail_sparepart) {
        var jumlah_real = $(`#stock-real-${id_detail_sparepart}`).val()
        var keterangan_detail = $(`#keterangan-${id_detail_sparepart}`).val()
        var selisih = $(`#selisih-${id_detail_sparepart}`).val()

        if (jumlah_real == 0 | jumlah_real == '' | jumlah_real < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terdapat Field Data Kosong!',
            })
        }else if(selisih == 0 | selisih < 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data Qty Tidak Terdapat Selisih!',
            })
        }  else {
            var data = $('#item-' + id_detail_sparepart)
            var kode_sparepart = $(data.find('.kode_sparepart')[0]).text()
            var nama_sparepart = $(data.find('.nama_sparepart')[0]).text()
            var merk_sparepart = $(data.find('.merk_sparepart')[0]).text()
            var satuan = $(data.find('.satuan')[0]).text()
            var template = $($('#template_delete_button').html())
            var table = $('#dataTablekonfirmasi').DataTable()
            // Akses Parent Sampai <tr></tr> berdasarkan id kode sparepart
            var row = $(`#${$.escapeSelector(kode_sparepart.trim())}`).parent().parent()
            table.row(row).remove().draw();

            $('#dataTablekonfirmasi').DataTable().row.add([
                kode_sparepart, `<span id=${id_detail_sparepart}>${kode_sparepart}</span>`, nama_sparepart,
                merk_sparepart, satuan,
                jumlah_real, selisih, keterangan_detail
            ]).draw();

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
                // Akses Parent Sampai <tr></tr>
                var row = $(element).parent().parent()
                table.row(row).remove().draw();
                // draw() Reset Ulang Table
                var table = $('#dataTable').DataTable()
            }
        })
    
      
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
    });

</script>


@endsection

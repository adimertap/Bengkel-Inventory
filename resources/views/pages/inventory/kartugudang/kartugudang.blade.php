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
                            Kelola Stok Sparepart dan Kartu Gudang
                        </h1>
                        <div class="small">
                            <span class="font-weight-500">{{ $today }}</span>
                            · Tanggal {{ $tanggal }} · <span id="clock">12:16 PM</span>
                        </div>
                    </div>
                    <div class="col-12 col-xl-auto mt-4">
                        <div class="small">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            Bengkel
                            <span class="font-weight-500">{{ Auth::user()->bengkel->nama_bengkel}}</span>
                            <hr>
                            </hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid mt-n10">
        <div class="card card-waves mb-4">
            <div class="card-body p-5">
                <div class="row align-items-center justify-content-between">
                    <div class="col">
                        <h2 class="text-primary">Data Sparepart Bengkel</h2>
                        <p class="text-gray-700">Anda ingin menambahkan stok sparepart? Anda dapat
                            melakukan pembelian sparepart pada menu <b>purchase order</b>
                        </p>
                        <a class="btn btn-primary btn-sm px-3 py-2" href="{{ route('purchase-order.index') }}">
                            Purchase Order
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-arrow-right ml-1">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                    <div class="col d-none d-lg-block ml-15">
                        <img class="img-fluid px-xl-4 " style="width: 19rem;"
                            src="/backend/src/assets/img/freepik/tes.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card card-header-actions">
                <div class="card-header ">List Sparepart</div>
            </div>
            <div class="card-body ">
                <div class="datatable">
                    @if(session('messageberhasil'))
                    <div class="alert alert-success" role="alert"> <i class="fas fa-check"></i>
                        {{ session('messageberhasil') }}
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                    @if(session('messagehapus'))
                    <div class="alert alert-danger" role="alert"> <i class="fas fa-check"></i>
                        {{ session('messagehapus') }}
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 20px;">
                                                No</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 30px;">Kode</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 140px;">Nama Sparepart</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 70px;">Jenis Sparepart</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 50px;">Merk</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 40px;">Qty</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 40px;">Stok Min</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 40px;">Gudang</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 40px;">Status Qty</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 60px;">Kartu Gudang</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 80px;">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sparepart as $item)
                                        <tr role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                            <td>{{ $item->Sparepart->kode_sparepart }}</td>
                                            <td>{{ $item->Sparepart->nama_sparepart }}</td>
                                            <td>{{ $item->Sparepart->Jenissparepart->jenis_sparepart }}</td>
                                            <td>{{ $item->Sparepart->Merksparepart->merk_sparepart }}</td>
                                            <td>{{ $item->qty_stok }}</td>
                                            <td>{{ $item->stok_min}}</td>
                                            <td>{{ $item->Gudang->nama_gudang }}</td>
                                            <td class="text-center">
                                                @if($item->status_jumlah == 'Cukup')
                                                <span class="badge badge-success">
                                                    @elseif($item->status_jumlah == 'Habis')
                                                    <span class="badge badge-danger">
                                                        @elseif($item->status_jumlah == 'Kurang')
                                                        <span class="badge badge-warning">
                                                            @else
                                                            <span>
                                                                @endif
                                                                {{ $item->status_jumlah }}
                                                            </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('Kartu-gudang.show', $item->id_detail_sparepart) }}"
                                                    class="btn btn-info btn-datatable" data-toggle="tooltip"
                                                    data-placement="top" title=""
                                                    data-original-title="Sparepart Report">
                                                    <i class="fas fa-box"></i>
                                                </a>
                                                <a href="{{ route('cetak-kartu-gudang', $item->id_detail_sparepart) }}"
                                                    class="btn btn-primary btn-datatable" data-toggle="tooltip"
                                                    target="_blank" data-placement="top" title=""
                                                    data-original-title="Cetak Sparepart Report">
                                                    <i class="fas fa-print"></i></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('Detailsparepart-gallery', $item->id_detail_sparepart) }}"
                                                    class="btn btn-secondary btn-datatable" data-toggle="tooltip"
                                                    data-placement="top" title=""
                                                    data-original-title="Detail Sparepart dan Foto">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="" class="btn btn-light btn-xs" type="button"
                                                    data-toggle="modal"
                                                    data-target="#Modalmutasi-{{ $item->id_detail_sparepart }}">
                                                    Mutasi
                                                </a>
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
</main>


@forelse ($sparepart as $item)
<div class="modal fade" id="Modalmutasi-{{ $item->id_detail_sparepart }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">Mutasi Sparepart</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('Detailsparepart.update', $item->id_detail_sparepart) }}" method="POST"
                class="d-inline">
                @csrf
                <div class="modal-body">
                    <h6>Mutasi Penempatan Sparepart</h6>
                    <div class="form-group">
                        <label class="small mb-1 mr-1" for="id_gudang">Pilih Gudang</label><span class="mr-4 mb-3"
                            style="color: red">*</span>
                        <select class="form-control" name="id_gudang" id="id_gudang" class="form-control" required>
                            <option value="" holder>Pilih Jenis</option>
                            @foreach ($gudang as $items)
                            <option value="{{ $items->id_gudang }}">
                                {{ $items->nama_gudang }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="small mb-1 mr-1" for="id_rak">Pilih Rak</label><span class="mr-4 mb-3"
                            style="color: red">*</span>
                        <select class="form-control" name="id_rak" id="id_rak" class="form-control">
                            <option value="" holder>Pilih Rak</option>
                        </select>
                        <span class="small" style="font-size: 13px" style="color: rgb(117, 114, 114)">(Pilih jenis
                            sparepart terlebih
                            dahulu)</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="submit">Mutasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@empty

@endforelse

@if (count($errors) > 0)
<button id="validasierror" style="display: none" type="button" data-toggle="modal" data-target="#Modaltambah">Open
    Modal</button>
@endif

{{-- Script Open Modal Callback --}}
<script>
    $(document).ready(function () {
        $('#validasierror').click();

        $('select[name="id_gudang"]').on('change', function () {
            var id_gudang = $(this).val();
            if (id_gudang) {
                $.ajax({
                    url: 'getrak/' + id_gudang,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="id_rak"]').empty();
                        $('select[name="id_rak"]').append(
                            '<option value="" holder>Pilih Rak</option>')
                        $.each(data, function (key, value) {
                            $('select[name="id_rak"]').append(
                                '<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                    error: function (response) {
                        console.log(response)
                    }
                });
            } else {
                $('select[name="id_rak"]').empty();
            }
        });
    });

    setInterval(displayclock, 500);

    function displayclock() {
        var time = new Date()
        var hrs = time.getHours()
        var min = time.getMinutes()
        var sec = time.getSeconds()
        var en = 'AM';

        if (hrs > 12) {
            en = 'PM'
        }

        if (hrs > 12) {
            hrs = hrs - 12;
        }

        if (hrs == 0) {
            hrs = 12;
        }

        if (hrs < 10) {
            hrs = '0' + hrs;
        }

        if (min < 10) {
            min = '0' + min;
        }

        if (sec < 10) {
            sec = '0' + sec;
        }

        document.getElementById('clock').innerHTML = hrs + ':' + min + ':' + sec + ' ' + en;
    }

</script>
@endsection

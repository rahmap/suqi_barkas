@extends('layouts.customer.v_main_customer')

@section('title', $title)

@section('outCSS')
    <!-- DataTables -->
    <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('dashboard/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('contents')
    @if (\session()->has('message'))
        {!! \session()->get('message') !!}
    @endif
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">{{ $title }}</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>


                                <tbody class="text-center">
                                    <tr>
                                        <td>{{ $produk['id'] }}</td>
                                        <td>{{ $produk['nama'] }}</td>
                                        <td>{{ 'Rp '.formatRupiah($produk['harga']) }}</td>
                                        <td>{{ $produk['diskon'] }} %</td>
                                        <td>{!! $produk['kategoris']['nama'] !!}</td>
                                        <td>
                                            @if($produk['is_active'] == 0)
                                                <span class="badge badge-secondary">Tidak Aktif</span>
                                            @elseif($produk['is_active'] == 1)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-warning">Menunggu Persetujuan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group mt-1 mr-1 dropright" style="z-index: 999999;">
                                                <button type="button" class="btn btn-secondary waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-chevron-down"></i> Pilihan
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('produk.edit',['produk' => $produk['id']]) }}">Update Produk</a>
                                                    <div class="dropdown-divider"></div>
                                                    @if($produk['is_active'] != 2)
                                                        @if($produk['is_active'])
                                                            <a class="dropdown-item btn_nonaktifkan" data-nama="<?= $produk['nama'] ?>"
                                                               href="{{ route('produk.aktifNonaktifCustomer', ['product' => $produk['id'], 'status' => 0]) }}">
                                                                Nonaktifkan Produk</a>
                                                        @else
                                                            <a class="dropdown-item btn_aktifkan" data-nama="<?= $produk['nama'] ?>"
                                                               href="{{ route('produk.aktifNonaktifCustomer', ['product' => $produk['id'], 'status' => 1]) }}">
                                                                Aktifkan Produk</a>
                                                        @endif
                                                    @endif
                                                    <a class="dropdown-item btn_delete" data-nama="<?= $produk['nama'] ?>"
                                                       data-href="{{ route('produk.destroy', ['produk' => $produk['id']]) }}"
                                                       href="javascript:0;">Hapus Produk</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-5">
                    <div class="card">

                        <div class="card-body">
                        <h4 class="header-title">Keterangan</h4>
                            <hr>
                            <p><b>Lokasi :</b> {{ $produk['produk_location'] }}</p>
                            {!! $produk['keterangan'] !!}
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="text-center">
                                <tr>
                                    <th>Dibuat</th>
                                    <th>Diupdate</th>
                                    <th>Gambar</th>
                                    <th>Gambar Tambahan</th>
                                </tr>
                                </thead>


                                <tbody class="text-center">
                                <tr>
                                    <td>{{ $produk['created_at'] }}</td>
                                    <td>{{ $produk['updated_at'] }}</td>
                                    <td><a target="_blank" href="{{ asset('storage/product/'.$produk->gambar) }}">Lihat</a></td>
                                    <td><a target="_blank" href="{{ asset('storage/product/'.$produk->gambar_tambahan) }}">Lihat</a></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <form class="form_delete" action="" method="post">
        @csrf
        @method('delete')
    </form>
@endsection

@section('outJS')
    <!-- Required datatable js -->
    <script src="{{ asset('dashboard/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('dashboard/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function (){
            let table = $('#datatable').DataTable()
            let table1 = $('#datatable1').DataTable()
            let nama = '';
            table.on('click', '.btn_delete', function (e){
                nama = $(this).data('nama')
                e.preventDefault();
                Swal.fire({
                    title: 'Anda Yakin?',
                    text: 'Hapus Produk ' + nama + ' ?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, lanjutkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Pertanyaan Terakhir!',
                            text: 'Tidak bisa diulangi!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus produk!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('.form_delete').attr('action', $(this).data('href')).submit()
                            }
                        })
                    }
                })
            })
        })
    </script>
@endsection

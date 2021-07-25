@extends('layouts.admin.v_main_admin')

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

                            <h4 class="header-title">{{ $title }}</h4>
                            <p>List Pesanan yang sudah dilakukan Pelanggan</p>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Penerima</th>
                                    <th>Nomor HP</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Status Pemesanan</th>
                                    <th>Total Harga</th>
                                    <th>Dipesan Pada</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>


                                <tbody class="text-center">

                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order['id'] }}</td>
                                        <td>{{ $order['nama_penerima'] }}</td>
                                        <td>{{ $order['phone_penerima'] }}</td>
                                        <td>{!! !empty($order['bukti_pembayaran'])? '<a target="_blank" href="'.asset('storage/bukti/'.$order['bukti_pembayaran']).'">lihat</a>' : '<span class="badge badge-secondary">Belum Ada</span>' !!}</td>
                                        <td>
                                            @if($order['status_pemesanan'] == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($order['status_pemesanan'] == 'success')
                                                <span class="badge badge-success">Success</span>
                                            @elseif($order['status_pemesanan'] == 'cancel')
                                                <span class="badge badge-danger">Cancel</span>
                                            @else
                                                <span class="badge badge-info">Delivery</span>
                                            @endif
                                        </td>
                                        <td>Rp {{ formatRupiah($order['ongkir'] + $order['total_harga_barang']) }}</td>
                                        <td>{{ substr(str_replace('T',' ',$order['created_at']),0,16) }}</td>
                                        <td>
                                            <div class="btn-group mt-1 mr-1 dropright" style="z-index: 999999;">
                                                <button type="button" class="btn btn-secondary waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-chevron-down"></i> Pilihan
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('pesanan_detail',['order' => $order['id']]) }}">Detail Pesanan</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <!-- end row -->

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
            let table = $('#datatable').DataTable({
                "order": [[ 0, "desc" ]]
            })
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

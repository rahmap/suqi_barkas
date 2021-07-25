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
                        <h4 class="mb-0 font-size-18">{{ $title }} ID : <span class="text-info">{{ $order['id'] }}</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Update Status Pesanan</h4>
                            <p class="card-title-desc">Update status pesanan supaya memberikan kenyamanan pada Pelanggan</p>

                            <form class="needs-validation" action="<?= route('pesanan_detail_post',['order' => $order['id']]) ?>" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id }}">
                                <div class="row">
                                    <div class="col-md-12 mb-12">
                                        <label for="resi">Nomor Resi</label>
                                        <input type="text" disabled id="resi" data-resi="{{ $order['nomor_resi'] }}"
                                               class="form-control @error('nomor_resi') is-invalid @enderror"
                                               name="nomor_resi" minlength="3" maxlength="100" placeholder="Kosongkan jika belum ada"
                                               value="{{ old('nomor_resi', $order['nomor_resi']) }}">
                                        @error('nomor_resi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-12 mt-3">
                                        <label for="informasi">Informasi Pemesanan</label>
                                        <input type="text" id="informasi" @if($order['status_pemesanan'] == 'success' OR $order['status_pemesanan'] == 'cancel') disabled @endif class="form-control @error('informasi_pemesanan') is-invalid @enderror"
                                               name="informasi_pemesanan" minlength="3" maxlength="100" placeholder="" value="{{ old('informasi_pemesanan', $order['informasi_pemesanan']) }}" required>
                                        @error('informasi_pemesanan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-12 mt-3">
                                        <label for="status">Status Pemesanan</label>
                                        <select name="status_pemesanan" @if($order['status_pemesanan'] == 'success' OR $order['status_pemesanan'] == 'cancel') disabled @endif
                                            required class="form-control" id="status">
                                            @if($order['status_pemesanan'] != 'success')
                                                @if($order['status_pemesanan'] == 'cancel')
                                                    <option value=""> - </option>
                                                @else
                                                    <option value="" id="opt-pilih"
                                                        data-info="{{ $order['informasi_pemesanan'] }}"> - Pilih -</option>
                                                @endif
                                            @else
                                                <option value=""> - </option>
                                            @endif
                                            @if($order['status_pemesanan'] == 'pending')
                                            <option value="delivery" @if($order['status_pemesanan'] == 'delivery') selected @endif
                                                data-info="Pembayaran Berhasil Diverifikasi, barang sedang dikirim.">Delivery</option>
                                            <option value="cancel" @if($order['status_pemesanan'] == 'cancel') selected @endif
                                                data-info="Pesanan Dibatalkan oleh Admin karena ..">Cancel</option>
                                            @endif
                                            @if($order['status_pemesanan'] == 'delivery')
                                            <option value="success" @if($order['status_pemesanan'] == 'success') selected @endif
                                                data-info="Pesanan sudah selesai.">Success</option>
                                            @endif
{{--                                            <option value="pending" @if($order['status_pemesanan'] == 'pending') selected @endif--}}
{{--                                            data-info="Menunggu Pembayaran.">Pending</option>--}}
                                        </select>
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                @if($order['status_pemesanan'] != 'success' AND $order['status_pemesanan'] != 'cancel')
                                <div class="container mt-4">
                                    <div class="row">
                                        <div class="col text-center">
                                            <button class="btn btn-primary" type="submit">Update Status Pesanan</button>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Bukti Pembayaran</h4>
                            <div class="card">
                                <div class="card-body text-center">
                                    @if(empty($order['bukti_pembayaran']))
                                        <h3>Belum Ada</h3>
                                    @else
                                        <img class="img-fluid" src="{{ asset('storage/bukti/'.$order['bukti_pembayaran']) }}" alt="Bukti Pembayaran">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title">{{ $title }}</h4>
                            <p>Detail Pesanan yang sudah dilakukan Pelanggan</p>
                            <table id="datatable1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Penerima</th>
                                    <th>Nomor HP Penerima</th>
{{--                                    <th>Bukti Pembayaran</th>--}}
                                    <th>Status Pemesanan</th>
                                    <th>Informasi Pemesanan</th>
                                    <th>Nomor Resi</th>
                                    <th>Dipesan Pada</th>
                                    <th>Diupdate Pada</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>{{ $order['id'] }}</td>
                                        <td>{{ $order['nama_penerima'] }}</td>
                                        <td>{{ $order['phone_penerima'] }}</td>
{{--                                        <td>{!! !empty($order['bukti_pembayaran'])? '<a target="_blank" href="'.asset('storage/bukti/'.$order['bukti_pembayaran']).'">lihat</a>' : '<span class="badge badge-secondary">Belum Ada</span>' !!}</td>--}}
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
                                        <td>{{ $order['informasi_pemesanan'] }}</td>
                                        <td>{!! !empty($order['nomor_resi'])? $order['nomor_resi'] : '<span class="badge badge-secondary">Belum Ada</span>' !!}</td>
                                        <td>{{ substr(str_replace('T',' ',$order['created_at']),0,16) }}</td>
                                        <td>{{ substr(str_replace('T',' ',$order['updated_at']),0,16) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable2" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="text-center">
                                <tr>
                                    <th>Alamat Pengiriman</th>
                                    <th>Kurir, Service, Estimasi</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Ongkos Kirim</th>
                                    <th>Total Harga Barang</th>
                                    <th>Total Harga</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <tr>
                                    <td>{{ $order['alamat_pengiriman'] }}</td>
                                    <td>{{ $order['kurir_service_estimasi'] }}</td>
                                    <td>{{ $order['metode_pembayaran'] }}</td>
                                    <td>Rp {{ formatRupiah($order['ongkir']) }}</td>
                                    <td>Rp {{ formatRupiah($order['total_harga_barang']) }}</td>
                                    <td>Rp {{ formatRupiah($order['ongkir'] + $order['total_harga_barang']) }}</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title">Informasi Barang Pesanan</h4>
                            <table id="datatable3" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Diskon Barang</th>
                                    <th>Jumlah Pesanan</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($order['orderProduks'] as $op)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $op['nama_produk'] }}</td>
                                    <td>Rp {{ formatRupiah($op['harga_produk']) }}</td>
                                    <td>{{ $op['diskon_produk'] }} %</td>
                                    <td>{{ $op['jumlah_pesan_produk'] }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title">Informasi Pelanggan</h4>
                            <table id="datatable4" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="text-center">
                                <tr>
                                    <th>Nama Pelanggan</th>
                                    <th>Email Pelanggan</th>
                                    <th>Nomor HP Pelanggan</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <tr>
                                    <td>{{ $order['users']['nama'] }}</td>
                                    <td>{{ $order['users']['email'] }}</td>
                                    <td>{{ $order['users']['phone'] }}</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title">Informasi Admin Penanggung Jawab</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="text-center">
                                <tr>
                                    <th>Nama Admin</th>
                                    <th>Email Admin</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>{{ !empty($order['admins']['nama'])? $order['admins']['nama'] : '-' }}</td>
                                        <td>{{ !empty($order['admins']['email'])? $order['admins']['email'] : '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
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
            $('#datatable1').DataTable()
            $('#datatable2').DataTable()
            $('#datatable3').DataTable()

            let status = $('#status')
            let resi = $('#resi')
            status.change(function(){
                $('#informasi').val(status.find('option:selected').data('info'))
                status.find('option[id="opt-pilih"]').remove()
                if($(this).val() === 'delivery'){
                    resi.prop('disabled', false)
                    resi.prop('required', true)
                } else {
                    resi.val(resi.data('resi'))
                    resi.prop('disabled', true)
                    resi.prop('required', false)
                }
            })
        })
    </script>
@endsection

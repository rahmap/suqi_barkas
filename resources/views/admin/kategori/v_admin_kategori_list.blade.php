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
                            <a href="{{ route('kategori.create') }}">
                                <button class="btn btn-info float-right">Tambahkan Ketegori</button>
                            </a>

                            <h4 class="header-title">{{ $title }}</h4>
                            <p>List kategori yang sudah anda Tambahkan</p>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>


                                <tbody class="text-center">

                                @foreach($kategoris as $kat)
                                    <tr>
                                        <td>{{ $kat['id'] }}</td>
                                        <td>{{ $kat['nama'] }}</td>
                                        <td>{{ $kat['slug'] }}</td>
                                        <td>{{ $kat['is_active'] }}</td>
                                        <td>
                                            <div class="btn-group mt-1 mr-1 dropright" style="z-index: 999999;">
                                                <button type="button" class="btn btn-secondary waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-chevron-down"></i> Pilihan
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('kategori.edit',['kategori' => $kat['id']]) }}">Update Produk</a>
                                                    <div class="dropdown-divider"></div>
                                                    @if($kat['is_active'])
                                                        <a class="dropdown-item btn_nonaktifkan" data-nama="<?= $kat['nama'] ?>"
                                                           href="{{ route('kategori.aktifNonaktif', ['kategori' => $kat['id'], 'status' => 0]) }}">
                                                            Nonaktifkan Kategori</a>
                                                    @else
                                                        <a class="dropdown-item btn_aktifkan" data-nama="<?= $kat['nama'] ?>"
                                                           href="{{ route('kategori.aktifNonaktif', ['kategori' => $kat['id'], 'status' => 1]) }}">
                                                            Aktifkan Kategori</a>
                                                    @endif
                                                    <a class="dropdown-item btn_delete" data-nama="<?= $kat['nama'] ?>"
                                                       data-href="{{ route('kategori.destroy', ['kategori' => $kat['id']]) }}"
                                                       href="javascript:0;">Hapus Kategori</a>
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
            let table = $('#datatable').DataTable()
            let nama = '';
            table.on('click', '.btn_delete', function (e){
                nama = $(this).data('nama')
                e.preventDefault();
                Swal.fire({
                    title: 'Anda Yakin?',
                    text: 'Hapus Kategori ' + nama + ' ?',
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
                            confirmButtonText: 'Ya, hapus kategori!',
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

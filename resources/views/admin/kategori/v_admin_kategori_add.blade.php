@extends('layouts.admin.v_main_admin')

@section('title', $title)

@section('outCSS')

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
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Menambahkan Kategori</h4>
                            <p class="card-title-desc">Nantinya data kategori akan digunakan di attribut produk</p>

                            <form class="needs-validation" action="<?= route('kategori.store') ?>" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-12">
                                        <label for="kategoriNama">Nama Kategori</label>
                                        <input type="text" id="kategoriNama" class="form-control @error('nama') is-invalid @enderror"
                                               name="nama" minlength="3" maxlength="20" placeholder="Meja.." value="" required>
                                            @error('nama')
                                            <div class="invalid-feedback">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="container mt-3">
                                    <div class="row">
                                        <div class="col text-center">
                                            <button class="btn btn-primary" type="submit">Tambahkan Kategori</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@section('outJS')

@endsection

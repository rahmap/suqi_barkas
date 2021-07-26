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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Menambahkan Admin</h4>
                            <p class="card-title-desc">Menambahkan Admin Toko untuk mengelola Toko.</p>

                            <form class="needs-validation" action="<?= route('admin.store') ?>" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label for="nama">Nama Admin</label>
                                        <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror"
                                               name="nama" minlength="3" maxlength="20" placeholder="Sutijo.." value="{{ old('nama') }}" required>
                                            @error('nama')
                                            <div class="invalid-feedback">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label for="email">Email Admin</label>
                                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                               name="email" placeholder="admin1@gamail.com" value="{{ old('email') }}" required>
                                            @error('email')
                                            <div class="invalid-feedback">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6 mb-6">
                                        <label for="password">Password</label>
                                        <input type="text" id="password" class="form-control @error('password') is-invalid @enderror"
                                               name="password" minlength="6" maxlength="20" required>
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label for="password1">Password Konfirmasi</label>
                                        <input type="text" id="password1" class="form-control @error('password_confirmation') is-invalid @enderror"
                                               name="password_confirmation" required>
                                        @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="container mt-4">
                                    <div class="row">
                                        <div class="col text-center">
                                            <button class="btn btn-primary" type="submit">Tambahkan Admin</button>
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

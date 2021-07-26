@extends('layouts.customer.v_main_customer')

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
                            <h4 class="header-title">Perbaruhi Data Anda</h4>
                            <p class="card-title-desc">Update data diri anda sendiri.</p>

                            <form class="needs-validation" action="<?= route('update_profile_post_customer') ?>" method="post" autocomplete="off">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-12 mb-12">
                                        <label for="namaAdmin">Nama</label>
                                        <input type="text" id="namaAdmin" class="form-control @error('nama') is-invalid @enderror"
                                               name="nama" minlength="3" maxlength="20" placeholder="Nama anda.." value="{{ old('nama', $admin['nama']) }}" required>
                                            @error('nama')
                                            <div class="invalid-feedback">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-12 mt-3">
                                        <label for="emailAdmin">Email</label>
                                        <input type="email" id="emailAdmin" class="form-control @error('email') is-invalid @enderror"
                                               name="email" minlength="3" maxlength="20" placeholder="Email anda.." value="{{ old('email', $admin['email']) }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-12 mt-3">
                                        <label for="nomorAdmin">Nomor HP</label>
                                        <input type="number" id="nomorAdmin" class="form-control @error('phone') is-invalid @enderror"
                                               name="phone" minlength="3" maxlength="20" placeholder="Nomor HP anda.." value="{{ old('phone', $admin['phone']) }}" required>
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-12 mt-3">
                                        <label for="passwordAdmin">Password Baru</label>
                                        <input type="password" id="passwordAdmin" class="form-control @error('password') is-invalid @enderror"
                                               autocomplete="off"
                                               name="password" minlength="6" maxlength="30" placeholder="Kosongkan jika tidak ingin diganti..">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-12 mt-3">
                                        <label for="password1Admin">Password Baru Konfirmasi</label>
                                        <input type="password" id="password1Admin" class="form-control @error('password_confirmation') is-invalid @enderror"
                                               autocomplete="off" placeholder="Kosongkan jika tidak ingin diganti.."
                                               name="password_confirmation" minlength="6" maxlength="30">
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
                                            <button class="btn btn-primary" type="submit">Update Profile</button>
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

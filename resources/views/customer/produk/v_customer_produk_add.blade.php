@extends('layouts.customer.v_main_customer')

@section('title', $title)

@section('outCSS')
    <link href="<?= asset('dashboard/libs/summernote/summernote-bs4.css') ?>" rel="stylesheet" type="text/css" />
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
                            <h4 class="header-title">Menambahkan Produk</h4>
                            <p class="card-title-desc">Nantinya data produk akan dibeli calon Pembeli</p>

                            <form class="needs-validation" enctype="multipart/form-data" action="<?= route('produk.store') ?>" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label for="nama">Nama Produk</label>
                                        <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror"
                                               name="nama" minlength="3" maxlength="100" placeholder="Meja belajar.." value="{{ old('nama') }}" required>
                                            @error('nama')
                                            <div class="invalid-feedback">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="harga">Harga Produk</label>
                                        <input type="number" id="harga" class="form-control @error('harga') is-invalid @enderror"
                                               name="harga" min="1000" max="99999999" placeholder="1000000" value="{{ old('harga', 1000) }}" required>
                                            @error('harga')
                                            <div class="invalid-feedback">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="">Ketegori Produk</label>
                                        <select class="custom-select" name="kategori_id" required>
                                            <option selected="" value="">- Pilih -</option>
                                            @foreach($kategoris as $kat)
                                            <option value="{{ $kat['id'] }}">{{ $kat['nama'] }}</option>
                                            @endforeach
                                        </select>
                                            @error('nama')
                                            <div class="invalid-feedback">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label for="diskon">Diskon Produk <small>(%)</small></label>
                                        <input type="number" id="diskon" class="form-control @error('diskon') is-invalid @enderror"
                                               name="diskon" min="0" max="100" placeholder="0" value="{{ old('diskon', 0) }}" required>
                                        @error('diskon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="gambar">Gambar Produk</label>
                                        <input type="file" id="gambar" class="form-control @error('gambar') is-invalid @enderror"
                                               name="gambar" required>
                                        @error('gambar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="gambar_tambahan">Gambar Tambahan</label>
                                        <input type="file" id="gambar_tambahan" class="form-control @error('gambar_tambahan') is-invalid @enderror"
                                               name="gambar_tambahan" required>
                                        @error('gambar_tambahan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label for="keterangan">Keterangan Produk</label>
                                        <textarea type="text" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                                  name="keterangan" minlength="10" maxlength="200" placeholder="Meja ini terbuat dari bahan berkualitas tinggi dan.." required>{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="container mt-3">
                                    <div class="row">
                                        <div class="col text-center">
                                            <button class="btn btn-primary" type="submit">Tambahkan Produk</button>
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
    <script src="<?= asset('dashboard/libs/summernote/summernote-bs4.min.js') ?>"></script>
    <script>
        $('#keterangan').summernote(
            {
                height:300,
                minHeight:null,
                maxHeight:900,
                focus:!1,
                toolbar: [
        						['style', ['bold', 'italic', 'underline', 'clear']],
        						['fontsize', ['fontsize']],
        						['color', ['color']],
        						['para', ['ul', 'ol', 'paragraph']],
        						['height', ['height']],
        						['view', ['help']]
        				]

            }

        )
    </script>
@endsection

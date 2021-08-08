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
                                               name="nama" minlength="3" maxlength="20" placeholder="Nama anda.." value="{{ old('nama', $user['nama']) }}" required>
                                            @error('nama')
                                            <div class="invalid-feedback">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-12 mt-3">
                                        <label for="emailAdmin">Email</label>
                                        <input type="email" id="emailAdmin" class="form-control @error('email') is-invalid @enderror"
                                               name="email" minlength="3" maxlength="20" placeholder="Email anda.." value="{{ old('email', $user['email']) }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-12 mt-3">
                                        <label for="nomorAdmin">Nomor HP</label>
                                        <input type="number" id="nomorAdmin" class="form-control @error('phone') is-invalid @enderror"
                                               name="phone" minlength="3" maxlength="20" placeholder="Nomor HP anda.." value="{{ old('phone', $user['phone']) }}" required>
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
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="namaAdmin">Provinsi</label>
                                        <div class="form-group">
                                            <select name="provinsi"
                                                    class="form-control @error('provinsi') is-invalid @enderror"
                                                    required id="provinsi">
                                                @foreach($provinsis as $prov)
                                                    <option value="{{ $prov['province_id'].'_'.$prov['province'] }}"
                                                            {{ old('location', $user['provinsi'] == $prov['province'] ? 'selected' : '') }}>
                                                        {{ $prov['province'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('provinsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="namaAdmin">Kabupaten</label>
                                        <div class="form-group">
                                            <select disabled name="kabupaten"
                                                    class="form-control @error('kabupaten') is-invalid @enderror"
                                                    required id="kabupaten">
                                            </select>
                                            @error('kabupaten')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-12">
                                        <label for="namaAdmin">Alamat Lengkap</label>
                                        <textarea type="text" id="namaAdmin" class="form-control @error('location') is-invalid @enderror"
                                                  name="location"
                                                  minlength="10" maxlength="150"
                                                  placeholder="Dusun RT/RW/No Rumah, Kelurahan, Kecamatan" required>{{ old('location', $user['location'] ?? '') }}</textarea>
                                        @error('location')
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
    <script>
      $(document).ready(function (){
        let provinsi = $('#provinsi')
        let kabupaten = $('#kabupaten')
        let currentKabupaten = '{{ $user['kabupaten'] }}'
        provinsi.change(function (){
          resetKabupaten()
          kabupaten.prop('disabled', true)
          getKabupaten()
          $(`#provinsi option[value='']`).remove();
        });

        function getKabupaten()
        {
          let arrVal = provinsi.val().split('_')
          console.log(arrVal)
          $.ajax({
            url : `{{ url('/get-kabupaten/') }}/${arrVal[0]}`,
            type: 'GET',
            success: function(response){
              response.results.map(r => {
                if(r.city_name === currentKabupaten){
                  kabupaten
                    .append(`<option value="${r.city_id}_${r.city_name}" selected>${r.city_name}</option>`);
                } else {
                  kabupaten
                    .append(`<option value="${r.city_id}_${r.city_name}">${r.city_name}</option>`);
                }
              })
            },
            error: function(){
              Swal.fire({
                title : 'Gagal mengambil data Kabupaten!'
              })
            },
            complete: function(){
              kabupaten.prop('disabled', false)
              // kabupaten.val(kabupaten.find('option:first').val());
              console.log(kabupaten.val())
            }
          })
        }

        getKabupaten()

        function resetKabupaten()
        {
          kabupaten
            .find('option')
            .remove()
            .end()
        }
      })
    </script>
@endsection

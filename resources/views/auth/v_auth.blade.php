@extends('layouts/v_main_home')

@section('title', $title)

@section('outCSS')
<!-- SPECIFIC CSS -->
<link href="<?= asset('home/css/account.css') ?>" rel="stylesheet">

<style>
    /* already defined in bootstrap4 */
    .text-xs-center {
        text-align: center;
    }

    .g-recaptcha {
        display: inline-block;
    }
</style>
@endsection

@section('contents')
<main class="bg_gray">

    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?= route('home') ?>">Home</a></li>
                    <li><a href="<?= route('auth') ?>">Auth</a></li>
                </ul>
                <h1>Masuk Atau Buat Akun Baru</h1>
            </div>
            <!--			<h1>Buat Akan Baru</h1>-->
        </div>
        <!-- /page_header -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-8">
                <div class="box_account">
                    <h3 class="client">Sudah Punya Akun</h3>
                    <div class="form_container">
                        <?= (session()->has('messageLogin'))? session()->messageLogin : '' ?>
                        <form action="<?= route('auth_login') ?>" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control @error('email_login') is-invalid @enderror"
                                       value="<?= old('email_login'); ?>" name="email_login" id="email_login" placeholder="Email*" required>
                                @error('email_login')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control @error('password_login') is-invalid @enderror"
                                       name="password_login" id="password_login_in"
                                       required minlength="6"
                                       placeholder="Password*">
                                @error('password_login')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="text-center" style="margin-top: 10px;"><input type="submit" value="Masuk" class="btn_1 full-width"></div>
                        </form>
                    </div>
                    <!-- /form_container -->
                </div>
                <!-- /box_account -->

                <!-- /row -->
            </div>
            <div class="col-xl-6 col-lg-6 col-md-8">
                <div class="box_account">
                    <h3 class="new_client">Buat Akun Baru</h3> <small class="float-right pt-2" style="color:red;">* Wajib Diisi</small>
                    <form action="<?= route('auth_register') ?>" method="post">
                        @csrf
                        <div class="form_container">
                            <?= (session()->has('messageRegister'))? session()->messageRegister : '' ?>
                            <div class="form-group">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                       name="nama" value="<?= old('nama'); ?>"
                                       placeholder="*Nama" required minlength="5">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="private box">
                                <div class="row no-gutters">
                                    <div class="col-6 pr-1">
                                        <div class="form-group">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="<?= old('email'); ?>"
                                                   placeholder="*Email" required>
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 pl-1">
                                        <div class="form-group">
                                            <input type="number" name="phone"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   value="<?= old('phone'); ?>"
                                                   placeholder="*Nomor Telepon Ex : 6289xxxxxx" required minlength="9" maxlength="20">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->

                            </div>
                            <div class="private box">
                                <div class="row no-gutters">
                                    <div class="col-6 pr-1">
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   placeholder="*Password" required minlength="6">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 pl-1">
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation"
                                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                                   placeholder="*Password Konfirmasi" required minlength="6">
                                            @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /private -->
                            <div class="private box">
                                <div class="row no-gutters">
                                    <div class="col-6 pr-1">
                                        <div class="form-group">
                                            <select name="provinsi"
                                                   class="form-control @error('provinsi') is-invalid @enderror"
                                                   required id="provinsi">
                                                <option value=""> - Pilih Provinsi -</option>
                                                @foreach($provinsis as $prov)
                                                    <option value="{{ $prov['province_id'].'_'.$prov['province'] }}">{{ $prov['province'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('provinsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 pl-1">
                                        <div class="form-group">
                                            <select disabled name="kabupaten"
                                                    class="form-control @error('kabupaten') is-invalid @enderror"
                                                    required id="kabupaten">
                                                <option value="" selected></option>
                                            </select>
                                            @error('kabupaten')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /private -->
                            <div class="form-group">
                                <textarea type="text" class="form-control @error('location') is-invalid @enderror"
                                    name="location"
                                    placeholder="*Dusun RT/RW/No Rumah, Kelurahan, Kecamatan"
                                          required minlength="10" maxlength="150"><?= old('location'); ?></textarea>
                                @error('location')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <hr>
                            <div class="text-center"><input type="submit" value="Buat Akun" class="btn_1 full-width"></div>
                        </div>
                    </form>
                    <!-- /form_container -->
                </div>
                <!-- /box_account -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
<!--/main-->
@endsection

@section('outJS')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.2/js/umd/util.js"></script>

<script>
    $(document).ready(function (){
        let provinsi = $('#provinsi')
        let kabupaten = $('#kabupaten')
        provinsi.change(function (){
            resetKabupaten()
            kabupaten.prop('disabled', true)
            getKabupaten()
            $(`#provinsi option[value='']`).remove();
        });

        function getKabupaten()
        {
            let arrVal = provinsi.val().split('_')
            $.ajax({
                url : `{{ url('/get-kabupaten/') }}/${arrVal[0]}`,
                type: 'GET',
                success: function(response){
                    response.results.map(r => {
                        kabupaten
                            .append(`<option value="${r.city_id}_${r.city_name}" >${r.city_name}</option>`);
                    })
                },
                error: function(){
                    Swal.fire({
                        title : 'Gagal mengambil data Kabupaten!'
                    })
                },
                complete: function(){
                    kabupaten.prop('disabled', false)
                    kabupaten.val(kabupaten.find('option:first').val());
                    console.log(kabupaten.val())
                }
            })
        }

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



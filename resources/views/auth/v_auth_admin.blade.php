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
                <h1>Masuk</h1>
            </div>
            <!--			<h1>Buat Akan Baru</h1>-->
        </div>
        <!-- /page_header -->
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10">
                <div class="box_account">
                    <h3 class="client">Sudah Punya Akun</h3>
                    <div class="form_container">
                        <?= (session()->has('messageLogin'))? session()->messageLogin : '' ?>
                        <form action="<?= route('auth_login_admin') ?>" method="post">
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
        $('input[name="client_type"]').on("click", function() {
            let inputValue = $(this).attr("value");
            let targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });

        let checkEmailForgot = "<?= session()->has('messageForgetEmail') ?>";
        if(checkEmailForgot){
            $('#forgot').click()
        }

        $('#btnKembaliForgot').click(function (){
            $('#forgot_pw').hide()
        })
    })
</script>
@endsection



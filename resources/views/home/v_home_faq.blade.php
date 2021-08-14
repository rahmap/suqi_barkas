@extends('layouts/v_main_home')

@section('title', $title)

@section('outCSS')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('home/css/faq.css') }}" rel="stylesheet">

@endsection

@section('contents')
    <main class="bg_gray">
        <div class="bg_white">
            <div class="container margin_90_65">
                <div class="main_title">
                    <h2>{{ $title }}</h2>
                    <br>
{{--                    <p>{{ $title }} pada Toko {{ getenv('APP_NAME') }}</p>--}}
                    <p align="justify">
                        Pengguna dalam hal ini, Mitra Bar-Bek-Ku patuh pada Kebijakan Privasi dan Syarat dan Ketentuan yang tertulis di bawah ini. Pengguna disarankan membaca dengan seksama karena dapat berdampak kepada hak dan kewajiban Pengguna secara hukum.
                        <br>
                        Dengan mendaftar dan/atau menggunakan Mitra Barbekku, maka Pengguna dianggap telah membaca, mengerti, memahami dan menyetujui semua isi dalam Syarat dan Ketentuan ini. Syarat dan Ketentuan ini merupakan bentuk kesepakatan yang dituangkan dalam sebuah perjanjian yang sah antara Pengguna dengan Mitra Barbekku. Jika Pengguna tidak menyetujui salah satu, sebagian, atau seluruh isi Syarat dan Ketentuan, maka Pengguna tidak diperkenankan menggunakan layanan di
                        <a href="https://suqi.belisc.com">suqi.belisc.com</a>.

                    </p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-wallet"></i>
                            <h3>Definisi</h3>
                            <p>Barbekku adalah kegiatan usaha jasa web portal www.suqi.belisc.com yang berisi seperti situs pencarian Barang Fisik yang dijual oleh Partner.</p>

                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-user"></i>
                            <h3>Umum</h3>
                            <p>Barbekku hanya dapat digunakan oleh Pengguna yang telah mendaftarkan diri, menyetujui Syarat dan Ketentuan ini serta yang sudah diverifikasi sesuai kebijakan dari Barbekku.</p>
                        </a>
                    </div>
                </div>
                <!-- /row -->

                <div class="row">
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-help"></i>
                            <h3>Akun, Password, dan Keamanan</h3>
                            <p>Barbekku memiliki kewenangan untuk melakukan tindakan yang perlu atas setiap dugaan pelanggaran atau pelanggaran Syarat dan Ketentuan ini dan/atau hukum yang berlaku, yakni tindakan berupa suspensi akun, dan/atau penghapusan akun Partner Barbekku.</p>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-truck"></i>
                            <h3>Transaksi</h3>
                            <p>Pengguna memahami sepenuhnya dan menyetujui bahwa segala transaksi yang dilakukan antara Pengguna dan Partner hanya melalui Kontak person dan/atau tanpa sepengetahuan Barbekku (melalui fasilitas/jaringan pribadi, pengiriman pesan, pengaturan transaksi khusus diluar Situs atau upaya lainnya) adalah merupakan tanggung jawab pribadi dari Pengguna.</p>
                        </a>
                    </div>
                </div>
                <!-- /row -->

                <div class="row">
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-eraser"></i>
                            <h3>Harga</h3>
                            <p>Harga Barang Fisik yang terdapat dalam Situs adalah harga yang ditetapkan oleh Partner.</p>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-comments"></i>
                            <h3>Pembaruan</h3>
                            <p>Syarat dan Ketentuan ini mungkin diubah dan/atau diperbaharui dari waktu ke waktu tanpa pemberitahuan sebelumnya. Barbekku menyarankan agar Pengguna maupun Partner membaca secara seksama dan memeriksa halaman Syarat dan ketentuan ini dari waktu ke waktu untuk mengetahui perubahan apapun.</p>
                        </a>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_white -->
    </main>
    <!--/main-->
@endsection

@section('outJS')

@endsection



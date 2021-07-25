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
                    <p>{{ $title }} pada Toko {{ getenv('APP_NAME') }}</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-wallet"></i>
                            <h3>Payments</h3>
                            <p>Eu qui mundi lucilius petentium, mea amet libris prodesset in, ei unum delectus vituperata eum. Ne usu omittam menandri.</p>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-user"></i>
                            <h3>Account</h3>
                            <p>Eu qui mundi lucilius petentium, mea amet libris prodesset in, ei unum delectus vituperata eum. Ne usu omittam menandri.</p>
                        </a>
                    </div>
                </div>
                <!-- /row -->

                <div class="row">
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-help"></i>
                            <h3>General help</h3>
                            <p>Eu qui mundi lucilius petentium, mea amet libris prodesset in, ei unum delectus vituperata eum. Ne usu omittam menandri.</p>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-truck"></i>
                            <h3>Shipping</h3>
                            <p>Eu qui mundi lucilius petentium, mea amet libris prodesset in, ei unum delectus vituperata eum. Ne usu omittam menandri.</p>
                        </a>
                    </div>
                </div>
                <!-- /row -->

                <div class="row">
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-eraser"></i>
                            <h3>Refunds</h3>
                            <p>Eu qui mundi lucilius petentium, mea amet libris prodesset in, ei unum delectus vituperata eum. Ne usu omittam menandri.</p>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="box_topic_2" href="#0">
                            <i class="ti-comments"></i>
                            <h3>Reviews</h3>
                            <p>Eu qui mundi lucilius petentium, mea amet libris prodesset in, ei unum delectus vituperata eum. Ne usu omittam menandri.</p>
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



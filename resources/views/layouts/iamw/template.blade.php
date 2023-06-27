@php
    date_default_timezone_set('Asia/Jakarta');
@endphp

<!DOCTYPE html>
{{--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
--}}
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <title>@yield('title') | IAMW WEC - MADIUN</title>

    @include('layouts.iamw.sc_head')
</head>

<body>

    <!-- Content Start -->

    @include('layouts.iamw.navbar')
    {{--  Header Start  --}}
    <div class="hero-wrap img" style="background-image: url({{ asset('img/iamw/bg_1.jpg') }});">
        <div class="overlay">
            <div class="bg-secondary rounded">
                @if (session('text'))
                    <div class="alert alert-{{ session('type') }} text-center" style="width: 300px;" role="alert">
                        {{ session('text') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="row d-md-flex no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-10 d-flex align-items-center ftco-animate">
                    <div class="text text-center pt-5 mt-md-5">
                        <h1 class="mb-5">Selamat Datang di IAMW - Ikatan Alumni Mahasiswa Wearnes</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  Header End  --}}

    <!-- Content Start -->
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </section>
    <!-- Content End -->

    <!-- Footer Start -->
    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-3 grid_4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Tentang Kami</h2>
                        <p>"IAMW adalah bursa kerja khusus Wearnes Education Center dan Royal Ocean
                            International.
                            Membantu mahasiswa dan alumni dalam mencari pekerjaan."</p>
                    </div>
                </div>
                <div class="col-md-3 grid_4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">link terkait</h2>
                        <ul class="footer_list">
                            <li><a href="http://wearneseducation.com">- WEARNES EDUCATION CENTER </a></li>
                            <li><a href="http://royaloceancollege.com">- ROYAL OCEAN INTERNATIONAL</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-3 grid_4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">hubungi kami</h2>
                        <address>
                            <span>Jl. Thamrin No.35A, Klegen, Kec. Kartoharjo, Kota Madiun, Jawa Timur 63117</span>
                            <br>
                            <abbr>Telepon : </abbr> (0351) 483778
                            <br>
                            <!--<abbr>Email 1 : </abbr> <a href="#">admin@wearneseducation.com</a><br>-->
                            <!--<abbr>Email 2 : </abbr> <a href="#">admin@royaloceancollege.com</a>-->
                        </address>
                    </div>
                </div>
                <div class="col-md-3 grid_4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Jam Kerja</h2>
                        <table class="table_working_hours">
                            <tbody>
                                <tr class="opened_1">
                                    <td class="day_label">Senin</td>
                                    <td class="day_value">08:00 am - 6.00 pm</td>
                                </tr>
                                <tr class="opened_1">
                                    <td class="day_label">Selasa</td>
                                    <td class="day_value">08:00 am - 6.00 pm</td>
                                </tr>
                                <tr class="opened_1">
                                    <td class="day_label">Rabu</td>
                                    <td class="day_value">08:00 am - 6.00 pm</td>
                                </tr>
                                <tr class="opened_1">
                                    <td class="day_label">Kamis</td>
                                    <td class="day_value">08:00 am - 6.00 pm</td>
                                </tr>
                                <tr class="opened_1">
                                    <td class="day_label">Jumat</td>
                                    <td class="day_value">08:00 am - 6.00 pm</td>
                                </tr>
                                <tr class="closed">
                                    <td class="day_label">Sabtu</td>
                                    <td class="day_value"><span>08:00 am - 5.00 pm</span></td>
                                </tr>
                                <tr class="closed">
                                    <td class="day_label">Minggu</td>
                                    <td class="day_value"><span>08:00 am - 0.00 pm</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        Copyright &copy;
                        <?= date('F Y') ?> All rights reserved | This template
                        is made with <i class="fas fa-heart"></i> IAMW | iRzellA <a href="http://wearneseducation.com/"
                            title="wearneseducation.com" target="_blank">wearneseducation.com</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>
    <!-- Footer End -->
    @include('layouts.iamw.sc_footer')

</body>

</html>

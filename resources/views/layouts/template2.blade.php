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
    <title>@yield('title') | BOPI UNIVERSITY - MADIUN</title>

    @include('layouts.sc_head')
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @include('layouts.sidebar')

        <!-- Content Start -->
        <div class="content">
            @include('layouts.navbar')

            <!-- Content Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    @yield('content')
                </div>
            </div>
            <!-- Content End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4 mt-auto">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="https://www.linkedin.com/in/ahmaddfn/" target="_blank">IAMW</a>, iRzella
                            - All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://github.com/AhmadDFN" target="_blank">iRzellA</a>
                            <br>Distributed By: <a href="https://www.linkedin.com/in/ahmaddfn/" target="_blank">Ahmad
                                Dany FN</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
                class="bi bi-arrow-up-short"></i></a>
    </div>
    @if (session('notification'))
        <div class="notification-glass bg-{{ session('notification.type') }}" id="notification">
            <div class="notification-content">
                {{ session('notification.text') }}
            </div>
        </div>
    @endif
    @include('layouts.sc_footer')

</body>

</html>

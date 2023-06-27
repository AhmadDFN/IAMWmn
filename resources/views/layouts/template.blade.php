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
        @if (session('mess'))
            <div class="col-sm-4">
                <div class="d-flex align-items-center justify-content-between p-4">
                    {{-- Notif --}}

                    <div class="alert alert-{{ session('type') }} text-center" style="width: 300px;" role="alert">
                        {{ session('mess') }}
                    </div>

                </div>
            </div>
        @endif
        <!-- Content Start -->
        <div class="content">
            @include('layouts.navbar')
            {{--  Header Start  --}}
            <div class="content-header">
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-0 bg-secondary">
                        <div class="col-sm-8">
                            <div class="d-flex align-items-center justify-content-between p-4">
                                <h3 class="m-0">@yield('page-title')</h3>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center justify-content-end p-4">
                                <ol class="breadcrumb float-lg-right m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  Header End  --}}

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
                            &copy; <a href="https://www.instagram.com/wearnesmadiun/" target="_blank">IAMW</a>, iRzella
                            - All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
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
    @include('layouts.sc_footer')

</body>

</html>

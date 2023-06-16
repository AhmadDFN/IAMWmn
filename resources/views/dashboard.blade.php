@extends('layouts.template2')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Small boxes (Stat box) -->
    {{-- Notif --}}
    @if (session('text'))
        <div class="alert alert-{{ session('type') }}" role="alert">
            {{ session('text') }}
        </div>
    @endif
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total User</p>
                        <h1 class="mb-0">{{ @$users->count() }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Mahasiswa</p>
                        <h1 class="mb-0">{{ @$mahasiswas->count() }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Perusahaan</p>
                        <h1 class="mb-0">{{ @$perusahaans->count() }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Loker</p>
                        <h1 class="mb-0">{{ @$lokers->count() }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-6">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Mahasiswa sekarang</p>
                        <h1 class="mb-0">{{ @$mhsact->count() }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">loker Aktif</p>
                        <h1 class="mb-0">{{ @$lamaract->count() }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    <!-- Sales Chart Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="mb-0">Worldwide Sales</h1>
                        <a href="#">Show All</a>
                    </div>
                    <canvas id="worldwide-sales"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="mb-0">Salse & Revenue</h1>
                        <a href="#">Show All</a>
                    </div>
                    <canvas id="salse-revenue"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Sales Chart End -->
@endsection

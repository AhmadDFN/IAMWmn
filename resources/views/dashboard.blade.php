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
                        <p class="mb-2">Mahasiswa Tahunini</p>
                        <h1 class="mb-0">{{ @$mhsact->count() }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">loker Aktif</p>
                        <h1 class="mb-0">{{ @$lokeract->count() }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Record Pelamar Terbaru</h6>
                <a href="{{ url('lamar') }}">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Lamaran</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Perusahaan</th>
                            <th scope="col">Tanggal - Jam</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lamars as $lamar)
                            <tr>
                                <td>{{ @$lamar->lamar_nm }}</td>
                                <td>{{ @$lamar->lamar_NIM }}</td>
                                <td>{{ @$lamar->mhs_nm }}</td>
                                <td>{{ @$lamar->perusahaan_nm }}</td>
                                <td>{{ @$lamar->created_at }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ url('lamar/' . @$lamar->id) }}">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Lowongan Terbaru</h6>
                <a href="{{ url('loker') }}">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Loker KD</th>
                            <th scope="col">Nama Loker</th>
                            {{--  <th scope="col" width="30%">Keterangan Loker</th>  --}}
                            <th scope="col">Loker Exp</th>
                            <th scope="col">Jurusan Loker</th>
                            <th scope="col">Stats</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lokers as $loker)
                            <tr>
                                <td>{{ @$loker->loker_kd }}</td>
                                <td>{{ @$loker->loker_nm }}</td>
                                {{--  <td>{{ $loker->loker_ket }}</td>  --}}
                                <td>{{ @$loker->loker_exp }}</td>
                                <td>
                                    @foreach (@$loker->jurusans as $jurusan)
                                        {!! '-' . @$jurusan->jurusan_nm . '</br>' !!}
                                    @endforeach
                                </td>
                                <td>{{ @$loker->loker_status }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ url('loker/' . @$loker->id) }}">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection

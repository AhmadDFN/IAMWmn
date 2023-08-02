@extends('layouts.perusahaan.template2')

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
            <div class="col-sm-6 col-xl-6">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Pelamar</p>
                        <h1 class="mb-0">{{ @$lamars->jumlah_pelamar }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Lowongan</p>
                        <h1 class="mb-0">{{ @$lokers->count() }}</h1>
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
                <h6 class="mb-0">Lowongan Kerja</h6>
                <a href="{{ url('perusahaan/loker') }}">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">Nama Loker</th>
                            <th scope="col">Jurusan Loker</th>
                            <th scope="col">Deadline</th>
                            <th scope="col" width="8%">Pelamar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lokers as $loker)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$loker->loker_nm }}</td>
                                <td>
                                    @foreach (@$loker->jurusans as $jurusan)
                                        {!! '-' . @$jurusan->jurusan_kda . '</br>' !!}
                                    @endforeach
                                </td>
                                <td>{{ @$loker->loker_exp }}</td>
                                <td class="text-center">
                                    <a href={{ url('perusahaan/lamar/' . @$loker->id . '/detail') }}>
                                        {{ $loker->pelamar->count() }}
                                    </a>
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
                <h6 class="mb-0">Pelamar</h6>
                <a href="{{ url('perusahaan/lamar') }}">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">Lamaran</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Perusahaan</th>
                            <th scope="col">Tanggal - Jam</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lamars->lamar as $lamar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$lamar->lamar_nm }}</td>
                                <td>{{ @$lamar->lamar_NIM }}</td>
                                <td> <a href={{ url('perusahaan/mahasiswa/' . @$lamar->mhs_id . '/berkas/tampil') }}>
                                        {{ @$lamar->mhs_nm }}
                                    </a>
                                </td>
                                <td>{{ @$lamar->perusahaan_nm }}</td>
                                <td>{{ @$lamar->created_at }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ url('perusahaan/lamar/' . @$lamar->lamar_id_loker . '/detail') }}">Detail</a>
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

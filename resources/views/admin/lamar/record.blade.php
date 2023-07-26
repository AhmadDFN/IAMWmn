@extends('layouts.template')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')

    <div class="col-12">
        <div class="bg-secondary rounded h-100 p-4">
            <div class="row">
                <div class="col-8">
                    <h5 class="mb-4 text-primary">@yield('title')</h5>
                </div>
                <div class="card-tools text-right mb-2 mr-2 col-4 align-items-center justify-content-end d-flex">
                    {{--  <a href="{{ url($routes->add) }}" class="btn btn-outline-primary btn-sm">Tambah {{ $data->title }}</a>  --}}
                </div>
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
                            <th scope="col">Status</th>
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
                                <td
                                    class="{{ ($lamar->lamar_status == 0
                                            ? 'bg-warning text-black'
                                            : $lamar->lamar_status == 0)
                                        ? 'bg-warning text-black'
                                        : ($lamar->lamar_status == 1
                                            ? 'bg-primary text-white'
                                            : ($lamar->lamar_status == 2
                                                ? 'bg-danger text-white'
                                                : ($lamar->lamar_status == 6
                                                    ? 'bg-danger text-white'
                                                    : 'bg-success text-white'))) }}">
                                    {{ ($lamar->lamar_status == 0
                                            ? 'Menunggu'
                                            : $lamar->lamar_status == 0)
                                        ? 'Menunggu'
                                        : ($lamar->lamar_status == 1
                                            ? 'Interview'
                                            : (($lamar->lamar_status == 2
                                                    ? 'Ditolak'
                                                    : $lamar->lamar_status == 6)
                                                ? 'Ditolak'
                                                : 'Diterima')) }}
                                </td>
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
@endsection

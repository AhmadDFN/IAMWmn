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
                <table id="dtTable" class="table compact table-dark dtTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Lowongan</th>
                            <th scope="col">Perusahaan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Sistem Kerja</th>
                            <th scope="col" width="12%">Jumlah Pelamar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lamars as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href={{ url('loker/' . $item->id) }}>
                                        {{ $item->loker_nm }}
                                    </a>
                                </td>
                                <td>{{ $item->perusahaan_nm }}</td>
                                <td>{{ $item->perusahaan_kota }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->loker_exp)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </td>
                                <td>{{ $item->jenis_loker_nm }}</td>
                                <td class="text-center">
                                    <a href={{ url('lamar/' . @$item->id . '/detail') }}>
                                        {{ $item->jumlah_pelamar }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

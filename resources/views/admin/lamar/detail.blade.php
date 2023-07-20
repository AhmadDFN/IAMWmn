@extends('layouts.template')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')
    <div class="col-12 container-fluid px-4">
        {{-- Detail Lowongan --}}
        <div class="bg-secondary card card-dark row">
            <div class="bg-dark card-header">
                <h4 class="card-title">{{ $loker->loker_nm }}</h4>
            </div>
            <div class="bg-secondary card-body">
                <div class="row">
                    <div class="col-md-2 col-lg-2">
                        @if ($perusahaan->perusahaan_foto != '')
                            <img class="thumb-menu" src="{{ asset($perusahaan->perusahaan_foto) }}"
                                alt="{{ $perusahaan->perusahaan_nm }}">
                        @else
                            <img class="thumb-menu" src="{{ asset('images/no-image.jpg') }}"
                                alt="{{ $perusahaan->perusahaan_nm }}">
                        @endif
                    </div>
                    <div class="col-md-10 col-lg-10">
                        <h2>{{ $perusahaan->perusahaan_nm }}</h2>
                        <p class="mb-0">{{ $perusahaan->perusahaan_alamat }}</p>
                        <p class="mb-0">Posisi : {{ $loker->posisi }}</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Lowongan --}}

        {{-- Pelamar --}}
        <div class="bg-secondary card card-dark mt-3 row">
            <div class="bg-dark card-header">
                <h4 class="card-title">KANDIDAT</h4>
            </div>
            <div class="bg-secondary card-body">
                <table class="dtTable table table-bordered table-hover">
                    @if ($lamars->count() > 0)
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Lamar</th>
                                <th>Berkas</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lamars as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mhs_nm }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->lamar_tgl_daftar)->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </td>
                                    <td><a target="_blank" href="{{ url('mahasiswa/' . @$item->id_mahasiswa) }}">Mahasiswa
                                    </td>
                                    </a>
                                    <td
                                        class=" {{ $item->lamar_status == 0
                                            ? 'bg-warning'
                                            : ($item->lamar_status == 1
                                                ? 'bg-primary'
                                                : ($item->lamar_status == 2
                                                    ? 'bg-danger'
                                                    : 'bg-success')) }}">
                                        {{ $item->lamar_status == 0
                                            ? 'Menunggu'
                                            : ($item->lamar_status == 1
                                                ? 'Interview'
                                                : ($item->lamar_status == 2
                                                    ? 'Ditolak'
                                                    : 'Diterima')) }}
                                    </td>
                                    <td>
                                        @if ($item->lamar_status == 0)
                                            <a class="btn btn-xs btn-success"
                                                href="{{ url('lamar/' . @$item->id . '/status/' . 1) }}"><i
                                                    class="fas fa-check-circle"></i></a>
                                            <a class="btn btn-xs btn-danger ml-2"
                                                href="{{ url('lamar/' . @$item->id . '/status/' . 2) }}"><i
                                                    class="fas fa-times-circle"></i></a>
                                        @endif
                                        @if ($item->lamar_status == 1)
                                            <a class="btn btn-xs btn-success"
                                                href="{{ url('lamar/' . @$item->id . '/status/' . 3) }}"><i
                                                    class="fas fa-check"></i> TERIMA</a>
                                            <a class="btn btn-xs btn-danger ml-2"
                                                href="{{ url('lamar/' . @$item->id . '/status/' . 2) }}"><i
                                                    class="fas fa-times-circle"></i> TOLAK</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center pt-3"><b>
                                        <p>- BELUM ADA PELAMAR -</p>
                                    </b></td>
                            </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{-- End Pelamar --}}
    </div>
@endsection

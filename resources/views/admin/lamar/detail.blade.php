@extends('layouts.template')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')
    {{-- Detail Lowongan --}}
    <div class="card card-dark">
        <div class="card-header">
            <h4 class="card-title">Lowongan</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 col-lg-2">
                    @if ($rsLowongan->foto != '')
                        <img class="thumb-logo" src="{{ asset($rsLowongan->foto) }}" alt="{{ $rsLowongan->mn_nama }}">
                    @else
                        <img class="thumb-logo" src="{{ asset('images/no-image.jpg') }}" alt="{{ $rsLowongan->mn_nama }}">
                    @endif
                </div>
                <div class="col-md-10 col-lg-10">
                    <h2>{{ $rsLowongan->nama_low }}</h2>
                    <p class="mb-0">{{ $rsLowongan->perusahaan_low }}</p>
                    <p class="mb-0">{{ $rsLowongan->alamat_low }}</p>
                    <p class="mb-0">Posisi : {{ $rsLowongan->posisi }}</p>
                </div>
            </div>
        </div>
    </div>
    {{-- End Lowongan --}}

    {{-- Pelamar --}}
    <div class="card card-dark">
        <div class="card-header">
            <h4 class="card-title">KANDIDAT</h4>
        </div>
        <div class="card-body">
            <table class="dtTable table table-bordered table-hover">
                @if ($dtLamar->count() > 0)
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Lamar</th>
                            <th>Resume</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtLamar as $pelamar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pelamar->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($pelamar->tgl_lamar)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </td>
                                <td><a href="{{ asset($pelamar->filepath . $pelamar->filename) }}">RESUME</td></a>
                                <td
                                    class=" {{ $pelamar->status == 0
                                        ? 'bg-warning'
                                        : ($pelamar->status == 1
                                            ? 'bg-primary'
                                            : ($pelamar->status == 2
                                                ? 'bg-danger'
                                                : 'bg-success')) }}">
                                    {{ $pelamar->status == 0
                                        ? 'Menunggu'
                                        : ($pelamar->status == 1
                                            ? 'Interview'
                                            : ($pelamar->status == 2
                                                ? 'Ditolak'
                                                : 'Diterima')) }}
                                </td>
                                <td>
                                    @if ($pelamar->status == 0)
                                        <a class="btn btn-xs btn-success"
                                            href="{{ route('update_status_lamar', ['id_lamar' => $pelamar->id, 'status' => 1]) }}"><i
                                                class="fas fa-check-circle"></i></a>
                                        <a class="btn btn-xs btn-danger ml-2"
                                            href="{{ route('update_status_lamar', ['id_lamar' => $pelamar->id, 'status' => 2]) }}"><i
                                                class="fas fa-times-circle"></i></a>
                                    @endif
                                    @if ($pelamar->status == 1)
                                        <a class="btn btn-xs btn-success"
                                            href="{{ route('update_status_lamar', ['id_lamar' => $pelamar->id, 'status' => 3]) }}"><i
                                                class="fas fa-check"></i> TERIMA</a>
                                        <a class="btn btn-xs btn-danger ml-2"
                                            href="{{ route('update_status_lamar', ['id_lamar' => $pelamar->id, 'status' => 2]) }}"><i
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
@endsection

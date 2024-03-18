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
                    <div class="col-md-3 col-lg-3">
                        @if ($perusahaan->perusahaan_foto != '')
                            <img style="width: 100%; height:100%;" class="thumb-menu"
                                src="{{ asset($perusahaan->perusahaan_foto) }}" alt="{{ $perusahaan->perusahaan_nm }}">
                        @else
                            <img style="width: 100%; height:100%;" class="thumb-menu"
                                src="{{ asset('images/no-image.jpg') }}" alt="{{ $perusahaan->perusahaan_nm }}">
                        @endif
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <h2>Data Perusahaan</h2>
                        <p class="mb-0">{{ $perusahaan->perusahaan_nm }}</p>
                        <p class="mb-0">{{ $perusahaan->perusahaan_alamat }}</p>
                        <p class="mb-0">{{ $perusahaan->perusahaan_kota }}</p>
                        <p class="mb-0">{{ $perusahaan->perusahaan_notelp }}</p>
                        <p class="mb-0 text-white">Contact Person :</p>
                        <p class="mb-0">{{ $perusahaan->perusahaan_cp_nama }}</p>
                        <p class="mb-0">{{ $perusahaan->perusahaan_cp_notelp }}</p>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <h2>Data Loker</h2>
                        <p class="mb-0">Exp Date Lowongan :</p>
                        <p class="mb-0">
                            {{ \Carbon\Carbon::parse($loker->loker_exp)->locale('id')->isoFormat('D MMMM YYYY') }}</p>
                        <p class="mb-0"> Jurusan : <br>
                            @foreach ($loker->jurusans as $item)
                                {{ $item->jurusan_kda . ' , ' }}
                            @endforeach
                        </p>
                        <p class="mb-0">Sistem Kerja : <br>{{ $loker->jenisloker->jenis_loker_nm }}</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Lowongan --}}

        {{-- Pelamar --}}
        <div class="bg-secondary card card-dark mt-3 row">
            <div class="bg-dark card-header overflow-hidden">
                <div class="row gx-5">
                    <div class="col">
                        <h4 class="card-title">KANDIDAT</h4>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary float-end ms-2"
                            href="{{ url('lamar/' . @$loker->id . '/detail/denied') }}" role="button"><i
                                class="fas fa-times-circle"></i> Tolak
                            Semua</a>
                        <a class="btn btn-success float-end" href="{{ url('lamar/' . @$loker->id . '/detail/accept') }}"
                            role="button"><i class="fas fa-check-circle"></i> Terima
                            Semua</a>
                    </div>
                </div>
            </div>
            <div class="bg-secondary card-body">
                <table class="dtTable table table-bordered table-hover">
                    @if ($lamars->count() > 0)
                        <thead>
                            <tr class="text-white-50">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal Lamar</th>
                                <th scope="col">Berkas</th>
                                <th scope="col">Status</th>
                                <th scope="col" width="19.5%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lamars as $item)
                                <tr class="text-white">
                                    <td class="text-white-50">{{ $loop->iteration }}</td>
                                    <td>{{ $item->mhs_nm }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->lamar_tgl_daftar)->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </td>
                                    <td><a target="_blank"
                                            href="{{ url('mahasiswa/' . @$item->id_mahasiswa . '/berkas/tampil') }}">Berkas
                                    </td>
                                    </a>
                                    <td
                                        class="{{ $item->lamar_status == 0
                                            ? 'bg-warning text-black'
                                            : ($item->lamar_status == 5
                                                ? 'bg-success text-white'
                                                : 'bg-danger text-white') }}">
                                        {{ $item->lamar_status == 0 ? 'Menunggu' : ($item->lamar_status == 5 ? 'Data Diterima' : 'Data Ditolak') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->lamar_status == 0)
                                            <a class="btn btn-xs btn-success"
                                                href="{{ url('lamar/' . @$item->id . '/status/' . 5) }}"><i
                                                    class="fas fa-check-circle"></i> TERIMA</a>
                                            <a class="btn btn-xs btn-danger ml-2"
                                                href="{{ url('lamar/' . @$item->id . '/status/' . 6) }}"><i
                                                    class="fas fa-times-circle"></i> TOLAK</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <tr>
                            <td colspan="4" class="text-center pt-3"><b>
                                    <p>- BELUM ADA PELAMAR -</p>
                                </b>
                            </td>
                        </tr>
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
        {{-- End Pelamar --}}
    </div>
@endsection

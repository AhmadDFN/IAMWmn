@extends('layouts.template')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')
    <div class="col-12 container-fluid px-4">
        <div class="bg-secondary rounded h-100 p-4 row">
            <div class="bg-secondary rounded">
                @if (session('text'))
                    <div class="alert alert-{{ session('type') }} text-center" style="width: 300px;" role="alert">
                        {{ session('text') }}
                    </div>
                @endif
            </div>
            <div class="col-md-5">
                <div class="profile-header">
                    <div class="overlay"></div>
                    <div class="profile-main" style="background-image: url({{ asset('img/profile-bg.png') }});">
                        <div class="profile-glass">
                            <div class="glass-effect">
                                @if ($mahasiswa->mhs_foto != '')
                                    <img src="{{ asset($mahasiswa->mhs_foto) }}" alt="{{ $mahasiswa->mhs_nm }}"
                                        class="img-circle" width="100">
                                @else
                                    <img src="{{ asset($mahasiswa->mhs_foto) }}" alt="{{ asset('images/no-image.webp') }}"
                                        class="img-circle" width="100">
                                @endif

                                <h3 class="name">{{ $mahasiswa->mhs_nm }}</h3>
                                <span
                                    class="online-status {{ @$mahasiswa->mhs_status != 0 ? 'status-available' : 'status-unavailable' }}">{{ @$mahasiswa->mhs_status != 0 ? 'Aktif' : 'Tidak Aktif' }}</span>
                            </div>
                        </div>
                    </div>
                    <div
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
                        Status Lamaran :
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
                    </div>
                    <div class="profile-detail">
                        <div class="profile-info">
                        </div>
                        <a href="{{ route('lamar.index') }}" class="btn btn-primary" style="position: relative;">Back
                            to
                            Lamar List</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="profile-detail">
                    <div class="profile-info">
                        <h4><i class="fa fa-user box-circle"></i> Informasi Dasar</h4>
                        <div class="row">
                            <div class="col-md-4">NIM</div>
                            <div class="col-md-8">: {{ @$mahasiswa->mhs_NIM }}</div>
                            <div class="col-md-4">Nama</div>
                            <div class="col-md-8">: {{ @$mahasiswa->mhs_nm }}</div>
                            <div class="col-md-4">Email</div>
                            <div class="col-md-8">: {{ @$mahasiswa->mhs_email }}</div>
                            <div class="col-md-4">Jenis Kelamin</div>
                            <div class="col-md-8">: {{ @$mahasiswa->mhs_jk == 1 ? 'Laki-Laki' : 'Perempuan' }}</div>
                            <div class="col-md-4">No Telpon</div>
                            <div class="col-md-8">: {{ @$mahasiswa->mhs_notelp }}</div>
                            <div class="col-md-4">Alamat</div>
                            <div class="col-md-8">: {{ @$mahasiswa->mhs_alamat }}</div>
                            <div class="col-md-4">Tahun Lulus</div>
                            <div class="col-md-8">: {{ @$mahasiswa->mhs_th_lulus }}</div>
                            <div class="col-md-4">TTL</div>
                            <div class="col-md-8">:
                                {{ @$mahasiswa->mhs_kota_lahir .', ' .\Carbon\Carbon::createFromFormat('Y-m-d', @$mahasiswa->mhs_tanggal_lahir)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </div>
                            @if (@$mahasiswa->mhs_tb)
                                <div class="col-md-4">Tinggi Badan</div>
                                <div class="col-md-8">: {{ @$mahasiswa->mhs_tb . ' CM' }}</div>
                            @endif
                            @if (@$mahasiswa->mhs_bb)
                                <div class="col-md-4">Berat Badan</div>
                                <div class="col-md-8">: {{ @$mahasiswa->mhs_bb . ' KG' }}</div>
                            @endif
                            <br><br>
                            <a href="{{ url('/mahasiswa/' . $mahasiswa->id) }}" class="btn btn-primary"
                                style="position: relative;">Ke
                                Pelamar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

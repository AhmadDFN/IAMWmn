@extends('layouts.mhs.template2')

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
            <div class="col-md-12">
                <div class="profile-header">
                    <div class="overlay"></div>
                    <div class="profile-main" style="background-image: url({{ asset('img/profile-bg.png') }});">
                        <div class="profile-glass">
                            <div class="glass-effect">
                                @if (@$perusahaan->perusahaan_foto == null)
                                    <img src="{{ asset('img/iamw/company-4.jpg') }}" alt="{{ @$perusahaan->perusahaan_nm }}"
                                        class="img-circle" width="100">
                                @else
                                    <img src="{{ asset($perusahaan->perusahaan_foto) }}"
                                        alt="{{ asset('img/iamw/company-2.jpg') }}" class="img-circle" width="100">
                                @endif

                                <h3 class="name">{{ @$loker->loker_nm }}</h3>
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
                        <a href="{{ url('home/lamar') }}" class="btn btn-primary" style="position: relative;">Back
                            to
                            Lamar List</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-detail">
                    <div class="profile-info">
                        <h4><i class="fa fa-user box-circle"></i> Informasi Loker</h4>
                        <div class="row">
                            <div class="col-md-4">Kode</div>
                            <div class="col-md-8">: {{ @$loker->loker_kd }}</div>
                            <div class="col-md-4">Nama Lowongan</div>
                            <div class="col-md-8">: {{ @$loker->loker_nm }}</div>
                            <div class="col-md-4">Ket Loker</div>
                            <div class="col-md-8">: {{ @$loker->loker_ket }}</div>
                            <div class="col-md-4">Terbuka Hingga</div>
                            <div class="col-md-8">:
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', @$loker->loker_exp)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </div>
                            <div class="col-md-4">Loker Lowongan Jurusan</div>
                            <div class="col-md-8">
                                @foreach ($loker->jurusans as $jurusan)
                                    {!! '-' . $jurusan->jurusan_nm . '</br>' !!}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

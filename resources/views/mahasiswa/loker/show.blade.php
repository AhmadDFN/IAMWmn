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
            <div class="profile-header">
                <div class="overlay"></div>
                <div class="profile-main" style="background-image: url({{ asset('img/profile-bg.png') }});">
                    <div class="profile-glass">
                        <div class="glass-effect">
                            @if (@$perusahaan->perusahaan_foto != '')
                                <img src="{{ asset($perusahaan->perusahaan_foto) }}" alt="{{ $perusahaan->perusahaan_nm }}"
                                    class="img-circle" width="100">
                            @else
                                <img src="{{ url(asset('img/iamw/company-1.jpg')) }}" alt="{{ $perusahaan->perusahaan_nm }}"
                                    class="img-circle" width="100">
                            @endif
                            <h3 class="name">{{ $perusahaan->perusahaan_nm }}</h3>
                            <span class="online-status status-available">Aktif</span>
                        </div>
                    </div>
                </div>
                <a href="{{ url('home/perusahaan') }}" class="btn btn-primary" style="position: relative;">Back
                    to
                    perusahaan List</a>
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
                        <h4><i class="fa fa-user box-circle"></i> Informasi Perusahaan</h4>
                        <div class="row">
                            <div class="col-md-4">Nama</div>
                            <div class="col-md-8">: {{ @$perusahaan->perusahaan_nm }}</div>
                            <div class="col-md-4">Alamat</div>
                            <div class="col-md-8">: {{ @$perusahaan->perusahaan_alamat }}</div>
                            <div class="col-md-4">Kota Perusahaan</div>
                            <div class="col-md-8">: {{ @$perusahaan->perusahaan_kota }}</div>
                            <div class="col-md-4">No Telpon</div>
                            <div class="col-md-8">: {{ @$perusahaan->perusahaan_notelp }}</div>
                            <div class="col-md-4">Email</div>
                            <div class="col-md-8">: {{ @$perusahaan->perusahaan_email }}</div>
                            <div class="col-md-4">Website</div>
                            <div class="col-md-8">: {{ @$perusahaan->perusahaan_website }}</div>
                            <div class="col-md-4">CP Nama</div>
                            <div class="col-md-8">: {{ @$perusahaan->perusahaan_cp_nama }}</div>
                            <div class="col-md-4">CP No Telp</div>
                            <div class="col-md-8">: {{ @$perusahaan->perusahaan_cp_notelp }}</div>
                            <br><br>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-6">
                    <a href="{{ url('home/loker') }}" class="btn btn-primary" style="position: relative; width:100%;">Ke
                        Loker list</a>
                </div>
                <div class="col-6">
                    <a href="{{ url('home/perusahaan/' . $perusahaan->id) }}" class="btn btn-primary"
                        style="position: relative;width:100%;">Info
                        {{ @$perusahaan->perusahaan_nm }}</a>
                </div>
            </div>
            <br><br>
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-6">
                    <a href="{{ url('home/lokerku') }}" class="btn btn-primary" style="position: relative;width:100%;">Info
                        Loker
                        Jurusanku</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.template')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')
    <div class="col-12 container-fluid px-4">
        <div class="bg-secondary rounded h-100 p-4 row">
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
                <a href="{{ route('perusahaan.index') }}" class="btn btn-primary" style="position: relative;">Back
                    to
                    perusahaan List</a>
            </div>
            <div class="bg-secondary rounded">
                @if (session('text'))
                    <div class="alert alert-{{ session('type') }} text-center" style="width: 300px;" role="alert">
                        {{ session('text') }}
                    </div>
                @endif
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
                            <div class="col-md-4">Expired Lowongan Kerja</div>
                            <div class="col-md-8">: {{ @$loker->loker_exp }}</div>
                            <div class="col-md-4">Loker Status</div>
                            <div class="col-md-8">: {{ @$loker->loker_status == 1 ? 'Active' : 'Not Active' }}</div>
                            <br><br>
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
            <div class="col-6">
                <a href="{{ url('/loker') }}" class="btn btn-primary" style="position: relative;width:100%;">Ke
                    Loker</a>
            </div>
            <div class="col-6">
                <a href="{{ url('/perusahaan') }}" class="btn btn-success" style="position: relative;width:100%;">Ke
                    Perusahaan</a>
            </div>
            <div class="col-12">
                <div class="tombol-export"></div>
                <div class="table-responsive">
                    <table id="dtTableshow" class="table compact table-dark dtTable">
                        <thead>
                            <tr>
                                <th scope="col">NIM</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Loker</th>
                                <th scope="col">Pelamar</th>
                                <th scope="col" width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lamars as $item)
                                <tr>
                                    <td>{{ $item->lamar_NIM }}</td>
                                    <td>{{ $item->lamar_kd }}</td>
                                    <td>{{ $item->lamar_nm }}</td>
                                    <td>{{ $item->mhs_nm }}</td>
                                    <td>
                                        <a href="{{ url('/lamar/' . $item->id) }}"><i class="text-success fas fa-eye"
                                                style="position: relative;"></i></a><br>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

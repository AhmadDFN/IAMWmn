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
                                @if (@$perusahaan->perusahaan_foto != '')
                                    <img src="{{ asset($perusahaan->perusahaan_foto) }}"
                                        alt="{{ $perusahaan->perusahaan_nm }}" class="img-circle" width="100">
                                @else
                                    <img src="{{ url(asset('img/iamw/company-1.jpg')) }}"
                                        alt="{{ $perusahaan->perusahaan_nm }}" class="img-circle" width="100">
                                @endif
                                <h3 class="name">{{ $perusahaan->perusahaan_nm }}</h3>
                                <span class="online-status status-available">Aktif</span>
                            </div>
                        </div>
                    </div>
                    <div class="profile-detail">
                        <div class="profile-info">
                            <div class="col">Jumlah Lowongan</div>
                            <div class="col">{{ @$lokers->count() }}</div>
                        </div>
                        <a href="{{ route('perusahaan.index') }}" class="btn btn-primary" style="position: relative;">Back
                            to
                            perusahaan List</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
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
                            <a href="{{ url('/perusahaan') }}" class="btn btn-primary" style="position: relative;">Ke
                                Perusahaan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table id="dtTableshow" class="table compact table-dark dtTable">
                        <thead>
                            <tr>
                                <th scope="col">Loker KD</th>
                                <th scope="col" width="15%">Nama Loker</th>
                                <th scope="col" width="30%">Keterangan Loker</th>
                                <th scope="col">Loker Exp</th>
                                <th scope="col">Jurusan Loker</th>
                                <th scope="col">Stats</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lokers as $item)
                                <tr>
                                    <td>{{ $item->loker_kd }}</td>
                                    <td>{{ $item->loker_nm }}</td>
                                    <td>{{ $item->loker_ket }}</td>
                                    <td>{{ $item->loker_exp }}</td>
                                    <td>
                                        @foreach ($item->jurusans as $jurusan)
                                            {!! '-' . $jurusan->jurusan_nm . '</br>' !!}
                                        @endforeach
                                    </td>
                                    {{--  <td>
                                        @foreach ($item->loker_kd_jurusan as $kd_jurusan)
    
                                        @endforeach
                                    </td>  --}}
                                    <td>{{ $item->loker_status }}</td>
                                    <td>
                                        <a href="{{ url('/loker/' . $item->id) }}"><i
                                                class="text-success fas fa-eye"></i></a><br>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endsection

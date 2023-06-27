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
                                <img src="{{ asset($mahasiswa->mhs_foto) }}" alt="{{ $mahasiswa->mhs_nm }}"
                                    class="img-circle" width="100">
                                <h3 class="name">{{ $mahasiswa->mhs_nm }}</h3>
                                <span
                                    class="online-status {{ @$mahasiswa->mhs_status == 1 ? 'status-available' : 'status-unavailable' }}">{{ @$mahasiswa->mhs_status == 1 ? 'Aktif' : 'Tidak Aktif' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-detail" style="padding-bottom: 0px;">
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="profile-info">
                    <h4><i class="fa fa-briefcase box-circle"></i> Pemberkasan</h4>
                    @if ($progress == 0)
                        <div class="pg-bar mb-3">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @elseif ($progress == 1)
                        <div class="pg-bar mb-3">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="17"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @elseif ($progress == 2)
                        <div class="pg-bar mb-3">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                    aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @elseif ($progress == 3)
                        <div class="pg-bar mb-3">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-info" role="progressbar" aria-valuenow="51"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @elseif ($progress == 4)
                        <div class="pg-bar mb-3">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="68"
                                    style="background-color: #007bff;" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @elseif ($progress == 5)
                        <div class="pg-bar mb-3">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"
                                    aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @elseif ($progress == 6)
                        <div class="pg-bar mb-0">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endif
                    <ul>
                        <li>KTP Upload
                            {!! @$berkas->berkas_ktp == null
                                ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>'
                                : '<span class="label label-success"><i class="fa fa-check"></i><span>' !!}
                        </li>
                        <li>Kartu Keluarga Upload
                            {!! @$berkas->berkas_kk == null
                                ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>'
                                : '<span class="label label-success"><i class="fa fa-check"></i><span>' !!}
                        </li>
                        <li>Ijazah / SKL Upload
                            {!! @$berkas->berkas_ijazah == null
                                ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>'
                                : '<span class="label label-success"><i class="fa fa-check"></i><span>' !!}
                        </li>
                        <li>SKCK Upload
                            {!! @$berkas->berkas_skck == null
                                ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>'
                                : '<span class="label label-success"><i class="fa fa-check"></i><span>' !!}
                        </li>
                        <li>Foto Upload
                            {!! @$berkas->berkas_foto == null
                                ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>'
                                : '<span class="label label-success"><i class="fa fa-check"></i><span>' !!}
                        </li>
                        <li>CV Upload
                            {!! @$berkas->berkas_cv == null
                                ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>'
                                : '<span class="label label-success"><i class="fa fa-check"></i><span>' !!}
                        </li>
                    </ul>
                    <a href="{{ url('/mahasiswa/' . $mahasiswa->id) }}" class="btn btn-primary"
                        style="position: relative;">Ke
                        Profil {{ @$mahasiswa->mhs_nm }}</a>
                    <a href="{{ url('/mahasiswa/' . $mahasiswa->id . '/berkas') }}" class="btn btn-success"
                        style="position: relative;">Berkas {{ @$mahasiswa->mhs_nm }}</a>
                </div>
            </div>
            <div class="col-12">
                <table id="dtTable" class="table compact table-dark dtTable">
                    <thead>
                        <tr>
                            <th scope="col">foto</th>
                            <th scope="col">KTP</th>
                            <th scope="col">skck</th>
                            <th scope="col">kk</th>
                            <th scope="col">cv</th>
                            <th scope="col">ijazah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ pathinfo($berkas->berkas_foto, PATHINFO_FILENAME) }}</td>
                            <td>{{ pathinfo($berkas->berkas_ktp, PATHINFO_FILENAME) }}</td>
                            <td>{{ pathinfo($berkas->berkas_skck, PATHINFO_FILENAME) }}</td>
                            <td>{{ pathinfo($berkas->berkas_kk, PATHINFO_FILENAME) }}</td>
                            <td>{{ pathinfo($berkas->berkas_cv, PATHINFO_FILENAME) }}</td>
                            <td>{{ pathinfo($berkas->berkas_ijazah, PATHINFO_FILENAME) }}</td>
                        </tr>
                        <tr>
                            <td>{!! $berkas->berkas_foto !== null
                                ? '<p><a target="_blank" href="' .
                                    asset($berkas->berkas_foto) .
                                    '">Download foto</a> <i class="fa fa-check"></i></p>'
                                : '<span class="label label-danger">foto belum ada <i class="fa fa-remove"></i></span>' !!}</td>
                            <td>{!! $berkas->berkas_ktp !== null
                                ? '<p><a target="_blank" href="' . asset($berkas->berkas_ktp) . '">Download ktp</a> <i class="fa fa-check"></i></p>'
                                : '<span class="label label-danger">ktp belum ada <i class="fa fa-remove"></i></span>' !!}
                            </td>
                            <td>{!! $berkas->berkas_skck !== null
                                ? '<p><a target="_blank" href="' .
                                    asset($berkas->berkas_skck) .
                                    '">Download skck</a> <i class="fa fa-check"></i></p>'
                                : '<span class="label label-danger">ktp belum ada <i class="fa fa-remove"></i></span>' !!}</td>
                            <td>{!! $berkas->berkas_kk !== null
                                ? '<p><a target="_blank" href="' . asset($berkas->berkas_kk) . '">Download kk</a> <i class="fa fa-check"></i></p>'
                                : '<span class="label label-danger">ktp belum ada <i class="fa fa-remove"></i></span>' !!}</td>
                            <td>{!! $berkas->berkas_cv !== null
                                ? '<p><a target="_blank" href="' . asset($berkas->berkas_cv) . '">Download cv</a> <i class="fa fa-check"></i></p>'
                                : '<span class="label label-danger">ktp belum ada <i class="fa fa-remove"></i></span>' !!}</td>
                            <td>{!! $berkas->berkas_ijazah !== null
                                ? '<p><a target="_blank" href="' .
                                    asset($berkas->berkas_ijazah) .
                                    '">Download ijazah</a> <i class="fa fa-check"></i></p>'
                                : '<span class="label label-danger">ktp belum ada <i class="fa fa-remove"></i></span>' !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

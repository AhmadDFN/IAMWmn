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
                    <div class="profile-detail">
                        <div class="profile-info">
                            <div class="col">Jumlah Lamaran</div>
                            <div class="col">{{ @$lamars->count() }}</div>
                        </div>
                        <a href="{{ url('/home/mahasiswa/' . @$mahasiswa->id . '/edit') }}" class="btn btn-primary"
                            style="position: relative;">Upload Atau Edit Berkas</a>
                    </div>
                </div>
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
                    <ul class="mt-3">
                        <li>KTP Upload
                            {!! @$berkas->berkas_ktp == null
                                ? '<span class="badge bg-danger float-end"><span class="bi bi-x"></span></span>'
                                : '<span class="badge bg-success float-end"><span class="bi bi-check"></span></span>' !!}
                        </li>
                        <li>Kartu Keluarga Upload
                            {!! @$berkas->berkas_kk == null
                                ? '<span class="badge bg-danger float-end"><span class="bi bi-x"></span></span>'
                                : '<span class="badge bg-success float-end"><span class="bi bi-check"></span></span>' !!}
                        </li>
                        <li>Ijazah / SKL Upload
                            {!! @$berkas->berkas_ijazah == null
                                ? '<span class="badge bg-danger float-end"><span class="bi bi-x"></span></span>'
                                : '<span class="badge bg-success float-end"><span class="bi bi-check"></span></span>' !!}
                        </li>
                        <li>SKCK Upload
                            {!! @$berkas->berkas_skck == null
                                ? '<span class="badge bg-danger float-end"><span class="bi bi-x"></span></span>'
                                : '<span class="badge bg-success float-end"><span class="bi bi-check"></span></span>' !!}
                        </li>
                        <li>Foto Upload
                            {!! @$berkas->berkas_foto == null
                                ? '<span class="badge bg-danger float-end"><span class="bi bi-x"></span></span>'
                                : '<span class="badge bg-success float-end"><span class="bi bi-check"></span></span>' !!}
                        </li>
                        <li>CV Upload
                            {!! @$berkas->berkas_cv == null
                                ? '<span class="badge bg-danger float-end"><span class="bi bi-x"></span></span>'
                                : '<span class="badge bg-success float-end"><span class="bi bi-check"></span></span>' !!}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-7">
                <div class="profile-detail">
                    <div class="profile-info">
                        <h4><i class="fa fa-user box-circle"></i> Informasi {{ @Auth::user()->name }}</h4>
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
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>foto</h5>
                                <p>{{ pathinfo($berkas->berkas_foto, PATHINFO_FILENAME) }}</p>
                                <p>
                                    {!! $berkas->berkas_foto !== null
                                        ? '<a target="_blank" href="' .
                                            asset($berkas->berkas_foto) .
                                            '">Download foto</a> <span class="badge bg-success"><span class="bi bi-check"></span></span>'
                                        : '<span class="label label-danger">foto belum ada <span class="badge bg-danger"><span class="bi bi-x"></span></span></span>' !!}
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h5>KTP</h5>
                                <p>{{ pathinfo($berkas->berkas_ktp, PATHINFO_FILENAME) }}</p>
                                <p>
                                    {!! $berkas->berkas_ktp !== null
                                        ? '<a target="_blank" href="' .
                                            asset($berkas->berkas_ktp) .
                                            '">Download ktp</a> <span class="badge bg-success"><span class="bi bi-check"></span></span>'
                                        : '<span class="label label-danger">ktp belum ada <span class="badge bg-danger"><span class="bi bi-x"></span></span></span>' !!}
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h5>SKCK</h5>
                                <p>{{ pathinfo($berkas->berkas_skck, PATHINFO_FILENAME) }}</p>
                                <p>
                                    {!! $berkas->berkas_skck !== null
                                        ? '<a target="_blank" href="' .
                                            asset($berkas->berkas_skck) .
                                            '">Download skck</a> <span class="badge bg-success"><span class="bi bi-check"></span></span>'
                                        : '<span class="label label-danger">skck belum ada <span class="badge bg-danger"><span class="bi bi-x"></span></span></span>' !!}
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h5>KK</h5>
                                <p>{{ pathinfo($berkas->berkas_kk, PATHINFO_FILENAME) }}</p>
                                <p>
                                    {!! $berkas->berkas_kk !== null
                                        ? '<a target="_blank" href="' .
                                            asset($berkas->berkas_kk) .
                                            '">Download kk</a> <span class="badge bg-success"><span class="bi bi-check"></span></span>'
                                        : '<span class="label label-danger">kk belum ada <span class="badge bg-danger"><span class="bi bi-x"></span></span></span>' !!}
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h5>CV</h5>
                                <p>{{ pathinfo($berkas->berkas_cv, PATHINFO_FILENAME) }}</p>
                                <p>
                                    {!! $berkas->berkas_cv !== null
                                        ? '<a target="_blank" href="' .
                                            asset($berkas->berkas_cv) .
                                            '">Download cv</a> <span class="badge bg-success"><span class="bi bi-check"></span></span>'
                                        : '<span class="label label-danger">cv belum ada <span class="badge bg-danger"><span class="bi bi-x"></span></span></span>' !!}
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h5>Ijazah</h5>
                                <p>{{ pathinfo($berkas->berkas_ijazah, PATHINFO_FILENAME) }}</p>
                                <p>
                                    {!! $berkas->berkas_ijazah !== null
                                        ? '<a target="_blank" href="' .
                                            asset($berkas->berkas_ijazah) .
                                            '">Download ijazah</a> <span class="badge bg-success"><span class="bi bi-check"></span></span>'
                                        : '<span class="label label-danger">ijazah belum ada <span class="badge bg-danger"><span class="bi bi-x"></span></span></span>' !!}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <div class="table-responsive">
                    <table id="dtTableshow" class="table compact table-dark dtTable">
                        <thead>
                            <tr class="text-white">
                                <th scope="col">Lamaran</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama Mahasiswa</th>
                                <th scope="col">Perusahaan</th>
                                <th scope="col">Tanggal - Jam</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lamars as $lamar)
                                <tr>
                                    <td>{{ @$lamar->lamar_nm }}</td>
                                    <td>{{ @$lamar->lamar_NIM }}</td>
                                    <td>{{ @$mahasiswa->mhs_nm }}</td>
                                    <td>{{ @$lamar->perusahaan_nm }}</td>
                                    <td>{{ @$lamar->created_at }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ url('home/lamar/' . @$lamar->id) }}">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

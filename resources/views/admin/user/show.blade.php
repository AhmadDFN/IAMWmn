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
            @if (@$user->role == 'Admin' or @$user->role == 'SuperAdmin')
                <div class="col-md-3"></div>
            @endif
            <div class="col-md-{{ (@$user->role == 'Admin' ? '6' : @$user->role == 'SuperAdmin') ? '6' : '5' }}">
                <div class="profile-header">
                    <div class="overlay"></div>
                    <div class="profile-main" style="background-image: url({{ asset('img/profile-bg.png') }});">
                        <div class="profile-glass">
                            <div class="glass-effect">
                                @if (@$user->role == 'Admin' or @$user->role == 'SuperAdmin')
                                    <img src="{{ asset('img/iamw/company-2.jpg') }}"
                                        alt="{{ asset('images/no-image.webp') }}" class="img-circle" width="100">
                                @endif
                                @if (@$user->role == 'Mahasiswa')
                                    @if (@$mahasiswa->mhs_foto != '')
                                        <img src="{{ asset(@$mahasiswa->mhs_foto) }}" alt="{{ @$mahasiswa->mhs_nm }}"
                                            class="img-circle" width="100">
                                    @else
                                        <img src="{{ asset(@$mahasiswa->mhs_foto) }}"
                                            alt="{{ asset('images/no-image.webp') }}" class="img-circle" width="100">
                                    @endif
                                @endif
                                @if (@$user->role == 'Perusahaan')
                                    @if (@$perusahaan->perusahaan_foto != '')
                                        <img src="{{ asset(@$perusahaan->perusahaan_foto) }}"
                                            alt="{{ @$perusahaan->perusahaan_nm }}" class="img-circle" width="100">
                                    @else
                                        <img src="{{ asset(@$perusahaan->perusahaan_foto) }}"
                                            alt="{{ asset('images/no-image.webp') }}" class="img-circle" width="100">
                                    @endif
                                @endif

                                <h3 class="name">{{ @$user->name }}</h3>
                                <span
                                    class="online-status {{ @$user->status != 0 ? 'status-available' : 'status-unavailable' }}">{{ @$user->status != 0 ? 'Aktif' : 'Tidak Aktif' }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('user.index') }}" class="btn btn-primary" style="position: relative;">Back
                        to
                        User List</a>
                </div>
                <div class="profile-detail">
                    <div class="profile-info">
                        <h4><i class="fa fa-user box-circle"></i> Informasi Dasar</h4>
                        <div class="row">
                            <div class="col-md-4">Nama</div>
                            <div class="col-md-8">: {{ $user->name }}</div>
                            <div class="col-md-4">Email</div>
                            <div class="col-md-8">: {{ $user->email }}</div>
                            <div class="col-md-4">Role</div>
                            <div class="col-md-8">: {{ @$user->role }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @if (@$user->reff != null or @$user->reff != '')

                @if (@$user->role == 'Mahasiswa')
                    <div class="col-md-7">
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4><i class="fa fa-user box-circle"></i> Informasi {{ @$user->role }}</h4>
                                <div class="row">
                                    <div class="col-md-4">NIM</div>
                                    <div class="col-md-8">: {{ @$mahasiswa->mhs_NIM }}</div>
                                    <div class="col-md-4">Nama</div>
                                    <div class="col-md-8">: {{ @$mahasiswa->mhs_nm }}</div>
                                    <div class="col-md-4">Email</div>
                                    <div class="col-md-8">: {{ @$mahasiswa->mhs_email }}</div>
                                    <div class="col-md-4">Jenis Kelamin</div>
                                    <div class="col-md-8">: {{ @$mahasiswa->mhs_jk == 1 ? 'Laki-Laki' : 'Perempuan' }}
                                    </div>
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
                                        Mahasiswa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-7">
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4><i class="fa fa-user box-circle"></i> Informasi {{ @$user->role }}</h4>
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
                                    <a href="{{ url('/perusahaan/' . $perusahaan->id_perusahaan) }}"
                                        class="btn btn-primary" style="position: relative;">Ke
                                        Perusahaan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

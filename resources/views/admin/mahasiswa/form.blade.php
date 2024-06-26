@extends('layouts.template')

@section('title', $title)
@section('page-title', $page)

@section('content')

    <div class="bg-secondary rounded">
        @if (session('text'))
            <div class="alert alert-{{ session('type') }} text-center" style="width: 300px;" role="alert">
                {{ session('text') }}
            </div>
        @endif
    </div>
    <form action="{{ route('mahasiswa.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="container-fluid pt-1 px-0">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="bg-secondary rounded p-4">
                        @if (@$mahasiswa->mhs_foto)
                            @if (file_exists($mahasiswa->mhs_foto))
                                <img class="thumb-menu-big" src="{{ asset(@$mahasiswa->mhs_foto) }}"
                                    alt="{{ @$mahasiswa->mhs_nm }}">
                            @else
                                <img class="thumb-menu-big" src="{{ asset('img/no-image.webp') }}"
                                    alt="{{ @$mahasiswa->mhs_nm }}">
                            @endif
                        @else
                            <img class="thumb-menu-big" src="{{ asset('img/no-image.webp') }}"
                                alt="{{ @$mahasiswa->mhs_nm }}">
                        @endif
                        <div class="mb-3">
                            <input class="form-control form-control-sm bg-dark mt-2" id="mhs_foto" type="file"
                                name="mhs_foto" />
                        </div>
                        {{--  <input type="file" class="mt-2" name="mhs_foto" id="mhs_foto">  --}}
                        <input type="hidden" name="old_foto" value="{{ @$mahasiswa->mhs_foto }}">
                        @error('foto')
                            <div id="foto" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="bg-secondary rounded h-100 p-4">
                        <div class="form-floating mb-3">
                            <input type="hidden" name="id" value="{{ @$mahasiswa->id }}">
                            <input type="text" class="form-control @error('mhs_NIM') is-invalid @enderror" id="mhs_NIM"
                                name="mhs_NIM" placeholder="Masukkan NIM 10 Digit" value="{{ @$mahasiswa->mhs_NIM }}">
                            <label for="mhs_NIM">NIM</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="mhs_nm" name="mhs_nm" placeholder="Nama Anda"
                                value="{{ @$mahasiswa->mhs_nm }}">
                            <label for="mhs_nm">Nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="mhs_email" name="mhs_email"
                                placeholder="name@google.com" value="{{ @$mahasiswa->mhs_email }}">
                            <label for="mhs_email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="mhs_notelp" name="mhs_notelp"
                                placeholder="No Telpon" value="{{ @$mahasiswa->mhs_notelp }}">
                            <label for="mhs_notelp">No Telp</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="mhs_tanggal_lahir" name="mhs_tanggal_lahir"
                                value="{{ @$mahasiswa->mhs_tanggal_lahir }}">
                            <label for="mhs_tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        </div>
                        {{--  <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="mhs_password"
                            placeholder="Password" value="{{@$mahasiswa->mhs_pass}}">
                        <label for="mhs_password">Password</label>
                    </div>  --}}
                        <div class="form-floating mb-3">
                            <select class="form-select" id="mhs_kd_jurusan" name="mhs_kd_jurusan" aria-label="Jurusan"
                                style="height: 70px; color: white;">
                                <option selected>Pilih</option>
                                @foreach ($jurusans as $jurusan)
                                    <option style="color: white" value="{{ $jurusan->jurusan_kd }}"
                                        {{ @$mahasiswa->mhs_kd_jurusan == $jurusan->jurusan_kd ? 'selected' : '' }}>
                                        {{ $jurusan->jurusan_nm }}</option>
                                @endforeach
                            </select>
                            <label for="mhs_kd_jurusan">Jurusan</label>
                        </div>
                        <div class="form-floating mb-3 ps-1">
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mhs_jk" id="l"
                                            value="1" {{ @$mahasiswa->mhs_jk == 1 ? 'checked' : '' }} />
                                        <label class="form-check-label" for="l" style="color: white;">
                                            Laki - Laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mhs_jk" id="p"
                                            value="2" {{ @$mahasiswa->mhs_jk == 2 ? 'checked' : '' }} />
                                        <label class="form-check-label" for="p" style="color: white;">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="mhs_th_masuk" name="mhs_th_masuk" aria-label="Tahun Masuk"
                                style="height: 70px; color: white;">
                                <option selected>Tahun</option>
                                @for ($i = 2009; $i < 2030; $i++)
                                    <option style="color: white" value="{{ $i }}"
                                        {{ @$mahasiswa->mhs_th_masuk == $i ? 'selected' : '' }}>{{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <label for="mhs_th_masuk">Tahun Masuk</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="provinsiup" name="mhs_provinsi" aria-label="Provinsi"
                                style="height: 70px; color: white;" onchange="getKota(this,'{{ route('kota') }}')">
                                <option selected>Pilih Provinsi</option>
                                @foreach ($provinsis as $provinsi)
                                    <option style="color: white" value="{{ @$provinsi->id }}"
                                        {{ @$idprof[0]->province_id == @$provinsi->id ? 'selected' : '' }}>
                                        {{ @$provinsi->name }}</option>
                                @endforeach
                            </select>
                            <label for="provinsiup">Provinsi</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="kotaup" name="mhs_kota" aria-label="Kota"
                                style="height: 70px; color: white;">
                                <option selected>Pilih Kota</option>
                                @if (@$mahasiswa->id)
                                    @foreach ($kotas as $kota)
                                        <option style="color: white" value="{{ @$kota->name }}"
                                            {{ @$mahasiswa->mhs_kota == $kota->name ? 'selected' : '' }}>
                                            {{ $kota->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option style="color: white" value=""></option>
                                @endif
                            </select>
                            <label for="kotaup">kota</label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="SIMPAN">
                        </div>
                        {{--  <button type="submit" class="btn btn-primary">Simpan</button>  --}}
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

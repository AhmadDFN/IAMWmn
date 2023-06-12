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
    <form action="{{ url('perusahaan/' . @$perusahaan->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @isset($perusahaan)
            @method('PUT')
        @endisset
        <div class="container-fluid pt-1 px-0">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <div class="form-floating mb-3">
                            <input type="hidden" name="id" value="{{ @$perusahaan->id }}">
                            <input type="text" class="form-control @error('perusahaan_nm') is-invalid @enderror"
                                id="perusahaan_nm" name="perusahaan_nm" placeholder="Nama Perusahaan"
                                value="{{ @$perusahaan->perusahaan_nm }}">
                            <label for="perusahaan_nm">Nama Perusahaan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="perusahaan_alamat" name="perusahaan_alamat"
                                placeholder="Alamat Perusahaan" value="{{ @$perusahaan->perusahaan_alamat }}">
                            <label for="perusahaan_alamat">Alamat Perusahaan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="perusahaan_email" name="perusahaan_email"
                                placeholder="name@google.com" value="{{ @$perusahaan->perusahaan_email }}">
                            <label for="perusahaan_email">Email Perusahaan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="perusahaan_notelp" name="perusahaan_notelp"
                                placeholder="No Telp Perusahaan" value="{{ @$perusahaan->perusahaan_notelp }}">
                            <label for="perusahaan_notelp">No Telp Perusahaan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="perusahaan_website" name="perusahaan_website"
                                placeholder="Website Perusahaan" value="{{ @$perusahaan->perusahaan_website }}">
                            <label for="perusahaan_website">Website Perusahaan</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="provinsiup" name="perusahaan_provinsi" aria-label="Provinsi"
                                style="height: 70px; color: white;" onchange="getKota(this,'{{ route('kota') }}')">
                                <option selected>Pilih Provinsi</option>
                                @foreach ($provinsis as $provinsi)
                                    <option style="color: white" value="{{ @$provinsi->id }}"
                                        {{ @$idprof[0]->province_id == $provinsi->id ? 'selected' : '' }}>
                                        {{ @$provinsi->name }}</option>
                                @endforeach
                            </select>
                            <label for="provinsiup">Provinsi</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="kotaup" name="perusahaan_kota" aria-label="Kota"
                                style="height: 70px; color: white;">
                                <option selected>Pilih Kota</option>
                                @if (@$perusahaan->id)
                                    @foreach ($kotas as $kota)
                                        <option style="color: white" value="{{ $kota->name }}"
                                            {{ @$perusahaan->perusahaan_kota == $kota->name ? 'selected' : '' }}>
                                            {{ $kota->name }}</option>
                                    @endforeach
                                    {{--  <option style="color: white" value="{{ @$perusahaan->perusahaan_kota }}" selected>
                                        {{ @$perusahaan->perusahaan_kota }}</option>  --}}
                                @else
                                    <option style="color: white" value=""></option>
                                @endif
                            </select>
                            <label for="kotaup">kota</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="perusahaan_cp_nama" name="perusahaan_cp_nama"
                                placeholder="Nama CP Perusahaan" value="{{ @$perusahaan->perusahaan_cp_nama }}">
                            <label for="perusahaan_cp_nama">Nama CP Perusahaan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="perusahaan_cp_notelp" name="perusahaan_cp_notelp"
                                placeholder="No Telpon CP" value="{{ @$perusahaan->perusahaan_cp_notelp }}">
                            <label for="perusahaan_cp_notelp">No Telpon CP</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

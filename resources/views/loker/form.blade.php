@extends('layouts.template')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')

    <div class="bg-secondary rounded">
        @if (session('text'))
            <div class="alert alert-{{ session('type') }} text-center" style="width: 300px;" role="alert">
                {{ session('text') }}
            </div>
        @endif
    </div>
    <form action="{{ url($routes->save) }}" method="post" enctype="multipart/form-data">
        @csrf
        @isset($is_update)
            @method('PUT')
        @endisset
        <div class="container-fluid pt-1 px-0">
            <div class="row g-4">
                <div class="col-md">
                    <div class="bg-secondary rounded h-100 p-4">
                        <div class="form-floating mb-3">
                            <input type="hidden" id="id" name="id" value="{{ @$loker->id }}">
                            {{-- <input type="hidden" id="loker_status" name="loker_status" value=1> --}}
                            <input type="hidden" id="loker_kd" name="loker_kd"
                                value="{{ isset($is_update) ? @$loker->loker_kd : @$code }}">
                            <input type="text" class="form-control @error('loker_nm') is-invalid @enderror"
                                id="loker_nm" name="loker_nm" placeholder="loker_nm" value="{{ @$loker->loker_nm }}">
                            <label for="loker_nm">Nama Loker</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control @error('loker_exp') is-invalid @enderror"
                                id="loker_exp" name="loker_exp" placeholder="loker_exp" value="{{ @$loker->loker_exp }}">
                            <label for="loker_exp">Lowongan Hingga</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="loker_id_perusahaan" name="loker_id_perusahaan"
                                aria-label="perusahaan" style="height: 70px; color: white;">
                                <option selected>Pilih</option>
                                @foreach ($perusahaans as $perusahaan)
                                    <option style="color: white" value="{{ $perusahaan->id }}"
                                        {{ @$loker->loker_id_perusahaan == $perusahaan->id ? 'selected' : '' }}>
                                        {{ $perusahaan->perusahaan_nm }}</option>
                                @endforeach
                            </select>
                            <label for="loker_id_perusahaan">Nama Perusahaan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="loker_id_jnsloker" name="loker_id_jnsloker"
                                aria-label="Jenis Loker" style="height: 70px; color: white;">
                                <option selected>Pilih</option>
                                @foreach ($jenislokers as $jenisloker)
                                    <option style="color: white" value="{{ $jenisloker->id }}"
                                        {{ @$loker->loker_id_jnsloker == $jenisloker->id ? 'selected' : '' }}>
                                        {{ $jenisloker->jenis_loker_nm }}</option>
                                @endforeach
                            </select>
                            <label for="loker_id_jnsloker">Jenis Lowongan</label>
                        </div>
                        <div class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">
                                Checkbox
                            </legend>
                            <div class="col-sm-10">
                                @foreach ($jurusans as $jurusan)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="{{ @$jurusan->jurusan_kd }}"
                                            name="loker_kd_jurusan[]" value="{{ @$jurusan->jurusan_kd }}"
                                            {{ strpos(@$loker->loker_kd_jurusan, @$jurusan->jurusan_kd) !== false ? 'checked' : '' }} />
                                        <label class="form-check-label" for="{{ @$jurusan->jurusan_kd }}"
                                            style="color: white">
                                            {{ @$jurusan->jurusan_nm }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-floating mb-3 ps-1">
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="loker_status" id="avaible"
                                            value="1" {{ @$loker->loker_status == 1 ? 'checked' : '' }} />
                                        <label class="form-check-label" for="avaible" style="color: white;">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="loker_status" id="notavaible"
                                            value="2" {{ @$loker->loker_status == 2 ? 'checked' : '' }} />
                                        <label class="form-check-label" for="notavaible" style="color: white;">
                                            Not Active
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Keterangan Lowongan Pekerjaan</span>
                            <textarea class="form-control" aria-label="With textarea" id="loker_ket" name="loker_ket">{{ @$loker->loker_ket }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

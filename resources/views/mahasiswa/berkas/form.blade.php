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
    <form action="{{ url($save) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid pt-1 px-0">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="bg-secondary rounded p-4">
                        @if (@$berkas->berkas_foto)
                            @if (file_exists(@$berkas->berkas_foto))
                                <img class="thumb-menu-big" src="{{ asset(@$berkas->berkas_foto) }}"
                                    alt="{{ @$berkas->berkas_nm }}">
                            @else
                                <img class="thumb-menu-big" src="{{ asset('img/no-image.webp') }}"
                                    alt="{{ @$berkas->berkas_nm }}">
                            @endif
                        @else
                            <img class="thumb-menu-big" src="{{ asset('img/no-image.webp') }}"
                                alt="{{ @$berkas->berkas_nm }}">
                        @endif
                        <div class="mb-3">
                            <input class="form-control form-control-sm bg-dark mt-2" id="berkas_foto" type="file"
                                name="berkas_foto" />
                        </div>
                        {{--  <input type="file" class="mt-2" name="mhs_foto" id="mhs_foto">  --}}
                        <input type="hidden" name="old_foto" value="{{ @$berkas->berkas_foto }}">
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
                            <input type="hidden" name="id" value="{{ @$berkas->id }}">
                            <input type="hidden" name="berkas_kd" value="{{ @$berkas->berkas_kd }}">
                            <input type="hidden" name="berkas_NIM" value="{{ @$berkas->berkas_NIM }}">
                        </div>
                        <div class="mb-3">
                            <label for="berkas_cv" class="form-label text-white">CV</label>
                            <input type="file" id="berkas_cv" name="berkas_cv" class="form-control bg-dark">
                            <input type="hidden" name="old_cv" value="{{ @$berkas->berkas_cv }}">
                        </div>
                        <div class="mb-3">
                            <label for="berkas_skck" class="form-label text-white">SKCK</label>
                            <input type="file" id="berkas_skck" name="berkas_skck" class="form-control bg-dark">
                            <input type="hidden" name="old_skck" value="{{ @$berkas->berkas_skck }}">
                        </div>
                        <div class="mb-3">
                            <label for="berkas_kk" class="form-label text-white">KARTU KELUARGA</label>
                            <input type="file" id="berkas_kk" name="berkas_kk" class="form-control bg-dark">
                            <input type="hidden" name="old_kk" value="{{ @$berkas->berkas_kk }}">
                        </div>
                        <div class="mb-3">
                            <label for="berkas_ijazah" class="form-label text-white">IJAZAH</label>
                            <input type="file" id="berkas_ijazah" name="berkas_ijazah" class="form-control bg-dark">
                            <input type="hidden" name="old_ijazah" value="{{ @$berkas->berkas_ijazah }}">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="SIMPAN">
                        </div>
                        {{--  <button type="submit" class="btn btn-primary">Simpan</button>  --}}
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

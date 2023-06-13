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
    <form action="{{ url('jurusan/' . @$jurusan->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @isset($is_update)
            @method('PUT')
        @endisset
        <div class="container-fluid pt-1 px-0">
            <div class="row g-4">
                <div class="col-md">
                    <div class="bg-secondary rounded h-100 p-4">
                        <div class="form-floating mb-3">
                            <input type="hidden" name="id" value="{{ @$jurusan->id }}">
                            <input type="text" class="form-control @error('jurusan_kd') is-invalid @enderror"
                                id="jurusan_kd" name="jurusan_kd" placeholder="Kode jurusan"
                                value="{{ @$jurusan->jurusan_kd }}">
                            <label for="jurusan_kd">Kode jurusan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="jurusan_nm" name="jurusan_nm"
                                placeholder="Alamat jurusan" value="{{ @$jurusan->jurusan_nm }}">
                            <label for="jurusan_nm">Nama jurusan</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

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
                            <input type="hidden" name="id" value="{{ @$jenisloker->id }}">
                            <input type="text" class="form-control @error('jenis_loker_nm') is-invalid @enderror"
                                id="jenis_loker_nm" name="jenis_loker_nm" placeholder="jenis_loker_nm"
                                value="{{ @$jenisloker->jenis_loker_nm }}">
                            <label for="jenis_loker_nm">Jenis Loker</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

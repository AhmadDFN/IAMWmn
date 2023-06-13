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
                            <input type="hidden" name="id" value="{{ @$user->id }}">
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" placeholder="Username" value="{{ @$user->username }}">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email User" value="{{ @$user->email }}">
                            <label for="email">Email user</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama user"
                                value="{{ @$user->name }}">
                            <label for="name">Nama user</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="role" name="role" aria-label="Jurusan"
                                style="height: 70px; color: white;">
                                <option selected>Pilih</option>
                                <option style="color: white" value="SuperAdmin"
                                    {{ @$user->role == 'SuperAdmin' ? 'selected' : '' }}>SuperAdmin</option>
                                <option style="color: white" value="Admin" {{ @$user->role == 'Admin' ? 'selected' : '' }}>
                                    Admin</option>
                                <option style="color: white" value="Mahasiswa"
                                    {{ @$user->role == 'Mahasiswa' ? 'selected' : '' }}>
                                    Mahasiswa</option>
                            </select>
                            <label for="role">Jurusan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="status" name="status" aria-label="Jurusan"
                                style="height: 70px; color: white;">
                                <option selected>Pilih</option>
                                <option style="color: white" value=1 {{ @$user->status == 1 ? 'selected' : '' }}>
                                    Sudah Aktivasi</option>
                                <option style="color: white" value=2 {{ @$user->status == 2 ? 'selected' : '' }}>
                                    Belum Aktivasi</option>
                            </select>
                            <label for="status">Status</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

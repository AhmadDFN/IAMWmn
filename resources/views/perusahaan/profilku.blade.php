@extends('layouts.perusahaan.template2')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')
    <form action="{{ url('perusahaan/myprofile/update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                                    <input type="file" name="foto" id="photo-input" style="display: none;">
                                    <input type="hidden" name="old_foto" value="{{ @$user->foto }}">
                                    @if (@Auth::user()->foto != '')
                                        <img src="{{ asset(@Auth::user()->foto) }}" id="photo-preview"
                                            alt="{{ @Auth::user()->name }}" class="img-circle" width="100"
                                            style="cursor: pointer;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ @Auth::user()->name }}&background=007BFF&color=FFF"
                                            id="photo-preview" alt="{{ @Auth::user()->name }}" class="img-circle"
                                            width="100" style="cursor: pointer;">
                                    @endif
                                    {{--  <img src="{{ asset('img/admin.png') }}" class="img-circle" width="100">  --}}
                                    <h3 class="name">{{ @Auth::user()->name }}</h3>
                                    <span class="online-status status-available">Aktif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-detail">
                        <div class="profile-info">
                            <h4><i class="fa fa-user box-circle"></i> Informasi Dasar</h4>
                            <div class="row">
                                <div class="col-md-4">Nama</div>
                                <div class="col-md-8">: {{ @Auth::user()->name }}</div>
                                <div class="col-md-4">Email</div>
                                <div class="col-md-8">: {{ @Auth::user()->email }}</div>
                                <div class="col-md-4">Role</div>
                                <div class="col-md-8">: {{ @Auth::user()->role }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <input type="hidden" id="email" name="email" value="{{ @$user->email }}">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email User"
                            value="{{ @$user->email }}" disabled style="background-color: #331111">
                        <label for="email">Email user</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama user"
                            value="{{ @$user->name }}">
                        <label for="name">Nama user</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nama user">
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                            placeholder="Nama user">
                        <label for="confirmpassword">Confirm Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection

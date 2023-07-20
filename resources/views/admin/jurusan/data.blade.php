@extends('layouts.template')

@section('title', $title)
@section('page-title', $page)

@section('content')

    <div class="col-12">
        <div class="bg-secondary rounded h-100 p-4">
            <div class="row">
                <div class="col-8">
                    <h5 class="mb-4 text-primary">@yield('title')</h5>
                </div>
                <div class="card-tools text-right mb-2 mr-2 col-4 align-items-center justify-content-end d-flex">
                    <a href="{{ route($add) }}" class="btn btn-outline-primary btn-sm">Tambah {{ $title }}</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="dtTable" class="table compact table-dark dtTable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Kode Jurusan</th>
                            <th scope="col">Nama Jurusan</th>
                            <th scope="col">Jurusan Kode</th>
                            <th scope="col" width="12%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurusans as $jurusan)
                            <tr>
                                <td>{{ $jurusan->id }}</td>
                                <td>{{ $jurusan->jurusan_kd }}</td>
                                <td>{{ $jurusan->jurusan_nm }}</td>
                                <td>{{ $jurusan->jurusan_kda }}</td>
                                <td>
                                    <form id="{{ 'delete-form-' . @$jurusan->id }}"
                                        action="{{ route($index . 'destroy', $jurusan->id) }}" method="post">
                                        <a href="{{ route($index . 'edit', $jurusan->id) }}"><i
                                                class="text-warning fas fa-edit"></i></a>
                                        <a href="{{ route($index . 'show', $jurusan->id) }}"><i
                                                class="text-success fas fa-eye"></i></a><br>
                                        @csrf
                                        @method('DELETE')
                                        <button hidden type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-transparent mt-0"
                                            onclick="confirmDeleteItem('{{ 'delete-form-' . $jurusan->id }}')"><i
                                                class="text-danger fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    {{--  
    <div class="card-tools text-right mb-2 mr-2">
        <a href="{{ url("jurusan/form") }}" class="btn btn-primary btn-sm">Tambah jurusan</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="dtCustomers" class="dtTable table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Gender</th>
                        <th>Tahun Lulus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jurusans as $jurusan)
                    <tr>
                        <td>{{ $jurusan->mhs_foto }}</td>
                        <td>{{ $jurusan->mhs_NIM }}</td>
                        <td>{{ $jurusan->mhs_nm }}</td>
                        <td>{!! $jurusan->mhs_alamat.", ".$jurusan->mhs_kota."</br>".$jurusan->mhs_notelp !!}</td>
                        <td>{{ $jurusan->mhs_jk==1 ? "Laki-Laki" : "Perempuan" }}</td>
                        <td>{{ $jurusan->mhs_th_lulus }}</td>
                        <td>
                            <form action="{{ route('jurusan.destroy',$jurusan->id) }}" method="post">
                                <a href="{{ route('jurusan.edit',$jurusan->id) }}"><i class="text-warning fas fa-user-edit"></i></a>
                                
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-transparent mt-0"><i class="text-danger fas fa-user-times"></i></button>
                                
                                <a href="{{ route('jurusan.show',$jurusan->id) }}"><i class="text-primary fas fa-eye"></i></a><br>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
    </div>   --}}
@endsection

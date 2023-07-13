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
                    <a href="{{ route('perusahaan.create') }}" class="btn btn-outline-primary btn-sm">Tambah Perusahaan</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="dtTable" class="table compact table-dark dtTable">
                    <thead>
                        <tr>
                            <th scope="col">Nama Perusahaan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Email</th>
                            <th scope="col">Website</th>
                            <th scope="col">Contect Person</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perusahaans as $perusahaan)
                            <tr>
                                <td>{{ $perusahaan->perusahaan_nm }}</td>
                                <td>{!! $perusahaan->perusahaan_alamat .
                                    ', ' .
                                    $perusahaan->perusahaan_kota .
                                    '</br>' .
                                    $perusahaan->perusahaan_notelp !!}</td>
                                <td>{{ $perusahaan->perusahaan_email }}</td>
                                <td>{{ $perusahaan->perusahaan_website }}</td>
                                <td>{!! $perusahaan->perusahaan_cp_nama . '</br>' . $perusahaan->perusahaan_cp_notelp !!}</td>
                                <td>
                                    <form id="{{ 'delete-form-' . @$perusahaan->id }}"
                                        action="{{ route('perusahaan.destroy', $perusahaan->id) }}" method="post">
                                        <a href="{{ route('perusahaan.edit', $perusahaan->id) }}"><i
                                                class="text-warning fas fa-edit"></i></a>
                                        <a href="{{ route('perusahaan.show', $perusahaan->id) }}"><i
                                                class="text-success fas fa-eye"></i></a><br>

                                        @csrf
                                        @method('DELETE')
                                        <button hidden type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-transparent mt-0"
                                            onclick="confirmDeleteItem('{{ 'delete-form-' . $perusahaan->id }}')"><i
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
        <a href="{{ url("mahasiswa/form") }}" class="btn btn-primary btn-sm">Tambah Mahasiswa</a>
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
                    @foreach ($mahasiswas as $mahasiswa)
                    <tr>
                        <td>{{ $mahasiswa->mhs_foto }}</td>
                        <td>{{ $mahasiswa->mhs_NIM }}</td>
                        <td>{{ $mahasiswa->mhs_nm }}</td>
                        <td>{!! $mahasiswa->mhs_alamat.", ".$mahasiswa->mhs_kota."</br>".$mahasiswa->mhs_notelp !!}</td>
                        <td>{{ $mahasiswa->mhs_jk==1 ? "Laki-Laki" : "Perempuan" }}</td>
                        <td>{{ $mahasiswa->mhs_th_lulus }}</td>
                        <td>
                            <form action="{{ route('mahasiswa.destroy',$mahasiswa->id) }}" method="post">
                                <a href="{{ route('mahasiswa.edit',$mahasiswa->id) }}"><i class="text-warning fas fa-user-edit"></i></a>
                                
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-transparent mt-0"><i class="text-danger fas fa-user-times"></i></button>
                                
                                <a href="{{ route('mahasiswa.show',$mahasiswa->id) }}"><i class="text-primary fas fa-eye"></i></a><br>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
    </div>   --}}
@endsection

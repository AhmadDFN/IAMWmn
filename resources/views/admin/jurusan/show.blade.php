@extends('layouts.template')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')
    <div class="col-12 container-fluid px-4">
        <div class="bg-secondary rounded h-100 p-4 row">
            <div class="col-md-12">
                <div class="profile-info">
                    <h4><i class="fa fa-user box-circle"></i> Informasi Jurusan</h4>
                    <div class="row">
                        <div class="col-md-4">Kode Jurusan</div>
                        <div class="col-md-8">: {{ $jurusan->jurusan_kd }}</div>
                        <div class="col-md-4">Email</div>
                        <div class="col-md-8">: {{ $jurusan->jurusan_nm }}</div>
                    </div>
                    <br>
                    <a href="{{ route('jurusan.index') }}" class="btn btn-primary">Back to Jurusan List</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="profile-info">
                    <h4><i class="fa fa-user box-circle"></i>Mahasiswa Jurusan {{ $jurusan->jurusan_nm }}</h4>
                    <div class="table-responsive">
                        <table id="dtTable" class="table compact table-dark dtTable">
                            <thead>
                                <tr>
                                    <th scope="col">Foto</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Tahun Lulus</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswas as $mahasiswa)
                                    <tr>
                                        <td>
                                            @if ($mahasiswa->mhs_foto != '')
                                                <img class="thumb-menu" src="{{ asset($mahasiswa->mhs_foto) }}"
                                                    alt="{{ $mahasiswa->mhs_nm }}">
                                            @else
                                                <img class="thumb-menu" src="{{ asset('images/no-image.webp') }}"
                                                    alt="{{ $mahasiswa->mhs_nm }}">
                                            @endif
                                            {{--  @if ($mahasiswa->mhs_foto != '')                                
                                            <img class="thumb-menu" src="{{ asset(str_replace("public/","",$mahasiswa->mhs_foto)) }}" alt="{{ $mahasiswa->mhs_nm }}">
                                        @else
                                            <img class="thumb-menu" src="{{ asset('images/no-image.webp') }}" alt="{{ $mahasiswa->mhs_nm }}">
                                        @endif  --}}
                                        </td>
                                        <td>{{ $mahasiswa->mhs_NIM }}</td>
                                        <td>{{ $mahasiswa->mhs_nm }}</td>
                                        <td>{{ $mahasiswa->mhs_jk == 1 ? 'Laki-Laki' : 'Perempuan' }}</td>
                                        <td>{{ $mahasiswa->mhs_th_lulus }}</td>
                                        <td>
                                            <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}"><i
                                                    class="text-warning fas fa-user-edit"></i></a>
                                            <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}"><i
                                                    class="text-success fas fa-eye"></i></a>
                                            <a href="{{ url('/mahasiswa/' . $mahasiswa->id . '/berkas') }}"><i
                                                    class="fa-solid fa-file"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-transparent m-0 p-0"><i
                                                        class="text-danger fas fa-user-times"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

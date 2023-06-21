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
            </div>
            <div class="table-responsive">
                <table id="dtTable" class="table compact table-dark dtTable">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">NIM</th>
                            <th scope="col">kd</th>
                            <th scope="col">skck</th>
                            <th scope="col">kk</th>
                            <th scope="col">cv</th>
                            <th scope="col">ijazah</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($berkas as $item)
                            <tr>
                                <td>
                                    @if ($item->berkas_foto != '')
                                        <img class="thumb-menu" src="{{ asset($item->berkas_foto) }}"
                                            alt="{{ $item->berkas_nm }}">
                                    @else
                                        <img class="thumb-menu" src="{{ asset('images/no-image.webp') }}"
                                            alt="{{ $item->berkas_nm }}">
                                    @endif
                                </td>
                                <td>{{ $item->berkas_NIM }}</td>
                                <td>{{ $item->berkas_kd }}</td>
                                <td>{{ $item->berkas_skck }}</td>
                                <td>{{ $item->berkas_kk }}</td>
                                {{--  <td>{{ $item->berkas_cv }}</td>  --}}
                                <td><a href="{{ asset('cvku.pdf') }}">Download PDF</a></td>
                                <td>{{ $item->berkas_ijazah }}</td>
                                <td>
                                    <form action="{{ url($index . $item->id) }}" method="post">
                                        <a href="{{ url($index . $item->id) . '/edit' }}"><i
                                                class="text-warning fas fa-user-edit"></i></a>
                                        <a href="{{ url($index . $item->id) }}"><i
                                                class="text-success fas fa-eye"></i></a><br>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-transparent mt-0"><i
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

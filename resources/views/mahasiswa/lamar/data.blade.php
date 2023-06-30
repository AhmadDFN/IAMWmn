@extends('layouts.mhs.template2')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')

    <div class="col-12">
        <div class="bg-secondary rounded h-100 p-4">
            <div class="row">
                <div class="col-8">
                    <h5 class="mb-4 text-primary">@yield('title')</h5>
                </div>
                <div class="card-tools text-right mb-2 mr-2 col-4 align-items-center justify-content-end d-flex">
                    {{--  <a href="{{ url($routes->add) }}" class="btn btn-outline-primary btn-sm">Tambah {{ $data->title }}</a>  --}}
                </div>
            </div>
            <div class="table-responsive">
                <table id="dtTable" class="table compact table-dark dtTable">
                    <thead>
                        <tr>
                            <th scope="col">NIM</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Perusahaaan</th>
                            {{--  <th scope="col">Jenis Loker</th>  --}}
                            <th scope="col" width="12%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lamars as $item)
                            <tr>
                                <td>{{ $item->lamar_NIM }}</td>
                                <td>{{ $item->lamar_kd }}</td>
                                <td>{{ $item->lamar_nm }}</td>
                                <td>{{ $item->perusahaan_nm }}</td>
                                {{--  <td>{{ $item->jenis_loker_nm }}</td>  --}}
                                <td>
                                    <form action="{{ url($routes->index . $item->id) }}" method="post">
                                        <a href="{{ url($routes->index . $item->id . '/edit') }}"><i
                                                class="text-warning fas fa-user-edit"></i></a>
                                        <a href="{{ url($routes->index . $item->id) }}"><i
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
@endsection

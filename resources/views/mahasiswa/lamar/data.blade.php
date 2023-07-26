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
                            <th scope="col">Status</th>
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
                                <td
                                    class="{{ ($item->lamar_status == 0
                                            ? 'bg-warning text-black'
                                            : $item->lamar_status == 0)
                                        ? 'bg-warning text-black'
                                        : ($item->lamar_status == 1
                                            ? 'bg-primary text-white'
                                            : ($item->lamar_status == 2
                                                ? 'bg-danger text-white'
                                                : ($item->lamar_status == 6
                                                    ? 'bg-danger text-white'
                                                    : 'bg-success text-white'))) }}">
                                    {{ ($item->lamar_status == 0
                                            ? 'Menunggu'
                                            : $item->lamar_status == 0)
                                        ? 'Menunggu'
                                        : ($item->lamar_status == 1
                                            ? 'Interview'
                                            : (($item->lamar_status == 2
                                                    ? 'Ditolak'
                                                    : $item->lamar_status == 6)
                                                ? 'Ditolak'
                                                : 'Diterima')) }}
                                </td>
                                {{--  <td>{{ $item->jenis_loker_nm }}</td>  --}}
                                <td>
                                    <form action="{{ url($routes->index . $item->id) }}" method="post"
                                        id="{{ 'delete-form-' . @$item->id }}">
                                        <a href="{{ url($routes->index . $item->id) }}"><i
                                                class="text-success fas fa-eye"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button hidden type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-transparent mt-0"
                                            onclick="confirmDeleteItem('{{ 'delete-form-' . $item->id }}')"><i
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
@endsection

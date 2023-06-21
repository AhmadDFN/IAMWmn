@extends('layouts.template')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')

    <div class="col-12">
        <div class="bg-secondary rounded h-100 p-4">
            <div class="row">
                <div class="col-8" id="tambahan">
                    <h5 class="mb-4 text-primary">@yield('title')</h5>
                </div>
                <div class="card-tools text-right mb-2 mr-2 col-4 align-items-center justify-content-end d-flex">
                    <a href="{{ url($routes->add) }}" class="btn btn-outline-primary btn-sm">Tambah {{ $data->title }}</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="dtTable" class="table compact table-dark dtTable">
                    <thead>
                        <tr>
                            <th scope="col">Loker KD</th>
                            <th scope="col"width="15%">Nama Loker</th>
                            <th scope="col" width="30%">Keterangan Loker</th>
                            <th scope="col">Loker Exp</th>
                            <th scope="col">Jurusan Loker</th>
                            <th scope="col">Stats</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lokers as $item)
                            <tr>
                                <td>{{ $item->loker_kd }}</td>
                                <td>{{ $item->loker_nm }}</td>
                                <td>{{ $item->loker_ket }}</td>
                                <td>{{ $item->loker_exp }}</td>
                                <td>
                                    @foreach ($item->jurusans as $jurusan)
                                        {!! '-' . $jurusan->jurusan_nm . '</br>' !!}
                                    @endforeach
                                </td>
                                {{--  <td>
                                    @foreach ($item->loker_kd_jurusan as $kd_jurusan)

                                    @endforeach
                                </td>  --}}
                                <td>{{ $item->loker_status }}</td>
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

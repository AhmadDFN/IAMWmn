@extends('layouts.mhs.template2')

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
                    {{--  <a href="{{ url($routes->add) }}" class="btn btn-outline-primary btn-sm">Tambah {{ $data->title }}</a>  --}}
                </div>
            </div>
            <div class="table-responsive">
                <table id="dtTablekuae" class="table compact table-dark dtTable">
                    <thead>
                        <tr>
                            <th scope="col">Loker KD</th>
                            <th scope="col" width="15%">Nama Loker</th>
                            <th scope="col" width="30%">Keterangan Loker</th>
                            <th scope="col">Loker Exp</th>
                            <th scope="col">Jurusan Loker</th>
                            <th scope="col" class="lowkeer">Lamar Kerja</th>
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
                                <td class="text-center align-middle">
                                    @if ($item->lamar_kd == null or $item->lamar_kd == '')
                                        <a href="#" onclick="confirmLowongan({{ $item->id }})"><span
                                                class="badge bg-success text-black"><i class="fas fa-check-circle"> Lamar
                                                    Kerja</i></span></a>
                                        {{--  <a href="{{ url('home/loker/' . @$item->id . '/submit') }}"><span
                                                class="badge bg-success text-black"><i class="fas fa-check-circle"> Lamar
                                                    Kerja</i></span></a>  --}}
                                    @else
                                        <span class="badge bg-warning text-black"><i class="fas fa-file-alt">
                                                Sedang
                                                Aktif</i></span>
                                        {{--  <i class="fa-sharp fa-light fa-star"></i>  --}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

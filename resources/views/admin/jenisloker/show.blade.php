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
                        <div class="col-md-4">Nama Jenis Loker</div>
                        <div class="col-md-8">: {{ $jenisloker->jenis_loker_nm }}</div>
                        <div class="col-md-4">Keterangan</div>
                        <div class="col-md-8">: {{ @$jenisloker->jenis_loker_ket }}</div>
                    </div>
                    <br>
                    <a href="{{ route('jenisloker.index') }}" class="btn btn-primary">Back to Jenis Loker List</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="profile-info">
                    <h4><i class="fa fa-user box-circle"></i>Jenis Loker Lowongan {{ $jenisloker->jenis_loker_nm }}</h4>
                    <div class="table-responsive">
                        <table id="dtTable" class="table compact table-dark dtTable">
                            <thead>
                                <tr>
                                    <th scope="col">Loker KD</th>
                                    <th scope="col" width="15%">Nama Loker</th>
                                    <th scope="col" width="30%">Keterangan Loker</th>
                                    <th scope="col">Loker Exp</th>
                                    <th scope="col">Jurusan Loker</th>
                                    <th scope="col">Stats</th>
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

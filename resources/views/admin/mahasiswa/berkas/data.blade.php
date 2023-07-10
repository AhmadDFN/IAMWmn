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
                            <th scope="col">NIM</th>
                            <th scope="col">kd</th>
                            <th scope="col">skck</th>
                            <th scope="col">ktp</th>
                            <th scope="col">kk</th>
                            <th scope="col">cv</th>
                            <th scope="col">ijazah</th>
                            <th scope="col">action</th>
                            <th scope="col">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($berkas as $item)
                            <tr>

                                <td>{{ $item->berkas_NIM }}</td>
                                <td>{{ $item->berkas_kd }}</td>
                                <td>{{ pathinfo($item->berkas_skck, PATHINFO_FILENAME) }}</td>
                                <td>{{ pathinfo($item->berkas_ktp, PATHINFO_FILENAME) }}</td>
                                <td>{{ pathinfo($item->berkas_kk, PATHINFO_FILENAME) }}</td>
                                <td>{{ pathinfo($item->berkas_cv, PATHINFO_FILENAME) }}</td>
                                <td>{{ pathinfo($item->berkas_ijazah, PATHINFO_FILENAME) }}</td>
                                <td>
                                    <form action="{{ url($index . $item->id) }}" method="post">
                                        <a href="{{ url($index . $item->id) . '/edit' }}"><i
                                                class="text-warning fas fa-edit"></i></a>
                                        <a href="{{ url($index . $item->id) }}"><i
                                                class="text-success fas fa-eye"></i></a><br>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-transparent mt-0"><i
                                                class="text-danger fas fa-trash"></i></button>

                                    </form>
                                </td>
                                <td>
                                    @if ($item->berkas_foto != '')
                                        <img class="thumb-menu" src="{{ asset($item->berkas_foto) }}"
                                            alt="{{ $item->berkas_nm }}">
                                    @else
                                        <img class="thumb-menu" src="{{ asset('images/no-image.webp') }}"
                                            alt="{{ $item->berkas_nm }}">
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

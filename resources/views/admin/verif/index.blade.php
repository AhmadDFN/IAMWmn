@extends('layouts.template')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')

    <div class="col-12">
        <div class="bg-secondary rounded h-100 p-4">
            <div class="card" style="background-color: #191C24 !important">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dtTablepaginate" class="table compact table-dark dtTablepaginate">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">NIM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-center">Gender</th>
                                    <th scope="col" class="text-center">Tahun Lulus</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center" width="5%">Act</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswas as $mahasiswa)
                                    <tr>
                                        <td>{{ $mahasiswa->mhs_NIM }}</td>
                                        <td>{{ $mahasiswa->mhs_nm }}</td>
                                        <td>{{ $mahasiswa->mhs_email }}</td>
                                        <td>{{ $mahasiswa->mhs_jk == 1 ? 'Laki-Laki' : 'Perempuan' }}
                                        </td>
                                        <td class="text-center">{{ $mahasiswa->mhs_th_lulus }}</td>
                                        <td class="text-center">
                                            @if ($mahasiswa->mhs_status == 1 and $mahasiswa->reff != null)
                                                <span class="badge rounded-pill bg-warning text-dark">Belum Verif</span>
                                            @else
                                                @if ($mahasiswa->mhs_status == 1 and $mahasiswa->status == 0)
                                                    <span class="badge rounded-pill bg-danger text-white">Belum a
                                                        Pengajuan</span>
                                                @endif
                                                @if ($mahasiswa->mhs_status == 2)
                                                    <span class="badge rounded-pill bg-success">Sudah Verif</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($mahasiswa->mhs_status == 1 and $mahasiswa->reff != null)
                                                <a href="{{ url('verif/' . $mahasiswa->id . '/acc') }}"><i
                                                        class="text-success fas fa-check"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <div class="dataTables_info" id="dtTable_info" role="status" aria-live="polite">Showing
                                {{ @$mahasiswas->firstItem() }} to {{ @$mahasiswas->lastItem() }}
                                of {{ @$mahasiswas->total() }} entries</div>
                        </div>
                        <div class="col-6">
                            {{--  <ul class="pagination pagination-sm m-0 float-end">
                                <li class="page-item"><a class="page-link" href="{{ $mahasiswas->previousPageUrl() }}">«
                                        Prev</a>
                                </li>
                                <li class="page-item"><a class="page-link"
                                        href="javasscript:void(0)">{{ 'Hal : ' . $mahasiswas->currentPage() }}</a></li>
                                <li class="page-item"><a class="page-link" href="{{ $mahasiswas->nextPageUrl() }}">Next
                                        »</a>
                                </li>
                            </ul>  --}}
                            <ul class="pagination float-end pagination-dark">
                                <li class="paginate_button page-item first {{ @$mahasiswas->firstItem() == 1 ? 'disabled' : '' }}"
                                    id="dtTablepaginate_first"><a
                                        href="{{ @$mahasiswas->firstItem() == 1 ? '#' : @$mahasiswas->url(1) }}"
                                        aria-controls="dtTablepaginate"
                                        aria-disabled="{{ @$mahasiswas->firstItem() == 1 ? 'true' : 'false' }}"
                                        aria-role="link" data-dt-idx="first" tabindex="0" class="page-link">First</a></li>
                                <li class="paginate_button page-item previous {{ @$mahasiswas->firstItem() == 1 ? 'disabled' : '' }}"
                                    id="dtTablepaginate_previous"><a
                                        href="{{ @$mahasiswas->firstItem() == 1 ? '#' : @$mahasiswas->previousPageUrl() }}"
                                        aria-controls="dtTablepaginate"
                                        aria-disabled="{{ @$mahasiswas->firstItem() == 1 ? 'true' : '' }}" aria-role="link"
                                        data-dt-idx="previous" tabindex="0" class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#"
                                        aria-controls="dtTablepaginate" aria-role="link" aria-current="page" data-dt-idx="0"
                                        tabindex="0" class="page-link">{{ $mahasiswas->currentPage() }}</a>
                                </li>
                                <li class="paginate_button page-item next {{ @$mahasiswas->lastItem() == @$mahasiswas->total() ? 'disabled' : '' }}"
                                    id="dtTablepaginate_next"><a
                                        href="{{ @$mahasiswas->lastItem() == @$mahasiswas->total() ? '#' : @$mahasiswas->nextPageUrl() }}"
                                        aria-controls="dtTablepaginate"
                                        aria-disabled="{{ @$mahasiswas->lastItem() == @$mahasiswas->total() ? 'true' : 'false' }}"
                                        aria-role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a></li>
                                <li class="paginate_button page-item last {{ @$mahasiswas->lastItem() == @$mahasiswas->total() ? 'disabled' : '' }}"
                                    id="dtTablepaginate_last"><a
                                        href="
                                        {{ @$mahasiswas->lastItem() == @$mahasiswas->total() ? '#' : @$mahasiswas->url(@$mahasiswas->lastPage()) }}"
                                        aria-controls="dtTablepaginate"
                                        aria-disabled="{{ @$mahasiswas->lastItem() == @$mahasiswas->total() ? 'true' : 'false' }}"
                                        aria-role="link" data-dt-idx="last" tabindex="0" class="page-link">Last</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.iamw.template')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')

    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="row justify-content-center pb-3">
            <div class="col-md-12 heading-section ftco-animate">
                <span class="subheading">Pekerjaan Terbaru</span>
                <h2 class="mb-4">Menampilkan setiap pekerjaan yang sedang aktif</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($lokers as $loker)
                @if ($loker->loker_exp <= $datenow)
                    <div class="col-md-12 ftco-animate">
                        <div class="job-post-item p-4 d-block d-lg-flex align-items-center" style="border-radius: 15px;">
                            <div class="one-third col-md-9">
                                <div class="job-post-item-header align-items-center">
                                    <span style="text-transform: capitalize;"><?= $loker->jenis_loker_nm ?></span>
                                    <h2 class="mr-3 text-black"><a href="#"><?= $loker->loker_nm ?></a></h2>
                                </div>
                                <div class="job-post-item-body d-block d-md-flex">
                                    <div class="mr-3"><i class="fas fa-map-marker-alt"></i>
                                        @foreach (@$loker->jurusans as $jurusan)
                                            {!! @$jurusan->jurusan_nm . ' - ' !!}
                                        @endforeach
                                        Mulai Pendaftaran:
                                        {{ date('d M Y', strtotime(@$loker->loker_exp)) }}
                                    </div>
                                </div>
                            </div>
                            <div class="one-forth col-md-3">
                                <a href="{{ url('/auth/login') }}" class="btn btn-primary btn-block">Pilih <i
                                        class="fas fa-check-circle" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

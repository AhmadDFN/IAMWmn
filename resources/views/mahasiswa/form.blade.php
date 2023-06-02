@extends('layouts.template')

@section("title",$title)
@section("page-title",$page)

@section('content')
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">INPUT DATA MAHASISWA YANG AKAN DI TAMBAHKAN</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('mahasiswa.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            {{--  KIRI  --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mhs_NIM">NIM</label>
                                    <input type="text" class="form-control @error('mhs_NIM') is-invalid @enderror" name="mhs_NIM" id="mhs_NIM" placeholder="NIM Mahasiswa" value="{{ @old('mhs_NIM') }}">
                                    @error('mhs_NIM')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mhs_nm">Nama Mahasiswa</label>
                                    <input type="text" class="form-control @error('mhs_nm') is-invalid @enderror" name="mhs_nm" id="mhs_nm" placeholder="Nama Mahasiswa" value="{{ @old('mhs_nm') }}">
                                    @error('mhs_nm')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mhs_alamat">Alamat Mahasiswa</label>
                                    <input type="text" class="form-control @error('mhs_alamat') is-invalid @enderror" name="mhs_alamat" id="mhs_alamat" placeholder="Alamat Mahasiswa" value="{{ @old('mhs_alamat') }}">
                                    @error('mhs_alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mhs_kota">Kota Mahasiswa</label>
                                    <input type="text" class="form-control @error('mhs_kota') is-invalid @enderror" name="mhs_kota" id="mhs_kota" placeholder="Kota Mahasiswa" value="{{ @old('mhs_kota') }}">
                                    @error('mhs_kota')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Jenis Kelamin</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mhs_jk" id="l" value="1">
                                        <label class="form-check-label" for="l">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mhs_jk" id="p" value="2">
                                        <label class="form-check-label" for="p">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            {{--  KANAN  --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mhs_notelp">Nomor Telepon</label>
                                    <input type="number" class="form-control @error('mhs_notelp') is-invalid @enderror" name="mhs_notelp" id="mhs_notelp" placeholder="Nomor Telepon" value="{{ @old('mhs_notelp') }}">
                                    @error('mhs_notelp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mhs_status" class="form-label">Status</label>
                                    <select class="form-control" name="mhs_status" id="mhs_status">
                                        <option value="1">Terdaftar</option>
                                        <option value="2">Belum Terdaftar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="mhs_th_masuk">Tahun Masuk Mahasiswa</label>
                                    <input type="number" class="form-control @error('mhs_th_masuk') is-invalid @enderror" name="mhs_th_masuk" id="mhs_th_masuk" placeholder="Tahun Masuk Mahasiswa" value="{{ @old('mhs_th_masuk') }}">
                                    @error('mhs_th_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <!-- /.card -->
@endsection
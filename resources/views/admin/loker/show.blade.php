@extends('layouts.template2')

@section('title', $data->title)
@section('page-title', $data->page)

@section('content')
    <!-- Blank Start -->
    <div class="container-fluid px-4 col-12">
        <div class="bg-secondary rounded h-100 p-4 row">
            <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 text-center">
                    <h3>This is blank page</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Blank End -->
@endsection

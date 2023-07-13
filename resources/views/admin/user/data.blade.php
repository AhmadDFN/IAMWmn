@extends('layouts.template')

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
                    <a href="{{ url($routes->add) }}" class="btn btn-outline-primary btn-sm">Tambah {{ $data->title }}</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="dtTableNoorder" class="table compact table-dark dtTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Reff</th>
                            <th scope="col">Email</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->reff }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->status = 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <form id="{{ 'delete-form-' . @$user->id }}"
                                        action="{{ url($routes->index . $user->id) }}" method="post">
                                        <a href="{{ url($routes->index . $user->id . '/edit') }}"><i
                                                class="text-warning fas fa-user-edit"></i></a>
                                        <a href="{{ url($routes->index . $user->id) }}"><i
                                                class="text-success fas fa-eye"></i></a><br>
                                        @csrf
                                        @method('DELETE')
                                        <button hidden type="submit" class="btn btn-primary">Submit</button>
                                        <button onclick="confirmDeleteItem('{{ 'delete-form-' . $user->id }}')"
                                            type="button" class="btn btn-transparent mt-0"><i
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

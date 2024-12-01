@extends('backend.layouts.master')
@section('title', 'User')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">User Table</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <!-- Card container -->
                <div class="card rounded-lg shadow-sm border-0">
                    <div class="card-body pt-4 table-responsive">
                        <!-- DataTable -->
                        <table id="datatable" class="table table-hover table-bordered dt-responsive w-100">
                            <thead class="thead-custom">
                                <tr>
                                    <th style="min-width: 100px">ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="min-width: 150px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sl = 1 @endphp
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>
                                        <img src="{{ asset($user->photo) }}" class="img-fluid img-circle">
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('users.edit', $user->id) }}">
                                                <button class="btn btn-sm btn-danger" title="Edit">
                                                    <i class="fa-solid fa-edit"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 my-4">
            <a href="{{ route('users.create') }}">
                <button class="btn btn-primary btn-submit">➥ Create</button>
            </a>
        </div>
    </div>
</div>
@endsection

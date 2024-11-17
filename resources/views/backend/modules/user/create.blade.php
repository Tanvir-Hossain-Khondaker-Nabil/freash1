@extends('backend.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Users</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            @if (isset($user))
                                <h4 class="card-title mb-4">Edit User</h4>
                            @else
                                <h4 class="card-title mb-4">Create User</h4>
                            @endif

                            <form method="post"
                                action="{{ @$user ? route('users.update', $user->id) : route('users.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                @if (isset($user))
                                    @method('put')
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-email-input" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                id="formrow-email-input" value="{{ @$user->name }}"
                                                placeholder="Enter Your Name">
                                            @error('name')
                                                <code>*{{ $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-password-input" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                id="formrow-password-input" value="{{ @$user->email }}"
                                                placeholder="Enter Your Email">
                                            @error('email')
                                                <code>*{{ $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-inputCity" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="formrow-inputCity" placeholder="Enter Your Password">
                                            @error('password')
                                                <code>*{{ $message }}</code>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-inputCity" class="form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                id="formrow-inputCity" placeholder="Confirm Your Password">
                                            @error('password_confirmation')
                                                <code>*{{ $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary w-md">
                                        @if (isset($user))
                                            Update
                                        @else
                                            Submit
                                        @endif
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

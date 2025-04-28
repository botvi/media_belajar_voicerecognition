@extends('template-admin.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header pb-0 text-center">
                        <div class="mb-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/7915/7915522.png" class="rounded-circle" style="width: 150px; height: 150px;">
                        </div>
                        <h3 class="mb-1">{{ $user->name }}</h3>
                        <p class="text-muted">{{ $user->username }}</p>
                    </div>
                    <div class="card-body px-4 pt-0 pb-4">
                        <form action="{{ route('profil.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="">
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

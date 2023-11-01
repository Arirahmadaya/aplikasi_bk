@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mx-auto"  style="margin-top: 2cm;">
            <div class="card">
                <div class="card-header text-center"><strong>Profile</strong></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->nama }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="{{ $user->password }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Level</label>
                        <div class="col-md-6">
                            <input id="role" type="role" class="form-control" name="role" value="{{ $user->role }}" disabled>
                        </div>
                    </div>


                        </div>
                        @if (Auth::user()->role == 'operator')
                        <a href="{{ url('') }}/admin/operator/user" class="btn btn-success" style="color: rgb(255, 255, 255);">
                            <strong>Update Data User</strong>
                        </a>
                        @endif
    
                            
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

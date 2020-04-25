@extends('management.themekit.dashboard')
@section('pageTitle')
Change Password
@endsection

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-settings bg-blue"></i>
                <div class="d-inline">
                    <h2>Change Password</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
                    <div class="alert alert-success">{{ $message }}</div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('profile.UpdatePass') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Old password</label>
                        <div class="col-sm-9">
                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" placeholder="Old password" value="{{ old('old_password')}}">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">New password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="New password" value="{{ old('password')}}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Re Password" value="{{ old('password_confirmation')}}">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('csspage')
<link rel="stylesheet" href="{!! asset('plugins/summernote/dist/summernote-bs4.css') !!}">
@endsection
@section('scriptpage')
<script src="{!! asset('/plugins/sweetalert/dist/sweetalert.min.js') !!}"></script>
<script src="{!! asset('/plugins/summernote/dist/summernote-bs4.min.js') !!}"></script>
<script src="{!! asset('/js/layouts.js') !!}"></script>
@endsection

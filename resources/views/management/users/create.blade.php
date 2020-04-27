@extends('management.themekit.dashboard')

@section('pageTitle')
Create New User
@endsection

@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-user-plus bg-blue"></i>
                <div class="d-inline">
                    <h2>Create New User</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('management') }}"><i class="ik ik-home"></i></a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Users Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create New User</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
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
        {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        {!! Form::text('name', old('name',null), array('id'=>'name','placeholder' => 'Name','class' => 'form-control','required' => 'required')) !!}
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        {!! Form::text('email', old('email',null), array('id'=>'email','placeholder' => 'Email','class' => 'form-control','required' => 'required')) !!}
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control','required' => 'required')) !!}
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control','required' => 'required')) !!}
                    </div>
                    <div class="form-group">
                        <label for="roles">Role</label>
                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control select2','multiple')) !!}
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a class="btn btn-dark" href="{{ route('users.index') }}"> Back</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('csspage')
<link rel="stylesheet" href="{!! asset('/plugins/select2/dist/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! asset('/plugins/summernote/dist/summernote-bs4.css') !!}">
<link rel="stylesheet" href="{!! asset('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') !!}">
<link rel="stylesheet" href="{!! asset('/plugins/mohithg-switchery/dist/switchery.min.css') !!}">
@endsection
@section('scriptpage')
<script src="{!! asset('/plugins/select2/dist/js/select2.min.js') !!}"></script>
<script src="{!! asset('/plugins/summernote/dist/summernote-bs4.min.js') !!}"></script>
<script src="{!! asset('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') !!}"></script>
<script src="{!! asset('/plugins/jquery.repeater/jquery.repeater.min.js') !!}"></script>
<script src="{!! asset('/plugins/mohithg-switchery/dist/switchery.min.js') !!}"></script>
<script>
    "use strict";
$(document).ready(function() {
    $(".select2").select2();
    $('.html-editor').summernote({
      height: 300,
      tabsize: 2
    });
});
</script>
@endsection

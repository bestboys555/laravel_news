@extends('management.themekit.dashboard')

@section('pageTitle')
Show User {{ $user->name }}
@endsection

@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-eye bg-blue"></i>
                <div class="d-inline">
                    <h2>Show User {{ $user->name }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('management') }}"><i class="ik ik-home"></i></a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Users Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Show User {{ $user->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="card">
        <div class="card-footer text-right">
            <a class="btn btn-dark" href="{{ route('users.index') }}"> Back</a>
        </div>
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <div class="form-group">
                    <img src="{!! photo($user->id) !!}" class="rounded-circle" width="150">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $user->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Roles:</strong>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

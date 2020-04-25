@extends('management.themekit.dashboard')
@section('pageTitle')
View Data {{ $perm->name }}
@endsection

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-eye bg-blue"></i>
                <div class="d-inline">
                    <h2>View Data {{ $perm->name }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('management') }}"><i class="ik ik-home"></i></a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('perm.index') }}">Products Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit {{ $perm->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

    <div class="row">
        <div class="card">
            <div class="card-footer text-right">
                <a class="btn btn-dark" href="{{ route('perm.index') }}"> Back</a>
            </div>
            <div class="card-body">
                {!! $perm->name !!}
            </div>
            <div class="card-body">
                {!! $perm->description !!}
            </div>
        </div>
    </div>
@endsection

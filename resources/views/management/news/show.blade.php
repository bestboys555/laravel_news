@extends('management.themekit.dashboard')
@section('pageTitle')View Data {{ $news->name }}@endsection

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-eye bg-blue"></i>
                <div class="d-inline">
                    <h2>View Data</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('management') }}"><i class="ik ik-home"></i></a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('news.index') }}">News Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Data</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

    <div class="row">
        <div class="card col-md-8">
            <div class="card-footer text-right">
                <a class="btn btn-dark" href="{{ route('news.index') }}"> Back</a>
            </div>
            <div class="card-body">
                {!! images_news($news->id, $news->name) !!}
                {!! $news->detail !!}
            </div>
        </div>
    </div>
@endsection

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
                {!! images_news($news->id, $news->name, 'img-thumbnail') !!}
                {!! $news->detail !!}
                @foreach ($documents as $document)
                <div class="alert alert-primary col-12" role="alert">
                    <a href="{{ url_file_document($document->id, $news->id) }}" target="_blank" class="alert alert-primary" title="{{ $document->title }}"> <i class="ik ik-paperclip"></i> {{ $document->title }} (115.25 KB)</a>
                </div>
                @endforeach
                <div class="row text-center text-lg-left baguetteBox">
                    @foreach ($pictures as $picture)
                    <div class="col-lg-3 col-md-4 col-6">
                    <a href="{{ url_file_picture($picture->id, $news->id, "") }}" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" src="{{ url_file_picture($picture->id, $news->id, "thumb_") }}" alt="">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('csspage')
<link rel="stylesheet" href="{!! asset('plugins/baguetteBox/css/baguetteBox.css') !!}">
@endsection
@section('scriptpage')
<script src="{!! asset('plugins/baguetteBox/js/baguetteBox.js') !!}"></script>
<script>
    baguetteBox.run('.baguetteBox');
</script>
@endsection

@extends('indexmain')

@section('pageTitle'){!!$news->name!!}@endsection

@section('content')
    <h1 class="mt-3">{!!$news->name!!}</h1>
    <p class="card-text" datetime="{{ $news->created_at }}" title="{{ $news->created_at }}"><small class="text-muted">{{ Carbon\Carbon::parse($news->created_at)->diffForHumans()}}</small></p>
@auth
    @canany(['news-edit'])
    <a class="btn btn-primary mb-4" href="{{ route('news.edit',$news->id) }}" target="_blank" role="button">edit</a>
    @endcan
@endauth
    {!! images_news($news->id, $news->name,"card-img-top pb-4") !!}
    <div class="lead">{!!$news->detail!!}</div>
<div class="row">
    <div class="col-sm-12 pl-0 pr-0">
        <div class="row">
            @foreach ($documents as $document)
            <?php $file=public_path('/images/news/'.$document->folder.'/'.$document->name); ?>
            <div class="col-md-4">
                <div class="document mb-4">
                    <a href="{{ url_file_document($document->id, $news->id) }}" target="_blank" title="{{ $document->title }}">
                        <div class="document-body">{!! get_extenstion($file) !!}</div>
                        <div class="document-footer">
                                <span class="document-name"> {{ $document->title }} </span>
                                <span class="document-description"> {{ get_file_size($file) }}</span>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="row baguetteBox">
    <div class="row tab-content no-bg no-border">
        @foreach ($pictures as $picture)
        <div class="col-md-3">
            <a href="{{ url_file_picture($picture->id, $news->id, "") }}" class="d-block mb-4 h-100">
                    <img class="img-fluid img-thumbnail" src="{{ url_file_picture($picture->id, $news->id, "thumb_") }}" alt="">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('csspage')

<link rel="stylesheet" href="{!! asset('plugins/fontawesome/css/all.min.css') !!}">
<link rel="stylesheet" href="{!! asset('plugins/baguetteBox/css/baguetteBox.css') !!}">
<link rel="stylesheet" href="{!! asset('css/document_list.css') !!}">

@endsection
@section('scriptpage')
<script src="{!! asset('plugins/baguetteBox/js/baguetteBox.js') !!}"></script>
<script>
    baguetteBox.run('.baguetteBox');
</script>
@endsection

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
    {!! images_news($news->id, $news->name) !!}
    <div class="lead">{!!$news->detail!!}</div>
@endsection
@section('csspage')

@endsection
@section('scriptpage')

@endsection

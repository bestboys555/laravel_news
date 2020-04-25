@extends('indexmain')

@section('pageTitle')Home @endsection

@section('content')
<div class="card-deck">
    @foreach ($news as $news_value)
    <div class="card col-md-4 pr-0 pl-0">
        <a href="{{ route('web.show',$news_value->id) }}" title="{{ $news_value->name }}"><img src="{!! cover_news($news_value->id) !!}" class="card-img-top" alt="{{ $news_value->name }}"></a>
        <div class="card-body">
            <h5 class="card-title"><a href="{{ route('web.show',$news_value->id) }}" title="{{ $news_value->name }}">{{ $news_value->name }}</a></h5>
            <p class="card-text"><small class="text-muted">{{ Carbon\Carbon::parse($news_value->created_at)->diffForHumans()}}</small></p>
        </div>
    </div>
    @endforeach
</div>
<div class="col-md-12 pt-2 pl-0 pr-0">
{!! $news->links() !!}
</div>
@endsection
@section('csspage')

@endsection
@section('scriptpage')

@endsection

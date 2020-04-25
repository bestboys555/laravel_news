@extends('management.themekit.dashboard')

@section('pageTitle')
News Management
@endsection

@section('content')
<?php $ref_cat = Request::segment(4) ?>
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h2>@if(isset($category))
                            @foreach($category as $value)
                                <div>
                                    {!!$value->name!!}
                                </div>
                            @endforeach
                        @else
                        News Management
                        @endif
                        </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('management') }}"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active"><a href="{{ route('news.index') }}">News Management</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-block">
                    @can('news-create')
                    <div class="text-right">
                        @if ($ref_cat)
                        <a class="btn btn-success" href="{{ route('news.create_ref', ['id' => $ref_cat]) }}"> Create new News</a>
                        @else
                        <a class="btn btn-success" href="{{ route('news.create') }}"> Create new News</a>
                        @endif
                    </div>
                    @endcan
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success mt-2 mb-0">{{ $message }}</div>
                @endif
                </div>
                <div class="card-body p-0 table-border-style">
                    <div class="table-responsive">
                        <table class="table table-inverse table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Pic</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $news_value)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td><img src="{!! cover_news($news_value->id) !!}" class="img-thumbnail" width="150"></td>
                                    <td>{{ $news_value->name }}</td>
                                    <td>
                                        <a class="btn btn-icon btn-outline-success mr-3" href="{{ route('news.show',$news_value->id) }}"><i class="ik ik-eye"></i></a>
                                        @can('news-edit')
                                        @if ($ref_cat)
                                        <a class="btn btn-icon btn-outline-primary mr-3" href="{{ route('news.edit_ref',[$news_value->id, $ref_cat]) }}"><i class="ik ik-edit-2"></i></a>
                                        @else
                                        <a class="btn btn-icon btn-outline-primary mr-3" href="{{ route('news.edit',$news_value->id) }}"><i class="ik ik-edit-2"></i></a>
                                        @endif
                                        @endcan
                                        @can('news-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['news.destroy', $news_value->id],'style'=>'display:inline']) !!}
                                        {!!
                                        Form::button('<i class="ik ik-trash-2"></i>', array(
                                                    'type' => 'submit',
                                                    'class'=> 'btn btn-icon btn-outline-danger',
                                                    'onclick'=>'return confirm("Are you sure Delete?")'))
                                        !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! $news->links() !!}
@endsection

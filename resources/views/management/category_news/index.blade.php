@extends('management.themekit.dashboard')

@section('pageTitle')
News Category Management
@endsection

@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h2>News Category Management</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('management') }}"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active"><a href="{{ route('category_news.index') }}">News Category Management</a></li>
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
                        <a class="btn btn-success" href="{{ route('category_news.create') }}"> Create Category</a>
                    </div>
                    @endcan
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success mt-2 mb-0">{{ $message }}</div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger mt-2 mb-0">
                        <strong>Whoops!</strong> There were some problems with your input.<br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="card-body p-0 table-border-style">
                    <div class="table-responsive">
                        <table class="table table-inverse table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news_categorys as $value)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>
                                        <a class="btn btn-icon btn-outline-success mr-3" href="{{ route('category_news.show',$value->id) }}"><i class="ik ik-eye"></i></a>
                                        @can('news-edit')
                                        <a class="btn btn-icon btn-outline-primary mr-3" href="{{ route('category_news.edit',$value->id) }}"><i class="ik ik-edit-2"></i></a>
                                        @endcan
                                        @can('news-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['category_news.destroy', $value->id],'style'=>'display:inline']) !!}
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
    {!! $news_categorys->links() !!}
@endsection

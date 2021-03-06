@extends('management.themekit.dashboard')
@section('pageTitle')
Create new Category
@endsection

@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-file-text bg-blue"></i>
                <div class="d-inline">
                    <h2>Create new News</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('management') }}"><i class="ik ik-home"></i></a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('category_news.index') }}">Category Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create new Category</li>
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
        <form class="forms-sample" action="{{ route('category_news.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputTitle">Name</label>
                            {!! Form::text('name', old('name', null), array('id'=>'name','placeholder' => 'Name','class' => 'form-control','required' => 'required')) !!}
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                    <a class="btn btn-dark" href="{{ route('category_news.index') }}"> Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('csspage')

@endsection
@section('scriptpage')

@endsection

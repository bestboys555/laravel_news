@extends('management.themekit.dashboard')
@section('pageTitle')
Create New Permision
@endsection

@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-file-text bg-blue"></i>
                <div class="d-inline">
                    <h2>Create New Permision</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('management') }}"><i class="ik ik-home"></i></a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('perm.index') }}">Products Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create New Permision</li>
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
        <form class="forms-sample" action="{{ route('perm.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputTitle">Permission Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Description</label>
                            <input type="text" name="description" value="{{ old('description')}}" class="form-control" placeholder="description">
                        </div>
                        <div class="form-group">
                            <label for="roles">Ref Permission</label>
                            {!! Form::select('ref_id', $perms_select, old('ref_id') , array('class' => 'form-control select2', 'placeholder' => '')) !!}
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a class="btn btn-dark" href="{{ route('perm.index') }}"> Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('csspage')
<link rel="stylesheet" href="{!! asset('plugins/summernote/dist/summernote-bs4.css') !!}">
@endsection
@section('scriptpage')
<script src="{!! asset('/plugins/sweetalert/dist/sweetalert.min.js') !!}"></script>
<script src="{!! asset('/plugins/summernote/dist/summernote-bs4.min.js') !!}"></script>
<script src="{!! asset('/js/layouts.js') !!}"></script>
@endsection

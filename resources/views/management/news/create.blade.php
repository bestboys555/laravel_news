@extends('management.themekit.dashboard')
@section('pageTitle')
Create new News
@endsection

@section('content')
<?php
$ref_id_value = isset($ref_id) ? $ref_id : '';
?>
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
                    <li class="breadcrumb-item active"><a href="{{ route('news.index') }}">News Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create new News</li>
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
    <form class="forms-sample" action="{{ route('news.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputTitle">Name</label>
                        {!! Form::text('name', old('name', null), array('id'=>'name','placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label for="roles">Category</label>
                        {!! Form::select('cat_id', $category, old('cat_id',null) , array('class' => 'form-control select2', 'placeholder' => '')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Detail</label>
                        <textarea class="form-control html-editor" id="summernote" name="detail" cols="50">{{ old('detail', null) }}</textarea>
                    </div>
                    <div class="form-group">
                        <div id="myDropzone" class="dropzone" route-data="{{ route('news.upload_file') }}"></div>
                    </div>
                    <div id="show_doc" route-data="{{ route('news.show_doc') }}" route-data-sortable="{{ route('news.doc_sortable') }}" class="row">
                    </div>
                    <div id="show_pic" route-data="{{ route('news.show_pic') }}" route-data-sortable="{{ route('news.pic_sortable') }}" class="row">
                    </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                @if (isset($ref_id))
                <a class="btn btn-dark" href="{{ route('news.category', ['id' => $ref_id]) }}"> Back</a>
                 @else
                <a class="btn btn-dark" href="{{ route('news.index') }}"> Back</a>
                @endif
                {!! Form::hidden('ref_id', $ref_id_value, array('id'=>'ref_id')) !!}
                {!! Form::hidden('table_id', null, array('id'=>'table_id')) !!}
            </div>
        </div>
    </form>
    </div>
</div>
@endsection

@section('csspage')
<link rel="stylesheet" href="{!! asset('plugins/summernote/summernote-0.8.16-dist/summernote.min.css') !!}">
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
<link rel="stylesheet" href="{!! asset('css/dropzone.css') !!}">
<link rel="stylesheet" href="{!! asset('css/dropzone_custom.css') !!}">
<link rel="stylesheet" href="{!! asset('css/paperclip.css') !!}">
<link rel="stylesheet" href="{!! asset('plugins/jquery-ui-1.12.1/jquery-ui.css') !!}">
@endsection
@section('scriptpage')
<script src="{!! asset('plugins/sweetalert/dist/sweetalert.min.js') !!}"></script>
<script src="{!! asset('plugins/summernote/summernote-0.8.16-dist/summernote.min.js') !!}"></script>
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<script src="{!! asset('js/dropzone.js') !!}"></script>
<script src="{!! asset('js/upload_pic.js') !!}"></script>
<script>
function load_data_pic(){
@if (!empty(old('picture')))
    @foreach (old('picture') as $date => $array)
    $("#alt_{{ $date }}").val("{{ $array['title'] }}");
    @endforeach
@endif
}
function load_data_file(){
@if (!empty(old('document')))
    @foreach (old('document') as $date => $array)
    $("#file_alt_{{ $date }}").val("{{ $array['title'] }}");
    @endforeach
@endif
}
</script>
@endsection

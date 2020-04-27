@extends('management.themekit.dashboard')

@section('pageTitle')
Edit {{ $role->name }}
@endsection

@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-user bg-blue" ><span class="ik ik-edit-2" style="font-size: 12px;"></span></i>
                <div class="d-inline">
                    <h2>Edit {{ $role->name }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('management') }}"><i class="ik ik-home"></i></a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">Role Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit {{ $role->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
        {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    {!! Form::text('name', old('name', $role->name), array('id'=>'name','placeholder' => 'Name','class' => 'form-control','required' => 'required')) !!}
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="sub-title">Permission</h4>
                        <div id="treeview_container" class="hummingbird-treeview well h-scroll-large">
                            <ul id="treeview" class="hummingbird-base">
                                @foreach($permission->where('ref_id',0) as $value)
                                <li><i class="fa fa-minus"></i>
                                    <label> {{ Form::checkbox('permission[]', $value->id, false, array('id' => 'node_'.$value->id)) }} {!!$value->name!!}</label>
                                    <ul style="display: block;">
                                    @foreach($permission->where('ref_id',$value->id) as $child)
                                        @include('management.roles.child_permission_tree',['child_permission'=>$child])
                                    @endforeach
                                    </ul>
                                <li>
                               @endforeach
                            </ul>
                        </div>
                        <div class="card-footer text-left">
                            <a class="btn btn-primary  mr-2" id="checkAll">Check All</a>
                            <a class="btn btn-primary" id="uncheckAll">Uncheck All</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success mr-2">Submit</button>
                <a class="btn btn-dark" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('csspage')
<link rel="stylesheet" href="{!! asset('/plugins/select2/dist/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! asset('/plugins/summernote/dist/summernote-bs4.css') !!}">
<link rel="stylesheet" href="{!! asset('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') !!}">
<link rel="stylesheet" href="{!! asset('/plugins/mohithg-switchery/dist/switchery.min.css') !!}">
<link rel="stylesheet" href="{!! asset('css/Collapsible-Tree-View/hummingbird-treeview-1.3.css') !!}">
@endsection
@section('scriptpage')
<script src="{!! asset('/plugins/select2/dist/js/select2.min.js') !!}"></script>
<script src="{!! asset('/plugins/summernote/dist/summernote-bs4.min.js') !!}"></script>
<script src="{!! asset('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') !!}"></script>
<script src="{!! asset('/plugins/jquery.repeater/jquery.repeater.min.js') !!}"></script>
<script src="{!! asset('/plugins/mohithg-switchery/dist/switchery.min.js') !!}"></script>
<script src="{!! asset('/js/Collapsible-Tree-View/hummingbird-treeview-1.3.js') !!}"></script>
<script>
$("#treeview").hummingbird();
@foreach($rolePermissions as $value)
$("#treeview").hummingbird("checkNode",{attr:"id",name: "node_{{ $value }}",state:true});
@endforeach
$( "#checkAll" ).click(function() {
    $("#treeview").hummingbird("checkAll");
});
$( "#uncheckAll" ).click(function() {
    $("#treeview").hummingbird("uncheckAll");
});
</script>
@endsection

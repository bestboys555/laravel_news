@extends('management.themekit.dashboard')

@section('pageTitle')
Permision Management
@endsection

@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h2>Permision Management</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('management') }}"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active"><a href="{{ route('perm.index') }}">Permision Management</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-block">
                    @can('perm-create')
                    <div class="text-right">
                        <a class="btn btn-success" href="{{ route('perm.create') }}"> Create New Permision</a>
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
                                    <th>Permission Name</th>
                                    <th>Description</th>
                                    <th>Ref Permission</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perms as $perm)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $perm->name }}</td>
                                    <td>{{ $perm->description }}</td>
                                    <td>{{ get_field('permissions','id',$perm->ref_id,'name') }}</td>
                                    <td>
                                        <a class="btn btn-icon btn-outline-success mr-3" href="{{ route('perm.show',$perm->id) }}"><i class="ik ik-eye"></i></a>
                                        @can('perm-edit')
                                        <a class="btn btn-icon btn-outline-primary mr-3" href="{{ route('perm.edit',$perm->id) }}"><i class="ik ik-edit-2"></i></a>
                                        @endcan
                                        @can('perm-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['perm.destroy', $perm->id],'style'=>'display:inline']) !!}
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
    {!! $perms->links() !!}
@endsection

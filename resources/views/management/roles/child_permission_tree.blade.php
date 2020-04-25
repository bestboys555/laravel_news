<?php
    $permission_rs = $permission->where('ref_id',$child_permission->id)
?>
<li>
    @if (count($permission_rs) > 0)
    <i class="fa fa-minus"></i>
    @endif
    <label> {{ Form::checkbox('permission[]', $child_permission->id, false, array('id' => 'node_'.$child_permission->id)) }} {!!$child_permission->name!!}</label>
    <ul style="display: block;">
            @foreach($permission_rs as $child)
            @include('management.roles.child_permission_tree',['child_permission'=>$child])
         @endforeach
    </ul>
</li>

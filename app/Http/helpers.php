<?php
function cover_news($id)
{
    $no_image="/images/no-images.png";
    $fetch_userTo = DB::table('picture')
    ->where('ref_table_id', $id)
    ->where('is_cover', '1')
    ->get();

    $count = $fetch_userTo->count();
    if($count!=0){
        $thumb_pic = $fetch_userTo[0]->name_thumb;
        $photos_path = public_path('/images/news/'.$id.'/');
        $photos_path_return ='/images/news/'.$id.'/';
        if (file_exists( $photos_path . $thumb_pic)) {
            return $photos_path_return. $thumb_pic;
        }else{
            return $no_image;
        }
    }else{
        return $no_image;
    }
}

function images_news($id,$alt)
{
    $fetch_userTo = DB::table('picture')
    ->where('ref_table_id', $id)
    ->where('is_cover', '1')
    ->get();

    $count = $fetch_userTo->count();
    if($count!=0){
        $thumb_pic = $fetch_userTo[0]->name;
        $photos_path = public_path('/images/news/'.$id.'/');
        $photos_path_return ='/images/news/'.$id.'/';
        if (file_exists( $photos_path . $thumb_pic)) {

            return "<img src=\"".$photos_path_return. $thumb_pic."\" class=\"card-img-top pb-4\" alt=\"".$alt."\" >";
        }else{
            return '';
        }
    }else{
        return '';
    }
}

function photo($id)
{
    $fetch_userTo = DB::table('users')
    ->where('id', $id)
    ->get();
    $old_avatar_pic = $fetch_userTo[0]->avatar_pic;
    $photos_path = public_path('/images/avatar/');
    if ($old_avatar_pic!=null and file_exists( $photos_path . $old_avatar_pic)) {
        return '/images/avatar/' . $old_avatar_pic;
    } else {
        return '/images/avatar/no-avatar.png';
    }
}

function get_field($table, $column_name, $id, $return_id) {
    if($id!=null or $id!=0){
    $fetch = DB::table($table)
    ->where($column_name, $id)
    ->get();
    $value = $fetch[0]->$return_id;
    return $value;
    }
}

function get_table_all($table) {
    $fetch = DB::table($table)
    ->get();
    return $fetch;
}

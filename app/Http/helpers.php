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

function images_news($id,$alt,$class)
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
            return "<img src=\"".$photos_path_return. $thumb_pic."\" class=\"".$class."\" alt=\"".$alt."\" >";
        }else{
            return '';
        }
    }else{
        return '';
    }
}

function url_file_picture($id, $folder, $thumb)
{
    $fetch_userTo = DB::table('picture')
    ->where('id', $id)
    ->first();
    if($fetch_userTo){
        $thumb_pic = $fetch_userTo->name;
        $photos_path = public_path('/images/news/'.$folder.'/');
        $photos_path_return ='/images/news/'.$folder.'/';
        if (file_exists( $photos_path . $thumb_pic)) {
            return $photos_path_return. $thumb . $thumb_pic;
        }else{
            return '';
        }
    }else{
        return '';
    }
}

function url_file_document($id, $folder)
{
    $fetch_filedocument = DB::table('filedocument')
    ->where('id', $id)
    ->first();

    if($fetch_filedocument){
        $name = $fetch_filedocument->name;
        $photos_path = public_path('/images/news/'.$folder.'/');
        $photos_path_return ='/images/news/'.$folder.'/';
        if (file_exists( $photos_path . $name)) {
            return $photos_path_return . $name;
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

function get_file_size($file) {
    if (file_exists($file)) {
        $size = File::size($file); // bytes
        $base = log($size) / log(1024);
        $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
        return round(pow(1024, $base - floor($base)), 2) . $suffixes[floor($base)];
        //$filesize = round($filesize / 1024, 2); // kilobytes with two digits
    }
}

function get_extenstion($file) {
    if (file_exists($file)) {
        $show="";
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        if($extension=="doc" or $extension=="docx"){
            $show='<i class="far fa-file-word text-info"></i>';
        }else if($extension=="xls" or $extension=="xlsx"){
            $show='<i class="far fa-file-excel text-success"></i>';

        }else if($extension=="pdf"){
            $show='<i class="far fa-file-pdf text-danger"></i>';

        }
        return $show;
    }
}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'picture';
    protected $fillable = [
        'name', 'name_thumb', 'title' ,'folder','table_name','ref_table_id','is_cover','section_order','tmp_key'
    ];
}

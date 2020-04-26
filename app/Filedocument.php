<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filedocument extends Model
{
    protected $table = 'filedocument';
    protected $fillable = [
        'name', 'title' ,'folder','table_name','ref_table_id','section_order','tmp_key'
    ];
}

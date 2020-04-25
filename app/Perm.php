<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perm extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
        'name', 'description', 'ref_id'
    ];
}

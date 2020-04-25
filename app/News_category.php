<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News_category extends Model
{
    protected $table = 'news_category';
    protected $fillable = [
        'name'
    ];
}

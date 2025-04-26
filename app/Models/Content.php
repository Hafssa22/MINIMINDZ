<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'title',
        'category',
        'media_type',
        'media_path',
        'poster_path',
    ];
}

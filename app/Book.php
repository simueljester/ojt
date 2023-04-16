<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    //
    protected $table = 'books';

    protected $fillable = [
        'title', 'description', 'cover','deleted_at','archived_at'
    ];

    protected $dates = ['deleted_at','archived_at'];
}

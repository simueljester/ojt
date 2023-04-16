<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookAssignment extends Model
{
    //
    protected $table = 'book_assignments';

    protected $fillable = [
        'user_id', 'book_id', 'assigned_by_id'
    ];
}

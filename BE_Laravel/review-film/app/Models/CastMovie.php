<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CastMovie extends Pivot
{
    protected $table = 'cast_movie';

    protected $fillable = ['name', 'cast_id' , 'movie_id'];
}
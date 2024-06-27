<?php

// app/Models/Movie.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['id', 'title', 'summary', 'year', 'poster', 'genre_id'];

    // Relasi dengan Genre
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }
}


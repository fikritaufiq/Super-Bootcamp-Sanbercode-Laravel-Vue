<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'summary', 'poster', 'year'];

    public function casts()
    {
        return $this->belongsToMany(Cast::class, 'cast_movie', 'movie_id', 'cast_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
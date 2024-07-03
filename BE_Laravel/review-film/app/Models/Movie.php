<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Movie extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'movies';

    protected $fillable = ['title', 'summary', 'year', 'poster', 'genre_id'];
}

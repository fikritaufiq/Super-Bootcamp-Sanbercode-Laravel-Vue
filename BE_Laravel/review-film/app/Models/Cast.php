<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Cast extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'cast';

    protected $fillable=['name', 'age', 'bio'];
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];
    protected $primaryKey = 'id_uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}


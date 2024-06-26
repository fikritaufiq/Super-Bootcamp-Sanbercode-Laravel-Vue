<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $fillable = ['name', 'bio', 'age'];
    protected $primaryKey = 'id_uuid'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 


    public $timestamps = true;
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Roles extends Model
{
    use HasFactory, HasUuids;

    // Menentukan tabel yang digunakan (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'roles';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'name', // Nama role
    ];
}
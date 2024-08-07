<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name']; // Kolom yang dapat diisi

    // Definisikan relasi dengan model Books
    public function books()
    {
        return $this->hasMany(Books::class, 'category_id', 'id'); // Menghubungkan category_id di tabel books dengan id di tabel categories
    }
}
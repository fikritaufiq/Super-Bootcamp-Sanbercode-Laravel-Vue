<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Book extends Model
{
    use HasFactory, HasUuids;

    protected $table="books";
    
    protected $fillable = [
        'title',
        'summary',
        'image',
        'stok',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'book_id', 'id');
    }
}

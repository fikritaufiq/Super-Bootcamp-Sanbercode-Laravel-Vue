<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Books extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['title', 'summary', 'image', 'stok', 'category_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid(); // Menghasilkan UUID secara otomatis
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
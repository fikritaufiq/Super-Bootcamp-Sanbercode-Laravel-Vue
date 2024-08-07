<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Books;

class BooksSeeder extends Seeder
{
    public function run()
    {
        $categoryId = 'dc461175-a5d8-45fd-9a72-4df0193e3bf8';

        Books::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'title' => 'Perahu Kertas',
            'summary' => 'Namanya Kugy, mungil, pengkhayal, dan berantakan...',
            'image' => 'http://localhost/storage/images/1722139171-image.jpg',
            'stok' => 20,
            'category_id' => $categoryId,
        ]);

        Books::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'title' => 'Ayah',
            'summary' => 'Sabari memiliki 3 sahabat...',
            'image' => 'http://localhost/storage/images/1722139305-image.jpg',
            'stok' => 30,
            'category_id' => $categoryId,
        ]);
    }
}
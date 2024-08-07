<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // Pastikan model Category diimpor

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['id' => (string) \Illuminate\Support\Str::uuid(), 'name' => 'Novel']);
        Category::create(['id' => (string) \Illuminate\Support\Str::uuid(), 'name' => 'Manga']);
        Category::create(['id' => (string) \Illuminate\Support\Str::uuid(), 'name' => 'Komik']);
        // Tambahkan kategori lainnya sesuai kebutuhan
    }
}
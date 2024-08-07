<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category; // Pastikan ini ada

class CategoryController extends Controller
{
    // Mendapatkan semua kategori
    public function index()
    {
        $categories = Category::all(); // Mengambil semua kategori
        return response()->json(['message' => 'Berhasil Tampil semua kategori', 'data' => $categories], 200);
    }

    // Mendapatkan detail kategori
    public function show($id)
    {
        // Mengambil kategori berdasarkan ID dan memuat relasi dengan buku
        $category = Category::with('books')->findOrFail($id); 

        // Menyusun respons dengan menambahkan book_id
        $listBooks = $category->books->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'summary' => $book->summary,
                'image' => $book->image,
                'stok' => $book->stok,
                'book_id' => $book->id, // Menambahkan book_id
                'created_at' => $book->created_at,
                'updated_at' => $book->updated_at,
            ];
        });

        return response()->json([
            'message' => "Berhasil Detail data dengan id $id",
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
                'list_books' => $listBooks // Mengambil daftar buku yang terkait
            ]
        ], 200);
    }

    // Menambahkan kategori
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $category = Category::create($request->only('name'));

        return response()->json(['message' => 'Kategori berhasil ditambahkan'], 201);
    }

    // Mengupdate kategori
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $category = Category::findOrFail($id);
        $category->update($request->only('name'));

        return response()->json(['message' => "Berhasil melakukan update kategori id : $id"], 201);
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => "Data dengan id : $id berhasil terhapus"], 200);
    }
}
<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Books;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    // Mendapatkan semua buku
    public function index()
    {
        $books = Books::with('category')->get(); // Mengambil semua buku dengan kategori
        return response()->json(['message' => 'Data berhasil ditampilkan', 'data' => $books], 200);
    }

    // Mendapatkan detail buku
    public function show($id)
    {
        $book = Books::with('category')->findOrFail($id); // Mengambil detail buku
        return response()->json(['message' => 'Data Detail ditampilkan', 'data' => $book], 200);
    }

    // Menambahkan buku
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'stok' => 'required|integer',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'category_id' => 'required|uuid|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $path = $request->file('image')->store('images', 'public');

        $book = Books::create([
            'title' => $request->title,
            'summary' => $request->summary,
            'stok' => $request->stok,
            'image' => $path,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => $book], 201);
    }

    // Mengupdate buku
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'stok' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'category_id' => 'required|uuid|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $book = Books::findOrFail($id);
        $book->update($request->only('title', 'summary', 'stok', 'category_id'));

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $book->image = $path;
            $book->save();
        }

        return response()->json(['message' => 'Data berhasil diupdate', 'data' => $book], 200);
    }

    // Menghapus buku
    public function destroy($id)
    {
        $book = Books::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Data berhasil didelete'], 200);
    }
}
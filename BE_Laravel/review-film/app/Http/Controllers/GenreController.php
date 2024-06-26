<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return response()->json(['message' => 'tampil data berhasil', 'data' => $genres]);
    }

    public function store(StoreGenreRequest $request)
    {
        Genre::create($request->validated());
        return response()->json(['message' => 'Tambah Genre berhasil']);
    }

    public function show($id)
    {
        $genre = Genre::findOrFail($id);
        return response()->json(['message' => 'Detail Data Genre', 'data' => $genre]);
    }

    public function update(UpdateGenreRequest $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->update($request->validated());
        return response()->json(['message' => 'Update Genre berhasil']);
    }

    public function destroy($id)
    {
        Genre::destroy($id);
        return response()->json(['message' => 'berhasil Menghapus Genre']);
    }
}

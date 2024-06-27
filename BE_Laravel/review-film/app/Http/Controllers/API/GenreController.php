<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Requests\GenreRequest;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return response()->json([
            "message" => "Berhasil mendapatkan daftar genre",
            "data" => $genres
        ], 200);
    }

    public function store(GenreRequest $request)
    {
        $genre = Genre::create($request->validated());
        return response()->json([
            "message" => "Berhasil menambahkan genre",
            "data" => $genre
        ], 201);
    }

    public function show(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                "message" => "ID $id tidak ditemukan",
            ], 404);
        }

        return response()->json([
            "message" => "Berhasil mendapatkan detail data dengan ID $id",
            "data" => $genre
        ], 200);
    }

    public function update(GenreRequest $request, string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                "message" => "ID $id tidak ditemukan",
            ], 404);
        }

        $genre->update($request->validated());

        return response()->json([
            "message" => "Berhasil memperbarui genre dengan ID : $id",
            "data" => $genre
        ], 200);
    }

    public function destroy(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                "message" => "ID $id tidak ditemukan",
            ], 404);
        }

        $genre->delete();

        return response()->json([
            "message" => "Berhasil menghapus genre dengan ID : $id",
        ], 200);
    }
}

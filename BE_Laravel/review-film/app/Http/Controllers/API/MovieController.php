<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function store(MovieRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('poster')) {
            $imageName = time().'-poster.'.$request->poster->extension();
            $request->poster->storeAs('public/images', $imageName);
            $path = env('APP_URL') . '/storage/images/';
            $data['poster'] = $path.$imageName;
        }

        Movie::create($data);

        return response()->json([
            "message" => "Data berhasil ditambahkan"
        ], 201);
    }

    public function index()
    {
        $movies = Movie::all();

        return response()->json([
            "message" => "Berhasil mendapatkan daftar movie",
            "data" => $movies
        ]);
    }

    public function show(string $id)
    {
        $movie = Movie::with('casts', 'reviews')->find($id);

        if (!$movie) {
            return response()->json([
                "message" => "Movie dengan ID $id tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "message" => "Detail data movie dengan ID $id",
            "data" => $movie
        ]);
    }

    public function update(string $id, MovieRequest $request)
    {
        $data = $request->validated();

        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                "message" => "Movie dengan ID $id tidak ditemukan"
            ], 404);
        }

        if ($request->hasFile('poster')) {
            // Hapus gambar lama jika ada
            if ($movie->poster) {
                $nameImage = basename($movie->poster);
                Storage::delete('public/images/' . $nameImage);
            }

            // Upload gambar baru
            $imageName = time().'-poster.'. $request->poster->extension();
            $request->poster->storeAs('public/images', $imageName);
            $path = env('APP_URL').'/storage/images/';
            $data['poster'] = $path.$imageName;
        }

        $movie->update($data);

        return response()->json([
            "message" => "Movie dengan ID $id berhasil diperbarui"
        ], 201);
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                "message" => "Movie dengan ID $id tidak ditemukan"
            ], 404);
        }

        // Hapus gambar dari storage jika ada
        if ($movie->poster) {
            $nameImage = basename($movie->poster);
            Storage::delete('public/images/' . $nameImage);
        }

        $movie->delete();

        return response()->json([
            "message" => "Movie dengan ID $id berhasil dihapus"
        ]);
    }


}

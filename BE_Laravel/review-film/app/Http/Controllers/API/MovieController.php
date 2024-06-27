<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Movie;
use App\Http\Requests\MovieRequest;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        return response()->json([
            "message" => "Tampil data berhasil",
            "data" => $movies
        ], 200);
    }

    public function store(MovieRequest $request)
    {
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters');
        } else {
            $posterPath = null;
        }

        $movie = Movie::create([
            'id' => $request->id,
            'title' => $request->title,
            'summary' => $request->summary,
            'year' => $request->year,
            'poster' => $posterPath,
            'genre_id' => $request->genre_id
        ]);

        return response()->json([
            "message" => "Tambah Movie berhasil",
            "data" => $movie
        ], 201);
    }

    public function show($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                "message" => "Detail Data Movie",
                "data" => []
            ], 404);
        }

        return response()->json([
            "message" => "Detail Data Movie",
            "data" => $movie
        ], 200);
    }

    public function update(MovieRequest $request, $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                "message" => "Movie dengan ID $id tidak ditemukan"
            ], 404);
        }
        if ($request->hasFile('poster')) {
            if ($movie->poster) {
                Storage::delete($movie->poster);
            }
            $posterPath = $request->file('poster')->store('posters');
        } else {
            $posterPath = $movie->poster;
        }

        $movie->fill([
            'title' => $request->title,
            'summary' => $request->summary,
            'year' => $request->year,
            'poster' => $posterPath,
            'genre_id' => $request->genre_id
        ])->save();

        return response()->json([
            "message" => "Update Movie berhasil",
            "data" => $movie
        ], 200);
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                "message" => "Movie dengan ID $id tidak ditemukan"
            ], 404);
        }

        if ($movie->poster) {
            Storage::delete($movie->poster);
        }

        $movie->delete();

        return response()->json([
            "message" => "Berhasil Menghapus movie"
        ], 200);
    }
}


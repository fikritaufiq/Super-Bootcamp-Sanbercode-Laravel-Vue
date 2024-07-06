<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CastMovie;
use App\Models\Cast;
use App\Models\Movie;
use App\Http\Requests\CastMovieRequest;

class CastMovieController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth:api')->only('store'); // Adjust as per your requirements
    }

    public function index()
    {
        $castMovies = CastMovie::all();

        return response()->json([
            "message" => "Berhasil mendapatkan daftar Cast Movie",
            "data" => $castMovies
        ], 200);
    }

    public function store(CastMovieRequest $request)
{
    if (!auth()->check()) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    $validated = $request->validated();

    // Cari cast dan movie berdasarkan ID
    $cast = Cast::findOrFail($validated['cast_id']);
    $movie = Movie::findOrFail($validated['movie_id']);

    // Simpan hubungan cast dan movie
    $movie->casts()->attach($cast);

    return response()->json([
        'message' => 'Berhasil menambahkan hubungan cast dengan movie',
        'data' => [
            'cast' => $cast,
            'movie' => $movie,
        ]
        ], 201);
    }

    public function show($id)
    {
        $castMovie = CastMovie::find($id);

        if (!$castMovie) {
            return response()->json([
                "message" => "Cast Movie dengan ID $id tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "message" => "Detail Cast Movie dengan ID $id",
            "data" => $castMovie
        ], 200);
    }

    public function update(CastMovieRequest $request, $id)
    {
        $castMovie = CastMovie::find($id);

        if (!$castMovie) {
            return response()->json([
                "message" => "Cast Movie dengan ID $id tidak ditemukan"
            ], 404);
        }

        $castMovie->update($request->all());

        return response()->json([
            "message" => "Berhasil memperbarui Cast Movie dengan ID $id",
            "data" => $castMovie
        ], 200);
    }

    public function destroy($id)
    {
        $castMovie = CastMovie::find($id);

        if (!$castMovie) {
            return response()->json([
                "message" => "Cast Movie dengan ID $id tidak ditemukan"
            ], 404);
        }

        $castMovie->delete();

        return response()->json([
            "message" => "Berhasil menghapus Cast Movie dengan ID $id"
        ], 200);
    }
}

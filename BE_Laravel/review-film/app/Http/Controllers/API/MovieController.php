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
        $data = $request->validated();

        if ($request->hasFile('poster')) {
            $imageName = time().'.'.$request->poster->extension();
            $request->poster->storeAs('public/images', $imageName);
            $path = env('APP_URL') . '/storage/images/';
            $data['poster'] = $path . $imageName;
        }

        $movie = Movie::create($data);

        return response()->json([
            "message" => "Tambah Movie berhasil",
            "data" => $movie
        ], 201);
    }

    public function show(string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                "message" => "Movie dengan ID $id tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "message" => "Detail Data Movie",
            "data" => $movie
        ]);
    }

    public function update(string $id, MovieRequest $request)
    {
        $data = $request->validated();
        $movieData = Movie::find($id);

        if (!$movieData) {
            return response()->json([
                "message" => "Movie dengan ID $id tidak ditemukan"
            ], 404);
        }

        if ($request->hasFile('poster')) {
            if ($movieData->poster) {
                $nameImage = basename($movieData->poster);
                Storage::delete('public/images/' . $nameImage);
            }
            $imageName = time().'.'.$request->poster->extension();
            $request->poster->storeAs('public/images', $imageName);
            $path = env('APP_URL') . '/storage/images/';
            $data['poster'] = $path . $imageName;
        } else {
            $data['poster'] = $movieData->poster;
        }

        $movieData->update($data);

        return response()->json([
            "message" => "Update Movie berhasil",
            "data" => $movieData
        ], 201);
    }

    public function destroy($id)
    {
        $movieData = Movie::find($id);

        if ($movieData->poster) {
            $nameImage = basename($movieData->poster);
            Storage::delete('public/images/'.$nameImage);
        }

        $movieData->delete();

        return response()->json([
            "message" => "Berhasil Menghapus movie",
        ], 200);
    }
}

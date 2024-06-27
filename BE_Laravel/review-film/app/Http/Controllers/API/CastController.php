<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cast;
use App\Http\Requests\CastRequest;

class CastController extends Controller
{
    public function index()
    {
        $casts = Cast::all();

        return response()->json([
            "message" => "Berhasil mendapatkan daftar Cast",
            "data" => $casts
        ], 200);
    }

    public function store(CastRequest $request)
    {
        $cast = Cast::create($request->validated());
        return response()->json([
            "message" => "Berhasil menambahkan Cast",
            "data" => $cast
        ], 201);
    }

    public function show(string $id)
    {
        $cast = Cast::find($id);

        if(!$cast){
            return response()->json([
                "message" => "ID $id tidak ditemukan",
            ], 404);
        }

        return response()->json([
            "message" => "Berhasil mendapatkan detail data dengan ID $id",
            "data" => $cast
        ], 200);
    }

    public function update(CastRequest $request, string $id)
    {
        $cast = Cast::find($id);

        if(!$cast){
            return response()->json([
                "message" => "ID $id tidak ditemukan",
            ], 404);
        }

        $cast->update($request->validated());

        return response()->json([
            "message" => "Berhasil memperbarui Cast dengan ID : $id",
            "data" => $cast
        ], 200);
    }

    public function destroy(string $id)
    {
        $cast = Cast::find($id);

        if(!$cast){
            return response()->json([
                "message" => "ID $id tidak ditemukan",
            ], 404);
        }

        $cast->delete();

        return response()->json([
            "message" => "Berhasil menghapus Cast dengan ID : $id",
        ], 200);
    }
}

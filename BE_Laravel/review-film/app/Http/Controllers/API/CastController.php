<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CastRequest;
use App\Models\Cast;

class CastController extends Controller
{
    // public function __construct(){
    //     $this->middleware(['auth:api', 'isAdmin'])->only('index');
    // }

    public function index()
    {
        $casts = Cast::all();

        return response()->json([
            "message" => "Berhasil menampilkan daftar cast",
            "data" => $casts
        ], 200);
    }

    public function store(CastRequest $request)
    {
        Cast::create($request->all());

        return response()->json([
            "message" => "Berhasil menambahkan cast"
        ], 201);
    }

    public function show(string $id)
    {
       $cast = Cast::find($id);

       if (!$cast) {
        return response()->json([
            "message" => "ID $id tidak ditemukan"
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

       if (!$cast) {
        return response()->json([
            "message" => "ID $id tidak ditemukan"
        ], 404);
    }

        $cast->update($request->all());

        return response()->json([
            "message" => "Berhasil memperbarui cast dengan ID $id",
            "data" => $cast
        ], 200);
    }

    public function destroy(string $id)
    {
        $cast = Cast::find($id);

        if (!$cast) {
         return response()->json([
             "message" => "ID $id tidak ditemukan"
         ], 404);
        }
 
        $cast->delete();

        return response()->json([
            "message" => "Berhasil menghapus cast dengan ID : $id",
        ], 200);
     }

}
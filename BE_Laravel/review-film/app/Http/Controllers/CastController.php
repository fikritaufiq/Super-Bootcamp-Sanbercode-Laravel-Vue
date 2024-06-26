<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCastRequest;
use App\Http\Requests\UpdateCastRequest;
use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function index()
    {
        $casts = Cast::all();
        return response()->json(['message' => 'tampil data berhasil', 'data' => $casts]);
    }

    public function store(StoreCastRequest $request)
    {
        Cast::create($request->validated());
        return response()->json(['message' => 'Tambah Cast berhasil']);
    }

    public function show($id)
    {
        $cast = Cast::findOrFail($id);
        return response()->json(['message' => 'Detail Data Cast', 'data' => $cast]);
    }

    public function update(UpdateCastRequest $request, $id)
    {
        $cast = Cast::findOrFail($id);
        $cast->update($request->validated());
        return response()->json(['message' => 'Update Cast berhasil']);
    }

    public function destroy($id)
    {
        Cast::destroy($id);
        return response()->json(['message' => 'berhasil Menghapus Cast']);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\Roles;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Roles::all();

        return response()->json([
            "message" => "Berhasil mendapatkan daftar role",
            "data" => $roles
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles'
        ]);

        $role = Roles::create($request->all());

        return response()->json(['message' => 'Data berhasil ditambahkan'], 201);
    }

    public function show($id)
    {
        $role = Roles::find($id);

        if (!$role) {
            return response()->json([
                "message" => "Role dengan ID $id tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "message" => "Detail role dengan ID $id",
            "data" => $role
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id
        ]);

        $role = Roles::find($id);

        if (!$role) {
            return response()->json([
                "message" => "Role dengan ID $id tidak ditemukan"
            ], 404);
        }

        $role->update($request->all());

        return response()->json([
            "message" => "Berhasil memperbarui role dengan ID $id",
            "data" => $role
        ], 200);
    }

    public function destroy($id)
    {
        $role = Roles::find($id);

        if (!$role) {
            return response()->json([
                "message" => "Role dengan ID $id tidak ditemukan"
            ], 404);
        }

        $role->delete();

        return response()->json([
            "message" => "Berhasil menghapus role dengan ID $id"
        ], 200);
    }
}
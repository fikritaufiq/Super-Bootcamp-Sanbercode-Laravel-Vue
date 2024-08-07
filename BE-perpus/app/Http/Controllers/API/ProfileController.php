<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateOrCreate(Request $request)
    {
        // Validasi input
        $request->validate([
            'bio' => 'required|string',
            'age' => 'required|integer',
        ]);

        // Mendapatkan pengguna yang terautentikasi
        $user = $request->user();

        // Update atau buat profil
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id], // Kondisi pencarian
            [
                'bio' => $request->bio,
                'age' => $request->age,
            ]
        );

        return response()->json([
            'message' => 'Profile berhasil diubah',
            'data' => $profile
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Jika validasi gagal, kembalikan response error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $roleUser = User::where('name', 'user')->first();
        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleUser->id
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'User berhasil di register',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function getUser()
    {
    
    $currentUser = auth()->user();
    return response()->json([
        'message' => 'Profile berhasil ditampilkan',
        'user' => $currentUser
    ]);
    }

    public function login(Request $request)
    {
        // Validasi input dari request
        $credentials = request(['email', 'password']);
        
        // Coba melakukan login
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(
                [
                    'message' => 'User Invalid'
                ], 401);
        }

        $UserData = User::where('email',$request['email'])->first();
        // Dapatkan user yang sedang diautentikasi
        $token = JWTAuth::fromUser($UserData);

        return response()->json([
            'message' => 'User berhasil di register',
            'user' => $UserData,
            'token' => $token
        ]);
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'Logout berhasil']);
    }
}

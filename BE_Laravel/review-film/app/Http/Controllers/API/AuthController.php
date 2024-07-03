<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Roles;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        $roleUser = Roles::where('name', 'user')->first();

        if (!$roleUser) {
            return response()->json(['error' => 'Role user tidak ditemukan'], 404);
        }

        
        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $roleUser->id
            ]);
    
            $token = JWTAuth::fromUser($user);
    
            return response()->json([
                'message' => 'User berhasil di daftarkan',
                'user' => $user,
                'token' => $token
            ], 201);
    }

    public function login(Request $request)
    {
        // Validasi input dari request
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $userData = User::where('email', $request->email)->first();

        return response()->json([
            'user' => $userData,
            'token' => $token
        ]);
    } 

    public function getUser()
    {
        $currentuser = auth()->user();
        return response()->json([
            'message' => 'Profil pengguna berhasil ditampilkan',
            'user' => $currentuser
        ]);
    }

    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $currentUser = auth()->user();

        $userId = User::find($currentUser->id);

        $userId->name = $request['name'];

        $userId->save();

        return response()->json([
            'message' => 'Update user berhasil',
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logout berhasil']);
    }
}
    


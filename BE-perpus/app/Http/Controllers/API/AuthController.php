<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
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
            return response()->json(['error' => 'Role not found'], 404);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleUser->id,
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Register Berhasil',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function logout(Request $request)
    {
        \Log::info('Logout attempt', ['user' => auth()->user()]);
        try {
            auth()->logout();
            \Log::info('Logout successful');
            return response()->json(['message' => 'Logout berhasil']);
        } catch (\Exception $e) {
            \Log::error('Logout failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Logout gagal'], 500);
        }
    }

    public function getUser(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $role = $user->role; 

        return response()->json([
            'message' => 'berhasil get user',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'role' => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'created_at' => $role->created_at,
                    'updated_at' => $role->updated_at,
                ],
            ],
        ]);
    }

    public function deleteUser(Request $request)
    {
        $user = $request->user();
        $user->delete();

        return response()->json([
            'message' => 'Berhasil menghapus user'
        ]);
    }
}
<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Roles;
use App\Models\OtpCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;


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

        $user->generateOtpCode();
    
        $token = JWTAuth::fromUser($user);

        try {
            Mail::to($user->email)->queue(new RegisterMail($user));
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email registrasi: ' . $e->getMessage());
            // Anda bisa memutuskan apakah ingin mengembalikan respons error atau melanjutkan
            // return response()->json(['error' => 'Gagal mengirim email registrasi'], 500);
        }
    
            return response()->json([
                'message' => 'User berhasil di daftarkan',
                'user' => $user,
                'token' => $token
            ], 201);
    }

    public function generateOtpCode(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);
        
        $userData = User::where('email', $request->email)->first();

        $userData->generateOtpCode();

        return response()->json([
            'message' => 'OTP code berhasil generate ulang',
            'data' => $userData
        ]);
    }

    public function verifikasi(Request $request){
        $request->validate([
            'otp' => 'required'
        ]);

        //untuk cek apakah otp code di database sudah ada di table otp atau belum
        $otp_code = OtpCode::where('otp', $request->otp)->first();

        if(!$otp_code){
            return response()->json([
                'message' => 'OTP code tidak ditemukan',
                ], 404);
        }

        $now = Carbon::now();

        //check otp code apakah sudah kadaluarsa atau belum
        if($now > $otp_code->valid_until){
            return response()->json([
                'message' => 'OTP sudah tidak bisa lagi digunakan, silahkan generate ulang',
                ], 400);
        }

        //update User
        $user = User::find($otp_code->user_id);
        $user->email_verified_at = $now;
        $user->save();

        $otp_code->delete();
        return response()->json([
            'message' => 'OTP code berhasil di verifikasi'
        ]);
    }

    public function login(Request $request)
    {
        \Log::info('Login attempt', ['email' => $request->email]);
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'User Invalid'], 401);
        }

        $user = auth()->user();

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    } 

    public function getUser()
    {

        $user = auth()->user();

        $currentUser = User::with('Profile')->find($user->id);

        return response()->json([
            'message' => 'Profil pengguna berhasil ditampilkan',
            'user' => $currentUser
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
}
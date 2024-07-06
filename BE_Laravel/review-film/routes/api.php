<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\API\CastController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\CastMovieController;
use App\Http\Controllers\API\ReviewController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned to the "api"
| middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth:api'])->group(function () {
    // Your authenticated routes here
});

Route::prefix('v1')->group(function () {
    Route::apiResource('movie', MovieController::class); // Route movies to index method
    Route::apiResource('genre', GenreController::class);
    Route::apiResource('cast', CastController::class);
    Route::apiResource('role', RoleController::class);
    Route::apiResource('cast-movie', CastMovieController::class);
    Route::apiResource('review', ReviewController::class);
    
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
        Route::post('generate-otp-code', [AuthController::class, 'generateOtpCode'])->middleware('auth:api');
        Route::post('verifikasi-akun', [AuthController::class, 'verifikasi'])->middleware('auth:api');
    });
    Route::get('me', [AuthController::class, 'getUser'])->middleware('auth:api','isVerificationAccount');
    Route::post('update-user', [AuthController::class, 'updateUser'])->middleware('auth:api'.'isVerificationAccount');
    Route::post('profile', [ProfileController::class, 'store'])->middleware('auth:api');
    Route::get('get-profile', [ProfileController::class, 'index'])->middleware('auth:api','isVerificationAccount');
});

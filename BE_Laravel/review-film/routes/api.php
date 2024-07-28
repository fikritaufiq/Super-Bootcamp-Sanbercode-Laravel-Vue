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

Route::prefix('v1')->group(function () {
    // Rute publik
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
        Route::get('user', [AuthController::class, 'getUser'])->middleware('auth:api');
        Route::post('update-user', [AuthController::class, 'updateUser'])->middleware('auth:api');
    });

    // Rute yang memerlukan autentikasi
    Route::middleware('auth:api')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('generate-otp-code', [AuthController::class, 'generateOtpCode']);
            Route::post('verifikasi-akun', [AuthController::class, 'verifikasi']);
        });

        Route::get('me', [AuthController::class, 'getUser']);
        Route::post('update-user', [AuthController::class, 'updateUser']);
        Route::post('profile', [ProfileController::class, 'store']);

        // Rute yang memerlukan verifikasi akun
        Route::middleware('isVerificationAccount')->group(function () {
            Route::get('get-profile', [ProfileController::class, 'index']);
            
            Route::apiResource('movie', MovieController::class);
            Route::apiResource('genre', GenreController::class);
            Route::apiResource('cast', CastController::class);
            Route::apiResource('role', RoleController::class);
            Route::apiResource('cast-movie', CastMovieController::class);
            Route::apiResource('review', ReviewController::class);
        });
    });
});
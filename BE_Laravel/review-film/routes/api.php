<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\API\CastController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/movie', [MovieController::class, 'index']);
    Route::post('/movie', [MovieController::class, 'store']);
    Route::get('/movie/{id}', [MovieController::class, 'show']);
    Route::post('/movie/{id}', [MovieController::class, 'update']);
    Route::post('/movie/{id}', [MovieController::class, 'destroy']);
    
    Route::apiResource('genre', GenreController::class);
    Route::apiResource('cast', CastController::class);
});

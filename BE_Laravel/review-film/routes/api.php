<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\CastController;
use App\Http\Controllers\GenreController;
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
    Route::get('/cast', [CastController::class, 'index']);
    Route::post('/cast', [CastController::class, 'store']);
    Route::get('/cast/{id}', [CastController::class, 'show']);
    Route::post('/cast/{id}', [CastController::class, 'update'])->middleware('method:PUT');
    Route::post('/cast/{id}', [CastController::class, 'destroy'])->middleware('method:DELETE');

    Route::get('/genre', [GenreController::class, 'index']);
    Route::post('/genre', [GenreController::class, 'store']);
    Route::get('/genre/{id}', [GenreController::class, 'show']);
    Route::post('/genre/{id}', [GenreController::class, 'update'])->middleware('method:PUT');
    Route::post('/genre/{id}', [GenreController::class, 'destroy'])->middleware('method:DELETE');
});

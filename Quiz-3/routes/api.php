<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\PostController;

Route::prefix('api/v1')->group(function () {
    Route::get('post', [PostController::class, 'index']);
    Route::post('post', [PostController::class, 'store']);
    Route::get('post/{id}', [PostController::class, 'show']);
    Route::post('post/{id}?_method=PUT', [PostController::class, 'update']);
    Route::post('post/{id}?_method=DELETE', [PostController::class, 'destroy']);
});


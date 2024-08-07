<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\OwnerController;
use App\Http\Controllers\API\BorrowController; 
use App\Http\Controllers\API\CategoryController; 
use App\Http\Controllers\API\BookController; 

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
    // Rute publik untuk autentikasi
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
        Route::get('user', [AuthController::class, 'getUser'])->middleware('auth:api');
    });

    // Rute untuk mengelola buku (Public)
    Route::prefix('book')->group(function () {
        Route::get('/', [BookController::class, 'index']); // GET All Books (Public)
        Route::get('/{id}', [BookController::class, 'show']); // GET Detail Book (Public)

        Route::middleware('auth:api')->group(function () {
            Route::post('/', [BookController::class, 'store']); // POST Create Book (Owner)
            Route::put('/{id}', [BookController::class, 'update']); // POST Update Book (Owner)
            Route::delete('/{id}', [BookController::class, 'destroy']); // POST Delete Book (Owner)
        });
    });

    // Rute untuk mengelola kategori
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index']); // GET All Categories (Public)
        Route::get('/{id}', [CategoryController::class, 'show']); // GET Detail Category (Public)

        Route::middleware('auth:api')->group(function () {
            Route::post('/', [CategoryController::class, 'store']); // POST Create Category (Owner)
            Route::put('/{id}', [CategoryController::class, 'update']); // POST Update Category (Owner)
            Route::delete('/{id}', [CategoryController::class, 'destroy']); // POST Delete Category (Owner)
        });
    });

    // Rute yang memerlukan autentikasi
    Route::middleware('auth:api')->group(function () {
        Route::get('me', [AuthController::class, 'getUser']); // Mendapatkan informasi pengguna yang terautentikasi

        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index']); // Mendapatkan semua role
            Route::post('/', [RoleController::class, 'store']); // Membuat role baru
            Route::get('/{id}', [RoleController::class, 'show']); // Mendapatkan role tertentu
            Route::put('/{id}', [RoleController::class, 'update']); // Mengupdate role tertentu
            Route::delete('/{id}', [RoleController::class, 'destroy']); // Menghapus role tertentu
        });

        // Rute untuk mengelola profil pengguna
        Route::prefix('profile')->group(function () {
            Route::post('/', [ProfileController::class, 'updateOrCreate']); // Memperbarui atau membuat profil
        });

        // Rute yang hanya dapat diakses oleh role owner
        Route::middleware(['role:owner'])->group(function () {
            Route::get('/owner/dashboard', [OwnerController::class, 'dashboard']); // Mendapatkan dashboard owner
        });

        // Rute untuk mengelola peminjaman
        Route::prefix('borrow')->group(function () {
            Route::post('/', [BorrowController::class, 'store']); // POST Create/Update Borrow (Auth)
            Route::get('/', [BorrowController::class, 'index']); // GET All Borrows (Owner)
        });
    });
});
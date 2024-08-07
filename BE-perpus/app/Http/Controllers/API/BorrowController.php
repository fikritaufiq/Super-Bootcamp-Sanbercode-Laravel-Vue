<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Borrows; // Pastikan model Borrows diimpor
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BorrowController extends Controller
{
    // Mendapatkan semua peminjaman (hanya untuk owner)
    public function index()
    {
        $borrows = Borrows::with('user', 'book')->get(); // Mengambil semua peminjaman dengan informasi pengguna dan buku
        return response()->json(['message' => 'Semua Peminjaman', 'data' => $borrows], 200);
    }

    // Membuat atau memperbarui peminjaman
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|uuid|exists:books,id', // Validasi book_id
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Mengatur load_date dan borrow_date secara otomatis
        $load_date = now(); // Menggunakan waktu saat ini
        $borrow_date = now()->addDays(30); // Misalnya, pengembalian dalam 30 hari

        // Membuat peminjaman baru
        $borrow = Borrows::create([
            'load_date' => $load_date,
            'borrow_date' => $borrow_date,
            'book_id' => $request->book_id,
            'user_id' => $request->user()->id, // Ambil user_id dari autentikasi pengguna
        ]);

        return response()->json([
            'message' => 'Peminjaman berhasil dibuat',
            'data' => $borrow
        ], 201);
    }
}
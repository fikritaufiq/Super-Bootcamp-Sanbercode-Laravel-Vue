<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();

        return response()->json([
            "message" => "Berhasil mendapatkan daftar review",
            "data" => $reviews
        ], 200);
    }

    public function store(ReviewRequest $request)
    {
        $validatedData = $request->validated();
        Review::create($validatedData);

        return response()->json([
            "message" => "Berhasil menambahkan review"
        ], 201);
    }

    public function show($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                "message" => "Review dengan ID $id tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "message" => "Detail review dengan ID $id",
            "data" => $review
        ], 200);
    }

    public function update(ReviewRequest $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                "message" => "Review dengan ID $id tidak ditemukan"
            ], 404);
        }

        $validatedData = $request->validated();
        $review->update($validatedData);

        return response()->json([
            "message" => "Berhasil memperbarui review dengan ID $id",
            "data" => $review
        ], 200);
    }

    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                "message" => "Review dengan ID $id tidak ditemukan"
            ], 404);
        }

        $review->delete();

        return response()->json([
            "message" => "Berhasil menghapus review dengan ID $id"
        ], 200);
    }
}

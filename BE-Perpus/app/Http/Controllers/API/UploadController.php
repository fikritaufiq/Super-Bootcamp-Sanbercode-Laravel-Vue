<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Http\Controllers\Controller; // Added this line to import the Controller class

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // Log untuk melihat semua input yang diterima
        \Log::info($request->all());

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();

        return response()->json([
            'url' => $uploadedFileUrl,
        ]);
    }
}
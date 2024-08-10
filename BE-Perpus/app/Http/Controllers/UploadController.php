<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();

        return response()->json([
            'url' => $uploadedFileUrl,
        ]);
    }
}
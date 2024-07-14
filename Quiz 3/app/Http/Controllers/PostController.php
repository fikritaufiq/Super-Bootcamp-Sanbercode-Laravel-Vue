<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Menampilkan semua postingan
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    // Menginput data post baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = new Post([
            'id' => Str::uuid(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        $post->save();

        return response()->json($post, 201);
    }

    // Mendapatkan data post dengan id tertentu
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    // Mengubah data post dengan id tertentu
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
        ]);

        $post = Post::findOrFail($id);

        if ($request->has('title')) {
            $post->title = $request->title;
        }
        if ($request->has('content')) {
            $post->content = $request->content;
        }

        $post->save();

        return response()->json($post);
    }

    // Menghapus data post berdasarkan id
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(null, 204);
    }
}

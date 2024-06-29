<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'post_id' => 'required|uuid|exists:posts,id',
        ]);

        $comment = new Comment([
            'id' => Str::uuid(),
            'comment' => $request->comment,
            'post_id' => $request->post_id,
        ]);

        $comment->save();

        return response()->json($comment, 201);
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'string',
            'post_id' => 'uuid|exists:posts,id',
        ]);

        $comment = Comment::findOrFail($id);

        if ($request->has('comment')) {
            $comment->comment = $request->comment;
        }
        if ($request->has('post_id')) {
            $comment->post_id = $request->post_id;
        }

        $comment->save();

        return response()->json($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(null, 204);
    }
}

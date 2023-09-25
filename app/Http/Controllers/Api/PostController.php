<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json(['data' => $posts]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json(['post' => $post]);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array',
        ]);
        $post = post::create($validatedData);
        return response()->json(['message' => 'post successfully created', 'data' => $post], 201);
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array',
        ]);

        $post->update($validatedData);

        return response()->json(['message' => 'Post successfully updated', 'data' => $post], 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Post successfully deleted'], 200);
    }


}

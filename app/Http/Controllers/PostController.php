<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return Inertia::render('Posts/NotFound');
        }

        return Inertia::render('Posts/Show', ['post' => $post]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatePost($request);
        $post = post::create($validatedData);

        return Redirect::route('post.detail', ['id' => $post->id]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return Redirect::route('posts');
        }

        $validatedData = $this->validatePost($request);
        $post->update($validatedData);

        return Redirect::route('post.detail', ['id' => $post->id]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return Redirect::route('posts');
        }

        \Log::info('Destroying post', ['post' => $post]);
        $post->delete();
        \Log::info('Post destroyed', ['post' => $post]);

        return Redirect::route('posts');
    }

    private function validatePost(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array',
        ]);
    }
}

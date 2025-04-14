<?php
namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $site = $request->user()->sites()->first();

        if (! $site) {
            return response()->json(['message' => 'No site associated with your account'], 403);
        }

        return response()->json($site->posts()->with('user')->latest()->get());
    }

    public function show(Post $post)
    {
        return response()->json($post->load('user', 'site'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $site = $request->user()->sites()->first();

        if (! $site) {
            return response()->json(['message' => 'No site associated with your account'], 403);
        }

        $post = $site->posts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id,
        ]);

        return response()->json($post, 201);
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $post->update($request->only('title', 'content'));

        return response()->json($post);
    }

    public function destroy(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Deleted']);
    }
}

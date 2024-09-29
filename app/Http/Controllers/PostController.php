<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * Portal methods
     */
    public function index(Request $request)
    {
        $posts = Post::where('user_id', $request->user()->id)->get();
        return response()->json($posts);
    }
    public function getOne(Request $request, $id)
    {
        $post = Post::where('user_id', $request->user()->id)->where('id', $id)->first();
        return response()->json($post);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'slug' => ['required', 'unique:posts'],
            'description' => ["max:1000"],
        ]);

        $post = new Post();
        $post->user_id = $request->user()->id;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->description = $request->description ?? "";
        $post->content = $request->content ?? "";
        $post->image = $request->image ?? null;
        $post->published = $request->published ?? false;
        $post->save();
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'description' => ["max:1000"],
        // ]);

        $post = Post::where('user_id', $request->user()->id)->where('id', $id)->first();
        $post->title = $request->title ?? $post->title;
        $post->slug = $request->slug ?? $post->slug;
        $post->description = $request->description ?? $post->description;
        $post->content = $request->content ?? $post->content;
        $post->image = $request->image ?? $post->image;
        $post->published = $request->published ?? $post->published;
        $post->save();
        return response()->json($post);
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::where('user_id', $request->user()->id)->where('id', $id)->first();
        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
    /**
     * Public methods
     */
    public function allPosts(){
        $posts = Post::where('published', true)->get();
        return response()->json($posts);
    }

    public function showPublished($user)
    {
        $posts = Post::where('user_id', $user)->where('published', true)->get();
        return response()->json($posts);
    }

    public function showSinglePost($user, $id)
    {
        $post = Post::where('user_id', $user)->where('id', $id)->where('published', true)->first();
        return response()->json($post);
    }


}

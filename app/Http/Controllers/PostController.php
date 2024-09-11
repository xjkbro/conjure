<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // $posts = Post::all();
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
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        $post->save();
        return response()->json($post);
    }
}

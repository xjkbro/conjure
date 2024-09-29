<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    /**
     * Public methods
     */
    public function allCategories(){
        $categories = Category::all();
        return response()->json($categories);
    }

    public function showCategory($user)
    {
        $categories = Category::where('user_id', $user)->get();
        return response()->json($categories);
    }

    public function showSingleCategory($user, $id)
    {
        $category = Category::where('user_id', $user)->where('id', $id)->first();
        return response()->json($category);
    }

    public function getSingleCategory(Request $request, $user, $id)
    {
        $category = Category::where('user_id', $user)->where('id', $id)->first();
        if($request->withPosts){
            $category->posts = Post::where('category_id', $category->id)->where('published', true)->get()->makeHidden(['category_id','user_id'])->toArray();

        }

        return response()->json($category);
    }
}

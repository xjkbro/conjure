<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/posts', [PostController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/posts', [PostController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/post/{id}', [PostController::class, 'getOne']);
Route::middleware(['auth:sanctum'])->post('/posts', [PostController::class, 'store']);


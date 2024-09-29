<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

/**
 *  12 Group
 *  /api/v1
 */
Route::Group(['prefix' => 'v1'], function () {
    /**
     * Public Routes for external access
     * /api/v1/{route}
     */

     /* POSTS */
     Route::group(['prefix' => 'posts'], function () {
        // Route::get('/', [PostController::class, 'allPosts']);
        Route::get('/{user}', [PostController::class, 'showPublished']);
        Route::get('/{user}/{id}', [PostController::class, 'showSinglePost']);
    });

    /* CATEGORIES */
    Route::group(['prefix' => 'categories'], function () {
        // Route::get('/', [PostController::class, 'allCategories']);
        Route::get('/{user}', [CategoryController::class, 'showCategory']);
        Route::get('/{user}/{id}', [CategoryController::class, 'showSingleCategory']);
        Route::post('/{user}/{id}', [CategoryController::class, 'getSingleCategory']);

    });

    /**
     * Admin Routes (CRUD) for Portal
     * /api/v2/admin/{route}
     */
    Route::group(['prefix' => 'admin'], function () {

        Route::group(['prefix' => 'posts'], function () {
            Route::middleware(['auth:sanctum'])->get('/', [PostController::class, 'index']);
            Route::middleware(['auth:sanctum'])->get('/{id}', [PostController::class, 'getOne']);
            Route::middleware(['auth:sanctum'])->post('/', [PostController::class, 'store']);
            Route::middleware(['auth:sanctum'])->put('/{id}', [PostController::class, 'update']);
            Route::middleware(['auth:sanctum'])->delete('/{id}', [PostController::class, 'destroy']);
        });
    });



});


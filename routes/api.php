<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::namespace('Api')->group(function() {
        Route::resource('categories', 'CategoryController', ['as' => 'api']);
        Route::resource('tags', 'TagController', ['as' => 'api']);
        Route::resource('posts', 'PostController', ['as' => 'api']);
        Route::resource('comments', 'CommentController', ['as' => 'api']);
    });
});

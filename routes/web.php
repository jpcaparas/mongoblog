<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function() {
        return redirect(route('admin.categories.index'));
    })->name('admin.index');

    Route::namespace('Web\\Admin')->group(function() {
        Route::resource('categories', 'CategoryController', ['as' => 'admin', 'except' => 'show']);
        Route::resource('tags', 'TagController', ['as' => 'admin', 'except' => 'show']);
        Route::resource('posts', 'PostController', ['as' => 'admin']);
        Route::resource('comments', 'CommentController', ['as' => 'admin', 'except' => 'show']);
    });
});

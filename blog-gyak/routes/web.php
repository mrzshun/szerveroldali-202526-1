<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/posts', function () {
    return view('posts.index',[
        'posts_count' => Post::all(),
        'users' => User::all(),
        'categories' => Category::all(),
    ]);
});

Route::get('/posts/create', function () {
    return view('posts.create');
});

Route::get('/posts/x', function () {
    return view('posts.show');
});

Route::get('/posts/x/edit', function () {
    return view('posts.edit');
});

// -----------------------------------------

Route::get('/categories/create', function () {
    return view('categories.create');
});

Route::get('/categories/x', function () {
    return view('categories.show');
});

// -----------------------------------------

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

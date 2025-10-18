<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
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
    return redirect('/posts'); //->route('posts.index');
});

// Route::get('/posts', function () {
//     return view('posts.index',[
//         'posts' => Post::all(),
//         'users' => User::all(),
//         'categories' => Category::all(),
//     ]);
// })->name('posts.index');

// Route::get('/posts', [PostController::class,'index'])->name('posts.index');

// -----------------------------------------

Route::resource('posts', PostController::class);

Route::resource('categories', CategoryController::class);


// -----------------------------------------

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

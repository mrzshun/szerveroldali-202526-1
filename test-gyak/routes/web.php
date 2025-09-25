<?php

use App\Models\Post;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', function () {
    return view('posts', [
        "posts" => Post::all(),
    ]);
});

Route::get('/post/{id}', function ($id) {
    return view('post', [
        'id' => $id,
        "post" => Post::find($id),
    ]);
});


Route::get('/test/{id?}', function ($id=null) {
    return view('alma', [
        'id' => $id,
        'group' => "1-es gyakorlati csoport",
        'toIterate' => [
            1 => 'php',
            2 => 'python',
            3 => 'golang',
            4 => 'Kotlin',
        ]
    ]);
});

// custom get custom GET parameters from URL TODO!
// Route::get('/search', function (Request $request) {
//     return $request->city;
// });

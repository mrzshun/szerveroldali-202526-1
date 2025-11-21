<?php

use App\Http\Controllers\ApiController;
use App\Http\Middleware\ValidateParams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout',   [ApiController::class, 'logout'])       ->name('api.logout');
    Route::get('/user',     [ApiController::class, 'user'])         ->name('api.user');

    Route::post('categories', [ApiController::class, 'createCategory'])->name('api.categories.createCategory');

});

Route::post('register',     [ApiController::class, 'register'])     ->name('api.register');
Route::post('login',        [ApiController::class, 'login'])        ->name('api.login');

Route::get('categories/{id?}', [ApiController::class, 'getCategories'])->where('id','[0-9]+')->name('api.categories.getCategories');


Route::get('uri-params/{num}/{str}/{opt?}',function ($num,$str,$opt = null){
    return response()->json([
        'num' => $num,
        'str' => $str,
        'opt' => $opt,
    ]);
})->where('num','[0-9]+')->where('str','[A-Za-z]+');

Route::get('uri-params2/{num}/{str}/{opt?}',function ($num,$str,$opt = null){
    return response()->json([
        'num' => $num,
        'str' => $str,
        'opt' => $opt,
    ]);
})->middleware(ValidateParams::class) ;

//v3: a controllerben ellenőrizzük
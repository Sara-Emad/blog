<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\PostController;
Route::get('/post',[PostController::class,"allPosts"] )->name("posts.index");
Route::get('/post/{id}',[PostController::class,"show"] )->where("id",'[0-9]+')->name("posts.show");
Route::delete('/post/{id}',[PostController::class,"destroy"])->name("posts.destroy")->where("id",'[0-9]+');
Route::get('/post/create',[PostController::class,"create"])->name("posts.create");
Route::post('/post',[PostController::class,"store"])->name("posts.store");
Route::get('/post/{id}/edit',[PostController::class,"edit"])->name("posts.edit");
Route::put('/post/{id}',[PostController::class,"update"])->name("posts.update")->where("id",'[0-9]+');
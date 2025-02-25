<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[PostController::class,"allPosts"])->name("login");

Route::get('/post',[PostController::class,"allPosts"])->name("posts.index");
Route::get('/post/{id}',[PostController::class,"show"])->where("id",'[0-9]+')->name("posts.show");
Route::delete('/post/{id}',[PostController::class,"destroy"])->name("posts.destroy")->where("id",'[0-9]+');
Route::get('/post/create',[PostController::class,"create"])->name("posts.create");
Route::post('/post',[PostController::class,"store"])->name("posts.store");
Route::get('/post/{id}/edit',[PostController::class,"edit"])->name("posts.edit");
Route::put('/post/{id}',[PostController::class,"update"])->name("posts.update")->where("id",'[0-9]+');

Route::resource('categories', CategoryController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

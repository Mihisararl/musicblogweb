<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;

Route::redirect('/','posts');

Route::resource('posts',PostController::class);

Route::get('/{user}/posts', [DashboardController::class, 'userPosts'])->name('posts.user');

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::post('/logout',[AuthController::class,'logout'])->name('logout');


Route::get('/register',function(){
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register',[AuthController::class,'register']);

Route::view('/login','auth.login')->name('login');
Route::post('/login',[AuthController::class,'login']);


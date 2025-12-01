<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->middleware('auth')->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->middleware('auth')->name('posts.show');

Route::get('/categories', [CategoryController::class, 'index'])->middleware('auth')->name('categories.index');

Route::get('/register', [RegisterController::class, 'ShowRegistrationForm'])->middleware('guest')->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest')->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth')->name('dashboard');

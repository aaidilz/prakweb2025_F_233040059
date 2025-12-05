<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardPostController;
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

// Dashboard - Route untuk dashboard posts - hanya untuk yang sudah login
// Index - menampilkan semua posts milik user
Route::get('/dashboard', [DashboardPostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.index');

// Dashboard Categories - Route untuk CRUD categories (HARUS SEBELUM ROUTES DENGAN DYNAMIC SEGMENTS)
Route::get('/dashboard/categories', [DashboardCategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.categories.index');
Route::get('/dashboard/categories/create', [DashboardCategoryController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.categories.create');
Route::post('/dashboard/categories', [DashboardCategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('dashboard.categories.store');
Route::get('/dashboard/categories/{category}/edit', [DashboardCategoryController::class, 'edit'])->middleware(['auth', 'verified'])->name('dashboard.categories.edit');
Route::put('/dashboard/categories/{category}', [DashboardCategoryController::class, 'update'])->middleware(['auth', 'verified'])->name('dashboard.categories.update');
Route::delete('/dashboard/categories/{category}', [DashboardCategoryController::class, 'destroy'])->middleware(['auth', 'verified'])->name('dashboard.categories.destroy');

// Create - Menampilkan form untuk membuat post baru
Route::get('/dashboard/create', [DashboardPostController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.create');

// Store - Menyimpan post baru
Route::post('/dashboard', [DashboardPostController::class, 'store'])->middleware(['auth', 'verified'])->name('dashboard.store');

// SHOW - menampilkan detail post berdasarkan slug
Route::get('/dashboard/{post:slug}', [DashboardPostController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard.show');

// Edit - Menampilkan form untuk edit post
Route::get('/dashboard/{post:slug}/edit', [DashboardPostController::class, 'edit'])->middleware(['auth', 'verified'])->name('dashboard.edit');

// Update - Mengupdate post
Route::put('/dashboard/{post:slug}', [DashboardPostController::class, 'update'])->middleware(['auth', 'verified'])->name('dashboard.update');

// Delete - Menghapus post
Route::delete('/dashboard/{post:slug}', [DashboardPostController::class, 'destroy'])->middleware(['auth', 'verified'])->name('dashboard.destroy');

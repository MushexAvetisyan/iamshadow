<?php

use App\Http\Controllers\Dashboard\AuthorsController;
use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LanguagesController;
use App\Http\Controllers\Dashboard\PostsController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/




// Admin routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/authors', AuthorsController::class);
    Route::resource('/posts', PostsController::class);
    Route::resource('/languages', LanguagesController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/books', BookController::class);
    Route::get('books/{uuid}/download', [BookController::class, 'download'])->name('books.download');
});

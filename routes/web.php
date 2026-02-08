<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WatchlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome')->name('welcome');
Route::get('/change',  [HomeController::class, 'change'])->name('change');



// Auth routes
Auth::routes(['verify' => true]);

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(callback: function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('authors', [AuthorsController::class, 'index'])->name('authors.index');

    Route::get('books/author/{author}', [BookController::class, 'booksByAuthors'])->name('books.by.authors');
    Route::get('books/language/{language}', [BookController::class, 'booksByLanguage'])->name('books.by.languages');

    Route::get('all-books', [BookController::class, 'index'])->name('all-books.index');

    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');


    Route::resource('watchlist', WatchlistController::class);

    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('books/category/{category}', [BookController::class, 'booksByCategories'])->name('books.by.categories');

    Route::resource('todos', TodoController::class)->except(['create', 'edit', 'show']);


    /*POSTS*/
    Route::resource('posts', PostController::class);
    Route::get('posts/show/{id}', [PostController::class, 'show']);
    Route::get('posts/{language}', [PostController::class, 'index']);
    Route::get('posts/language/{language}', [PostController::class, 'postsByLanguage'])->name('posts.by.language');

    /*POSTS COMMENTS*/
    Route::resource('comments', CommentController::class)->except(['index', 'create', 'show']);
    Route::post('comments/{id}', [CommentController::class, 'store'])->name('comments.store');
    Route::get('comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    /*POSTS LIKES*/
    Route::resource('likes', LikeController::class);
    Route::post('likes/toggle/{id}', [LikeController::class, 'toggleLike'])->name('likes.toggle');
    Route::get('/likes/status/{id}', [LikeController::class, 'getLikeStatus']);


    /*WATCHLIST CONTROLLER*/
    Route::post('/watchlist/add/{book}', 'WatchlistController@add')->name('watchlist.add');
    Route::delete('/watchlist/destroy/{book}', 'WatchlistController@destroy')->name('watchlist.destroy');
    Route::get('/watchlist', 'WatchlistController@index')->name('watchlist.index');

    /*SEARCH*/
    Route::get('/search', [SearchController::class, 'index'])->name('search');

});

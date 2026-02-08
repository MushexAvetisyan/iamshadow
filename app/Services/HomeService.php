<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use App\Models\Logo;
//use App\Models\Slide;
//use App\Models\Topic;


class HomeService
{
    /**
     * @param Request $request
     * @return array
     */
    public static function getViewData(Request $request): array
    {
        return [
            'Posts' => Post::orderBy('created_at', 'desc')
            ->with(['post_likes', 'post_comments']) // eager load reviews and user
                ->take(3)
                ->get(),
            'NewBooks' => Book::orderBy('created_at', 'desc')
                ->with(['likes', 'reviews.user']) // eager load reviews and user
                ->take(3)
                ->get()
                ->map(function ($book) {
                    $book->userReview = $book->reviews
                        ->where('user_id', Auth::id())
                        ->first();

                    return $book;
                }),
            'mostLikedBooks' => Book::mostLiked()
                ->with(['likes', 'reviews.user'])
                ->take(6)
                ->get(),
            'mostLikedPosts' => Post::mostLiked()
                ->with(['post_likes', 'reviews.user'])
                ->take(6)
                ->get(),
            'followers' => User::all(),
            'authors' => Author::with('books')
                ->orderBy('created_at', 'desc')
                ->when($request->get('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->withCount('books')
                ->take(3)->get(),
            'categories' => Category::with('books')
                ->orderBy('created_at', 'desc')->get(),

            'followersCount' => User::count(),
            'authorsCount' => Author::count(),
            'booksCount' => Book::count(),
            'categoriesCount' => Category::count(),
        ];
    }
}

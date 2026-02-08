<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggleLike($id)
    {
        $book = Book::find($id);
        $existingLike = Like::where('user_id', auth()->id())->where('book_id', $id)->first();

        if ($existingLike) {
            $existingLike->delete();
            $isLiked = false;
        } else {
            $like = new Like(['user_id' => auth()->id()]);
            $book->likes()->save($like);
            $isLiked = true;
        }

        return response()->json(['success' => true, 'isLiked' => $isLiked, 'likesCount' => $book->likes->count()]);
    }

    public function getLikeStatus($id)
    {
        $book = Book::find($id);
        if (!auth()->check()) {
            // If user is not authenticated, return default response
            return response()->json(['isLiked' => false]);
        }
        $isLiked = $book->likes->contains('user_id', auth()->id());

        return response()->json(['isLiked' => $isLiked]);
    }
}

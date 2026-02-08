<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $review = Review::updateOrCreate(
            ['user_id' => auth()->id(), 'book_id' => $request->book_id],
            ['rating' => $request->rating, 'review' => $request->review]
        );

        return back()->with('success', 'Review submitted!');
    }


    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $review->delete();
        return back()->with('success', 'Review deleted.');
    }
}

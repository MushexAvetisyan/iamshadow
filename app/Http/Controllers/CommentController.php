<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        $book = Book::find($id);

        // Create and store the comment
        $comment = new Comment([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        $book->comments()->save($comment);

        // Redirect back or handle response as needed
        flash('You Added New Comment')->success();
        return redirect()->back();
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the logged-in user owns the comment
        if (Auth::user()->id !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('pages.comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the logged-in user owns the comment
        if (Auth::user()->id !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'required|max:255',
        ]);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        flash('Comment Updated Successfully')->success();
        if ($comment->book) {
            return redirect()->route('books.show', ['book' => $comment->book->id]);
        } else {
            return redirect()->route('home');
        }
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the logged-in user owns the comment
        if (Auth::user()->id !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        flash('Comment Deleted Successfully')->success();
        return redirect()->back();
    }
}

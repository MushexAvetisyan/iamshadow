<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $todos = Todo::where('user_id', Auth::id());

        if ($request->has('search')) {
            $todos = $todos->where('book_title', 'like', '%' . $request->search . '%');
        }

        $todos = $todos->get();
        $watchlist = Auth::user()->watchlist; // Fetch user's watchlist

        return view('pages.todos.index', compact('todos', 'watchlist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request) {
        $request->validate([
            'book_id' => 'nullable|exists:books,id',
            'book_title' => 'nullable|string|max:255',
            'status' => 'required|in:want_to_read,reading,read'
        ]);

        $bookTitle = $request->book_title;

        // If a book is selected from the watchlist, get its title
        if ($request->book_id) {
            $book = Book::find($request->book_id);
            $bookTitle = $book ? $book->title : $request->book_title;
        }

        Todo::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'book_title' => $bookTitle,
            'status' => $request->status,
        ]);

        return redirect()->route('todos.index')->with('success', 'Book added to your to-do list!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, Todo $todo) {
        $this->authorize('update', $todo); // Ensure only the owner can update

        $request->validate(['status' => 'required|in:want_to_read,reading,read']);

        $todo->update(['status' => $request->status]);

        return back()->with('success', 'To-Do Action updated!');
    }

    public function destroy(Todo $todo) {
        $this->authorize('delete', $todo);
        $todo->delete();
        return back()->with('success', 'Book removed from your To-Do list.');
    }
}

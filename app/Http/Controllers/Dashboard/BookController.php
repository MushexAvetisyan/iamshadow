<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Language;
use App\Services\Book\BookService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Webpatser\Uuid\Uuid;

class BookController extends Controller
{

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $data = BookService::indexDashboardView($request)->getData();
        return view('dashboard.pages.books.index', $data)
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $languages = Language::all();
        $categories = Category::all();
        $books = Book::all();
        $authors = Author::all();
        return view('dashboard.pages.books.create', compact(
            'languages',
            'books',
            'categories',
            'authors'
        ));
    }

    /**
     * @param BookRequest $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(BookRequest $request): RedirectResponse
    {
        $books = $request->all();
        $books['uuid'] = (string)Uuid::generate();

        // Handle the cover upload
        if ($request->hasFile('cover')) {
            $books['cover'] = $request->cover->getClientOriginalName();
            $request->cover->storeAs('public/SeedBook', $books['cover']);
        }
        if ($request->file('image')){
            $destinationPath = public_path('storage/images');
            $Image = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $request->image->move($destinationPath, $Image);
            $books['image'] = "$Image";
        }

        $books['description'] = strip_tags($request->input('description'));

        Book::create($books);

        flash('Book Created Successfully')->success();

        return redirect()->route('books.index');
    }


    /**
     * @param $uuid
     * @return BinaryFileResponse
     */
    public function download($uuid): BinaryFileResponse
    {
        $books = Book::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path('app/public/SeedBook/' . $books->cover);
        return response()->download($pathToFile);
    }


    /**
     * @param Book $book
     * @return View
     */
    public function show(Book $book): View
    {
        return view('dashboard.pages.books.show', compact('book'));
    }


    /**
     * @param Book $book
     * @return View
     */
    public function edit(Book $book): View
    {
        $authors = Author::all();
        $languages = Language::all();
        $categories = Category::all();
        return view('dashboard.pages.books.edit', compact('book', 'authors', 'languages', 'categories'));
    }


    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $data = $request->validated();

        // Handle the cover upload
        if ($request->hasFile('cover')) {
            // Delete the old cover if exists
            if ($book->cover) {
                Storage::disk('public')->delete('SeedBook/' . $book->cover);
            }
            $data['cover'] = $request->cover->getClientOriginalName();
            $request->cover->storeAs('public/SeedBook', $data['cover']);
        }

        // Handle the image upload
        if ($request->file('image')) {
            if ($book->image) {
                Storage::disk('public')->delete('images/' . $book->image);
            }
            $destinationPath = public_path('storage/images');
            $Image = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $request->image->move($destinationPath, $Image);
            $data['image'] = $Image;
        }

        $data['description'] = strip_tags($request->input('description'));
        $book->update($data);

        flash('Book Updated Successfully')->success();

        return redirect()->route('books.index');
    }


    public function destroy(Book $book): RedirectResponse
    {
        // Delete the cover and image files if they exist
        if ($book->cover) {
            Storage::disk('public')->delete('SeedBook/' . $book->cover);
        }
        if ($book->image) {
            Storage::disk('public')->delete('images/' . $book->image);
        }

        $book->delete();

        flash('Book Deleted Successfully')->error();

        return redirect()->route('books.index');
    }
}

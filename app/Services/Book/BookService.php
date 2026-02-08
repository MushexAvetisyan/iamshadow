<?php

namespace App\Services\Book;

use App\Models\Book;
use App\Models\Category;
use App\Services\Author\AuthorService;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BookService
{
    /**
     * @param Request $request
     * @return View
     */
    public static function indexDashboardView(Request $request): View
    {
        $search = $request->get('search');

        return view('dashboard.pages.books.index',
        [
            'books' => Book::ordered()
                ->with('language')
                ->with('category')
                ->with('author')
                ->search($search)
                ->latest()
                ->paginate(7),
            'NewBooks' => Book::orderBy('created_at', 'desc')->take(3)->get(),
        ]);
    }

    public static function indexView(): View
    {
        $data = [
            'books' => Book::with('language')
                ->with('category')
                ->with('author')
                ->search(request()->get('search'))
                ->latest()
                ->paginate(7),
            'NewBooks' => Book::orderBy('created_at', 'desc')->take(3)->get(),
        ];

        return view('pages.books.index', $data)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Handles the book download logic.
     *
     * @param string $uuid
     * @return \Illuminate\Http\RedirectResponse|BinaryFileResponse
     */
    public static function downloadBook(string $uuid): BinaryFileResponse
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();
        $filePath = storage_path('app/public/SeedBook/' . $book->cover);

        if (!file_exists($filePath)) {
            return redirect()->back()->withErrors('The file does not exist.');
        }

        return response()->download($filePath, $book->title . '.' . $book->format);
    }

    /**
     * Handles the view data for books by an author.
     *
     * @param string $authorName
     * @return View
     */
    public static function booksByAuthorView(string $authorName): View
    {
        return view('pages.authors.books', AuthorService::booksByAuthors($authorName));
    }

    public static function booksByCategoryView(string $categoryName): View
    {
        $data = CategoryService::booksByCategories($categoryName); // Ensure this returns an array
        return view('pages.genres.books', $data);
    }

    public static function booksByLanguageView(string $languageName): View
    {
        $data = CategoryService::booksByLanguages($languageName); // Ensure this returns an array
        return view('pages.languages.books', $data);
    }
}

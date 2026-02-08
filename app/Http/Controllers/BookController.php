<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\Book\BookService;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BookController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return BookService::indexView();
    }

    public function show($id)
    {
        $book = Book::with(['reviews' => function ($query) {
            $query->orderByDesc('created_at')->paginate(5);
        }])->findOrFail($id);

        return view('pages.books.show', compact('book'));
    }

    /**
     * @param $uuid
     * @return BinaryFileResponse
     */
    public function download($uuid): BinaryFileResponse
    {
        return BookService::downloadBook($uuid);
    }

    /**
     * @param $authorName
     * @return View
     */
    public function booksByAuthors($authorName): View
    {
        return BookService::booksByAuthorView($authorName);
    }

    /**
     * @param $categoryName
     * @return View
     */
    public function booksByCategories($categoryName): View
    {
        return BookService::booksByCategoryView($categoryName);
    }

    /**
     * @param $languageName
     * @return View
     */
    public function booksByLanguage($languageName): View
    {
        return BookService::booksByLanguageView($languageName);
    }
}

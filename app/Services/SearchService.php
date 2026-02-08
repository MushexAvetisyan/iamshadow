<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchService
{
    /**
     * @param Request $request
     * @return array
     */
    public static function getViewData(Request $request): array
    {
        $term = $request->get('search');
        return [
            'authors' => Author::withCount('books')->search($term)->with('books')->paginate(7),
            'categories' => Category::search($term)->with('books')->paginate(7),
            'books' => Book::search($term)->with('author', 'category', 'language')->latest()->paginate(7),
        ];
    }
}

<?php

namespace App\Services\Category;

use App\Models\Book;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryService
{
    /**
     * Handle category index view logic for the dashboard.
     *
     * @param Request $request
     * @return View
     */
    public static function indexDashboardView(Request $request): View
    {
        $search = $request->get('search');

        return view('dashboard.pages.categories.index', [
            'categories' => Category::ordered()
                ->search($search)  // Assuming you have a search scope
                ->withCount('books')
                ->sortable()
                ->paginate(10),
        ]);
    }

    /**
     * Handle category index view logic for the front-end.
     *
     * @param Request $request
     * @return View
     */
    public static function indexFrontEndView(Request $request): View
    {
        $search = $request->get('search');
        $genreName = null;

        if ($search) {
            $filteredCategory = Category::where('name_en', $search)
                ->orWhere('name_ru', $search)
                ->first();

            if ($filteredCategory) {
                $genreName = $filteredCategory->name_en;
            }
        }

        return view('pages.genres.index', [
            'categories' => Category::ordered()
                ->withCount('books')
                ->sortable()
                ->get()
            ->all(),
            'paginatedCategories' => Category::ordered()
                ->withCount('books')
                ->sortable()
                ->paginate(10),
            'totalCategories' => Category::count(),
            'filteredBooks' => $search
                ? Category::where('name_en', $search)
                    ->orWhere('name_ru', $search)
                    ->first()
                : null,
            'filteredBooksPaginated' => $search
                ? Book::whereHas('category', function ($query) use ($search) {
                    $query->where('name_en', $search)->orWhere('name_ru', $search);
                })
                    ->with('author', 'language', 'category')
                    ->paginate(10)
                : null,
            'allBooks' => !$search
                ? Book::with('author', 'language', 'category')->paginate(9)
                : null,
            'genreName' => $genreName
        ]);
    }

    /**
     * Handles the creation of a category.
     *
     * @param array $data
     * @return void
     */
    public static function create(array $data): void
    {
        Category::create($data);
    }

    /**
     * Updates a category's details.
     *
     * @param Category $category
     * @param string $name
     * @param string $slug
     * @return void
     */
    public static function update(Category $category, string $name, string $slug): void
    {
        $category->update(['name' => $name, 'slug' => $slug]);
    }

    public static function booksByCategories($categoryName): array
    {
        $category = Category::where('name_en', $categoryName)->firstOrFail();
        $books = Book::where('category_id', $category->id)
            ->with('category', 'language', 'author')
            ->paginate(10);

        return compact('category', 'books'); // Returns an array
    }

    public static function booksByLanguages($languageName): array
    {
        $language = Language::where('name', $languageName)->firstOrFail();
        $books = Book::where('language_id', $language->id)
            ->with('category', 'language', 'author')
            ->paginate(10);

        return compact('language', 'books'); // Returns an array
    }
}

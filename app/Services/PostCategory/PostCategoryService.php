<?php

namespace App\Services\PostCategory;

use App\Models\Book;
use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostCategoryService
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

        return view('dashboard.pages.postcategories.index', [
            'PostCategories' => PostCategory::ordered()
                ->search($search)  // Assuming you have a search scope
                ->withCount('posts')
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
            $filteredCategory = PostCategory::where('name_en', $search)
                ->orWhere('name_ru', $search)
                ->first();

            if ($filteredCategory) {
                $genreName = $filteredCategory->name_en;
            }
        }

        return view('pages.genres.index', [
            'PostCategories' => PostCategory::ordered()
                ->withCount('posts')
                ->sortable()
                ->get()
            ->all(),
            'paginatedPostCategories' => PostCategory::ordered()
                ->withCount('posts')
                ->sortable()
                ->paginate(10),
            'totalPostCategories' => PostCategory::count(),
            'filteredPosts' => $search
                ? PostCategory::where('name_en', $search)
                    ->orWhere('name_ru', $search)
                    ->first()
                : null,
            'filteredPostsPaginated' => $search
                ? Post::whereHas('category', function ($query) use ($search) {
                    $query->where('name_en', $search)->orWhere('name_ru', $search);
                })
                    ->with('author', 'language', 'PostCategory')
                    ->paginate(10)
                : null,
            'allPosts' => !$search
                ? Post::with('author', 'language', 'PostCategory')->paginate(9)
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
        PostCategory::create($data);
    }

    /**
     * Updates a category's details.
     *
     * @param PostCategory $PostCategory
     * @param string $name
     * @param string $slug
     * @return void
     */
    public static function update(PostCategory $PostCategory, string $name, string $slug): void
    {
        $PostCategory->update(['name' => $name, 'slug' => $slug]);
    }

    public static function postsByPostCategories($PostCategoryName): array
    {
        $PostCategory = PostCategory::where('name_en', $PostCategoryName)->firstOrFail();
        $posts = Post::where('category_id', $PostCategory->id)
            ->with('category', 'language', 'author')
            ->paginate(10);

        return compact('PostCategory', 'posts'); // Returns an array
    }

    public static function postsByLanguages($languageName): array
    {
        $language = Language::where('name', $languageName)->firstOrFail();
        $posts = Post::where('language_id', $language->id)
            ->with('category', 'language', 'author')
            ->paginate(10);

        return compact('language', 'posts'); // Returns an array
    }
}

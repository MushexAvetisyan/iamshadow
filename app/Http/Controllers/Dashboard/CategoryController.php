<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Language;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{

    /**
     * Display the category index page for the dashboard.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $data = CategoryService::indexDashboardView($request)->getData();
        return view('dashboard.pages.categories.index', $data)
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.pages.categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        CategoryService::create($request->validated());
        flash('Category Created Successfully')->success();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('dashboard.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        CategoryService::update($category, $request->validated());
        flash('Category Updated Successfully')->success();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        flash('Category Deleted Successfully')->error();
        return back();
    }
}

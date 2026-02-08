<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCategoryRequest;
use App\Models\PostCategory;
use App\Services\PostCategory\PostCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostCategoryController extends Controller
{

    /**
     * Display the category index page for the dashboard.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $data = PostCategoryService::indexDashboardView($request)->getData();
        return view('dashboard.pages.postcategories.index', $data)
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.pages.postcategories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param PostCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(PostCategoryRequest $request): RedirectResponse
    {
        PostCategoryService::create($request->validated());
        flash('Post Category Created Successfully')->success();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param PostCategory $PostCategory
     * @return View
     */
    public function edit(PostCategory $PostCategory): View
    {
        return view('dashboard.pages.postcategories.edit', compact('PostCategory'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param PostCategoryRequest $request
     * @param PostCategory $PostCategory
     * @return RedirectResponse
     */
    public function update(PostCategoryRequest $request, PostCategory $PostCategory): RedirectResponse
    {
        PostCategoryService::update($PostCategory, $request->validated());
        flash('Post Category Updated Successfully')->success();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param PostCategory $PostCategory
     * @return RedirectResponse
     */
    public function destroy(PostCategory $PostCategory): RedirectResponse
    {
        $PostCategory->delete();
        flash('Post Category Deleted Successfully')->error();
        return back();
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostCategory;
use App\Services\Post\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostsController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.pages.posts.index', PostService::getViewData(request()))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $languages = Language::all();
        $PostCategories = PostCategory::all();
        return view('dashboard.pages.posts.create', compact('languages', 'PostCategories'));
    }

    /**
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        PostService::store($request);
        flash('Post Created Successfully')->success();
        return redirect()->route('posts.index');
    }

    /**
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        return view('dashboard.pages.posts.show', ['post' => $post]);
    }

    /**
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {

        return view('dashboard.pages.posts.edit', PostService::edit($post));
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        PostService::update($request, $post);
        flash('Post Updated Successfully')->success();
        return redirect()->route('posts.index');
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        PostService::destroy($post);
        flash('Post Deleted Successfully')->error();
        return redirect()->route('posts.index');
    }
}

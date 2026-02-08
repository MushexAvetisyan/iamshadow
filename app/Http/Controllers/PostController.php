<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostCategory;
use App\Services\Post\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * @return View
     */
    public function index():View
    {
        return view('pages.posts.index', PostService::getViewData((request())));
    }


    public function create(): View
    {
        $languages = Language::all();
        $PostCategories = PostCategory::all();
        return view('pages.posts.create', compact('languages', 'PostCategories'));
    }

    /**
     * @param $id
     * @return View
     */
    public function show($id): View
    {
        return view('pages.posts.show', PostService::show($id));
    }

    /**
     * @param $languageName
     * @return View
     */
    public function postsByLanguage($languageName): View
    {
        return view('pages.posts.index', PostService::postsByLanguage($languageName));
    }


    public function edit($id)
    {
        //
    }


    public function store($request)
    {
        PostService::store($request);

        flash('Post Created Successfully')->success();
        return redirect()->route('posts.index');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

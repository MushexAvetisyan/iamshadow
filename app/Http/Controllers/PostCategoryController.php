<?php

namespace App\Http\Controllers;


use App\Services\Category\CategoryService;
use App\Services\PostCategory\PostCategoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostCategoryController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return PostCategoryService::indexFrontEndView($request);
    }
}

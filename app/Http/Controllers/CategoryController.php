<?php

namespace App\Http\Controllers;


use App\Services\Category\CategoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return CategoryService::indexFrontEndView($request);
    }
}

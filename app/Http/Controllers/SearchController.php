<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('search', SearchService::getViewData(request()));
    }
}

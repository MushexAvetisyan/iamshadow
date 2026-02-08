<?php

namespace App\Http\Controllers;

use App\Services\Language\LanguageService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LanguagesController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.languages.index', LanguageService::getViewData(request()));
    }
}

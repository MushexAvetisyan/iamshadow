<?php

namespace App\Http\Controllers;

use App\Services\Author\AuthorService;
use Illuminate\View\View;

class AuthorsController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.authors.index', AuthorService::GetViewData(request()))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}

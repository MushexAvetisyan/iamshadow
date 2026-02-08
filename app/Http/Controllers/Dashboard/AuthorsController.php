<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Services\Author\AuthorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthorsController extends Controller
{
    /**
     * @return View
     */
    public function index():View
    {
        return view('dashboard.pages.authors.index', AuthorService::GetViewData(request()))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.pages.authors.create');
    }

    /**
     * @param AuthorRequest $request
     * @return RedirectResponse
     */
    public function store(AuthorRequest $request): RedirectResponse
    {
        AuthorService::create($request);
        flash('Author Created Successfully!')->success();
        return redirect()->back();
    }

    /**
     * @param Author $author
     * @return View
     */
    public function show(Author $author): View
    {
        return view('dashboard.pages.authors.show', compact('author'));
    }

    /**
     * @param Author $author
     * @return View
     */
    public function edit(Author $author): View
    {
        return view('dashboard.pages.authors.edit', AuthorService::edit($author));
    }

    /**
     * @param AuthorRequest $request
     * @param Author $author
     * @return RedirectResponse
     */
    public function update(AuthorRequest $request, Author $author): RedirectResponse
    {
        AuthorService::update($request, $author);

        flash('Author Updated Successfully')->success();
        return redirect()->route('authors.index');
    }

    /**
     * @param Author $author
     * @return RedirectResponse
     */
    public function destroy(Author $author): RedirectResponse
    {
        AuthorService::destroy($author);
        flash('Author Deleted Successfully')->error();

        return redirect()->route('authors.index');
    }
}

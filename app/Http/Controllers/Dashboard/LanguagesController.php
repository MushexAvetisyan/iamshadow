<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Category;
use App\Models\Language;
use App\Services\Language\LanguageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LanguagesController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.pages.languages.index', LanguageService::getViewData(request()))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * @return View
     */
    public function create(): View
    {
        $languages = Language::all();

        return view('dashboard.pages.languages.create', compact( 'languages'));
    }


    /**
     * @param LanguageRequest $request
     * @return RedirectResponse
     */
    public function store(LanguageRequest $request):RedirectResponse
    {
        $request->validated();
        $input = $request->all();

        Language::create($input);
        flash('Language Created Successfully')->success();

        return redirect()->route('languages.index');
    }

    /**
     * @param Language $language
     * @return View
     */
    public function show(Language $language): View
    {
        return view('dashboard.pages.languages.show', compact('language'));
    }


    /**
     * @param Language $language
     * @return View
     */
    public function edit(Language $language): View
    {
        return view('dashboard.pages.languages.edit', compact('language'));
    }


    /**
     * @param LanguageRequest $request
     * @param Language $language
     * @return RedirectResponse
     */
    public function update(LanguageRequest $request, Language $language): RedirectResponse
    {
        $request->validated();

        $input = $request->all();
        $language->update($input);

        flash('Language Updated Successfully')->success();

        return redirect()->route('languages.index');
    }


    public function destroy(Language $language)
    {
        $language->delete();
        flash('Language Deleted Successfully')->error();

        return redirect()->route('languages.index');
    }
}

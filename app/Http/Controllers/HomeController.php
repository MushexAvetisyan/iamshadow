<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $viewData = HomeService::getViewData($request);
        $likedBooks = auth()->user()->likedBooks; // Assuming a 'likedBooks' relationship on User model
        $likedPosts = auth()->user()->likedPosts;

        $viewData['likedBooks'] = $likedBooks;
        $viewData['likedPosts'] = $likedPosts;

        return view('home', $viewData);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function change(Request $request): RedirectResponse
    {
        App::setLocale($request->lang);
        /*Get Locale*/
        session()->put('locale', $request->lang);

        return redirect()->back();
    }

}

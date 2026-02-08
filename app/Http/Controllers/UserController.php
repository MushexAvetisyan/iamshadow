<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.users.index', UserService::GetViewData(request()));
    }
}

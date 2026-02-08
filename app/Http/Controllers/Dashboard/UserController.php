<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.pages.users.index', UserService::GetViewData(request()))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.pages.users.create');
    }


    /**
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        UserService::create($request);
        flash('User Created Successfully')->success();
        return redirect()->route('users.index');
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        UserService::update($request, $user);
        flash('User Updated Successfully')->success();
        return redirect()->route('users.index');
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('dashboard.pages.users.edit', UserService::edit($user));
    }

    /**
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return view('dashboard.pages.users.show', compact('user'));
    }


    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        UserService::destroy($user);
        flash('User Deleted Successfully')->error();
        return redirect()->route('users.index');
    }
}

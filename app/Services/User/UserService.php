<?php

namespace App\Services\User;


use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param Request $request
     * @return array
     */
    public static function GetViewData(Request $request): array
    {
        return[
            'users' => User::search($request->get('search'))
                ->sortable()
                ->ordered()
                ->paginate(10),
            'NewUsers' => User::orderBy('created_at', 'desc')->take(3)->get()
        ];
    }

    /**
     * @param UserRequest $request
     * @return void
     */
    public static function create(UserRequest $request): void
    {
        $request->validated();
        $input = $request->all();
        $userData = [
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ];
        User::create($userData);
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return void
     */
    public static function update(UserUpdateRequest $request, User $user): void
    {
        $request->validated();

        $input = $request->all();
        $postData = [
            'name' => $input['name'],
            'email' => $input['email'],
        ];
        $user->update($postData);
    }

    /**
     * @param User $user
     * @return array
     */
    public static function edit(User $user): array
    {
        return[
          'user' => $user
        ];
    }

    /**
     * @param User $user
     * @return void
     */
    public static function destroy(User $user): void
    {
        $user->delete();
    }
}

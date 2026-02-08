<?php

namespace App\Services;


use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardService
{
    /**
     * @param Request $request
     * @return array
     */
    public static function getViewData(Request $request): array
    {
        return [
            'newUsers' => User::search($request->get('search'))
                ->sortable()
                ->ordered()
                ->paginate(10),
            'books' => Book::orderBy('created_at', 'desc')->with('language')->with('category')->take(3)->get(),
            'authors' =>Author::with('books')->Ordered()->take(7)->get(),
        ];
    }
}

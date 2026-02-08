<?php

namespace App\Services\Watchlist;



use Illuminate\Http\Request;

class WatchlistService
{
    public static function GetViewData(): array
    {
        $user = auth()->user();
        return[
            'user' => auth()->user(),
            'watchlist' => $user->watchlist,
        ];
    }
}

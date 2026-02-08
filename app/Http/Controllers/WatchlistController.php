<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Watchlist;
use App\Services\Watchlist\WatchlistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WatchlistController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.books.watchlist', WatchlistService::GetViewData());
    }
    /**
     * @param Book $book
     * @return RedirectResponse
     */
    public function add(Book $book): RedirectResponse
    {
        $user = auth()->user();
        if (!$user->watchlist->contains($book)) {
            $watchlistItem = new Watchlist(['book_id' => $book->id,]);
            $user->watchlist()->save($watchlistItem);

            session()->flash('success', 'Book added to your watchlist successfully!');
        }
            else {
                session()->flash('info', 'Book is already in your watchlist.');
            }
        return redirect()->back();
    }

    /**
     * @param Book $book
     * @return RedirectResponse
     */
    public function destroy(Book $book): RedirectResponse
    {
        $user = auth()->user();
        $watchlistItem = $user->watchlist()->where('book_id', $book->id)->first();
        if ($watchlistItem) {
            $watchlistItem->delete();
        }

        session()->flash('error', 'Book is Removed From Watchlist successfully!');
        return redirect()->back();
    }
}

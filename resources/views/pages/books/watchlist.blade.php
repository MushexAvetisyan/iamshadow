@extends('layouts.app')

@section('content')
    <div class="Books">
        <h2>New Books</h2>
        <p class="card-text">Don't miss out on the latest Books...</p>
        <div class="BooksContainer">
    @if ($watchlist->count() == 0)<tr><td colspan="5">Your Watchlist is Empty.</td></tr>@endif
    @foreach($watchlist as $item)
        <div class="book-card">
                <form method="POST" action="{{ route('watchlist.destroy', $item->book) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path style="fill: red" d="M12.7439 22.3037L11.2939 20.9837C6.1439 16.3137 2.7439 13.2237 2.7439 9.45374C2.7439 6.36374 5.1639 3.95374 8.2439 3.95374C9.9839 3.95374 11.6539 4.76374 12.7439 6.03374C13.8339 4.76374 15.5039 3.95374 17.2439 3.95374C20.3239 3.95374 22.7439 6.36374 22.7439 9.45374C22.7439 13.2237 19.3439 16.3137 14.1939 20.9837L12.7439 22.3037Z" fill="white"></path>
                        </svg>
                    </button>
                </form>
            <div class="book-card__cover">
                <div class="book-card__book">
                    <div class="book-card__book-front">
                        <img class="book-card__img" src="{{ asset('storage/images/' . $item->book->image) }}" />
                    </div>
                    <div class="book-card__book-back"></div>
                    <div class="book-card__book-side"></div>
                </div>
            </div>
            <div>
                <div class="book-card__title">{{ $item->book->title }}</div>
                <div class="book-card__author">
                    <a href="{{ route('books.by.authors', ['author' => $item->book->author->name]) }}">
                        Author: {{ $item->book->author->name }}
                    </a>
                </div>
                <div class="book-card__author">Language: {{ $item->book->language->name }}</div>
                <div class="book-card__author">Pages: {{ $item->book->pages }}</div>
                <div class="book-card__author">Year: {{ $item->book->year }}</div>
                <div class="book-card__author">Genre: {{ $item->book->category->name_en }}/{{ $item->book->category->name_ru }}</div>
                <a href="{{ route('books.download', $item->book->uuid) }}">Download</a>
            </div>
        </div>
    @endforeach
        </div>
    </div>
@endsection

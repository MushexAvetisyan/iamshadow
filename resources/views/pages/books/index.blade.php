@extends('layouts.app')

@section('content')
    <h1 class="page_header">Books</h1>
    <div class="Books" style="margin-top: 9rem">
        <form style="display: flex; justify-content: end; margin-right: 13rem"
              action="{{ request()->get('search') }}" method="GET">
            <input class="search-bar" name="search" placeholder="Search Book" type="text">
        </form>
        <div class="BooksContainer">
            @guest
                <h2 style="text-align: center">Viewing is available only for registered users
                    <a href="{{ route('login') }}">Sign in</a>
                </h2>
            @endguest
            @auth
                @foreach($NewBooks as $book)
                    <div class="book-card">
                        <div class="book-card__cover">
                            <div class="book-card__book">
                                <div class="book-card__book-front">
                                    <img class="book-card__img" src="{{ asset('storage/images/' . $book->image) }}" />
                                </div>
                                <div class="book-card__book-back"></div>
                                <div class="book-card__book-side"></div>
                            </div>
                        </div>
                        <div>
                            <div class="book-card__title">{{ $book->title }}</div>
                            <div class="book-card__author">
                                <a href="{{ route('books.by.authors', ['author' => $book->author->name]) }}">
                                    Author: {{ $book->author->name }}
                                </a>
                            </div>
                            <div class="book-card__author">Language: {{ $book->language->name }}</div>
                            <div class="book-card__author">Pages: {{ $book->pages }}</div>
                            <div class="book-card__author">Year: {{ $book->year }}</div>
                            <div class="book-card__author">Genre: {{ $book->category->name_en }}/{{ $book->category->name_ru }}</div>
                            <a href="{{ route('books.download', $book->uuid) }}">Download</a>
                            <div class="sharingDiv">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                                    <ion-icon name="logo-facebook"></ion-icon> Share on Facebook
                                </a>

                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($book->title) }}&url={{ urlencode(url()->current()) }}" target="_blank">
                                    <ion-icon name="logo-twitter"></ion-icon> Share on Twitter
                                </a>

                                <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($book->title) }}" target="_blank">
                                    <ion-icon name="paper-plane-outline"></ion-icon> Share on Telegram
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                    {!! $books->appends(Request::except('page'))->render() !!}
            @endauth
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Search Results</h1>
        @if ($books->isNotEmpty())
            <section class="LanguageSection">
                <h2>Books</h2>
                <form class="search" action="{{ route('search') }}" method="GET" id="search">
                    <input class="search-bar" name="search" placeholder="Search for books, authors" type="text" required>
                </form>
                <div class="Books" style="margin-top: 8rem">
                    <div class="BooksContainer">
                        @foreach ($books as $book)
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
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            {{ $books->links() }}
        @endif

        @if ($authors->isNotEmpty())
            <section class="LanguageSection">
                <h2>Authors</h2>
                <form class="search" action="{{ route('search') }}" method="GET" id="search">
                    <input class="search-bar" name="search" placeholder="Search for books, authors" type="text" required>
                </form>
                <div class="container">
                    <div class="ag-format-container">
                        <div class="ag-courses_box">
                            @foreach ($authors as $author)
                                <div class="ag-courses_item">
                                    <a href="{{ route('books.by.authors', ['author' => $author->name]) }}" class="ag-courses-item_link">
                                        <div class="ag-courses-item_bg"></div>
                                        <div class="ag-courses-item_title">
                                            @if (!empty($author->image))
                                                <img src="/storage/{{ $author->image }}" width="32" height="32" loading="lazy" alt="{{ $author->name }}">
                                            @endif
                                            <span>{{ $author->name }}</span>
                                            <small class="truncate">{{ htmlspecialchars(trim(strip_tags($author->description))) }}</small>
                                        </div>

                                        <div class="ag-courses-item_date-box">
                                            <small>Books: ({{ $author->books_count ?? 0 }} books)</small>
                                            <span class="ag-courses-item_date"></span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            {{ $authors->links() }}
        @endif
    </div>
@endsection

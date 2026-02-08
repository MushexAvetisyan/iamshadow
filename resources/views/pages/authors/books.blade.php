@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Books by {{ $author->name }}</h1>

        <div class="Books" style="margin-top: 15rem">
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

        {{ $books->links() }}
    </div>
@endsection

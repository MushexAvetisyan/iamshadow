@extends('layouts.app')

@section('content')
    <h1 class="page_header">Books by {{ $category->name_en }}/{{ $category->name_ru }}</h1>
    <div class="Books" style="margin-top: 25rem">
        <div class="BooksContainer">
                @if ($books->isEmpty())
                    <p>No books are available in this category.</p>
                @else
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
                            @endif
                    {{ $books->links() }}
        </div>
    </div>
@endsection

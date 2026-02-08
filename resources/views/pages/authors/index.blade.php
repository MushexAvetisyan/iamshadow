@extends('layouts.app')

@section('content')
    <section class="LanguageSection">
        <div class="container">
            <div class="ag-format-container">
                <div class="ag-courses_box">
                    @foreach ($authors as $author)
                        <div class="ag-courses_item">
                            <a href="{{ route('books.by.authors', ['author' => $author->name]) }}" class="ag-courses-item_link">
                                <div class="ag-courses-item_bg"></div>
                                <div class="ag-courses-item_title">
                                    @if (!empty($author->image))
                                        <img src="/storage/{{ $author->image }}" width="110" height="32" loading="lazy" alt="{{ $author->name }}">
                                    @endif
                                </div>

                                <div class="ag-courses-item_date-box">
                                    <span>{{ $author->name }}</span>
                                    <small class="truncate">{{htmlspecialchars(trim(strip_tags($author->description)))}}</small>
                                    <small>Books:</small>
                                    <span class="ag-courses-item_date">
                                        {{ $author->books_count }}
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

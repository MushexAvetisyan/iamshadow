@extends('layouts.app')

@section('content')
    <div class="GenresContainer">
        <div class="top">
            <div class="input-container">
                <form method="GET" action="{{ route('category.index') }}">
                    <input type="text" class="search-bar" name="search" value="{{ request('search') }}" placeholder="Search genres..." />
                </form>
                <div id="stats">
                    Showing {{ $paginatedCategories->count() }} of {{ $totalCategories }} genres
                </div>
            </div>
        </div>

        <div class="content">
            <div class="facets">
                <div class="facet">
                    <div class="facet-title">Genre List</div>
                    <ul id="genres">
                        <li>
                            <a href="{{ route('category.index') }}">
                                <button class="headerButton">All Genres</button>
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('category.index', ['search' => $category->name_en]) }}">
                                    {{ $category->name_en }}/{{ $category->name_ru }}
                                </a> ({{ $category->books_count }} books)
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="canvas">
                <div class="ais-hits">
                    @if($filteredBooksPaginated && $filteredBooksPaginated->count())
                        @foreach($filteredBooksPaginated as $book)
                            <article class="movie">
                                <img class="movie-image" src="{{ asset('storage/images/' . $book->image) }}" alt="{{ $book->title }}" />
                                <div class="movie-meta">
                                    <div class="movie-title">
                                        {{ $book->title }}
                                        <span class="movie-year">({{ $book->year }})</span>
                                    </div>
                                    <div class="movie-genres">
                                        <div class="movie-genre">Genre : {{ $filteredBooks->name_en }}/{{ $filteredBooks->name_ru }}</div>
                                        <div class="movie-genre">Author : {{ $book->author->name }}</div>
                                        <div class="movie-genre">Language : {{ $book->language->name }}</div>
                                    </div>
                                    <a class="DownloadButton" href="{{ route('books.download', $book->uuid) }}">Download</a>
                                </div>
                            </article>
                        @endforeach
                    @elseif($filteredBooksPaginated && $filteredBooksPaginated->isEmpty() && $genreName)
                        <p class="ais-hits__empty">No books found for the {{ $genreName }} genre.</p>
                    @elseif($allBooks && $allBooks->count())
                        @foreach($allBooks as $book)
                            <article class="movie">
                                <img class="movie-image" src="{{ asset('storage/images/' . $book->image) }}" alt="{{ $book->title }}" />
                                <div class="movie-meta">
                                    <div class="movie-title">
                                        {{ $book->title }}
                                        <span class="movie-year">({{ $book->year }})</span>
                                    </div>
                                    <div class="movie-genres">
                                        <div class="movie-genre">Genre : {{ $book->category->name_en }}/{{ $book->category->name_ru }}</div>
                                        <div class="movie-genre">Author : {{ $book->author->name }}</div>
                                        <div class="movie-genre">Language : {{ $book->language->name }}</div>
                                    </div>
                                    <a class="DownloadButton" href="{{ route('books.download', $book->uuid) }}">Download</a>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <p class="ais-hits__empty">No books found for the {{ $genreName }} genre.</p>
                    @endif
                </div>

                <div id="pagination">
                    @if($filteredBooksPaginated && $filteredBooksPaginated->count())
                        {{ $filteredBooksPaginated->appends(request()->query())->links() }}
                    @elseif($allBooks && $allBooks->count())
                        {{ $allBooks->appends(request()->query())->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

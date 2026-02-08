@extends('layouts.app')

@section('content')
    <main>
        <article>
            <section class="hero" id="home" aria-label="home">
                <div class="input-wrapper">
                    <form class="search input-field" action="{{ route('search') }}" method="GET" id="search">
                        <input class="" autocomplete="on" name="search" placeholder="Search for books, authors"
                               type="text" required>
                        <button class="btn btn-primary" type="submit">
                            <span class="span">Search</span>
                            <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                        </button>
                    </form>
                </div>
                <div class="Reviews">
                    <div class="celebration">
                        <h1 id="followers-count">0</h1>
                        <h2>Followers</h2>
                    </div>

                    <div class="celebration">
                        <h1 id="authors-count">0</h1>
                        <h2>Authors</h2>
                    </div>

                    <div class="celebration">
                        <h1 id="books-count">0</h1>
                        <h2>Books</h2>
                    </div>

                    <div class="celebration">
                        <h1 id="categories-count">0</h1>
                        <h2>Categories</h2>
                    </div>
                </div>
                <div class="container">
                    <div class="hero-banner">
                        <img src="{{asset('images/bookshelfWithoutBack.png')}}" width="600" alt="">
                    </div>
                    <div class="hero-content">
                        <div id="title">
                            <p>Infinity</p>
                            <p>Books</p>
                            <p>Universe</p>
                            <a href="{{url('all-books')}}"
                               target="_blank" class="buttonFirst">
                                <button>Start a Journey</button>
                                <span></span>
                            </a>
                        </div>
                        <p class="hero-text">
                            @if(auth()->check() && auth()->user()->role == 1)
                                Your journey through Infinity books universe begins here.  Search, download, and enjoy!
                            @elseif(auth()->check() && auth()->user()->role == 0)
                                Welcome {{auth()->user()->name}}
                                "Hello, book lover! At Infinity Books, we believe in making stories accessible to
                                everyone. Browse our vast library of free books, search by your favorite authors or
                                genres, and start your reading journey today!"
                                <a href="{{url('all-books')}}"
                                   target="_blank" class="buttonFirst">
                                    <button>Start a Journey</button>
                                    <span></span>
                                </a>
                            @else
                                "Hello, book lover! At Infinity Books, we believe in making stories accessible to
                                everyone. Browse our vast library of free books, search by your favorite authors or
                                genres, and start your reading journey today!"
                                Please Login Or Registration For See All Collection of Greatest Books, Authors, And
                                Genres
                                <a href="{{route('login')}}"
                                   target="_blank" class="buttonFirst">
                                    <button>Log In</button>
                                    <span></span>
                                </a>
                            @endif
                        </p>
                    </div>
                    <img src="{{asset('images/shadow1.svg')}}" width="500" height="800" alt=""
                         class="hero-bg hero-bg-1">
                    <img src="{{asset('images/shadow2.svg')}}" width="500" height="500" alt=""
                         class="hero-bg hero-bg-2">
                </div>
            </section>

            <div class="Books">
                <h2 style="text-align: center;" class="headline headline-2 section-title">
                    <span class="span">New Added Books</span>
                    <span style="font-size: 25px">"Your journey through stories begins here."</span>
                </h2>
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
                                            <img class="book-card__img"
                                                 src="{{ asset('storage/images/' . $book->image) }}"/>
                                        </div>
                                        <div class="book-card__book-back"></div>
                                        <div class="book-card__book-side"></div>
                                    </div>
                                </div>
                                <div class="reaction_navigation">
                                    @if (!$book->inWatchlistForUser(auth()->user()))
                                        <form method="POST" action="{{ route('watchlist.add', $book) }}">
                                            @csrf
                                            <button type="submit">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.7439 22.3037L11.2939 20.9837C6.1439 16.3137 2.7439 13.2237 2.7439 9.45374C2.7439 6.36374 5.1639 3.95374 8.2439 3.95374C9.9839 3.95374 11.6539 4.76374 12.7439 6.03374C13.8339 4.76374 15.5039 3.95374 17.2439 3.95374C20.3239 3.95374 22.7439 6.36374 22.7439 9.45374C22.7439 13.2237 19.3439 16.3137 14.1939 20.9837L12.7439 22.3037Z"
                                                        fill="white"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('watchlist.destroy', $book) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path style="fill: red"
                                                          d="M12.7439 22.3037L11.2939 20.9837C6.1439 16.3137 2.7439 13.2237 2.7439 9.45374C2.7439 6.36374 5.1639 3.95374 8.2439 3.95374C9.9839 3.95374 11.6539 4.76374 12.7439 6.03374C13.8339 4.76374 15.5039 3.95374 17.2439 3.95374C20.3239 3.95374 22.7439 6.36374 22.7439 9.45374C22.7439 13.2237 19.3439 16.3137 14.1939 20.9837L12.7439 22.3037Z"
                                                          fill="white"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                    <form id="likeForm{{ $book->id }}" method="post" data-book-id="{{ $book->id }}">
                                        @csrf
                                        <div class="comments">
                                            <button type="button" id="likeButton{{ $book->id }}"
                                                    data-book-id="{{ $book->id }}">
                                                Like
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="book-card_description">
                                    <div class="book-card__title">{{ $book->title }}</div>
                                    <div class="book-card__author">
                                        <a href="{{ route('books.by.authors', ['author' => $book->author->name]) }}">
                                            Author: {{ $book->author->name }}
                                        </a>
                                    </div>
                                    <div class="book-card__author">
                                        <a href="{{route('books.by.languages', ['language' => $book->language->name])}}">
                                            Language: {{ $book->language->name }}
                                        </a>
                                    </div>
                                    <div class="book-card__author">Pages: {{ $book->pages }}</div>
                                    <div class="book-card__author">Year: {{ $book->year }}</div>
                                    <div class="book-card__author">Genre: {{ $book->category->name_en }}
                                        /{{ $book->category->name_ru }}</div>
                                    <a href="{{ route('books.download', $book->uuid) }}">Download</a>
                                    <div style="display: flex">
                                        Likes-<span id="likesCount{{ $book->id }}">{{ $book->likes->count() }}</span>
                                    </div>
                                </div>
                                <form action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <input type="hidden" name="rating" id="rating-value-{{ $book->id }}"
                                           value="{{ $book->userReview->rating ?? 0 }}">

                                    <div class="star-rating" data-book="{{ $book->id }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span
                                                class="star {{ isset($book->userReview) && $i <= $book->userReview->rating ? 'selected' : '' }}"
                                                data-value="{{ $i }}" data-target="{{ $book->id }}">&#9733;</span>
                                        @endfor
                                    </div>

                                    <textarea id="reviewArea" name="review" rows="1"
                                              placeholder="Write review...">{{ $book->userReview->review ?? '' }}</textarea>
                                    <button type="submit">{{ $book->userReview ? 'Update' : 'Submit' }}</button>
                                </form>

                                @foreach($book->reviews as $review)
                                    @if($review->user_id !== auth()->id())
                                        <div class="p-2 border-b">
                                            <strong>{{ $review->user->name }}</strong>
                                            <span>{{ str_repeat('★', $review->rating) }}</span>
                                            <p>{{ $review->review }}</p>
                                            <small>{{ $review->created_at->diffForHumans() }}</small>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    @endauth
                </div>
            </div>

            <div class="wrapper_section">
                <h2 style="text-align: center;" class="headline headline-2 section-title"><span class="span">Latest Post`s</span></h2>
                @guest()
                    <h2 style="text-align: center">Viewing is available only for registered users<a href="{{route('login')}}">Sign in</a></h2>
                @endguest
                @auth()
                    <div class="example-2 posts-card">
                        @foreach($Posts as $post)
                            <div style="background-image: url({{asset('storage/postImages/'.$post->image)}})" class="wrapper">
                                <div class="post-header">
                                    <div class="date">
                                        <span>{{$post->created_at->format('M j, Y')}}</span>
                                    </div>
                                    <ul class="menu-content">
                                        @if (!$post->inWatchlistForUser(auth()->user()))
                                            <form method="POST" action="{{ route('watchlist.add', $post) }}">
                                                @csrf
                                                <button type="submit">
                                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.7439 22.3037L11.2939 20.9837C6.1439 16.3137 2.7439 13.2237 2.7439 9.45374C2.7439 6.36374 5.1639 3.95374 8.2439 3.95374C9.9839 3.95374 11.6539 4.76374 12.7439 6.03374C13.8339 4.76374 15.5039 3.95374 17.2439 3.95374C20.3239 3.95374 22.7439 6.36374 22.7439 9.45374C22.7439 13.2237 19.3439 16.3137 14.1939 20.9837L12.7439 22.3037Z" fill="white"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('watchlist.destroy', $post) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path style="fill: red" d="M12.7439 22.3037L11.2939 20.9837C6.1439 16.3137 2.7439 13.2237 2.7439 9.45374C2.7439 6.36374 5.1639 3.95374 8.2439 3.95374C9.9839 3.95374 11.6539 4.76374 12.7439 6.03374C13.8339 4.76374 15.5039 3.95374 17.2439 3.95374C20.3239 3.95374 22.7439 6.36374 22.7439 9.45374C22.7439 13.2237 19.3439 16.3137 14.1939 20.9837L12.7439 22.3037Z" fill="white"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </ul>
                                </div>
                                <div class="data">
                                    <div class="content">
                                        <div class="author_category">
                                            <span class="author">Author: {{$post->user->name}}</span>
                                            <span class="author">{{$post->language->name}}</span>
                                        </div>
                                        <h1 class="title"><a href="{{url('posts/show', $post)}}">{{$post->title}}</a></h1>
                                        <p class="text"><a href="{{url('posts/show', $post)}}">{{strip_tags($post->content)}}</a></p>
                                        <a href="{{url('posts/show', $post)}}" class="button">Read more</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>

            <div class="wrapper_section">
                <h2 style="text-align: center;" class="headline headline-2 section-title"><span class="span">Most Liked Post`s</span></h2>
                @guest()
                    <h2 style="text-align: center">Viewing is available only for registered users<a href="{{route('login')}}">Sign in</a></h2>
                @endguest
                <div class="example-2 posts-card">
                    @foreach($mostLikedPosts as $post)
                        <div style="background-image: url(/storage/images/{{ $post->image }}" class="wrapper">
                            <div class="post-header">
                                <div class="date">
                                    <span>{{$post->created_at->diffForHumans()}}</span>
                                    <p style="margin-left: 2rem">Likes: {{ $post->like_count }}</p>
                                </div>
                                <ul class="menu-content">
                                    @if (!$post->inWatchlistForUser(auth()->user()))
                                        <form method="POST" action="{{ route('watchlist.add', $post) }}">
                                            @csrf
                                            <button type="submit">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.7439 22.3037L11.2939 20.9837C6.1439 16.3137 2.7439 13.2237 2.7439 9.45374C2.7439 6.36374 5.1639 3.95374 8.2439 3.95374C9.9839 3.95374 11.6539 4.76374 12.7439 6.03374C13.8339 4.76374 15.5039 3.95374 17.2439 3.95374C20.3239 3.95374 22.7439 6.36374 22.7439 9.45374C22.7439 13.2237 19.3439 16.3137 14.1939 20.9837L12.7439 22.3037Z" fill="white"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('watchlist.destroy', $post) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path style="fill: red" d="M12.7439 22.3037L11.2939 20.9837C6.1439 16.3137 2.7439 13.2237 2.7439 9.45374C2.7439 6.36374 5.1639 3.95374 8.2439 3.95374C9.9839 3.95374 11.6539 4.76374 12.7439 6.03374C13.8339 4.76374 15.5039 3.95374 17.2439 3.95374C20.3239 3.95374 22.7439 6.36374 22.7439 9.45374C22.7439 13.2237 19.3439 16.3137 14.1939 20.9837L12.7439 22.3037Z" fill="white"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </ul>
                            </div>
                            <div class="data">
                                <div class="content">
                                    <div class="author_category">
                                        <span class="author">Author: {{$post->user->name}}</span>
                                        <span class="author">{{$post->language->name}}</span>
                                    </div>
                                    <h1 class="title"><a href="{{url('posts/show', $post)}}">{{$post->title}}</a></h1>
                                    <p class="text"><a href="{{url('posts/show', $post)}}">{{strip_tags($post->content)}}</a></p>
                                    <a href="{{url('posts/show', $post)}}" class="button">Read more</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endauth
            </div>

            <div class="Books">
                <h2 style="text-align: center;" class="headline headline-2 section-title"><span
                        class="span">What readers are saying</span></h2>
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
                                            <img class="book-card__img"
                                                 src="{{ asset('storage/images/' . $book->image) }}"/>
                                        </div>
                                        <div class="book-card__book-back"></div>
                                        <div class="book-card__book-side"></div>
                                    </div>
                                </div>
                                <div class="book-card_description">
                                    <div class="book-card__title">{{ $book->title }}</div>
                                    <div class="book-card__author">
                                        <a href="{{ route('books.by.authors', ['author' => $book->author->name]) }}">
                                            Author: {{ $book->author->name }}
                                        </a>
                                    </div>
                                </div>

                                <div>
                                    @foreach($book->reviews as $review)
                                        @if($review->user_id === auth()->id())
                                            <div class="RatingDiv">
                                                <strong>Reader : {{ $review->user->name }}</strong>
                                                <span>Rating Stars : <span
                                                        class="star selected">{{ str_repeat('★', $review->rating) }}</span></span>
                                                <p>Review : {{ $review->review }}</p>
                                                <small>{{ $review->created_at->diffForHumans() }}</small>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        {{--                            @foreach($book->reviews()->latest()->take(10)->get() as $review)--}}
                        {{--                                <div class="review-box">--}}
                        {{--                                    <strong>{{ $review->user->name }}</strong>--}}
                        {{--                                    <div>--}}
                        {{--                                        @for ($i = 1; $i <= 5; $i++)--}}
                        {{--                                            <span style="color: {{ $i <= $review->rating ? 'gold' : '#ccc' }}">★</span>--}}
                        {{--                                        @endfor--}}
                        {{--                                    </div>--}}
                        {{--                                    <p>{{ $review->review }}</p>--}}
                        {{--                                    <small>{{ $review->created_at->format('d M Y') }}</small>--}}
                        {{--                                </div>--}}
                        {{--                            @endforeach--}}
                    @endauth
                </div>

            </div>


            <div class="Books">
                <h2 style="text-align: center;" class="headline headline-2 section-title"><span
                        class="span">Last Liked Books</span></h2>
                <div class="BooksContainer">
                    @guest
                        <h2 style="text-align: center">Viewing is available only for registered users
                            <a href="{{ route('login') }}">Sign in</a>
                        </h2>
                    @endguest
                    @auth
                        @foreach($mostLikedBooks as $LikedBooks)
                            <div class="book-card">
                                @if (!$LikedBooks->inWatchlistForUser(auth()->user()))
                                    <form method="POST" action="{{ route('watchlist.add', $LikedBooks) }}">
                                        @csrf
                                        <button type="submit">
                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.7439 22.3037L11.2939 20.9837C6.1439 16.3137 2.7439 13.2237 2.7439 9.45374C2.7439 6.36374 5.1639 3.95374 8.2439 3.95374C9.9839 3.95374 11.6539 4.76374 12.7439 6.03374C13.8339 4.76374 15.5039 3.95374 17.2439 3.95374C20.3239 3.95374 22.7439 6.36374 22.7439 9.45374C22.7439 13.2237 19.3439 16.3137 14.1939 20.9837L12.7439 22.3037Z"
                                                    fill="white"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('watchlist.destroy', $LikedBooks) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path style="fill: red"
                                                      d="M12.7439 22.3037L11.2939 20.9837C6.1439 16.3137 2.7439 13.2237 2.7439 9.45374C2.7439 6.36374 5.1639 3.95374 8.2439 3.95374C9.9839 3.95374 11.6539 4.76374 12.7439 6.03374C13.8339 4.76374 15.5039 3.95374 17.2439 3.95374C20.3239 3.95374 22.7439 6.36374 22.7439 9.45374C22.7439 13.2237 19.3439 16.3137 14.1939 20.9837L12.7439 22.3037Z"
                                                      fill="white"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                                <div class="book-card__cover">
                                    <div class="book-card__book">
                                        <div class="book-card__book-front">
                                            <img class="book-card__img"
                                                 src="{{ asset('storage/images/' . $LikedBooks->image) }}"/>
                                        </div>
                                        <div class="book-card__book-back"></div>
                                        <div class="book-card__book-side"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="book-card__title">{{ $LikedBooks->title }}</div>
                                    <div class="book-card__author">
                                        <a href="{{ route('books.by.authors', ['author' => $LikedBooks->author->name]) }}">
                                            Author: {{ $LikedBooks->author->name }}
                                        </a>
                                    </div>
                                    <div class="book-card__author">Language: {{ $LikedBooks->language->name }}</div>
                                    <div class="book-card__author">Pages: {{ $LikedBooks->pages }}</div>
                                    <div class="book-card__author">Year: {{ $LikedBooks->year }}</div>
                                    <div class="book-card__author">Genre: {{ $LikedBooks->category->name_en }}
                                        /{{ $LikedBooks->category->name_ru }}</div>
                                    <a href="{{ route('books.download', $LikedBooks->uuid) }}">Download</a>
                                </div>
                            </div>
                        @endforeach
                    @endauth
                </div>

            </div>

            <div class="Books">
                <h2 style="text-align: center;" class="headline headline-2 section-title">
                    <span class="span">Authors</span>
                    <span style="font-size: 25px">"Meet the storytellers behind every great book."</span>
                </h2>
                <div class="BooksContainer">
                    @guest
                        <h2 style="text-align: center">Viewing is available only for registered users
                            <a href="{{ route('login') }}">Sign in</a>
                        </h2>
                    @endguest
                    @auth
                        <div class="AuthorsContainer">
                            @foreach($authors as $author)
                                <div class="ag-courses_item">
                                    <a href="{{ route('books.by.authors', ['author' => $author->name]) }}"
                                       class="ag-courses-item_link">
                                        <div class="ag-courses-item_bg"></div>
                                        <div class="ag-courses-item_title">
                                            @if (!empty($author->image))
                                                <img src="/storage/{{ $author->image }}" width="110" height="32"
                                                     loading="lazy" alt="{{ $author->name }}">
                                            @endif
                                        </div>

                                        <div class="ag-courses-item_date-box">
                                            <span>{{ $author->name }}</span>
                                            <small
                                                class="truncate">{{htmlspecialchars(trim(strip_tags($author->description)))}}</small>
                                            <small>Books:</small>
                                            <span class="ag-courses-item_date">
                                            {{ $author->books_count }}
                                        </span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endauth
                </div>
            </div>

            <section class="tags" aria-labelledby="tag-label">
                <div class="container">

                    <h2 style="text-align: center;" class="headline headline-2 section-title">
                        <span class="span">Genres</span>
                        <span style="font-size: 25px">"From mystery to romance, find your perfect read."</span>
                    </h2>
                    <ul class="grid-list-category">
                        @foreach($categories as $category)
                            <li>
                                <a target="_blank"
                                   href="{{ route('books.by.categories', ['category' => $category->name_en]) }}"
                                   class="card tag-btn">
                                    <p class="btn-text">{{ $category->name_en }}/{{ $category->name_ru }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </section>

            <section class="section recent-post" id="recent" aria-labelledby="recent-label">
                <div class="container">
                    <div class="post-main">
                        <h2 class="headline headline-2 section-title">
                            <span class="span">Hacking</span>
                        </h2>
                        <p class="section-text">
                            Don't miss the latest Posts About Hacking
                        </p>
                        <ul class="grid-list">
                            <li>
                                <div class="recent-post-card">
                                    <figure class="card-banner" style="--width: 271; --height: 258;">
                                        <img src="{{asset('images/recent-post-1.jpg')}}" width="271" height="258"
                                             loading="lazy"
                                             alt="Helpful Tips for Working from Home as a Freelancer" class="img-cover">
                                    </figure>
                                    <div class="card-content">
                                        <a href="#" class="card-badge">Working Tips</a>
                                        <h3 class="headline headline-3 card-title">
                                            <a href="#" class="link hover-2">Helpful Tips for Working from Home as a
                                                Freelancer</a>
                                        </h3>
                                        <p class="card-text">
                                            Gosh jaguar ostrich quail one excited dear hello and bound and the and bland
                                            moral misheard
                                            roadrunner flapped lynx far that and jeepers giggled far and far
                                        </p>
                                        <div class="card-wrapper">
                                            <div class="card-tag">
                                                <a href="#" class="span hover-2"># Travel</a>
                                                <a href="#" class="span hover-2"># Lifestyle</a>
                                            </div>
                                            <div class="wrapper">
                                                <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
                                                <span class="span">3 mins read</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="recent-post-card">
                                    <figure class="card-banner" style="--width: 271; --height: 258;">
                                        <img src="{{asset('images/recent-post-2.jpg')}}" width="271" height="258"
                                             loading="lazy"
                                             alt="Helpful Tips for Working from Home as a Freelancer" class="img-cover">
                                    </figure>
                                    <div class="card-content">
                                        <a href="#" class="card-badge">Working Tips</a>
                                        <h3 class="headline headline-3 card-title">
                                            <a href="#" class="link hover-2">Helpful Tips for Working from Home as a
                                                Freelancer</a>
                                        </h3>
                                        <p class="card-text">
                                            Gosh jaguar ostrich quail one excited dear hello and bound and the and bland
                                            moral misheard
                                            roadrunner flapped lynx far that and jeepers giggled far and far
                                        </p>
                                        <div class="card-wrapper">
                                            <div class="card-tag">
                                                <a href="#" class="span hover-2"># Travel</a>
                                                <a href="#" class="span hover-2"># Lifestyle</a>
                                            </div>
                                            <div class="wrapper">
                                                <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
                                                <span class="span">3 mins read</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="recent-post-card">
                                    <figure class="card-banner" style="--width: 271; --height: 258;">
                                        <img src="{{asset('images/recent-post-3.jpg')}}" width="271" height="258"
                                             loading="lazy"
                                             alt="Helpful Tips for Working from Home as a Freelancer" class="img-cover">
                                    </figure>
                                    <div class="card-content">
                                        <a href="#" class="card-badge">Working Tips</a>
                                        <h3 class="headline headline-3 card-title">
                                            <a href="#" class="link hover-2">Helpful Tips for Working from Home as a
                                                Freelancer</a>
                                        </h3>
                                        <p class="card-text">
                                            Gosh jaguar ostrich quail one excited dear hello and bound and the and bland
                                            moral misheard
                                            roadrunner flapped lynx far that and jeepers giggled far and far
                                        </p>
                                        <div class="card-wrapper">
                                            <div class="card-tag">
                                                <a href="#" class="span hover-2"># Travel</a>
                                                <a href="#" class="span hover-2"># Lifestyle</a>
                                            </div>
                                            <div class="wrapper">
                                                <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
                                                <span class="span">3 mins read</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="recent-post-card">
                                    <figure class="card-banner" style="--width: 271; --height: 258;">
                                        <img src="{{asset('images/recent-post-4.jpg')}}" width="271" height="258"
                                             loading="lazy"
                                             alt="Helpful Tips for Working from Home as a Freelancer" class="img-cover">
                                    </figure>
                                    <div class="card-content">
                                        <a href="#" class="card-badge">Working Tips</a>
                                        <h3 class="headline headline-3 card-title">
                                            <a href="#" class="link hover-2">Helpful Tips for Working from Home as a
                                                Freelancer</a>
                                        </h3>
                                        <p class="card-text">
                                            Gosh jaguar ostrich quail one excited dear hello and bound and the and bland
                                            moral misheard
                                            roadrunner flapped lynx far that and jeepers giggled far and far
                                        </p>
                                        <div class="card-wrapper">
                                            <div class="card-tag">
                                                <a href="#" class="span hover-2"># Travel</a>
                                                <a href="#" class="span hover-2"># Lifestyle</a>
                                            </div>
                                            <div class="wrapper">
                                                <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
                                                <span class="span">3 mins read</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="recent-post-card">
                                    <figure class="card-banner" style="--width: 271; --height: 258;">
                                        <img src="{{asset('images/recent-post-5.jpg')}}" width="271" height="258"
                                             loading="lazy"
                                             alt="Helpful Tips for Working from Home as a Freelancer" class="img-cover">
                                    </figure>
                                    <div class="card-content">
                                        <a href="#" class="card-badge">Working Tips</a>
                                        <h3 class="headline headline-3 card-title">
                                            <a href="#" class="link hover-2">Helpful Tips for Working from Home as a
                                                Freelancer</a>
                                        </h3>
                                        <p class="card-text">
                                            Gosh jaguar ostrich quail one excited dear hello and bound and the and bland
                                            moral misheard
                                            roadrunner flapped lynx far that and jeepers giggled far and far
                                        </p>
                                        <div class="card-wrapper">
                                            <div class="card-tag">
                                                <a href="#" class="span hover-2"># Travel</a>
                                                <a href="#" class="span hover-2"># Lifestyle</a>
                                            </div>
                                            <div class="wrapper">
                                                <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
                                                <span class="span">3 mins read</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>

                        <nav aria-label="pagination" class="pagination">
                            <a href="#" class="pagination-btn" aria-label="previous page">
                                <ion-icon name="arrow-back" aria-hidden="true"></ion-icon>
                            </a>
                            <a href="#" class="pagination-btn">1</a>
                            <a href="#" class="pagination-btn">2</a>
                            <a href="#" class="pagination-btn">3</a>
                            <a href="#" class="pagination-btn" aria-label="more page">...</a>

                            <a href="#" class="pagination-btn" aria-label="next page">
                                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                            </a>
                        </nav>
                    </div>
                </div>
            </section>
        </article>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let likeForms = document.querySelectorAll('[id^="likeForm"]');

            likeForms.forEach(form => {
                let bookId     = form.getAttribute('data-book-id');
                let postId     = form.getAttribute('data-post-id');
                let likeButton = document.getElementById(`likeButton${bookId}`);
                let PostLikeButton = document.getElementById(`likeButton${postId}`);
                let likesCount = document.getElementById(`likesCount${bookId}`);
                let PostLikeCount = document.getElementById(`likesCount${postId}`);

                if (likeButton) {
                    // Fetch the current like status when the page loads
                    fetch(`/likes/status/${bookId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.isLiked) {
                                likeButton.classList.add('liked');
                                likeButton.style.color = '#1bf503'; // Green color
                                likeButton.innerText   = 'Unlike'; // Change text
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching like status:', error);
                        });

                    likeButton.addEventListener('click', function () {
                        fetch(`/likes/toggle/${bookId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    if (data.isLiked) {
                                        likeButton.classList.add('Unlike');
                                        likeButton.style.color = '#1bf503'; // Green color
                                        likeButton.innerText   = 'Unlike'; // Change text
                                    } else {
                                        likeButton.classList.remove('liked');
                                        likeButton.style.color = ''; // Reset color
                                        likeButton.innerText   = 'Like'; // Reset text
                                    }
                                    likesCount.innerText = data.likesCount;
                                } else {
                                    alert('Error toggling like');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    });
                } else {
                    console.error('Like button not found in form:', form);
                }
            });
        });
    </script>



    <script>
        const animateCount = (element, start, end, duration) => {
            const range    = end - start;
            let current    = start;
            const stepTime = Math.abs(Math.floor(duration / range));
            let increment  = 1;

            const timer = setInterval(() => {
                current += increment;
                element.textContent = current;

                // Gradual easing
                increment = Math.ceil((end - current) / 2);

                if (current >= end) {
                    clearInterval(timer);
                    element.textContent = end;
                }
            }, stepTime);
        };

        document.addEventListener("DOMContentLoaded", () => {
            const countElement           = document.getElementById("followers-count");
            const countAuthorsElement    = document.getElementById("authors-count");
            const countBooksElement      = document.getElementById("books-count");
            const countCategoriesElement = document.getElementById("categories-count");

            const followersCount  = {{ $followersCount }}; // Followers count from controller
            const authorsCount    = {{ $authorsCount }}; // Authors count from controller
            const booksCount      = {{ $booksCount }}; // Books count from controller
            const categoriesCount = {{ $categoriesCount }}; // Categories count from controller

            animateCount(countElement, 0, followersCount, 4000);
            animateCount(countAuthorsElement, 0, authorsCount, 4000); // Add animation for authors
            animateCount(countBooksElement, 0, booksCount, 4000);
            animateCount(countCategoriesElement, 0, categoriesCount, 4000);

        });


        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.star-rating').forEach(container => {
                const bookId      = container.getAttribute('data-book');
                const stars       = container.querySelectorAll('.star');
                const ratingInput = document.getElementById(`rating-value-${bookId}`);

                stars.forEach(star => {
                    star.addEventListener('click', () => {
                        const value       = star.getAttribute('data-value');
                        ratingInput.value = value;

                        stars.forEach(s => {
                            s.classList.toggle('selected', s.getAttribute('data-value') <= value);
                        });
                    });
                });
            });
        });
    </script>

    <style>
    </style>
@endsection

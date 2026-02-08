@extends('layouts.app')

@section('content')
    <main>
        <article>
            <section class="hero" id="home" aria-label="home">
                <div class="input-wrapper">
                <form class="search input-field" action="{{ route('search') }}" method="GET" id="search">
                    <input class="" autocomplete="on" name="search" placeholder="Search for books, authors" type="text" required>
                    <button class="btn btn-primary" type="submit">
                        <span class="span">Search</span>
                        <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                    </button>
                </form>
                </div>


                <div class="container">
                    <div class="hero-content">
                        <h1 class="headline headline-1 section-title">
                            <span class="span">{{ __('Home.Library') }}</span>
                        </h1>
                        <p class="hero-text">
                            @if(auth()->check() && auth()->user()->role == 1)
                            Welcome {{auth()->user()->name}} You Are Admin
                            @elseif(auth()->check() && auth()->user()->role == 0)
                                Welcome {{auth()->user()->name}}
                            @else
                                Please Login Or Registration For See All Collection of Greatest Books, Authors, And Genres
                            @endif
                        </p>
                    </div>
                    <div class="hero-banner">
                        <img src="{{asset('images/bookshelfWithoutBack.png')}}" width="600" alt="">
                    </div>
                    <img src="{{asset('images/shadow1.svg')}}" width="500" height="800" alt="" class="hero-bg hero-bg-1">
                    <img src="{{asset('images/shadow2.svg')}}" width="500" height="500" alt="" class="hero-bg hero-bg-2">
                </div>
            </section>
@endsection

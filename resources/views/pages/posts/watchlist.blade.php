@extends('layouts.app')

@section('content')
    <section class="LanguageSection">
        <div class="wrapper_section">
            <div class="example-2 posts-card">
                @if ($watchlist->count() == 0)<tr><td colspan="5">Your Watchlist is Empty.</td></tr>@endif
                @foreach($watchlist as $item)
                    <div style="background-image: url({{asset('storage/postImages/'.$post->image)}})" class="wrapper">
                        <div class="post-header">
                            <div class="date">
                                <span>{{$item->post->created_at->format('M j, Y')}}</span>
                            </div>
                            <ul class="menu-content">
                                <li>
                                    <form method="POST" action="{{ route('watchlist.destroy', $item->post) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path style="fill: red" d="M12.7439 22.3037L11.2939 20.9837C6.1439 16.3137 2.7439 13.2237 2.7439 9.45374C2.7439 6.36374 5.1639 3.95374 8.2439 3.95374C9.9839 3.95374 11.6539 4.76374 12.7439 6.03374C13.8339 4.76374 15.5039 3.95374 17.2439 3.95374C20.3239 3.95374 22.7439 6.36374 22.7439 9.45374C22.7439 13.2237 19.3439 16.3137 14.1939 20.9837L12.7439 22.3037Z" fill="white"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="data">
                            <div class="content">
                                <div class="author_category">
                                    <span class="author">Author: {{$item->post->user->name}}</span>
                                    <span class="author">{{$item->post->language->name}}</span>
                                </div>
                                <h1 class="title"><a href="{{url('posts/show', $item->post)}}">{{$item->post->title}}</a></h1>
                                <p class="text">{{strip_tags($item->post->content)}}</p>
                                <a href="{{url('posts/show', $item->post)}}" class="button">Read more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

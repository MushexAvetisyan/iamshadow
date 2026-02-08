@extends('layouts.app')

@section('content')
    <section class="LanguageSection">
        <div class="wrapper_section">
            <div class="example-2 posts-card">
                @foreach($posts as $post)
                    <div style="background-image: url({{asset('storage/postImages/'.$post->image)}})" class="wrapper">
                        <div class="post-header">
                            <div class="date">
                                <span>{{$post->created_at->diffForHumans()}}</span>
                                <p>Likes: {{ $post->like_count }}</p>
                                <div class="comments">
                                    <a href="{{url('posts/show', $post)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                            <path d="M87.48 380c1.2-4.38-1.43-10.47-3.94-14.86a42.63 42.63 0 00-2.54-3.8
                                    199.81 199.81 0 01-33-110C47.64 139.09 140.72 48 255.82 48 356.2 48 440 117.54
                                    459.57 209.85a199 199 0 014.43 41.64c0 112.41-89.49 204.93-204.59 204.93-18.31
                                    0-43-4.6-56.47-8.37s-26.92-8.77-30.39-10.11a31.14 31.14 0 00-11.13-2.07 30.7 30.7
                                    0 00-12.08 2.43L81.5 462.78a15.92 15.92 0 01-4.66 1.22 9.61 9.61 0 01-9.58-9.74
                                    15.85 15.85 0 01.6-3.29z" fill="none" stroke="currentColor" stroke-linecap="round"
                                                  stroke-miterlimit="10" stroke-width="32"/><circle cx="160" cy="256" r="32"/>
                                            <circle cx="256" cy="256" r="32"/><circle cx="352" cy="256" r="32"/></svg>
                                    </a>
                                     <span>({{ $post->comments->count() }})</span>

                                    <form id="likeForm{{ $post->id }}" method="post" data-post-id="{{ $post->id }}">
                                        @csrf
                                        <div class="comments">
                                            <button type="button" id="likeButton" data-post-id="{{ $post->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                                    <path d="M320 458.16S304 464 256 464s-74-16-96-32H96a64 64 0 01-64-64v-48a64
                                        64 0 0164-64h30a32.34 32.34 0 0027.37-15.4S162 221.81 188 176.78 264 64 272
                                        48c29 0 43 22 34 47.71-10.28 29.39-23.71 54.38-27.46 87.09-.54 4.78 3.14 12
                                        7.95 12L416 205" fill="none" stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="32"/>
                                                    <path d="M416 271l-80-2c-20-1.84-32-12.4-32-30h0c0-17.6 14-28.84
                                        32-30l80-4c17.6 0 32 16.4 32 34v.17A32 32 0 01416 271zM448 336l-112-2c-18-.
                                        84-32-12.41-32-30h0c0-17.61 14-28.86 32-30l112-2a32.1 32.1 0 0132 32h0a32.1
                                        32.1 0 01-32 32zM400 464l-64-3c-21-1.84-32-11.4-32-29h0c0-17.6 14.4-30
                                        32-30l64-2a32.09 32.09 0 0132 32h0a32.09 32.09 0 01-32 32zM432 400l-96-2c-19-
                                        .84-32-12.4-32-30h0c0-17.6 13-28.84 32-30l96-2a32.09 32.09 0 0132 32h0a32.09
                                        32.09 0 01-32 32z" fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                          stroke-width="32"/></svg>
                                            </button>
                                            -<span  id="likesCount" style="margin-left: 5px">{{ $post->likes->count() }}</span>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <ul class="menu-content">
{{--                                @if (!$post->inWatchlistForUser(auth()->user()))x--}}
                                    <form id="WatchlistForm{{$post}}" method="POST" data-post-id="{{$post}}">
                                        @csrf
                                        <button type="button" id="WatchlistButton" data-post-id="{{$post}}">
                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.7439 22.3037L11.2939 20.9837C6.1439 16.3137
                                                2.7439 13.2237 2.7439 9.45374C2.7439 6.36374 5.1639 3.95374
                                                8.2439 3.95374C9.9839 3.95374 11.6539 4.76374 12.7439 6.03374C13.8339
                                                4.76374 15.5039 3.95374 17.2439 3.95374C20.3239 3.95374 22.7439
                                                6.36374 22.7439 9.45374C22.7439 13.2237 19.3439 16.3137 14.1939
                                                20.9837L12.7439 22.3037Z" fill="white"></path>
                                            </svg>
                                        </button>
                                    </form>
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
        {!! $posts->appends(Request::except('page'))->render() !!}
    </section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let likeForms = document.querySelectorAll('[id^="likeForm"]');

        likeForms.forEach(form => {
            let likeButton = form.querySelector('[data-post-id]');
            let likesCount = form.querySelector('#likesCount');

            if (likeButton) {
                let id = likeButton.getAttribute('data-post-id');
                // Fetch the current like status when the page loads
                fetch(`/likes/status/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.isLiked) {
                            likeButton.classList.add('liked');
                            likeButton.style.color = '#ff6347'; // Set the color to red
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching like status:', error);
                    });

                likeButton.addEventListener('click', function () {
                    fetch(`/likes/toggle/${id}`, {
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
                                    likeButton.classList.add('liked');
                                    likeButton.style.color = '#ff6347'; // Set the color to red
                                } else {
                                    likeButton.classList.remove('liked');
                                    likeButton.style.color = ''; // Reset to default color
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

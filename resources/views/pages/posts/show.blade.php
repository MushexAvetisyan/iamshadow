@extends('layouts.app')

@section('content')
    <section class="LanguageSection">
        <div class="container">
            <article>
                <header style="background-image: url({{asset('storage/postImages/'.$post->image)}})">
                    <div class="upper-header">
                        <div class="mini-title">{{$post->user->name}}</div>
                        <div class="date-since">
                            <p><span class="date-value" id="sinceData"></span></p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
                                <defs><style>.d {width: 20px;fill: #fff;opacity: .5;}</style></defs>
                                <path class="d" d="M15,0C6.75,0,0,6.75,0,15s6.75,15,15,15,15-6.75,15-15S23.25,0,15,0Zm7.35,16.65h-7.35c-.83,0-1.5-.67-1.5-1.5V7.8c0-.9,.6-1.5,1.5-1.5s1.5,.6,1.5,1.5v5.85h5.85c.9,0,1.5,.6,1.5,1.5s-.6,1.5-1.5,1.5Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="lower-header">
                        <div class="tags-container">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <defs><style>.d {width: 20px;fill: #fff;opacity: .75;}</style></defs>
                                <path class="d" d="M19.22,9.66L10.77,1.21c-.74-.74-1.86-1.21-2.97-1.21H1.67C.75,0,0,.75,0,1.67V7.8c0,1.11,.46,2.23,1.3,2.97l8.45,8.46c1,1,2.62,1,3.62,0l5.94-5.95c.93-.93,.93-2.6-.09-3.62ZM6.96,6.35c-.59,.59-1.56,.59-2.15,0-.59-.59-.59-1.56,0-2.15,.59-.59,1.56-.59,2.15,0,.59,.59,.59,1.56,0,2.15Z" />
                            </svg>
                            <span>{{$post->language->name}}</span>
                        </div>
                        <h1 class="title">{{$post->title}}</h1>
                        <p class="subtitle">{{strip_tags($post->content)}}</p>
                    </div>
                </header>
                <section class="summary">
                    <div class="summary-item">
                        <h5 class="item-title">View</h5>
                        <p class="item-text"><span class="item-data">1288</span> Views</p>
                    </div>
                    <div class="summary-item">
                        <h5 class="item-title">Publish Date</h5>
                        <p class="item-text"><span class="item-data" id="dateData">{{$post->created_at->diffForHumans()}}</span></p>
                    </div>
                    <div class="summary-item">
                        <h5 class="item-title">Post Likes</h5>
                        <p class="item-text"><span class="item-data" id="dateData">{{ $post->likes->count() }}</span></p>
                    </div>
                    <div class="summary-item">
                        <h5 class="item-title">Post Comments</h5>
                        <p class="item-text"><span class="item-data" id="dateData">{{ $post->comments->count() }}</span></p>
                    </div>
                </section>
                <section class="main-article">
                    <h4>{{$post->title}}</h4>
                    <p>{{$post->content}}</p>
                    <div class="container mt-5">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8">
                                <div class="AddCommentSection">
                                    <form method="post" action="{{ route('comments.store', ['id' => $post->id]) }}">
                                        @csrf
                                        <div style="display: grid">
                                            <label for="content">Add Comment:</label>
                                            <textarea name="content" id="content" required></textarea>
                                        </div>
                                        <div>
                                            <button style="margin: 15px 0 0 0" class="headerButton" type="submit">Add</button>
                                        </div>
                                    </form>
                                </div>
                                <h2>Comments</h2>

                                @foreach($post->comments as $comment)
                                <div class="card p-3">
                                    <div class="UserCommentSection">
                                        <div class="userImage">
                                            <img src="https://i.imgur.com/hczKIze.jpg" width="30" class="user-img">
                                            <span>
                                                <small class="Name">{{ $comment->user->name }}</small>
                                                <small class="comment">{{ $comment->content }}</small>
                                            </span>
                                        </div>
                                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if(Auth::check() && Auth::user()->id === $comment->user->id)
                                    <div class="ContentActionSection">
                                        <div class="reply">
                                            <form method="post" action="{{ route('comments.destroy', ['id' => $comment->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"><small>Remove</small></button>
                                            </form>
                                            <a href="{{ route('comments.edit', ['id' => $comment->id]) }}"><small>Edit</small></a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </article>
        </div>
    </section>
@endsection

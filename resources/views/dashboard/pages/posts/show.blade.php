@extends('layouts.app')

@section('content')
    <section class="LanguageSection">
        <div class="container">
            <ul class="grid-list">
                @foreach ($posts as $post)
                    <li>
                        <img src="/storage/images/{{$post->image}}" width="400" loading="lazy" alt="Travel">
                        <p class="btn-text">{{$post->title}}</p>
                        <span class="btn-text">{{$post->content}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection

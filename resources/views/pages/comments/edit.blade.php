<!-- edit.blade.php -->

@extends('layouts.app')

@section('content')
    <section class="LanguageSection">
        <form method="post" action="{{ route('comments.update', ['id' => $comment->id]) }}">
            @csrf
            @method('put')
            <div>
                <label for="content">Edit Comment:</label>
                <textarea name="content" id="content" required>{{ $comment->content }}</textarea>
            </div>
            <div>
                <button type="submit">Update</button>
            </div>
        </form>
    </section>
@endsection

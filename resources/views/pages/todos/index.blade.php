@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 19rem">
        <h2>My To-Do List</h2>
        <form action="{{ route('todos.index') }}" method="GET" class="TodoSearch">
            <div class="todo-form-group">
                <input type="text" name="search" class="todo-form-control" placeholder="Search books..."
                       value="{{ request()->get('search') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <!-- Add a new book -->
        <form action="{{ route('todos.store') }}" method="POST" class="mb-4">
            @csrf

            <!-- Watchlist Dropdown -->
            <div class="todo-form-group">
                <label for="book_id">Select from Your Watchlist</label>
                <select name="book_id" id="book_id" class="form-control">
                    <option value="">-- Select a Book --</option>
                    @foreach(auth()->user()->watchlist as $watchlistItem)
                        <option value="{{ $watchlistItem->book->id }}">{{ $watchlistItem->book->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Manual Book Title Input -->
            <div class="todo-form-group">
                <label for="book_title">Or Enter Book Title</label>
                <input type="text" name="book_title" id="book_title" class="todo-form-control" placeholder="Enter book title">
            </div>

            <!-- Status Selection -->
            <div class="todo-form-group-status">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="want_to_read">Want to Read</option>
                    <option value="reading">Reading</option>
                    <option value="read">Read</option>
                </select>
                <button type="submit" class="btn btn-primary mt-3">Add to To-Do List</button>
            </div>
        </form>

        <!-- To-Do List -->
        @if($todos->count())
        <div class="table">
            <div class="table-header">
                <div class="header__item"><a id="name" class="filter__link" href="#">Book Title</a></div>
                <div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">Status</a></div>
                <div class="header__item"><a id="draws" class="filter__link filter__link--number" href="#">Action</a></div>
            </div>
            <div class="table-content">
                @foreach($todos as $todo)
                <div class="table-row">
                    <div class="table-data">{{ $todo->book_title }}</div>
                    <div class="table-data">
                        <span class="badge
                                    @if($todo->status == 'want_to_read') badge-warning
                                    @elseif($todo->status == 'reading') badge-info
                                    @elseif($todo->status == 'read') badge-success
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $todo->status)) }}
                                </span>
                    </div>
                    <div class="table-data-last">
                        <form action="{{ route('todos.update', $todo) }}" method="POST" style="display:inline;">
                            @csrf @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="form-control-sm">
                                <option value="want_to_read" {{ $todo->status == 'want_to_read' ? 'selected' : '' }}>Want to Read</option>
                                <option value="reading" {{ $todo->status == 'reading' ? 'selected' : '' }}>Reading</option>
                                <option value="read" {{ $todo->status == 'read' ? 'selected' : '' }}>Read</option>
                            </select>
                        </form>
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-primary btn-sm">Delete Book</button>
                        </form>
                    </div>
                </div>
                    @endforeach
            </div>
        </div>
        @else
            <p>No books in your to-do list yet.</p>
        @endif

{{--        @if($todos->count())--}}
{{--            <table class="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Book Title</th>--}}
{{--                    <th>Status</th>--}}
{{--                    <th>Actions</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($todos as $todo)--}}
{{--                    <tr>--}}
{{--                        <td>{{ $todo->book_title }}</td>--}}
{{--                        <td>--}}
{{--                                <span class="badge--}}
{{--                                    @if($todo->status == 'want_to_read') badge-warning--}}
{{--                                    @elseif($todo->status == 'reading') badge-info--}}
{{--                                    @elseif($todo->status == 'read') badge-success--}}
{{--                                    @endif">--}}
{{--                                    {{ ucfirst(str_replace('_', ' ', $todo->status)) }}--}}
{{--                                </span>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <form action="{{ route('todos.update', $todo) }}" method="POST" style="display:inline;">--}}
{{--                                @csrf @method('PUT')--}}
{{--                                <select name="status" onchange="this.form.submit()" class="form-control-sm">--}}
{{--                                    <option value="want_to_read" {{ $todo->status == 'want_to_read' ? 'selected' : '' }}>Want to Read</option>--}}
{{--                                    <option value="reading" {{ $todo->status == 'reading' ? 'selected' : '' }}>Reading</option>--}}
{{--                                    <option value="read" {{ $todo->status == 'read' ? 'selected' : '' }}>Read</option>--}}
{{--                                </select>--}}
{{--                            </form>--}}

{{--                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">--}}
{{--                                @csrf @method('DELETE')--}}
{{--                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        @else--}}
{{--            <p>No books in your to-do list yet.</p>--}}
{{--        @endif--}}
    </div>
@endsection

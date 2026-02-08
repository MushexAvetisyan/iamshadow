@extends('dashboard.layouts.app')

@section('content')
    <main>
        <div class="header">
            <a href="{{ route('authors.create') }}">
                <button class="app-content-headerButton">Add New Author</button>
            </a>
            <h1>Authors</h1>
            <form  action="{{ request()->get('search') }}" method="GET">
                <label for="search">
                    <input class="search-bar" id="search" name="search" placeholder="Search..." type="text">
                </label>
            </form>
        </div>
    <div class="recent-orders">
        <h2>All Authors</h2>
        <table>
            <thead>
            <tr>
                <th><button class="sort-button">@sortablelink('id', 'Id')</button></th>
                <th><button class="sort-button">Image</button></th>
                <th><button class="sort-button">@sortablelink('title', 'Name')</button></th>
                <th><button class="sort-button">Description</button></th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if ($message = Session::get('success'))<div class="alert alert-success"><p>{{ $message }}</p></div>@endif
            @if ($authors->count() == 0)<tr><td colspan="5">No Books to display.</td></tr>@endif
            @foreach ($authors as $author)
                <tr>
                    <td><span>{{$author->id}}</span></td>
                    <td class="user_name">
                        <img class="profile-photo" src="{{ asset('storage/' . $author->image) }}" alt="product">
                    </td>
                    <td>{{$author->name}}</td>
                    <td class="truncate">{{strip_tags($author->description)}}</td>
                    <td><div class="action_buttons">
                            <form class="action_buttons"
                                  action="{{ route('authors.destroy',$author->id) }}" method="POST">
                                <a class="btn-edit" href="{{ route('authors.edit',$author->id) }}">Edit</a>
                                <a class="btn-show" href="{{ route('authors.show',$author->id)}}">Show More</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $authors->appends(Request::except('page'))->render() !!}
    </div>
    </main>
    <div class="right">
        @include('dashboard.layouts.components._right_menu')
    </div>
@endsection

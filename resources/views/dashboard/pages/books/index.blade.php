@extends('dashboard.layouts.app')

@section('content')
    <main>
        <div class="header">
            <a href="{{ route('books.create') }}">
                <button class="app-content-headerButton">Add New Book</button>
            </a>
            <h1>Books</h1>
            <form  action="{{ request()->get('search') }}" method="GET">
                <label for="search">
                    <input class="search-bar" id="search" name="search" placeholder="Search..." type="text">
                </label>
            </form>
        </div>
        <div class="recent-orders">
            <h2>All Books</h2>
            <table>
                <thead>
                <tr>
                    <th><button class="sort-button">@sortablelink('id', 'Id')</button></th>
                    <th><button class="sort-button">Image</button></th>
                    <th><button class="sort-button">@sortablelink('title', 'Name')</button></th>
                    <th>Description</th>
                    <th>Author</th>
                    <th>Pages</th>
                    <th>Year</th>
                    <th><button class="sort-button">@sortablelink('category_id', 'Category')</button></th>
                    <th><button class="sort-button">@sortablelink('language_id', 'Language')</button></th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if ($message = Session::get('success'))<div class="alert alert-success"><p>{{ $message }}</p></div>@endif
                @if ($books->count() == 0)<tr><td colspan="5">No Books to display.</td></tr>@endif
                @foreach ($books as $book)
                    <tr>
                        <td><span>{{$book->id}}</span></td>
                        <td class="user_name">
                            <img class="profile-photo" src="{{asset('storage/images/' . $book->image )}}" alt="product">
                        </td>
                        <td>{{$book->title}}</td>
                        <td class="truncate">{!!html_entity_decode($book->description)!!}</td>
                        <td>{{$book->author->name}}</td>
                        <td>{{$book->pages}}</td>
                        <td>{{$book->year}}</td>
                        <td>{{$book->category->name_en}}/{{$book->category->name_ru}}</td>
                        <td>{{$book->language->name}}</td>
                        <td><div class="action_buttons">
                                <form class="action_buttons"
                                      action="{{ route('books.destroy',$book->id) }}" method="POST">
                                    <a class="btn-edit" href="{{ route('books.edit',$book->id) }}">Edit</a>
                                    <a class="btn-show" href="{{ route('books.show',$book->id)}}">Show More</a>
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
            {!! $books->appends(Request::except('page'))->render() !!}
        </div>
    </main>
    <div class="right">
        @include('dashboard.layouts.components._right_menu')
        <div class="recent-updates">
            <h2>New Books</h2>
            <div class="updates">
                <div class="update">
                    @if ($message = Session::get('success'))<div class="alert alert-success"><p>{{ $message }}</p></div>@endif
                    @if ($NewBooks->count() == 0)<tr><td colspan="5">No Books to display.</td></tr>@endif
                    @foreach ($NewBooks as $NewBook)
                        <div class="profile-photo"><img src="{{asset("/storage/images/$NewBook->image")}}" alt="product"></div>
                        <div class="message"><p><b>{{$NewBook->title}}</b></p>
                            <small class="text-muted"> Added {{$NewBook->created_at->format('M j, Y')}}</small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

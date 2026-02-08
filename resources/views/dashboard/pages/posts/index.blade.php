@extends('dashboard.layouts.app')

@section('content')
    <main>
        <div class="header">
            <a href="{{ route('posts.create') }}">
                <button class="app-content-headerButton">Add New Post</button>
            </a>
            <h1>Post</h1>
            <form  action="{{ request()->get('search') }}" name="search" method="GET">
                <input class="search-bar" name="search" placeholder="Search..." type="text">
            </form>
        </div>


        <div class="recent-orders">
            <h2>All Posts</h2>
            <table>
                <thead>
                <tr>
                    <th><button class="sort-button">@sortablelink('id', 'Id')</button></th>
                    <th><button class="sort-button">@sortablelink('user.id', 'User')</button></th>
                    <th><button class="sort-button">@sortablelink('title', 'Title')</button></th>
                    <th><button class="sort-button">@sortablelink('language_id', 'Language')</button></th>
                    <th><button class="sort-button">@sortablelink('category_id', 'Category')</button></th>
                    <th><button class="sort-button">Image</button></th>
                    <th><button class="sort-button">Content</button></th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if ($message = Session::get('success'))<div class="alert alert-success"><p>{{ $message }}</p></div>@endif
                @if ($posts->count() == 0)<tr><td colspan="5">No Posts to Show.</td></tr>@endif
                @foreach ($posts as $post)
                    <tr>
                        <td><span>{{$post->id}}</span></td>
                        <td><span>{{$post->user->name}}</span></td>
                        <td><span>{{$post->title}}</span></td>
                        <td><span>{{$post->language->name}}</span></td>
                        <td><span>{{$post->category->name}}</span></td>
                        <td class="user_name">
                            <img class="profile-photo" src="{{asset("storage/images/$post->image")}}" alt="product">
                        </td>
                        <td><span id="truncateLongTexts">{{$post->content}}</span></td>
                        <td><div class="product-cell stock">
                                <form style="margin-left: 1rem" class="action_buttons"
                                      action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                    <a class="btn-edit" href="{{ route('posts.edit',$post->id) }}">Edit</a>
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
            {!! $posts->appends(Request::except('page'))->render() !!}
        </div>
    </main>
    <div class="right">
        @include('dashboard.layouts.components._right_menu')
    </div>
@endsection

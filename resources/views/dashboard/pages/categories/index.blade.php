@extends('dashboard.layouts.app')

@section('content')
    <main>
        <div class="header">
            <a href="{{ route('categories.create') }}">
                <button class="app-content-headerButton">Add New Category</button>
            </a>
            <h1>Category</h1>
            <form  action="{{ request()->get('search') }}" method="GET">
                <input class="search-bar" name="search" placeholder="Search..." type="text">
            </form>
        </div>


        <div class="recent-orders">
            <h2>All Categories</h2>
            <table>
                <thead>
                <tr>
                    <th><button class="sort-button">@sortablelink('id', 'Id')</button></th>
                    <th><button class="sort-button">@sortablelink('name', 'Name')</button></th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if ($message = Session::get('success'))<div class="alert alert-success"><p>{{ $message }}</p></div>@endif
                @if ($categories->count() == 0)<tr><td colspan="5">No Professions to Categories.</td></tr>@endif
                @foreach ($categories as $category)
                    <tr>
                        <td><span>{{$category->id}}</span></td>
                        <td class="warning">{{$category->name_en}} / {{$category->name_ru}}</td>
                        <td><div class="product-cell stock">
                                <form style="margin-left: 1rem" class="action_buttons"
                                      action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                    <a class="btn-edit" href="{{ route('categories.edit',$category->id) }}">Edit</a>
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
            {!! $categories->appends(Request::except('page'))->render() !!}
        </div>
    </main>

    <div class="right">
        @include('dashboard.layouts.components._right_menu')
    </div>
@endsection

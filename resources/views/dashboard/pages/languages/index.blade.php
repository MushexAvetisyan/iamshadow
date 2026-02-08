@extends('dashboard.layouts.app')

@section('content')
    <main>
        <div class="header">
            <a href="{{ route('languages.create') }}">
                <button class="app-content-headerButton">Add New Language</button>
            </a>
            <h1>Language</h1>
            <form  action="{{ request()->get('search') }}" method="GET">
                <input class="search-bar" name="search" placeholder="Search..." type="text">
            </form>
        </div>


        <div class="recent-orders">
            <h2>All Languages</h2>
            <table>
                <thead>
                <tr>
                    <th><button class="sort-button">@sortablelink('id', 'Id')</button></th>
                    <th><button class="sort-button">@sortablelink('name', 'Name')</button></th>
                    <th><button class="sort-button">@sortablelink('code', 'Code')</button></th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if ($message = Session::get('success'))<div class="alert alert-success"><p>{{ $message }}</p></div>@endif
                @if ($languages->count() == 0)<tr><td colspan="5">No Languages to Show.</td></tr>@endif
                @foreach ($languages as $language)
                    <tr>
                        <td><span>{{$language->id}}</span></td>
                        <td class="user_name">{{$language->name}}</td>
                        <td class="user_name">{{$language->code}}</td>
                        <td><div class="product-cell stock">
                                <form style="margin-left: 1rem" class="action_buttons"
                                      action="{{ route('languages.destroy',$language->id) }}" method="POST">
                                    <a class="btn-edit" href="{{ route('languages.edit',$language->id) }}">Edit</a>
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
        </div>
    </main>
    <div class="right">
        @include('dashboard.layouts.components._right_menu')
    </div>
@endsection

@extends('dashboard.layouts.app')

@section('content')
    <main>
        <div class="header">
            <a href="{{ route('users.create') }}">
                <button class="app-content-headerButton">Add New User</button>
            </a>
            <h1>Users</h1>
            <form  action="{{ request()->get('search') }}" method="GET">
                <label for="search">
                    <input class="search-bar" id="search" name="search" placeholder="Search..." type="text">
                </label>
            </form>
        </div>

        <div class="recent-orders">
            <h2>All Users</h2>
            <table>
                <thead>
                <tr>
                    <th><button class="sort-button">@sortablelink('id', 'Id')</button></th>
                    <th><button class="sort-button">@sortablelink('name', 'Name')</button></th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if ($message = Session::get('success'))<div class="alert alert-success"><p>{{ $message }}</p></div>@endif
                @if ($users->count() == 0)<tr><td colspan="5">No Users to display.</td></tr>@endif
                @foreach ($users as $user)
                    <tr>
                        <td><span>{{$user->id}}</span></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><div class="action_buttons">
                                <form class="action_buttons"
                                      action="{{ route('users.destroy',$user->id) }}" method="POST">
                                    <a class="btn-edit" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                    <a class="btn-show" href="{{ route('users.show',$user->id)}}">Show More</a>
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
            {!! $users->appends(Request::except('page'))->render() !!}
        </div>
    </main>

    <div class="right">
        @include('dashboard.layouts.components._right_menu')
        <div class="recent-updates">
            <h2>New Users</h2>
            <div class="updates">
                <div class="update">
                    @if ($message = Session::get('success'))<div class="alert alert-success"><p>{{ $message }}</p></div>@endif
                    @if ($NewUsers->count() == 0)<tr><td colspan="5">No Developers to display.</td></tr>@endif
                    @foreach ($NewUsers as $NewUser)
                        <div class="profile-photo"><img src="{{asset("/storage/images/$NewUser->image")}}" alt="product"></div>
                        <div class="message"><p><b>{{$NewUser->name}}</b></p>
                            <small class="text-muted"> Registraion {{$NewUser->created_at->format('M j, Y')}}</small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

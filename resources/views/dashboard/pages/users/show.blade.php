@extends('dashboard.layouts.app')

@section('content')
    <main>
        <a class="app-content-headerButton" href="{{route('users.index')}}">back to Users</a>
        <div class="recent-orders">
            <table>
                <thead>
                <tr>
                    <th><button class="sort-button">@sortablelink('id', 'Id')</button></th>
                    <th><button class="sort-button">@sortablelink('firstname', 'Name')</button></th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                @if ($message = Session::get('success'))<div class="alert alert-success"><p>{{ $message }}</p></div>@endif
                <tr>
                    <td><span>{{$user->id}}</span></td>
                    <td class="user_name">{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </main>
    <div class="right">
        @include('dashboard.layouts.components._right_menu')
    </div>
@endsection

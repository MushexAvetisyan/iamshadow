@extends('dashboard.layouts.app')

@section('content')
    <main>
        <h1>Dashboard</h1>
        <!------------------------------END OF INSIGHTS-------------------------------->

        <div class="recent-orders">
            <h2>New Users</h2>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($newUsers as $newUser)
                <tr>
                    <td>{{$newUser->id}}</td>
                    <td class="user_name">
                        {{$newUser->name}}
                    </td>
                    <td>{{$newUser->email}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {!! $newUsers->appends(Request::except('page'))->render() !!}
        </div>
    </main>

    <div class="right">
        @include('dashboard.layouts.components._right_menu')
        <!----------END OF TOP--------->
        <div class="recent-updates">
            <h2>New Books</h2>
            <div class="updates">
                <div class="update">
                    @foreach ($books as $book)
                        <div class="profile-photo"><img src="{{asset("/storage/images/$book->image")}}" alt="product"></div>
                        <div class="message"><p><b>{{$book->title}}</b></p>
                            <small class="text-muted">Category: {{$book->category->name}}</small><br>
                            <small class="text-muted">Language: {{$book->language->name}}</small><br>
                            <small class="text-muted">Date: {{$book->created_at->format('M j, Y')}}</small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

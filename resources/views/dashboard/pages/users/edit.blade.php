@extends('dashboard.layouts.app')

@section('content')

    <div>
        @if($errors->any())
            <div id="errors" role="alert">
                <div class="error_modal">
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong>There were some problems with your inputs.<br><br>
                        <ul>@foreach($errors->all() as $errors)<li>{{$errors}}</li>@endforeach</ul>
                    </div>
                </div>
            </div>
        @endif

            <div class="row">
                <div class="form-holder">
                    <div class="form-content">
                        <div class="form-items">
            <h3>Edit Category</h3>
            <a class="app-content-headerButton" href="{{route('users.index')}}">back to Users</a>
            <form class="editForm" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" required>
                </div>
                <div>
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" value="{{ $user->email }}" required>
                </div>
                <button class="app-content-headerButton" type="submit" value="submit">Update</button>
            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                @include('dashboard.layouts.components._right_menu')
            </div>
@endsection

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
                        <a class="app-content-headerButton" href="{{route('categories.index')}}">back to Categories</a>
                        <form class="requires-validation" action="{{ route('categories.update',$category->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="name_en">English Name</label>
                                <input type="text" name="name_en" id="name_en" value="{{ $category->name_en ?? old('name_en') }}" required>
                            </div>
                            <div>
                                <label for="name_ru">Russian Name</label>
                                <input type="text" name="name_ru" id="name_ru" value="{{ $category->name_ru ?? old('name_ru') }}" required>
                            </div>
                            <div class="form-button mt-3">
                                <button type="submit" class="app-content-headerButton">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="right">
        @include('dashboard.layouts.components._right_menu')
    </div>
@endsection

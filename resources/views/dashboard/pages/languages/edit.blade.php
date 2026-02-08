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
                        <h3>Edit Language</h3>
                        <a class="app-content-headerButton" href="{{route('languages.index')}}">back to Languages</a>
                        <form class="requires-validation" action="{{ route('languages.update',$language->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="name" class="form__label">Language Name</label>
                                <input type="text" name="name" id="name" value="{{ $language->name }}"
                                       class="form-control" placeholder="Name" />
                            </div>
                            <div>
                                <label for="slug" class="form__label">Slug Name</label>
                                <input type="text" name="slug" id="slug" value="{{ $language->slug }}"
                                       class="form-control" placeholder="Slug" />
                            </div>
                            <div>
                                <label for="logo" class="form__label">Logo</label>
                                <input type="file" name="logo" id="logo" value="{{ $language->logo }}"
                                       class="form-control" placeholder="Slug" />
                                <img class="profile-photo" src="/LangIcons/{{ $language->logo }}" width="50px">
                            </div>
                            <div>
                                <label for="logo" class="form__label">Logo</label>
                                <textarea name="description" id="description" class="ckeditor"
                                          placeholder="Language description">{{ $language->description }}
                                </textarea>
                            </div>
                            <div>
                                <label class="block">
                                    <span class="">Select Category</span>
                                    <select name="category_id" class="select_category">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
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

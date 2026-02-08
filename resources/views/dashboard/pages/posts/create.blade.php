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
                            <h3>Add New Post</h3>
                            <a class="app-content-headerButton" href="{{route('posts.index')}}">back to Posts</a>
                            <form class="requires-validation" action="{{ route('posts.store') }}"
                                  enctype="multipart/form-data" method="POST">
                                @csrf

                                <div>
                                    <input class="form-control" type="file" id="image" name="image" placeholder="image"
                                           value="{{old('image')}}" />
                                    <label for="image" class="form__label">Image</label>
                                </div>

                                <div>
                                    <input type="text" value="{{old('title')}}" class="form-control" placeholder="title"
                                           name="title" id='title' />
                                    <label for="title" class="form__label">Title</label>
                                </div>


                                <div>
                                <textarea name="content" id="content" class="ckeditor"
                                          placeholder="Language description">{{old('content')}}</textarea>
                                    <label for="logo" class="form__label">Content</label>
                                </div>

                                <div>
                                    <label class="form__label" for="language_id">Select Language:
                                        <select id="language_id" name="language_id" class="form-select">
                                            @foreach ($languages as $language)
                                                <option value="{{$language->id}}">{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>

                                <div>
                                    <label class="form__label" for="post_category_id">Select Category:
                                        <select id="post_category_id" name="post_category_id" class="form-select">
                                            @foreach ($PostCategories as $category)
                                                <option value="{{$category->id}}">{{$category->name_en}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>

                                <div class="form-button mt-3">
                                    <button type="submit" class="app-content-headerButton">Create</button>
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

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

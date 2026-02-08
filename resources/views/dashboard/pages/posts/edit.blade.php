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
                        <h3>Edit Post</h3>
                        <a class="app-content-headerButton" href="{{route('posts.index')}}">back to Posts</a>
                        <form class="requires-validation" action="{{ route('posts.update',$post->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="image" class="form__label">Image</label>
                                <input type="file" name="image" id="image" value="{{ $post->image }}"
                                       class="form-control" placeholder="image" />
                                <img class="profile-photo" src="/storage/images/{{ $post->image }}" width="50px">
                            </div>
                            <div>
                                <label for="title" class="form__label">Title</label>
                                <input type="text" name="title" id="title" value="{{ $post->title }}"
                                       class="form-control" placeholder="title" />
                            </div>
                            <div>
                                <label for="content" class="form__label">Content</label>
                                <textarea name="content" id="content" class="ckeditor"
                                          placeholder="content">{{ $post->content }}
                                </textarea>
                            </div>
                            <div>
                                <label class="block">
                                    <span class="">Select Language</span>
                                    <select name="language_id" class="select_category">
                                        @foreach ($languages as $language)
                                            <option value="{{$language->id}}">{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
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

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

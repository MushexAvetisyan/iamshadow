@extends('layouts.app')

@section('content')
    <section class="LanguageSection">
        <div class="wrapper_section">
            @if($errors->any())
                <div id="toast" role="alert">
                    <div class="error_modal">
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong>There were some problems with your inputs.<br><br>
                            <ul>@foreach($errors->all() as $errors)<li>{{$errors}}</li>@endforeach</ul>
                        </div>
                    </div>
                </div>
            @endif
            <form class="Language_form" action="{{ route('posts.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div>
                    <input type="file" id="image" name="image" placeholder="Image" value="{{old('image')}}" />
                </div>
                    <div class="form-group">
                        <label for="language_id" class="block"><span class="">Select Category</span></label>
                            <select id="language_id" name="language_id" class="changeLang">
                                @foreach ($languages as $language)
                                    <option value="{{$language->id}}">{{$language->name}}</option>
                                @endforeach
                            </select>
                    </div>
                <div class="form-group">
                    <label for="category_id" class="block"><span class="">Select Category</span></label>
                    <select id="category_id" name="category_id" class="changeLang">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-content">
                    <label for="title" class="">title</label>
                    <input type="text" autocomplete="off" value="{{old('title')}}" class="form__field" placeholder="title" name="title" id='title' />
                </div>
                <div class="form__group field">
                    <label for="content" class="form__label">Content</label>
                    <textarea class="ckeditor" id="content" name="content"></textarea>
                </div>
                <button type="submit" style="margin-top: 2rem" class="headerButton">Create</button>
            </form>
        </div>
    </section>
@endsection

<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.replace('content');
    });
</script>

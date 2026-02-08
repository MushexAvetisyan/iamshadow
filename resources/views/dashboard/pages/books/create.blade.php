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
                        <h3>Add New Book</h3>
                        <a class="app-content-headerButton" href="{{route('books.index')}}">back to Books</a>
                        <form class="requires-validation" action="{{ route('books.store') }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            <div>
                                <label for="cover">Cover
                                    <input class="form-control" type="file" id="cover" name="cover" placeholder="image"
                                           value="{{old('cover')}}" />
                                </label>
                            </div>
                            <div>
                                <label for="image">Image
                                    <input class="form-control" type="file" id="image" name="image" placeholder="image"
                                           value="{{old('image')}}" />
                                </label>
                            </div>
                            <div>
                                <label for="title">Title
                                    <input type="text" value="{{old('title')}}" class="form-control"
                                           placeholder="firstname" name="title" id='title' />
                                </label>
                            </div>
                            <div>
                                <label for="author_id">author
                                    <select id="author_id" name="author_id" class="form-select">
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div>
                                <label for="pages">Pages
                                    <input type="number" value="{{old('pages')}}" class="form-control"
                                           placeholder="pages" name="pages" id='pages' />
                                </label>
                            </div>
                            <div>
                                <label for="year">year
                                    <input type="number" value="{{old('year')}}" class="form-control"
                                           placeholder="year" name="year" id='year' />
                                </label>
                            </div>
                            <div>
                                <label id="description" for="description" class="form__label">Description</label>
                                <textarea placeholder="description" class="ckeditor form-control" id='description' name="description"></textarea>
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
                                <label class="form__label" for="category_id">Select Category:
                                    <select id="category_id" name="category_id" class="form-select">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name_en}}/{{$category->name_ru}}</option>
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
        $('.ckeditor').ckeditor({
            removePlugins: 'format,styles', // Disables HTML formatting
            enterMode: CKEDITOR.ENTER_BR, // Uses <br> instead of <p>
            basicEntities: false, // Keeps special characters
        });
    });
</script>

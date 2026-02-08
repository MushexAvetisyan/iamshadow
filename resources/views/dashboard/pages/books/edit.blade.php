@extends('dashboard.layouts.app')

@section('content')
    <div>
        @if($errors->any())
            <div id="errors" role="alert">
                <div class="error_modal">
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your inputs.<br><br>
                        <ul>@foreach($errors->all() as $error)<li>{{$error}}</li>@endforeach</ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Edit Book</h3>
                        <a class="app-content-headerButton" href="{{ route('books.index') }}">Back to Books</a>
                        <form class="requires-validation" action="{{ route('books.update', $book->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="cover">Cover
                                    <input class="form-control" type="file" id="cover" name="cover" />
                                    @if($book->cover)
                                        <span>{{$book->cover}}</span>
                                    @endif
                                </label>
                            </div>
                            <div>
                                <label for="image">Image
                                    <input class="form-control" type="file" id="image" name="image" />
                                    @if($book->image)
                                        <img src="{{ asset('storage/images/' . $book->image) }}" alt="Image" style="max-height: 15rem; max-width: 12rem;">
                                    @endif
                                </label>
                            </div>
                            <div>
                                <label for="title">Title
                                    <input type="text" value="{{ old('title', $book->title) }}" class="form-control"
                                           placeholder="Title" name="title" id="title" />
                                </label>
                            </div>
                            <div>
                                <label for="author_id">Author
                                    <select id="author_id" name="author_id" class="form-select">
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                                                {{ $author->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div>
                                <label for="pages">Pages
                                    <input type="number" value="{{ old('pages', $book->pages) }}" class="form-control"
                                           placeholder="Pages" name="pages" id="pages" />
                                </label>
                            </div>
                            <div>
                                <label for="year">Year
                                    <input type="number" value="{{ old('year', $book->year) }}" class="form-control"
                                           placeholder="Year" name="year" id="year" />
                                </label>
                            </div>
                            <div>
                                <label id="description" for="description" class="form__label">Description</label>
                                <textarea placeholder="Description" class="ckeditor form-control" id="description" name="description">
                                    {{ old('description', $book->description) }}
                                </textarea>
                            </div>
                            <div>
                                <label class="form__label" for="language_id">Select Language:
                                    <select id="language_id" name="language_id" class="form-select">
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}" {{ $book->language_id == $language->id ? 'selected' : '' }}>
                                                {{ $language->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div>
                                <label class="form__label" for="category_id">Select Category:
                                    <select id="category_id" name="category_id" class="form-select">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name_en }}/{{ $category->name_ru }}
                                            </option>
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
        $('.ckeditor').ckeditor({
            removePlugins: 'format,styles', // Disables HTML formatting
            enterMode: CKEDITOR.ENTER_BR, // Uses <br> instead of <p>
            basicEntities: false, // Keeps special characters
        });
    });
</script>

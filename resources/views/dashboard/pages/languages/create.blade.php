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
                        <h3>Add New Language</h3>
                        <a class="app-content-headerButton" href="{{route('languages.index')}}">back to Languages</a>
                        <form class="requires-validation" action="{{ route('languages.store') }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf

                            <div>
                                <input type="text" value="{{old('name')}}" class="form-control" placeholder="Name" name="name" id='name' />
                                <label for="name" class="form__label">Name</label>
                            </div>
                            <div>
                                <input type="text" value="{{old('slug')}}" class="form-control" placeholder="Slug" name="slug" id='slug' />
                                <label for="slug" class="form__label">Slug</label>
                            </div>
                            <div>
                                <input class="form-control" type="file" id="logo" name="logo" placeholder="logo"
                                       value="{{old('logo')}}" />
                                <label for="logo" class="form__label">Logo</label>
                            </div>

                            <div>
                                <textarea name="description" id="description" class="ckeditor"
                                          placeholder="Language description">{{old('description')}}</textarea>
                                <label for="logo" class="form__label">Description</label>
                            </div>

                            <div>
                                <label class="form__label" for="category_id">Select Category:
                                    <select id="category_id" name="category_id" class="form-select">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
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

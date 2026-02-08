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
            <a class="app-content-headerButton" href="{{route('authors.index')}}">back to Authors</a>
            <form class="requires-validation" action="{{route('authors.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-row">
                    <div class="input-data">
                        <input type="text" value="{{old('name')}}" name="name" id='name' required>
                        <div class="underline"></div>
                        <label for="name">Name</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <input type="file" value="{{old('image')}}" name="image" id='image' required>
                        <div class="underline"></div>
                        <label for="image"></label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data textarea">
                        <textarea rows="8" cols="80" class="ckeditor textarea" name="description" id="description"
                                  placeholder="description">
                        </textarea>
                        <div class="underline"></div>
                        <label for="description"></label>
                    </div>
                </div>
                <button class="app-content-headerButton" type="submit" value="submit">Create</button>
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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth scroll-pt-[115px]"
      style="
      --primary-nav-bg-color:38 42 46; --primary-nav-color:255,255,255;
      --primary-profile-bg-color:32 36 39; --primary-profile-color:255,255,255;  @yield('html-var')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="lorem">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="is-user-logged-in" content="{{ auth()->check() }}">
    <title>{{ config('app.name', 'Mushex Avetisyan') }}</title>
    <link href="{{ mix('css/light_mode_main.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/global.css') }}" rel="stylesheet">
    <link href="{{ mix('css/media_queries.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">
    @yield('header')
    <script src="{{mix('js/app.js')}}" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/ed1c70d70d.js" crossorigin="anonymous"></script>
    <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>

</head>

<body id="app">
@if(session('success') || session('info') || session('error'))
    <div id="toast" class="alert">
        <div class="notification_modal">
            <div style="margin-right: 12px">
                @if(session('success'))
                    <img src="{{ asset('images/success.png') }}" width="40" height="20" alt="success">
                @elseif(session('error'))
                    <img src="{{ asset('images/error.png') }}" width="40" height="20" alt="error">
                @else
                    <img src="{{ asset('images/info.png') }}" width="40" height="20" alt="info">
                @endif
            </div>
            <div>
                {{ session('success') ?? session('error') ?? session('info') }}
            </div>
        </div>
    </div>
@endif

@include('layouts.components._header')
{{--@include('chat')--}}
@yield('content')
@include('layouts.components._footer')
@yield('scripts')
</body>
</html>

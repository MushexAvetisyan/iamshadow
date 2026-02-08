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
    {{--    <meta name="is-user-logged-in" content="{{ auth()->check() }}">--}}
    <title>{{ config('app.name', 'Mushex Avetisyan') }}</title>
    <link href="{{ mix('dashboard/css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/global.css') }}" rel="stylesheet">
    <link href="{{ mix('css/light_mode.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="/public/images/Logo.png" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    @yield('header')
    <script src="{{mix('dashboard/js/app.js')}}" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
</head>

<body class="container">
@if(\Illuminate\Support\Facades\Session::has('flash_notification'))
    <div style="position: absolute" id="toast" role="alert">
        <div class="notification_modal">
            <div class="banners">
                @if(\Illuminate\Support\Facades\Session::get('flash_notification')->toArray()[0]['level'] == 'success')
                <div class="banner success">
                    <div class="banner-icon"><i data-eva="checkmark-circle-outline" data-eva-fill="#ffffff" data-eva-height="25" data-eva-width="30"></i></div>
                    <div class="banner-message">{{\Illuminate\Support\Facades\Session::get('flash_notification')->toArray()[0]['message']}}</div>
                </div>
                @else
                <div class="banner error">
                    <div class="banner-icon"><i data-eva="alert-circle-outline" data-eva-fill="#ffffff" data-eva-height="25" data-eva-width="30"></i></div>
                    <div class="banner-message">{{\Illuminate\Support\Facades\Session::get('flash_notification')->toArray()[0]['message']}}</div>
                </div>
                @endif
                    @if(\Illuminate\Support\Facades\Session::get('flash_notification')->toArray()[0]['level'] == 'info')
                <div class="banner info">
                    <div class="banner-icon"><i data-eva="info-outline" data-eva-fill="#ffffff" data-eva-height="25" data-eva-width="30"></i></div>
                    <div class="banner-message">{{\Illuminate\Support\Facades\Session::get('flash_notification')->toArray()[0]['message']}}</div>
                </div>
                    @endif
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/eva-icons" onload="eva.replace()"></script>
@endif

@include('dashboard.layouts.components._header')
@yield('content')
@include('dashboard.layouts.components._footer')
@yield('scripts')
</body>
</html>

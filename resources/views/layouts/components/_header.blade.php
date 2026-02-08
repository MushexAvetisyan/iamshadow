<header class="header" id="header-menu" data-header>
    <div class="container">
        @if(auth()->check() && auth()->user()->role == 1)
        <a href="{{url('/')}}" class="logo"><img src="{{asset('images/LogoInfinity.png')}}"
      width="200" height="40" alt="LearnItLogo"></a>
            @elseif(!auth()->check())
        <a href="{{url('/')}}" class="logo"><img src="{{asset('images/LogoInfinity.png')}}"
         width="200" height="40" alt="LearnItLogo"></a>
            @else
            <a href="{{url('/home')}}" class="logo"><img src="{{asset('images/LogoInfinity.png')}}"
             width="200" height="40" alt="LearnItLogo"></a>
            @endif
    <nav role="navigation"  class="navbar primary-navigation active" data-navbar>
    <div class="navbar-top">
        <a href="#" class="logo"><img src="{{asset('images/Logo.png')}}" width="230" height="40" alt="LearnItLogo"></a>
        <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
            <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
        </button>
    </div>
    <ul class="navbar-list">
    <li><a href="{{url('/home')}}" class="navbar-bottom-link hover-1" data-nav-toggler>{{ __('Header.Home') }}</a></li>
    <li><a href="{{url('authors')}}" class="navbar-bottom-link hover-1" data-nav-toggler>{{ __('Header.Author') }}</a></li>
    <li><a href="{{url('all-books')}}" class="navbar-bottom-link hover-1" data-nav-toggler>{{ __('Header.Books') }}</a></li>
    <li><a href="{{url('category')}}" class="navbar-bottom-link hover-1" data-nav-toggler>{{ __('Header.Category') }}</a></li>
    <li><a href="{{url('todos')}}" class="navbar-bottom-link hover-1" data-nav-toggler>Todos</a></li>
{{--    <li>--}}
{{--        <span class="navbar-link hover-1">{{ __('Header.Other')}}</span>--}}
{{--        <ul class="dropdown">--}}
{{--            <li><a href="{{url('cheatsheets')}}" class="navbar-link hover-1" data-nav-toggler>{{ __('Header.Sheets') }}</a></li>--}}
{{--            <li><a href="{{url('cyber')}}" class="navbar-link hover-1" data-nav-toggler>{{ __('Header.Hacking') }}</a></li>--}}
{{--            <li><a href="{{url('products')}}" class="navbar-link hover-1" data-nav-toggler>{{ __('Header.Products') }}</a></li>--}}
{{--            <li><a href="{{url('users')}}" class="navbar-link hover-1" data-nav-toggler>{{ __('Header.Devs') }}</a></li>--}}
{{--            <li><a href="{{url('resources')}}" class="navbar-link hover-1" data-nav-toggler>{{ __('Header.Resources') }}</a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}

        <li class="option">
            <span class="navbar-bottom-link hover-1">Main</span>
            <ul class="dropdown" id="registration-dropdown">
                @guest
                    <li><a href="{{route('login')}}" class="navbar-link hover-1" data-nav-toggler>{{ __('auth.login') }}</a></li>
                    <li><a href="{{route('register')}}" class="navbar-link hover-1" data-nav-toggler>{{ __('auth.registration') }}</a></li>

                    {{--ADMIN PANEL--}}
                @else
                    @if(auth()->user()->role == 1)
                    <li><a href="{{route('dashboard.index')}}" class="navbar-bottom-link hover-1">{{ __('Header.dashboard') }}</a></li>
                    <li><a href="{{route('profile.index')}}" class="navbar-bottom-link hover-1">Profile</a></li>
                    <li><a target="_blank" href="{{route('watchlist.index')}}" class="navbar-bottom-link hover-1">{{ __('Header.Watchlist') }}</a></li>
                    <li><a href="{{route('logout')}}" class="navbar-bottom-link hover-1" data-nav-toggler
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('auth.logout') }}</a>
                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">@csrf</form></li>

                     {{--USER PANNEL--}}
                    @else
                        <li style="display: flex; align-items: center">
                            <p style="margin-left: 2rem" class="card-title">{{ auth()->user()->name }}</p>
                        </li>
                    <li><a target="_blank" href="{{route('watchlist.index')}}" class="navbar-bottom-link hover-1">My Watchlist</a></li>
                    <li><a href="{{route('logout')}}" class="navbar-bottom-link hover-1" data-nav-toggler
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">@csrf</form></li>
            </ul>
        </li>
            @endguest
            @endif
        </ul>
    </nav>


        <label class="select" for="slct">
            <select class="changeLang" id="slct" required="required">
                <option selected="selected" value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                <option value="am" {{ session()->get('locale') == 'am' ? 'selected' : '' }}>Հայերեն</option>
            </select>
            <svg><use xlink:href="#select-arrow-down"></use></svg>
        </label>
        <!-- SVG Sprites-->
        <svg height="1rem" class="sprites"><symbol id="select-arrow-down" viewbox="0 0 10 6"><polyline points="1 1 5 5 9 1"></polyline></symbol></svg>
        <button class="nav-open-btn" aria-label="open menu" data-nav-toggler><ion-icon name="menu-outline" aria-hidden="true"></ion-icon></button>
        <div class="theme-switch-wrapper">
            <label class="theme-switch" for="theme-toggle">
                <input type="checkbox" id="theme-toggle" />
                <div class="slider round"></div>
            </label>
        </div>
    </div>
</header>


<script type="text/javascript">
    const url = "{{ route('change') }}";

    document.querySelector('.changeLang').addEventListener('change', function() {
        const selectedLang = this.value;
        window.location.href = `${url}?lang=${selectedLang}`;
    });
</script>

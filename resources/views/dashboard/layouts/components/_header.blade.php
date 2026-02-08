    <aside>
        <div class="top">
            <div class="logo"><a href="{{url('/')}}"><h2>Learn<span class="danger">IT</span></h2></a></div>
            <div id="close-btn"><span class="material-icons-sharp">close</span></div>
        </div>
        <div class="sidebar">
            <a class="nav-link {{Request::routeIs('dashboard.index') ? 'active' : ''}}" href="{{route('dashboard.index')}}"><span class="material-icons-sharp">grid_view</span><h3>Dashboard</h3></a>
            <a class="nav-link {{Request::routeIs('users.index') ? 'active' : ''}}" href="{{route('users.index')}}"><span class="material-icons-sharp">person_outline</span><h3>users</h3></a>
            <a class="nav-link {{Request::routeIs('authors.index') ? 'active' : ''}}" href="{{route('authors.index')}}"><span class="material-icons-sharp">person_outline</span><h3>Authors</h3></a>
            <a class="nav-link {{Request::routeIs('posts.index') ? 'active' : ''}}" href="{{route('posts.index')}}"><span class="material-icons-sharp">person_outline</span><h3>Posts</h3></a>
            <a class="nav-link {{Request::routeIs('categories.index') ? 'active' : ''}}" href="{{route('categories.index')}}"><span class="material-icons-sharp">category</span><h3>Categories</h3></a>
            <a class="nav-link {{Request::routeIs('languages.index') ? 'active' : ''}}" href="{{route('languages.index')}}"><span class="material-icons-sharp">developer_mode</span><h3>Languages</h3></a>
            <a class="nav-link {{Request::routeIs('books.index') ? 'active' : ''}}" href="{{route('books.index')}}"><span class="material-icons-sharp">menu_book</span><h3>Books</h3></a>
            <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="material-icons-sharp">logout</span><h3>Logout</h3>
            </a>
            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">@csrf</form>
        </div>
    </aside>


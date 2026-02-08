@extends('layouts.app')

@section('content')

    <div class="ProfileSection">
        <div class="container">
            <div class="left-side">
                <div class="side-wrapper">
                    <div class="side-title">YOUR FAVOURITE</div>
                    <div class="side-menu">
                        <h3>Liked Books</h3>
                        <ul>
                            @foreach($likedBooks as $like)
                                <li>{{ $like->book->title ?? 'Unknown Book' }}</li>
                            @endforeach
                        </ul>

                        <h3>Watchlist</h3>
                        <ul>
                            @foreach($watchlistBooks as $watchlist)
                                <li>{{ $watchlist->book->title ?? 'Unknown Book' }}</li>
                            @endforeach
                        </ul>
                        <a href="#">
                            Foresto
                        </a>

                        <h3>Requested Books</h3>
                        <ul>

                        </ul>
                    </div>
                </div>
                <a href="https://twitter.com/AysnrTrkk" class="follow-me" target="_blank">
   <span class="follow-text">
    <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
     <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
    </svg>
    Follow me on Twitter
   </span>
                    <span class="developer">
    <img src="https://pbs.twimg.com/profile_images/1253782473953157124/x56UURmt_400x400.jpg" />
    Aysenur Turk — @AysnrTrkk
   </span>
                </a>
            </div>
            <div class="main">
                <div class="main-container">
                    <div class="profile">
                        <div class="profile-avatar">
                            <img src="https://images.genius.com/2326b69829d58232a2521f09333da1b3.1000x1000x1.jpg" alt="" class="profile-img">
                            <div class="profile-name">{{auth()->user()->name}}</div>
                        </div>
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

                            <form action="{{ route('profile.update') }}" class="ProfileForm" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="ProfileFormBox">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="ProfileFormInput">
                                </div>

                                <div class="ProfileFormBox">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="ProfileFormInput">
                                </div>

                                <div class="ProfileFormBox">
                                    <label>New Password (optional)</label>
                                    <input type="password" name="password" class="ProfileFormInput">
                                </div>

                                <div class="ProfileFormBox">
                                    <label>Confirm New Password</label>
                                    <input type="password" name="password_confirmation" class="ProfileFormInput">
                                </div>

                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="timeline-left">
                            <div class="intro box">
                                <div class="intro-title">
                                    Bio
                                </div>
                                <div class="info">
                                    <div class="info-item">
                                        Email <a href="#">{{auth()->user()->email}}</a>
                                    </div>
                                    <div class="info-item">
                                        Live in <a href="#">Hanoi, Vietnam</a>
                                    </div>
                                    <div class="info-item">
                                        Player name <a href="#">Quan Ha</a>
                                    </div>
                                </div>
                            </div>
                            <div class="event box">
                                <div class="event-wrapper">
                                    <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80" class="event-img" />
                                    <div class="event-date">
                                        <div class="event-month">Jan</div>
                                        <div class="event-day">01</div>
                                    </div>
                                    <div class="event-title">Winter Wonderland</div>
                                    <div class="event-subtitle">01st Jan, 2019 07:00AM</div>
                                </div>
                            </div>
                            <div class="pages box">
                                <div class="intro-title">
                                    Your pages
                                    <button class="intro-menu"></button>
                                </div>
                                <div class="user">
                                    <img src="https://images.unsplash.com/photo-1549068106-b024baf5062d?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0f" alt="" class="user-img">
                                    <div class="username">Chandelio</div>
                                </div>
                                <div class="user">
                                    <img src="https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=d5849d81af587a09dbcf3f11f6fa122f" alt="" class="user-img">
                                    <div class="username">Janet Jolie</div>
                                </div>
                                <div class="user">
                                    <img src="https://images.unsplash.com/photo-1546539782-6fc531453083?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" class="user-img">
                                    <div class="username">Patrick Watsons</div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-right">
                            <div class="status box">
                                <div class="status-menu">
                                    <a class="status-menu-item active" href="#">Status</a>
                                    <a class="status-menu-item" href="#">Photos</a>
                                    <a class="status-menu-item" href="#">Videos</a>
                                </div>
                                <div class="status-main">
                                    <img src="https://images.genius.com/2326b69829d58232a2521f09333da1b3.1000x1000x1.jpg" class="status-img">
                                    <textarea class="status-textarea" placeholder="Write something to Quan Ha.."></textarea>
                                </div>
                                <div class="status-actions">
                                    <a href="#" class="status-action">
                                        <svg viewBox="-42 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M333.7 123.3c0 33.9-12.2 63.2-36.2 87.2-24 24-53.3 36.1-87.1 36.1h-.1c-33.9 0-63.2-12.1-87.1-36.1-24-24-36.2-53.3-36.2-87.2 0-33.9 12.2-63.2 36.2-87.2 24-24 53.2-36 87-36.1h.2c33.8 0 63.2 12.2 87.1 36.1 24 24 36.2 53.3 36.2 87.2zm0 0" fill="#ffbb85" />
                                            <path d="M427.2 424c0 26.7-8.5 48.3-25.3 64.3-16.5 15.7-38.4 23.7-65 23.7H90.2c-26.6 0-48.5-8-65-23.7C8.5 472.3 0 450.7 0 423.9c0-10.2.3-20.4 1-30.2a302.7 302.7 0 0112.1-64.9c3.3-10.3 7.8-20.5 13.4-30.3 5.8-10.2 12.5-19 20.1-26.3a89 89 0 0129-18.2c11.2-4.4 23.7-6.7 37-6.7 5.2 0 10.3 2.2 20 8.5l21 13.5c6.6 4.3 15.7 8.3 27 11.9a107.7 107.7 0 0033 5.3c11 0 22-1.8 33-5.3 11.2-3.6 20.3-7.6 27-12l21-13.4c9.7-6.3 14.7-8.5 20-8.5 13.3 0 25.7 2.3 37 6.7a89 89 0 0128.9 18.2c7.6 7.3 14.4 16.1 20.2 26.3 5.5 9.8 10 20 13.3 30.3a305.5 305.5 0 0112.1 64.9c.7 9.8 1 20 1 30.2zm0 0" fill="#6aa9ff" />
                                            <path d="M210.4 246.6h-.1V0c34 0 63.3 12.2 87.2 36.1 24 24 36.2 53.3 36.2 87.2 0 33.9-12.2 63.2-36.2 87.2-24 24-53.3 36.1-87.1 36.1zm0 0" fill="#f5a86c" />
                                            <path d="M427.2 424c0 26.7-8.5 48.3-25.3 64.3-16.5 15.7-38.4 23.7-65 23.7H210.2V286.5h3.3c11 0 22-1.8 33-5.3 11.2-3.6 20.3-7.6 27-12l21-13.4c9.7-6.3 14.7-8.5 20-8.5 13.3 0 25.7 2.3 37 6.7a89 89 0 0128.9 18.2c7.6 7.3 14.4 16.1 20.2 26.3 5.5 9.8 10 20 13.3 30.3a305.5 305.5 0 0112.1 64.9c.7 9.8 1 20 1 30.2zm0 0" fill="#2682ff" />
                                        </svg>
                                        People
                                    </a>
                                    <a href="#" class="status-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M87.084 192c-.456-5.272-.688-10.6-.688-16C86.404 78.8 162.34 0 256.004 0s169.6 78.8 169.6 176c0 5.392-.232 10.728-.688 16h.688c0 96.184-169.6 320-169.6 320s-169.6-223.288-169.6-320h.68zm168.92 32c36.392 1.024 66.744-27.608 67.84-64-1.096-36.392-31.448-65.024-67.84-64-36.392-1.024-66.744 27.608-67.84 64 1.096 36.392 31.448 65.024 67.84 64z" fill="#e21b1b" />
                                        </svg>
                                        Check in
                                    </a>
                                    <a href="#" class="status-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="256" cy="256" r="256" fill="#ffca28" />
                                            <g fill="#6d4c41">
                                                <path d="M399.68 208.32c-8.832 0-16-7.168-16-16 0-17.632-14.336-32-32-32s-32 14.368-32 32c0 8.832-7.168 16-16 16s-16-7.168-16-16c0-35.296 28.704-64 64-64s64 28.704 64 64c0 8.864-7.168 16-16 16zM207.68 208.32c-8.832 0-16-7.168-16-16 0-17.632-14.368-32-32-32s-32 14.368-32 32c0 8.832-7.168 16-16 16s-16-7.168-16-16c0-35.296 28.704-64 64-64s64 28.704 64 64c0 8.864-7.168 16-16 16z" />
                                            </g>
                                            <path d="M437.696 294.688c-3.04-4-7.744-6.368-12.736-6.368H86.4c-5.024 0-9.728 2.336-12.736 6.336-3.072 4.032-4.032 9.184-2.688 14.016C94.112 390.88 170.08 448.32 255.648 448.32s161.536-57.44 184.672-139.648c1.376-4.832.416-9.984-2.624-13.984z" fill="#fafafa" />
                                        </svg>
                                        Mood
                                    </a>
                                    <button class="status-share">Share</button>
                                </div>
                            </div>
                            <div class="album box">
                                <div class="status-main">
                                    <img src="https://images.genius.com/2326b69829d58232a2521f09333da1b3.1000x1000x1.jpg" class="status-img" />
                                    <div class="album-detail">
                                        <div class="album-title"><strong>Quan Ha</strong> create new <span>album</span></div>
                                        <div class="album-date">6 hours ago</div>
                                    </div>
                                    <button class="intro-menu"></button>
                                </div>
                                <div class="album-content">When the bass drops, so do my problems.
                                    <div class="album-photos">
                                        <img src="https://images.unsplash.com/photo-1508179719682-dbc62681c355?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2378&q=80" alt="" class="album-photo" />
                                        <div class="album-right">
                                            <img src="https://images.unsplash.com/photo-1502872364588-894d7d6ddfab?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2250&q=80" alt="" class="album-photo" />
                                            <img src="https://images.unsplash.com/photo-1566737236500-c8ac43014a67?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80" alt="" class="album-photo" />
                                        </div>
                                    </div>
                                </div>
                                <div class="album-actions">
                                    <a href="#" class="album-action">
                                        <svg stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                                        </svg>
                                        87
                                    </a>
                                    <a href="#" class="album-action">
                                        <svg stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1" viewBox="0 0 24 24">
                                            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                                        </svg>
                                        20
                                    </a>
                                    <a href="#" class="album-action">
                                        <svg stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1" viewBox="0 0 24 24">
                                            <path d="M17 1l4 4-4 4" />
                                            <path d="M3 11V9a4 4 0 014-4h14M7 23l-4-4 4-4" />
                                            <path d="M21 13v2a4 4 0 01-4 4H3" />
                                        </svg>
                                        13
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-side" :class="{ 'active': rightSide }">
                <div class="side-wrapper stories">
                    <div class="side-title">STORIES</div>
                    <div class="user">
                        <img src="https://pbs.twimg.com/profile_images/1102351320567164931/ZCkJgJIH.png" alt="" class="user-img">
                        <div class="username">Lisandro Matos
                            <div class="album-date">12 hours ago</div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://pbs.twimg.com/profile_images/1153966095444992000/1lpIyHaQ.jpg" alt="" class="user-img">
                        <div class="username">Gvozden Boskovsky
                            <div class="album-date">29 minutes ago</div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://images.unsplash.com/photo-1565464027194-7957a2295fb7?ixlib=rb-1.2.1&auto=format&fit=crop&w=3500&q=80" alt="" class="user-img">
                        <div class="username">Hnek Fortuin
                            <div class="album-date">3 hours ago</div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?ixlib=rb-1.2.1&auto=format&fit=crop&w=1400&q=80" alt="" class="user-img">
                        <div class="username">Lubomir Dvorak
                            <div class="album-date">18 hours ago</div>
                        </div>
                    </div>
                </div>
                <div class="side-wrapper contacts">
                    <div class="side-title">CONTACTS</div>
                    <div class="user">
                        <img src="https://randomuser.me/api/portraits/men/1.jpg" class="user-img">
                        <div class="username">Andrei Mashrin
                            <div class="user-status"></div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=046c29138c1335ef8edee7daf521ba50" class="user-img">
                        <div class="username">Aryn Jacobssen
                            <div class="user-status offline"></div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://images.unsplash.com/photo-1575084713138-342cae5f8d00?ixlib=rb-1.2.1&auto=format&fit=crop&w=958&q=80" class="user-img">
                        <div class="username">Carole Landu
                            <div class="user-status offline"></div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://images.pexels.com/photos/598745/pexels-photo-598745.jpeg?h=350&auto=compress&cs=tinysrgb" class="user-img">
                        <div class="username">Chineze Afa
                            <div class="user-status"></div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://pbs.twimg.com/profile_images/2452384114/noplz47r59v1uxvyg8ku.png" class="user-img">
                        <div class="username">Mok Kwang
                            <div class="user-status"></div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://randomuser.me/api/portraits/women/63.jpg" class="user-img">
                        <div class="username">Naomi Yepes
                            <div class="user-status"></div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://images.unsplash.com/photo-1476493279419-b785d41e38d8?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=61eaea85f1aa3d065400179c78163f15" class="user-img">
                        <div class="username">Shaamikh Ale
                            <div class="user-status"></div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://m.media-amazon.com/images/M/MV5BMjI4NDcyNjQxNl5BMl5BanBnXkFtZTgwMzI4OTM3NjM@._V1_UY256_CR13,0,172,256_AL_.jpg" class="user-img">
                        <div class="username">Sofia Alcocer
                            <div class="user-status idle"></div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://images.unsplash.com/photo-1509380836717-c4320ccf1a6f?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=e01c8c45a063daaf6d6e571a32bd6c90" class="user-img">
                        <div class="username">Wen Yahui
                            <div class="user-status"></div>
                        </div>
                    </div>
                    <div class="user">
                        <img src="https://pbs.twimg.com/profile_images/737221709267374081/sdwta9Oh.jpg" alt="" class="user-img">
                        <div class="username">Leslee Moss
                            <div class="user-status idle"></div>
                        </div>
                    </div>
                </div>
                <div class="search-bar right-search">
                    <input type="text" placeholder="Search" />
                    <div class="search-bar-svgs">
                        <svg stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" />
                        </svg>
                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 469.34 469.34">
                            <path d="M456.84 76.17l-64-64.06c-16.13-16.13-44.18-16.17-60.37.04L45.77 301.67a10.73 10.73 0 00-2.7 4.59L.41 455.73a10.68 10.68 0 0013.19 13.2l149.33-42.7c1.73-.5 3.3-1.42 4.58-2.7l289.33-286.98c8.06-8.07 12.5-18.78 12.5-30.19s-4.44-22.12-12.5-30.2zM285.99 89.74L325.25 129l-205 205-14.7-29.44a10.67 10.67 0 00-9.55-5.9H78.92L286 89.75zM26.2 443.14l13.9-48.64 34.74 34.74-48.64 13.9zm123.14-35.18L98.3 422.54l-51.5-51.5L61.38 320H89.4l18.38 36.77a10.67 10.67 0 004.77 4.77l36.78 18.39v28.03zm21.33-17.54v-17.09c0-4.04-2.28-7.72-5.9-9.54l-29.43-14.7 205-205 39.26 39.26-208.93 207.07zm271.11-268.7l-47.03 46.61L301 74.6l46.59-47c8.06-8.07 22.1-8.07 30.16 0l64 64c4.03 4.03 6.25 9.38 6.25 15.08s-2.22 11.05-6.22 15.05z" />
                        </svg>
                        <svg stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="overlay" @click="rightSide = false; leftSide = false" :class="{ 'active': rightSide || leftSide }"></div>
        </div>
    </div>
@endsection

<!doctype html>
<head>
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/f671750d47.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://kit.fontawesome.com/79ac1eddda.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{asset('favicon-32x32.ico')}}" type="image/x-icon">
</head>

<style>
   /* .nav-span:hover{ color: #1C6513 !important; }*/
</style>

<div class="container-fluid shadow-sm p-3 rounded" style="">
    <nav class="navbar navbar-expand-lg border-0 shadow-none bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{asset('clear-logo.png')}}" alt="cookmaster" width="64" height="64">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link mx-3" href="{{ route('home') }}">
                            <span class="nav-span">{{'Home'}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3" href="{{ route('workshops') }}">
                            <span class="nav-span">{{'Workshops'}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3" href="/">
                            <span class="nav-span">{{'Courses'}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3" href="{{ route('events.index') }}">
                            <span class="nav-span">{{'Events'}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3" href="/">
                            <span class="nav-span">{{'Shop'}}</span>
                        </a>
                    </li>
                </ul>

                <!-- Disconnected -->
                <ul class="navbar-nav">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fa-regular fa-user me-2"></i>
                                    <span class="nav-span">{{'Login'}}</span>
                                </a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fa-solid fa-right-to-bracket me-2"></i>
                                    <span class="nav-span">{{'Sign up'}}</span>
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown me-3">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink"
                               role="button" data-mdb-toggle="dropdown" aria-expanded="true">
                                <img src="https://www.pngall.com/wp-content/uploads/2016/05/Man-Download-PNG.png" class="rounded-circle"
                                     height="22" alt="Portrait of a Woman" loading="lazy" />
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profil') }}">Profile</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('reservations')}}">{{__("Mes réservations")}}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-menu-end" aria-labelledby="navbarDropdown" href="{{route('logout')}}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                        @auth
                            @if(auth()->user()->is_admin)
                                <style>
                                    .dropdown {
                                        position: relative;
                                        display: inline-block;
                                    }

                                    .dropdown-content {
                                        display: none;
                                        position: absolute;
                                        background-color: #ffffff;
                                        color: black!important;
                                        min-width: 160px;
                                        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                                        z-index: 1;
                                    }

                                    .active {
                                        background-color: #c2c2c2;
                                        color: black;
                                    }
                                    .dropdown:hover .dropdown-content {
                                        display: block;
                                    }

                                    .dropdown-content a {
                                        display: block;
                                        padding: 8px 16px;
                                        text-decoration: none;
                                    }
                                </style>
                                <div class="dropdown">
                                    <a class="btn btn-secondary">Administration</a>
                                    <div class="dropdown-content">
                                        <a href="{{ route('admin.office.index') }}" class="{{ Request::is('admin/office*') ? 'active' : '' }}">Les locaux</a>
                                        <a href="{{ route('admin.user.index') }}" class="{{ Request::is('admin/user*') ? 'active' : '' }}">Les utilisateurs</a>
                                        <a href="{{ route('admin.room.index') }}" class="{{ Request::is('admin/room*') ? 'active' : '' }}">Les rooms</a>
                                        <a href="{{ route('events.list') }}" class="{{ Request::is('events/list') ? 'active' : '' }}">Les évènements</a>
                                    </div>
                                </div>
                            @endif
                        @endauth
                </ul>
            </div>
        </div>
    </nav>
</div>

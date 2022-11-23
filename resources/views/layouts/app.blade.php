<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- scss & scripts -->
    @vite(['resources/sass/app.scss', 
            'resources/js/app.js', 
            'resources/js/common.js'])

    <style>
        .navbar {
            background-color: #000;
        }

        .app-name-abbrv {
            /* letter-spacing: 3px;
            color: #0066ff; */
        }
    </style>
    
    @yield('customcss')
    @yield('customjs')
</head>
<body>
    <span class="d-none" id="toast-data-holder" 
        data-msg="
            @if (session('notification') !== null)
                {{ session('notification')['message'] }}
            @endif
        "
        data-type="
            @if (session('notification') !== null)
                {{ session('notification')['type'] }}
            @endif
        ">
    </span>

    <div id="loader">
        <img src="/img/ball-triangle.svg" alt="" srcset="">
    </div>

    <img src="/img/background.jpg" alt="" style="display: none">
    <div id="background-image"></div>

    <div id="app" class="d-flex flex-column">
        <nav id="navbar" class="navbar navbar-expand-md shadow-sm fs-5 navbar-dark position-fixed w-100">
            <div class="container">
                <a class="navbar-brand fs-3 text-white" href="{{ url('/') }}">
                    <span class="fw-bolder text-secondary" style="letter-spacing: 3px">VJE</span>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/job-posts">Job Posts</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route(Auth::user()->role . '.dashboard') }}">Dashboard</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->email }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5 col" style="margin-top: 70px">
            <div class="container-md d-flex flex-column">
                @yield('content')
            </div>
        </main>

        <footer id="footer" class="pb-2 m-0 text-center">
            <hr>
            <div class="d-flex justify-content-center flex-wrap pt-1">
                <p class="text-muted p-0 m-0">&copy; 2022 Developed by <a href="https://github.com/fjebernas" 
                                                                        target="_blank"
                                                                        style="text-decoration: none; color: rgb(153, 153, 153)">
                                                                            <strong>Francis Bernas.</strong>
                                                                        </a>
                                                                    </p>
                <p class="text-muted p-0 m-0">&nbsp; VJE Virtual Job Expo</p>
            </div>
            <p class="text-muted p-0 mt-2">"Unless someone like you cares a whole awful lot, nothing is going to get better." - <i>Dr. Seuss</i></p>
        </footer>
    </div>
</body>
</html>

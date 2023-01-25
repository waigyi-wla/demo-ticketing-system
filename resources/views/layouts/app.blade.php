<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
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
                        
                        @Auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
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
                        @endAuth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container-lg">
            @auth
                <div class="row">
                    <div class="col-lg-2">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item {{request()->segment(1) == '' ? 'active' : ''}}" href="{{ url('/') }}">
                                Dashboard
                            </a>
                            <a class="list-group-item {{request()->segment(1) == 'tickets' ? 'active' : ''}}" href="{{ url('/tickets') }}">
                                Tickets
                            </a>
                            
                            @if(Auth::user()->is_admin == 1)
                            <a class="list-group-item {{request()->segment(1) == 'users' ? 'active' : ''}}" href="{{ url('/users') }}">
                                Users
                            </a>
                            <a class="list-group-item {{request()->segment(1) == 'categories' ? 'active' : ''}}" href="{{ url('/categories') }}">
                                Categories
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-10">
                        @yield('content')
                    </div>
                </div>
            @else
                @yield('content')
            @endauth
        </main>
    </div>
</body>
</html>
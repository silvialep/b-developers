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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">


        <nav class="navbar navbar-expand-md shadow-sm nav-bar-cont">
            <div class="container nav-container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="logo_bdevelopers">
                        <img src="{{Vite::asset('resources/img/bdevelopers-logo.png')}}" alt="logo-image">
                    </div>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item d-flex">
                            <a class="nav-link text-white" style="font-weight:bold" href="{{url('/') }}">{{ __('Home') }}</a>
                            <a class="nav-link text-white" style="font-weight:bold" href="{{url('/admin') }}">{{ __('Dashboard') }}</a>

                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" style="font-weight:bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" style="font-weight:bold" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown text-white">
                            <a id="navbarDropdown" style="font-weight:bold" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right text-white" aria-labelledby="navbarDropdown">
                                {{-- <a class="dropdown-item" href="{{ url('dashboard') }}">{{__('Dashboard')}}</a> --}}
                                <a class="dropdown-item text-dark" style="font-weight:bold" href="{{ url('profile') }}">{{__('Profilo')}}</a>
                                <a class="dropdown-item text-dark" style="font-weight:bold" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        <main class="">
            @yield('content')
        </main>
    </div>
</body>
</html>

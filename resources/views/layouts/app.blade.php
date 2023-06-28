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

        <nav class="navbar-light bg-white shadow-sm nav-bar-cont">
            <div class="container nav-container">
                <a class="navbar-brand d-flex align-items-center" href="http://localhost:5174/">
                    <div class="logo-bdevelopers">
                        <img src="{{Vite::asset('resources/img/bdevelopers-logo-white.png')}}" alt="logo-image">
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <div class="nav-burger">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li><a class="dropdown-item text-dark" style="font-weight:bold" href="http://localhost:5174/">{{ __('Home') }}</a></li>
                            <li><a class="dropdown-item text-dark" style="font-weight:bold" href="{{url('/admin') }}">{{ __('Dashboard') }}</a></li>
                            <li><a class="dropdown-item text-dark" style="font-weight:bold" href="{{ url('profile') }}">{{__('Profilo')}}</a></li>
                            <li><a class="dropdown-item text-dark" style="font-weight:bold" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a></li>
                        </ul>
                    </div>
                </div>

                <div class="nav-links">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item d-flex gap-3">
                            <a class="nav-link" style="color:rgb(20, 110, 190); font-weight:bold" href="{{url('http://localhost:5174/') }}">{{ __('Home') }}</a>
                            <a class="nav-link" style="color:rgb(20, 110, 190); font-weight:bold" href="{{url('/admin') }}">{{ __('Dashboard') }}</a>

                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav d-flex flex-row gap-3">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" style="color:rgb(20, 110, 190); font-weight:bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" style="color:rgb(20, 110, 190); font-weight:bold" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" style="color:rgb(20, 110, 190); font-weight:bold" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{-- <a class="dropdown-item" href="{{ url('dashboard') }}">{{__('Dashboard')}}</a> --}}
                                <a class="dropdown-item" style="color:rgb(20, 110, 190); font-weight:bold" href="{{ url('profile') }}">{{__('Profilo')}}</a>
                                <a class="dropdown-item" style="color:rgb(20, 110, 190); font-weight:bold" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        <main class="main-container">
            @yield('content')
        </main>
        <footer class="bg-light text-center text-white">
    
          <!-- Grid container -->
          <div class="container p-4 pb-0 mt-5">
            <!-- Links -->
              <section class="footer-links">
                <div class="container text-center text-md-start my-5" style="color:#333333">
                  <!-- Grid row -->
                  <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 bdevelopers">
                      <!-- Content -->
                      <h6 class="text-uppercase fw-bold mb-4">
                        <img src="{{Vite::asset('resources/img/bdevelopers-website-favicon-black.png')}}" alt=""> <span>BDevelopers</span>
                      </h6>
                      
                      <p>
                        Una soluzione fatta apposta per il business.
                        Approfitta di un'esperienza curata per accedere a talenti selezionati e strumenti esclusivi.
                      </p>
                    </div>
                    <!-- Grid column -->
    
                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 bdevelopers">
                      <!-- Links -->
                      <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fa-solid fa-microchip"></i> <span class="footer-lil-title">Servizi</span>
                      </h6>
                      <p>
                        <a href="#!" class="text-reset">Angular</a>
                      </p>
                      <p>
                        <a href="#!" class="text-reset">React</a>
                      </p>
                      <p>
                        <a href="#!" class="text-reset">Vue</a>
                      </p>
                      <p>
                        <a href="#!" class="text-reset">Laravel</a>
                      </p>
                    </div>
                    <!-- Grid column -->
    
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                      <!-- Links -->
                      <h6 class="text-uppercase fw-bold mb-4 titolo">
                        <i class="fa-solid fa-link"></i> <span class="footer-lil-title">Link Utili</span>
                      </h6>
                      <p>
                        <a href="#!" class="text-reset">Prezzi</a>
                      </p>
                      <p>
                        <a href="#!" class="text-reset">Impostazioni</a>
                      </p>
                      <p>
                        <a href="#!" class="text-reset">Ordini</a>
                      </p>
                      <p>
                        <a href="#!" class="text-reset">Assistenza</a>
                      </p>
                    </div>
                    <!-- Grid column -->
    
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                      <!-- Links -->
                      <h6 class="text-uppercase fw-bold mb-4 titolo">
                        <i class="fa-regular fa-address-card"></i> <span class="footer-lil-title">Contatti</span>
                      </h6>
                      <p><i class="fas fa-home me-3"></i> Vle Cassala 22 Milano Lombardia</p>
                      <p>
                        <i class="fas fa-envelope me-3"></i>
                        BDevelopers@email.it
                      </p>
                      <p><i class="fas fa-phone me-3"></i> + 02 367 890 22</p>
                      <p><i class="fas fa-print me-3"></i> + 02 690 582 37</p>
                    </div>
                    <!-- Grid column -->
                  </div>
                  <!-- Grid row -->
                </div>
              </section>
              <!-- Links -->
            <!-- Section: Social media -->
            <section class="my-5" id="footer-icons">
              <!-- Facebook -->
              <span
                class="btn text-white btn-floating m-1"
                style="background-color: #3b5998;"
                role="button"
                ><i class="fab fa-facebook-f"></i
              ></span>
    
              <!-- Twitter -->
              <span
                class="btn text-white btn-floating m-1"
                style="background-color: #55acee;"
                role="button"
                ><i class="fab fa-twitter"></i
              ></span>
    
              <!-- Google -->
              <span
                class="btn text-white btn-floating m-1"
                style="background-color: #dd4b39;"
                role="button"
                ><i class="fab fa-google"></i
              ></span>
    
              <!-- Instagram -->
              <span
                class="btn text-white btn-floating m-1"
                style="background-color: #ac2bac;"
                role="button"
                ><i class="fab fa-instagram"></i
              ></span>
    
              <!-- Linkedin -->
              <span
                class="btn text-white btn-floating m-1"
                style="background-color: #0082ca;"
                href=""
                role="button"
                ><i class="fab fa-linkedin-in"></i
              ></span>
              <!-- Github -->
              <span
                class="btn text-white btn-floating m-1"
                style="background-color: #333333;"
                role="button"
                ><i class="fab fa-github"></i
              ></span>
            </section>
            <!-- Section: Social media -->
          </div>
          <!-- Grid container -->
    
          
    
          <!-- Copyright -->
          <div class="text-center p-3" id="footer-bottom">
            © 2023 Copyright:
            <span>Team 1</span>
          </div>
          <!-- Copyright -->
        </footer>
    </div>

</body>

</html>

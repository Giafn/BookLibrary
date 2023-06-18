<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- swiper js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{url('/css/app.css')}}">
</head>
<body>
    <div id="app">
        @guest
        @else
        <nav class="navbar navbar-expand-lg mt-4 w-100 sticky-top bg-dark">
            <div class="container">
                <a class="navbar-brand me-md-5 ms-2" href="{{ url('/') }}">
                    <h3 class="fw-bolder">Book<span class="text-warning">Library</span></h3>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto w-100 d-md-block d-none">
                        <div class="input-group flex-nowrap w-50">
                            <span class="input-group-text" id="addon-wrapping"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search Book" aria-label="search" aria-describedby="addon-wrapping">
                        </div>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                    </ul>
                </div>
            </div>
        </nav>
        @endguest

        <div class="row w-100">
            @guest
            @else
            <div class="col-md-3 d-md-block d-none">
                <div class="d-flex flex-column flex-shrink-0 ps-4 text-center">
                    <a href="/" class="mx-auto mb-3 mb-md-0 me-md-auto text-decoration-none">
                        <i class="bi bi-book fs-1"></i>
                    </a>
                    <ul class="nav nav-pills flex-column mb-auto">
                      <li class="nav-item">
                        <a href="#" class="nav-link active" aria-current="page">
                            <i class="bi bi-house me-2"></i>
                            Home
                        </a>
                      </li>
                    <hr>
                      <li>
                        <a href="#" class="nav-link">
                            <i class="bi bi-book me-2"></i>
                            My Collection
                        </a>
                      </li>
                      <li>
                        <a href="#" class="nav-link">
                            <i class="bi bi-star me-2"></i>
                            Favorites
                        </a>
                      </li>
                    </ul>
                </div>
            </div>
            @endguest
            @guest
            <div class="col">
            @else
            <div class="col-md-9">
            @endguest
                <main class="py-4">
                    @yield('content')
                </main>
                <footer>
                    <div class="text-center py-3">
                        <span class="">Made with <i class="bi bi-heart-fill"></i> by kelompok 3</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
@stack('Scripts')

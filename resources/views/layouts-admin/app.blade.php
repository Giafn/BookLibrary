<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
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
        <div class="row w-100">
            <div class="col-md-3 d-md-block d-none vh-100 sticky-top" style="background-color: #F1C376">
                <div class="d-flex flex-column flex-shrink-0 ps-4 text-center pt-4">
                    <a class="text-center text-decoration-none" href="{{ url('/') }}">
                        <h3 class="fw-bolder text-primary">Admin<span class="text-white">Library</span></h3>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto text-dark">
                      <li class="nav-item">
                        <a href="{{url('/admin')}}" class="nav-link @if ($selected == "home") active @else text-dark @endif" aria-current="page">
                            <i class="bi bi-house me-2"></i>
                            Dashboard
                        </a>
                      </li>
                        <hr>
                      <li>
                        <a href="{{url('/admin/bookList')}}" class="nav-link @if ($selected == "bookList") active @else text-dark @endif">
                            <i class="bi bi-book-fill me-2"></i>
                            Book List
                        </a>
                      </li>
                      <li>
                        <a href="#" class="nav-link @if ($selected == "borrowed") active @else text-dark @endif">
                            <i class="bi bi-bookmark-fill me-2"></i>
                            Borrowed Book
                        </a>
                      </li>
                      <li>
                        <a href="#" class="nav-link @if ($selected == "member") active @else text-dark @endif">
                            <i class="bi bi-person-lines-fill me-2"></i>
                           Member List
                        </a>
                      </li>
                      <li>
                        <a href="#" class="nav-link @if ($selected == "lost") active @else text-dark @endif">
                            <i class="bi bi-journal-x me-2"></i>
                           Lost Book
                        </a>
                      </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <nav class="navbar navbar-expand-lg w-100">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
        
                        <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
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
                <main class="py-4">
                    {{-- loading div --}}
                    <div class="d-flex justify-content-center align-items-center bg-white fixed-top d-none opacity-50" id="loader" style="height: 100vh">
                        <div class="spinner-border text-primary opacity-100" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    @yield('content')
                </main>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@stack('Scripts')

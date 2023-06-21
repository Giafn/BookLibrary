<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Book Library</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- logo -->
    <link rel="icon" href="{{url('/img/logo/logo.png')}}" type="image/x-icon">
    
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
        @if (Auth::user()->hasVerifiedEmail())
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
                        <form action="{{url('/search')}}" method="get">
                            <div class="input-group flex-nowrap w-50">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-search"></i></span>
                                @csrf
                                <input name="search" type="text" class="form-control" placeholder="Search Book" aria-label="search" aria-describedby="addon-wrapping" 
                                @isset($typing)
                                    value="{{$typing}}"
                                @endisset>
                            </div>
                        </form>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a class="my-1 d-md-none d-block btn btn-dark @if(Request::url() == url('/home')) active @endif" href="{{url('/')}}">Home</a>
                            <a class="my-1 d-md-none d-block btn btn-dark @if(Request::url() == url('/borrow')) active @endif" href="{{url('/borrow')}}">My Borrow</a>
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
    @endif
    @endguest
    
    <div class="row w-100">
        @guest
        @else
        @if (Auth::user()->hasVerifiedEmail())
        <div class="col-md-3 d-md-block d-none">
            <div class="d-flex flex-column flex-shrink-0 ps-4 text-center">
                <a href="/" class="mx-auto mb-3 mb-md-0 me-md-auto text-decoration-none">
                    <i class="bi bi-book fs-1"></i>
                </a>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link @if(Request::url() == url('/home')) active @endif" aria-current="page">
                            <i class="bi bi-house me-2"></i>
                            Home
                        </a>
                    </li>
                    <hr>
                    <li>
                        <a href="{{url('/borrow')}}" class="nav-link @if(Request::url() == url('/borrow')) active @endif">
                            <i class="bi bi-book me-2"></i>
                            My Borrow
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        @endguest
        @guest
        <div class="col">
            @else
            @if (Auth::user()->hasVerifiedEmail())
            <div class="col-md-9">
                @endif
                @endguest
                <div class="d-none d-flex justify-content-center align-items-center bg-dark fixed-top opacity-50" id="loader" style="height: 100vh">
                    <div class="spinner-border text-primary opacity-100" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <main class="py-4">
                    @guest
                    @else
                    @if (Auth::user()->hasVerifiedEmail())
                    <div class="row ms-2">
                        <div class="col-12">
                            <form action="{{url('/search')}}" method="get">
                                <div class="input d-md-none d-block">
                                    @csrf
                                    <input name="search" type="text" class="form-control" placeholder="Search Book" aria-label="search"
                                    @isset($typing)
                                        value="{{$typing}}"
                                    @endisset>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    @endguest
                    @yield('content')
                </main>
                <div class="p-2 mt-5">
                    <footer class="fixed-bottom bg-dark">
                        <div class="text-center py-3">
                            <span class="">Made with <i class="bi bi-heart-fill"></i> by kelompok 3</span>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
{{-- jquery cdn --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- vite js --}}
<script>
    $(window).bind('beforeunload', function(){
        $('#loader').removeClass('d-none');
        setTimeout(function(){
            $('#loader').addClass('d-none');
        }, 7000);
    });
</script>
@stack('Scripts')

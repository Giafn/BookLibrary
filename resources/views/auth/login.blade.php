@extends('layouts.app')

@section('content')
<div class="d-none d-lg-block">
    <div class="position-absolute bottom-0 start-0">
        <img class="img-fluid" src="{{url('/img/book1.svg')}}" alt="">
    </div>
    <div class="position-absolute bottom-0 end-0">
        <img class="img-fluid" src="{{url('/img/book2.svg')}}" alt="">
    </div>
</div>
<div class="d-block d-lg-none">
    <div class="position-absolute top-5 start-50 translate-middle-x">
        <img class="img-fluid" src="{{url('/img/book1.svg')}}" alt="">
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-7 col-sm-10 pb-md-2 pb-5 position-absolute bottom-0 start-50 translate-middle-x z-index-modal">
           <div class="card rounded-5 rounded-bottom-0" data-bs-theme="light">
                <h4 class="text-center fw-bold mt-3">Login</h4>
                <div class="card-body px-md-5 px-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Email</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="username" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-1">
                                <div class="form-check">
                                    <div class="d-flex justify-content-between">
                                        <div class="formcheck">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                        <p class="text-end"><a href=""><small>Forgot Password?</small></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-5">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill btn-lg fs-6">LOGIN</button>
                        </div>
                        <div class="text-center mb-5">
                            <p class="mb-0">Don't have an account?</p>
                            <a href="{{ route('register') }}">Register</a>
                        </div>
                    </form>
                </div>
           </div>
        </div>
    </div>
</div>

@endsection

{{-- 
<div class="card">
    <div class="card-header">{{ __('Login') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div> --}}

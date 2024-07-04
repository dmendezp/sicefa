@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="row text-center">
                        <div class="col-md-12">
                           <a href="{{ route('cefa.welcome') }}" ><img class="mb-4" src="{{ asset('general/images/logosicefa2.png') }}"  width="78" height="74" ></img></a>
                        </div>
                      
                    </div>
            <div class="card shadow-sm p-3 mb-5 rounded-3">
            
                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row">

                            <div class="col-md-12">
                                <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="password" class="col-md-12 col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="row mb-0">
                            <div class="col-md-12 d-grid gap-2">
                                <button type="submit" class="btn" style="background-color: rgb(249, 89, 40, 1); color: #fff;">
                                    {{ __('Login') }}
                                </button>
                            </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-10 col-lg-8 col-xl-8">
            <div class="card d-flex mx-auto my-5">
                <div class="row">
                    <div class="col-md-5 col-sm-12 col-xs-12 c1 p-5">

                        <div id="hero" class="bg-transparent h-auto order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                            <img class="img-fluid animated"
                            src="{{ asset('general/images/Daco_227767.png')}}"
                            alt="">
                        </div>
                        <div class="row justify-content-center">
                            <div class="w-75 mx-md-5 mx-1 mx-sm-2 mb-5 mt-4 px-sm-5 px-md-2 px-xl-1 px-2">
                                <h1 class="wlcm">Welcome</h1> <span class="sp1"> <span
                                        class="px-3 bg-danger rounded-pill"></span> <span
                                        class="ml-2 px-1 rounded-circle"></span> <span
                                        class="ml-2 px-1 rounded-circle"></span> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12 c2 px-5 pt-5">
                        <div class="row mb-5 m-3"> 
                            <a href="{{ route('cefa.welcome') }}"><img src="{{ asset('general/images/Group1.png')}}" width="40%" height="auto" alt=""></a> 
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="px-5 pb-5" name="myform">
                            @csrf
                            <div class="d-flex">
                                <h3 class="font-weight-bold"> {{ __('Login') }}</h3>
                            </div>
                           
                            <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('E-Mail
                                Address') }}</label>
                            <input id="email" type="text" class=" @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="password" class="col-md-12 col-form-label text-md-right">{{ __('Password')
                            }}</label>
                            <input id="password" type="password" class=" @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <button type="submit" class="text-white text-weight-bold btlogin">Login</button>
                            <a href="{{ route('cefa.user.register.index') }}" class="btn btlogin text-white">Registrarse</a>
                            <a class="btn btn-link forgot" href="{{ route('password.request') }}" > {{ __('Forgot Your Password?') }}</a>
                            {{-- <a class="button google" href="{{ route('logingoogle') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" viewBox="0 0 256 262">
                                <path fill="#4285F4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"></path>
                                <path fill="#34A853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"></path>
                                <path fill="#FBBC05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"></path>
                                <path fill="#EB4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"></path>
                              </svg>
                                Ingresar con Google
                            </a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
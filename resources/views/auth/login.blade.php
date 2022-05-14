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
                            <button type="submit" class="text-white text-weight-bold bt">Login</button>
                            <a class="btn btn-link" href="{{ route('password.request') }}" > {{ __('Forgot Your Password?') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow p-3 mb-5 rounded">
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-md-7">
                           <img src="{{ asset('general/images/logosicefa.png') }}"  width="72" height="68" ></img>
                        </div>
                      
                    </div>

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
</div>
@endsection

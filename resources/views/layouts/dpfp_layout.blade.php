<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
                <link rel="stylesheet" href="{{asset('dpfp/css/estilos.css')}}">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        @yield('page_title')
                    </a> 
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif

                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nickname }}
                                </a>
                                <br>
                                <a style="cursor: pointer" class="create_token">Create Token</a>                         
                                <br>
                                <a class="nav-link" id="btn_user_list" href="{{ route('users_list') }}">{{ __('Users') }}</a>
                                <br>
                                <a class="nav-link" href="{{ route('verify-users') }}">{{ __('Check Users') }}</a>
                                <br>
                                <a class="nav-link" href="https://drive.google.com/drive/folders/1U_P6h7sJfjW6INqFMnS3HeJ9DAgnIcdy?usp=share_link">{{ __('Download Plugin') }}</a>

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
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
        <!--Use your jquery-->
        <script src="{{asset('dpfp/js/jquery-1.7.2.min.js')}}"></script>     
        <!-- Sweet Alert 2 -->
        <script src="{{asset('dpfp/js/SweetAlert2.js')}}"></script>
        <!-- Funciones -->
        <script src="{{asset('dpfp/js/funciones.js')}}"></script>
        <!--Other pages javascript-->
        @yield('js')

    </body>
</html>

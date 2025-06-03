<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trans('sia::mainPage.Title_General') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @stack('head')
    <!-- meta tags para el token CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --azul-marino: #2C3E50;
            --azul-claro: #3498DB;
            --naranja: #E67E22;
            --verde-oscuro: #16A085;
            --gris-claro: #F8F9FA;
            --gris-azulado: #34495E;
        }
        .navbar {
            background-color: var(--gris-claro);
        }
        .navbar-brand {
            color: var(--azul-marino) !important;
            font-weight: bold;
        }
        .navbar-brand:hover {
            color: var(--azul-claro) !important;
        }
        .breadcrumb-item a {
            color: var(--azul-claro);
        }
        .breadcrumb-item a:hover {
            color: var(--azul-marino);
        }
        .btn-login {
            background-color: var(--azul-claro);
            border-color: var(--azul-claro);
            color: #fff;
        }
        .btn-login:hover {
            background-color: var(--azul-marino);
            border-color: var(--azul-marino);
            color: #fff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">S.I.A.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-login" href="{{ route('login') }}">{{ trans('sia::mainPage.Login') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                @stack('breadcrumbs')
            </ol>
        </nav>

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    @stack('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Ganadero - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2e9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #2d4739;
            padding-top: 20px;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            color: #e6e9d8;
            padding: 15px 25px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #3d5a45;
            color: #ffffff;
            padding-left: 35px;
        }

        .sidebar .dropdown-menu {
            background-color: #3d5a45;
            border: none;
            width: 100%;
        }

        .sidebar .dropdown-item {
            color: #e6e9d8;
            padding: 10px 40px;
        }

        .sidebar .dropdown-item:hover {
            background-color: #4a6b52;
            color: #ffffff;
        }

        .top-navbar {
            margin-left: 250px;
            padding: 15px 2vw;
            background-color: #8da960;
            width: calc(100% - 250px);
            position: fixed;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-message {
            color: #ffffff;
            font-size: 24px; /* Tamaño más grande */
            font-weight: bold;
            text-align: center;
            flex-grow: 1; /* Para centrarlo */
        }

        .content-wrapper {
            margin-left: 250px;
            padding: 80px 2vw 2vw; /* Aumentamos el padding-top para dejar espacio al navbar */
            min-height: 100vh;
            width: calc(100% - 250px);
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .main-container {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(141, 169, 96, 0.3);
            min-height: calc(100vh - 120px); /* Ajustamos la altura para que no se corte */
            overflow-y: auto;
        }

        .main-container:hover {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .sidebar { width: 200px; }
            .content-wrapper { margin-left: 200px; width: calc(100% - 200px); padding: 70px 15px 15px; }
            .top-navbar { margin-left: 200px; width: calc(100% - 200px); }
            .main-container { padding: 15px; min-height: calc(100vh - 100px); }
            .welcome-message { font-size: 20px; }
        }

        @media (max-width: 576px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .content-wrapper { margin-left: 0; width: 100%; padding: 60px 10px 10px; }
            .top-navbar { margin-left: 0; width: 100%; }
            .main-container { min-height: calc(100vh - 80px); }
            .welcome-message { font-size: 18px; }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Animales -->
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Animales
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Agregar Animales</a></li>
                <li><a class="dropdown-item" href="#">Lista de Animales</a></li>
            </ul>
        </div>

        <!-- Lechería -->
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Lechería
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Agregar Leche</a></li>
                <li><a class="dropdown-item" href="#">Visualizar Leche</a></li>
                <li><a class="dropdown-item" href="#">Reportes</a></li>
            </ul>
        </div>

        <!-- Salud Animal -->
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Salud Animal
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Accidentes</a></li>
                <li><a class="dropdown-item" href="#">Tratamientos</a></li>
                <li><a class="dropdown-item" href="#">Vacunacion</a></li>

            </ul>
        </div>

        <!-- Bodega -->
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Bodega
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Agregar Insumo</a></li>
                <li><a class="dropdown-item" href="#">Agregar Herramientas</a></li>
                <li><a class="dropdown-item" href="#">Visualizar</a></li>
            </ul>
        </div>

        <!-- Potreros -->
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Potreros
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Agregar Potreros</a></li>
                <li><a class="dropdown-item" href="#">Gestión de Potreros</a></li>
            </ul>
        </div>

        <!-- Partos -->
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Partos
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Seguimientos de Partos</a></li>
            </ul>
        </div>

        <!-- Reportes -->
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Reportes
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Reportes Personalizados</a></li>
            </ul>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Historial
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Historial animal</a></li>
            </ul>
        </div>
    </div>

    <!-- Navbar superior con bienvenida y logout -->
    <nav class="top-navbar">
        <span class="welcome-message">
            Bienvenido {{ Auth::user()->roles->first()->name ?? 'sin rol' }}
        </span>
        <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" 
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->nickname }}
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Contenido principal -->
    <div class="content-wrapper">
        <div class="main-container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
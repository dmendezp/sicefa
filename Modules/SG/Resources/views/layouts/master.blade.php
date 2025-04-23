<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Ganadero - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('modules/SG/css/master.css') }}">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Animales -->
        <div class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapseAnimales" role="button" aria-expanded="false" aria-controls="collapseAnimales">
                Animales
            </a>
            <div class="collapse" id="collapseAnimales">
                <ul class="list-unstyled ps-4">
                    <li><a class="dropdown-item" href="#">Agregar Animales</a></li>
                    <li><a class="dropdown-item" href="#">Lista de Animales</a></li>
                </ul>
            </div>
        </div>
    
        <!-- Lechería -->
        <div class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapseLecheria" role="button" aria-expanded="false" aria-controls="collapseLecheria">
                Lechería
            </a>
            <div class="collapse" id="collapseLecheria">
                <ul class="list-unstyled ps-4">
                    <li><a class="dropdown-item" href="#">Agregar Leche</a></li>
                    <li><a class="dropdown-item" href="#">Visualizar Leche</a></li>
                    <li><a class="dropdown-item" href="#">Reportes</a></li>
                </ul>
            </div>
        </div>
    
        <!-- Salud Animal -->
        <div class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapseSalud" role="button" aria-expanded="false" aria-controls="collapseSalud">
                Salud Animal
            </a>
            <div class="collapse" id="collapseSalud">
                <ul class="list-unstyled ps-4">
                    <li><a class="dropdown-item" href="#">Accidentes</a></li>
                    <li><a class="dropdown-item" href="#">Tratamientos</a></li>
                    <li><a class="dropdown-item" href="#">Vacunacion</a></li>
                </ul>
            </div>
        </div>
    
        <!-- Bodega -->
        <div class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapseBodega" role="button" aria-expanded="false" aria-controls="collapseBodega">
                Bodega
            </a>
            <div class="collapse" id="collapseBodega">
                <ul class="list-unstyled ps-4">
                    <li><a class="dropdown-item" href="#">Agregar Insumo</a></li>
                    <li><a class="dropdown-item" href="#">Agregar Herramientas</a></li>
                    <li><a class="dropdown-item" href="#">Visualizar</a></li>
                </ul>
            </div>
        </div>
    
        <!-- Potreros -->
        <div class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapsePotreros" role="button" aria-expanded="false" aria-controls="collapsePotreros">
                Potreros
            </a>
            <div class="collapse" id="collapsePotreros">
                <ul class="list-unstyled ps-4">
                    <li><a class="dropdown-item" href="#">Agregar Potreros</a></li>
                    <li><a class="dropdown-item" href="#">Gestión de Potreros</a></li>
                </ul>
            </div>
        </div>
    
        <!-- Partos -->
        <div class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapsePartos" role="button" aria-expanded="false" aria-controls="collapsePartos">
                Partos
            </a>
            <div class="collapse" id="collapsePartos">
                <ul class="list-unstyled ps-4">
                    <li><a class="dropdown-item" href="#">Seguimientos de Partos</a></li>
                </ul>
            </div>
        </div>
    
        <!-- Reportes -->
        <div class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapseReportes" role="button" aria-expanded="false" aria-controls="collapseReportes">
                Reportes
            </a>
            <div class="collapse" id="collapseReportes">
                <ul class="list-unstyled ps-4">
                    <li><a class="dropdown-item" href="#">Reportes Personalizados</a></li>
                </ul>
            </div>
        </div>
    
        <!-- Historial -->
        <div class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapseHistorial" role="button" aria-expanded="false" aria-controls="collapseHistorial">
                Historial
            </a>
            <div class="collapse" id="collapseHistorial">
                <ul class="list-unstyled ps-4">
                    <li><a class="dropdown-item" href="#">Historial animal</a></li>
                </ul>
            </div>
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
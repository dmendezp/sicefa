<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <title>Gestión de Lombricultivo - SENA</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- AdminLTE style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">

    <style>
        :root {
            --sena-green: #39B54A;
            --sena-dark-green: #2E8B3E;
            --sena-light-green: #D1E7DD;
            --sena-white: #FFFFFF;
            --sena-light-gray: #F8F9FA;
        }
        
        body {
            background-color: var(--sena-light-gray);
        }
        
        .navbar-dark {
            background-color: var(--sena-dark-green) !important;
        }
        
        .brand-text {
            color: var(--sena-white) !important;
            font-weight: bold;
        }
        
        .main-footer {
            background-color: var(--sena-dark-green) !important;
            color: var(--sena-white) !important;
        }
        
        .btn-sena {
            background-color: var(--sena-green);
            border-color: var(--sena-dark-green);
            color: white;
        }
        
        .btn-sena:hover {
            background-color: var(--sena-dark-green);
            border-color: var(--sena-green);
            color: white;
        }
        
        .card-sena {
            border-top: 3px solid var(--sena-green);
        }
        
        .welcome-header {
            background: linear-gradient(135deg, var(--sena-green) 0%, var(--sena-dark-green) 100%);
            color: white;
            padding: 2rem;
            border-radius: 0.25rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid var(--sena-green);
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            color: var(--sena-green);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .nav-link.active {
            background-color: var(--sena-light-green) !important;
            color: var(--sena-dark-green) !important;
            font-weight: bold;
        }
        
        .search-box {
            border-color: var(--sena-green);
        }
        
        .dropdown-menu {
            border: 1px solid var(--sena-light-green);
        }
        
        .dropdown-item:hover {
            background-color: var(--sena-light-green);
        }
    </style>

    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="layout-top-nav">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('images/images.png') }}" alt="AdminLTELogo" height="100" width="150">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('images/Favicon2.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 30px;">
                <span class="brand-text">Lombricultivo SENA</span>
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Módulos</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Documentación</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Contacto</a>
                    </li>
                    @if(Auth::check() && checkRol('lombrisoft.admin'))
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('lombrisoft.admin.welcome') }}" class="nav-link @if (Route::is('lombrisoft.admin.*')) active @endif">Administración</a>
                    </li>
                    @endif
                    @if(Auth::check() && checkRol('lombrisoft.intern'))
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('lombrisoft.intern.paneli') }}" class="nav-link @if (Route::is('lombrisoft.intern.*')) active @endif">Pasante</a>
                    </li>
                    @endif
                </ul>
            </div>

            <!-- Right navbar -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm search-box">
                                <input class="form-control form-control-navbar" type="search" placeholder="Buscar..." aria-label="Buscar">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">3 Notificaciones</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-seedling mr-2 text-green"></i> Nueva actividad programada
                            <span class="float-right text-muted text-sm">12 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-tint mr-2 text-blue"></i> Recordatorio de riego
                            <span class="float-right text-muted text-sm">1 hora</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-clipboard-check mr-2 text-orange"></i> Reporte mensual listo
                            <span class="float-right text-muted text-sm">2 días</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
                    </div>
                </li>

                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="fas fa-user-circle mr-1"></i>
                        <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'Usuario' }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Perfil
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog mr-2"></i> Configuración
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="content-wrapper" style="min-height: calc(100vh - 130px);">
        <div class="content">
            <div class="container">
                <!-- Sección de Bienvenida Mejorada -->
                <section class="welcome-header text-center">
                    <h1 class="display-4"><i class="fas fa-seedling mr-2"></i> Bienvenido al Sistema de Lombricultivo</h1>
                    <p class="lead">Herramienta integral para la gestión de unidades de producción de humus de lombriz</p>
                    <div class="mt-4">
                        <a href="#" class="btn btn-light btn-lg mr-2">
                            <i class="fas fa-play-circle mr-1"></i> Tutorial Inicial
                        </a>
                        <a href="#" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-book mr-1"></i> Manual de Usuario
                        </a>
                    </div>
                </section>

                <!-- Tarjetas de Características -->
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card feature-card h-100">
                            <div class="card-body text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h4 class="card-title">Monitoreo en Tiempo Real</h4>
                                <p class="card-text">Seguimiento continuo de parámetros críticos para la producción óptima de humus.</p>
                                <a href="#" class="btn btn-sena">Explorar <i class="fas fa-arrow-right ml-1"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="card feature-card h-100">
                            <div class="card-body text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <h4 class="card-title">Gestión de Actividades</h4>
                                <p class="card-text">Programación y control de todas las tareas relacionadas con el lombricultivo.</p>
                                <a href="#" class="btn btn-sena">Gestionar <i class="fas fa-arrow-right ml-1"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="card feature-card h-100">
                            <div class="card-body text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h4 class="card-title">Reportes Automatizados</h4>
                                <p class="card-text">Generación de informes detallados para análisis y toma de decisiones.</p>
                                <a href="#" class="btn btn-sena">Ver Reportes <i class="fas fa-arrow-right ml-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenido Principal -->
                @yield('content')
                
                <!-- Sección de Acceso Rápido -->
                <div class="card card-sena mt-4">
                    <div class="card-header bg-white">
                        <h3 class="card-title"><i class="fas fa-bolt text-green mr-2"></i>Acceso Rápido</h3>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 col-6 mb-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="p-3 border rounded hover-shadow">
                                        <i class="fas fa-tint fa-2x text-primary mb-2"></i>
                                        <h6>Control de Humedad</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="p-3 border rounded hover-shadow">
                                        <i class="fas fa-utensils fa-2x text-success mb-2"></i>
                                        <h6>Registro de Alimentación</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="p-3 border rounded hover-shadow">
                                        <i class="fas fa-temperature-low fa-2x text-warning mb-2"></i>
                                        <h6>Monitoreo de Temperatura</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="p-3 border rounded hover-shadow">
                                        <i class="fas fa-box-open fa-2x text-info mb-2"></i>
                                        <h6>Registro de Cosecha</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer text-center">
        <strong>Sistema de Gestión de Lombricultivo &copy; {{ date('Y') }} 
            <a href="#" class="text-white">SENA</a>.
        </strong> Todos los derechos reservados.
        <div class="d-block mt-1">
            <b>Versión</b> 1.0.0 | <i class="fas fa-calendar-alt mr-1"></i> {{ now()->format('d/m/Y') }}
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>

<script>
    $(document).ready(function() {
        // Animación para las tarjetas al cargar la página
        $('.feature-card').each(function(i) {
            $(this).delay(200 * i).animate({
                opacity: 1,
                marginTop: 0
            }, 400);
        });
        
        // Mostrar SweetAlert de bienvenida
        @if(session('welcome'))
        Swal.fire({
            title: '¡Bienvenido {{ Auth::user()->name ?? "Usuario" }}!',
            text: 'Has ingresado al sistema de gestión de lombricultivo del SENA.',
            icon: 'success',
            confirmButtonColor: '#39B54A',
            confirmButtonText: 'Comenzar',
            timer: 5000,
            timerProgressBar: true,
            backdrop: `
                rgba(57,181,74,0.4)
                url("{{ asset('images/wavey-fingerprint.png') }}")
                center top
                no-repeat
            `
        });
        @endif
    });
</script>
</body>
</html>
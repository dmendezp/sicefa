<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/serena.png') }}" type="image/x-icon">
    <title>Gestión de Espacios Y Recursos</title>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    
    <!-- Scripts cargados de forma diferida -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand">
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('login') }}" class="nav-link text-white">Inicio</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
            @auth
                @if(checkRol('pserenacefa.admin'))
                    <li class="nav-item d-none d-sm-inline-block" style="margin-right: 80px;">
                        <a href="{{ route('pserenacefa.admin.welcome') }}" 
                        class="nav-link text-white @if(Route::is('pserenacefa.admin.*')) active @endif">
                            Administrador
                        </a>
                    </li>
                @endif
            @endauth
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                @auth
                    @if(checkRol('pserenacefa.pasante'))
                        <li class="nav-item d-none d-sm-inline-block" style="margin-right: 80px;">
                            <a href="{{ route('pserenacefa.pasante.welcomepasante') }}" 
                            class="nav-link text-white @if(Route::is('pserenacefa.pasante.*')) active @endif">
                                Pasante
                            </a>
                        </li>
                    @endif
                @endauth
                </li>
        </ul>
    </nav>

    <!-- Contenido principal -->
   
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">Sistema de Gestión de Espacios y Recursos</h1>
                <p class="hero-subtitle">Optimiza la administración de espacios y recursos en tu centro de formación con nuestra plataforma intuitiva y eficiente</p>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('pserenacefa.admin.welcome') }}" class="btn btn-primary">Ir a Mi Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Comenzar Ahora</a>
                    @endauth
                @endif
            </div>
        </div>

        <div class="section-title">
            <h2>Gestión Eficiente de Recursos</h2>
            <p>Descubre las características de nuestro sistema de gestión diseñado para optimizar los procesos en tu centro de formación</p>
        </div>

        <div class="resources-grid">
            <div class="card">
                <div class="card-header">
                    <div class="icon-wrapper">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="card-title">Reserva de Espacios</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Solicita y gestiona la reserva de espacios para tus actividades de formación. Nuestro sistema permite visualizar la disponibilidad en tiempo real, evitar conflictos de horarios y maximizar el uso de los recursos del centro.
                    </p>
                    <a href="#" class="card-link">
                        Conocer más <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="icon-wrapper">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="card-title">Gestión de Recursos</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Administra equipos, herramientas y materiales necesarios para tus actividades. Controla préstamos, devoluciones y mantén un inventario actualizado de todos los recursos disponibles en el centro de formación.
                    </p>
                    <a href="#" class="card-link">
                        Explorar recursos <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="icon-wrapper">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h3 class="card-title">Aprobaciones y Permisos</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Sistema de flujo de trabajo para la aprobación de solicitudes. Gestiona permisos según roles de usuario (instructores, aprendices, administrativos) y mantén un registro completo de todas las solicitudes y aprobaciones.
                    </p>
                    <a href="#" class="card-link">
                        Más información <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="icon-wrapper">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3 class="card-title">Solicitud y Seguimiento de Espacios</h3>
                </div>
                <div class="card-body">
                    <p class="card-text" style="text-align: justify;">
                        Solicita y administra espacios para tus actividades fácilmente. Consulta la disponibilidad en tiempo real, evita conflictos de horarios y recibe notificaciones sobre el estado de tu solicitud..
                    </p>
                    <a href="#" class="card-link">
                        Conocer más <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="why-use-section">
            <div class="why-use-content">
                <h3 class="why-use-title">¿Por qué utilizar nuestro sistema?</h3>
                <p class="why-use-text">
                    El Sistema de Gestión de Espacios y Recursos está diseñado específicamente para optimizar el uso de las instalaciones y recursos educativos, permitiendo una asignación eficiente y transparente que beneficia a todos los miembros de la comunidad educativa.
                </p>
                <div class="features-grid">
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <span class="feature-text">Reduce tiempos de gestión</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <span class="feature-text">Evita conflictos de horarios</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <span class="feature-text">Maximiza el uso de recursos</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <span class="feature-text">Seguimiento en tiempo real</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer">
        <div class="footer-content">
            <p class="footer-copyright">&copy; {{ date('Y') }} SERENA - Programado Por Andres Chimbaco</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/SENAComunica" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/SENAComunica" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/senacomunica/" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/user/SENATV" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>
            </div>
            
            <div class="footer-info">
                <div class="footer-location">
                    <i class="fas fa-building"></i>
                    <span>SENA - La Angostura</span>
                    <i class="fas fa-map-marker-alt ml-4"></i>
                    <span>Km 38 via al Sur Neiva
                        Campoalegre - Huila
                        Colombia
                    </span>
                </div>
                <div class="footer-version">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
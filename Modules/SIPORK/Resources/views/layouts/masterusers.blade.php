<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <title>Gestión de Unidad Porcina - SIPORK</title>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    
    <!-- Estilos personalizados -->
    <style>
        body {
            background: url('') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Source Sans Pro', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        .navbar-custom {
            background: linear-gradient(90deg, #2d5e3b 0%, #3d8b52 100%); /* Gradiente verde */
            padding: 15px 30px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .navbar-custom .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f1c40f;
            display: flex;
            align-items: center;
        }
        .navbar-custom .navbar-brand img {
            width: 40px;
            margin-right: 10px;
        }
        .navbar-custom .nav-link {
            color: #fff;
            font-weight: 500;
            margin-left: 20px;
            transition: color 0.3s ease;
        }
        .navbar-custom .nav-link:hover {
            color: #f1c40f;
        }

        .content-wrapper {
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5); /* Fondo semitransparente */
            padding: 80px 20px 60px; /* Espacio para navbar fija */
        }
        .welcome-container {
            background: #fff;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 900px;
            text-align: center;
            color: #333;
        }
        .welcome-container h1 {
            font-size: 2.8rem;
            color: #2d5e3b;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .welcome-container p {
            font-size: 1.3rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 40px;
        }
        .btn-custom {
            background-color: #f1c40f;
            color: #2d5e3b;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 12px 40px;
            border-radius: 30px;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #e67e22;
            color: #fff;
        }
        .footer-custom {
            background: #2d5e3b;
            color: #fff;
            padding: 20px 30px;
            position: fixed;
            bottom: 0;
            width: 100%;
            border-top: 4px solid #f1c40f;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);
        }
        .footer-custom a {
            color: #f1c40f;
            text-decoration: none;
            font-weight: 500;
        }
        .footer-custom a:hover {
            color: #e67e22;
        }
        .footer-custom .version {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="">
                <img src="{{ asset('images/sipork.png') }}" alt="SIPORK Logo">
                SIPORK
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color: #fff;"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @auth
                        @if(checkRol('sipork.admin'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('sipork.admin.welcome') }}"
                                   class="@if(Route::is('sipork.admin.*')) active @endif">
                                    Administrador
                                </a>
                            </li>
                        @endif
                        @if(checkRol('sipork.liderDeUnidad'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('sipork.liderDeUnidad.panelLider') }}"
                                   class="@if(Route::is('sipork.lider.*')) active @endif">
                                    Líder de Unidad
                                </a>
                            </li>
                        @endif
                        @if(checkRol('sipork.aprendiz'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('sipork.aprendiz.panelAprendiz') }}"
                                   class="@if(Route::is('sipork.aprendiz.*')) active @endif">
                                    Aprendiz
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="welcome-container">
            <h1>Bienvenido a SIPORK</h1>
            <p>
                Gestiona tu unidad porcina de manera eficiente con nuestra plataforma integral. 
                Optimiza la producción, monitorea la salud y alimentación de tus cerdos, 
                y toma decisiones estratégicas basadas en datos confiables.
            </p>
            @guest
                <a href="{{ route('login') }}" class="btn btn-custom">
                    Iniciar Sesión
                </a>
            @else
            <a href="http://127.0.0.1:8000" class="btn btn-custom">
                    Ir al Panel
                </a>
            @endauth
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left">
                    <strong>&copy; 2023-2025 <a href="#" style="color: #f1c40f; text-decoration: underline;">SIPORK</a>.</strong> Todos los derechos reservados.
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <span class="version" style="font-size: 0.95rem; font-weight: 600;">
                        <b>Versión</b> 3.2.0
                    </span>
                    <span style="margin-left: 15px;">
                        <a href="#" style="color: #f1c40f; text-decoration: underline;">Política de Privacidad</a>
                    </span>
                    <span style="margin-left: 15px;">
                        <a href="#" style="color: #f1c40f; text-decoration: underline;">Términos de Uso</a>
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
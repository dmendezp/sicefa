<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <title>Gestión de Unidad de Cultivos</title>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    
    <!-- Scripts cargados de forma diferida -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('login') }}" class="nav-link">Inicio</a>

            </li>

            
            <li class="nav-item d-none d-sm-inline-block">
            
        </li>
        </ul>
        
    </nav>

    <!-- Contenido principal -->
   
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center mt-5">
                        <h1 class="display-4">Bienvenido a Gestión de Unidad de Cultivos</h1>
                        <p class="lead">
                            Una solución integral para la administración eficiente de tus cultivos. 
                            Optimiza tus procesos, incrementa la productividad y toma decisiones informadas 
                            con nuestra plataforma diseñada para el éxito agrícola.
                        </p>
                        @auth
                    
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">
                                Iniciar Sesión
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

    <!-- Footer -->
    <footer style="width: 100%; position: fixed; bottom: 0; left: 0; background-color: #343a40; color: white; padding: 10px 20px;">
        <strong>Copyright &copy; 2023-2025 <a href="#" style="color: #3c8dbc;">GDF</a>.</strong> Todos los derechos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versión</b> 3.2.0
        </div>
        
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
</body>
</html>

 
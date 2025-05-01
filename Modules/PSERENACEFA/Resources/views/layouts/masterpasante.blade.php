<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/serena.png') }}" type="image/x-icon">
    <title>Bienvenido</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/master.css') }}"> 
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    @if(Auth::check())
                    @if(checkRol('pserenacefa.admin'))
                <li style="margin-right:80px">
                    <a href="{{ route('pserenacefa.admin.welcome') }}" id="an"
                        class="nav-link @if (Route::is('pserenacefa.admin.*')) active @endif">Administrador</a>
                        <a href="{{ route('pserenacefa.pasante.welcomepasante') }}" id="an"
                        class="nav-link @if (Route::is('pserenacefa.pasante.*')) active @endif">Pasante</a>
                </li>
                @endif
                @endif
                </li>
            </ul>
        
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <!-- Icono principal visible en el navbar -->
                    <a class="nav-link" data-toggle="dropdown" href="#" title="Cerrar sesión">
                        <i class="fas fa-door-open"></i> 
                    </a>
                    <!-- Menú desplegable -->
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light elevation-2">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar logo -->
                <div class="sidebar-logo" style="padding-bottom: 5px; margin-bottom: 0; text-align: center;">
                    <a href="">
                        <img src="{{ asset('img/serena.png') }}" alt="Logo" class="img-fluid" style="max-height: 150px; display: block; margin: auto;">
                    </a>
                </div>
                
                <!-- Sidebar Menu -->
                <nav class="mt-1"> <!-- Se redujo el margen superior -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Gestion de amientes -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-warehouse nav-icon"></i>
                                <p>
                                    Gestion De Ambientes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="fas fa-edit nav-icon"></i>
                                        <p>Ingreso</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">                  
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>Listas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Recursos -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-boxes nav-icon"></i>
                                <p>
                                    Gestion De Recursos
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ asset('AdminLTE-3.2.0/pages/UI/general.html') }}" class="nav-link">
                                        <i class="fas fa-box nav-icon"></i>
                                        <p>Administrar</p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="" class="nav-link">
                                                <i class="fas fa-edit nav-icon"></i>
                                                <p>Ingreso</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="" class="nav-link">
                                                <i class="fas fa-clipboard-list nav-icon"></i>
                                                <p>Listas</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- Gestion de Usuarios por rol -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>
                                    Gestion De Usuarios
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="fas fa-user-plus nav-icon"></i>
                                        <p>Registrar Usuario</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Solicitudes -->
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fas fa-chart-bar nav-icon"></i>
                                <p>Solicitudes</p>
                            </a>
                        </li>

                        <!-- Reportes -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>
                                    Reportes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ asset('AdminLTE-3.2.0/pages/tables/simple.html') }}" class="nav-link">
                                        <i class="fas fa-tasks nav-icon"></i>
                                        <p>Actividades</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ asset('AdminLTE-3.2.0/pages/tables/data.html') }}" class="nav-link">
                                        <i class="fas fa-file-invoice-dollar nav-icon"></i>
                                        <p>Contable</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

    
    </div>

     <!-- Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Chimbaco</b>
        </div>
        <strong>&copy; {{ date('Y') }} - Sistema de Gestión</strong>
    </footer>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('AdminLTE-/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo -->
    <script src="{{ asset('AdminLTE/dist/js/pages/dashboard2.js') }}"></script>
     <!-- jQuery -->
     <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
     <!-- jQuery UI 1.11.4 -->
     <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
     <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
     <script>
         $.widget.bridge('uibutton', $.ui.button)
     </script>
     <!-- Bootstrap 4 -->
     <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
     <!-- overlayScrollbars -->
     <script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
     <!-- AdminLTE App -->
     <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
     <!-- AdminLTE for demo purposes -->
     <script src="{{ asset('AdminLTE-3.2.0/dist/js/demo.js') }}"></script>
</body>

</html>
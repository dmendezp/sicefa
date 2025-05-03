<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png')}}" type="image/x-icon">
    <title>Gestion de Unidad Apicola</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --sena-green: #39B54A;
            --sena-dark-green: #2E8B3E;
            --sena-light-green: #D1E7DD;
        }

        .main-sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            bottom: 0;
            background-color: white;
            border-right: 1px solid #dee2e6;
        }

        .content-wrapper {
            margin-left: 250px;
            background-color: rgba(255, 255, 255, 0);

        }

        .hover-green:hover {
            color: var(--sena-green) !important;
            transition: color 0.3s ease-in-out;
        }

        .brand-link {
            border-bottom: 3px solid var(--sena-green);
        }

        .brand-text {
            color: var(--sena-dark-green) !important;
            font-weight: bold !important;
        }

        .nav-sidebar .nav-item>.nav-link {
            color: #495057;
        }

        .nav-sidebar .nav-item>.nav-link.active,
        .nav-sidebar .nav-item>.nav-link:hover {
            background-color: var(--sena-light-green);
            color: var(--sena-dark-green);
        }

        .navbar-dark {
            background-color: var(--sena-dark-green) !important;
        }

        .main-footer {
            background-color: var(--sena-dark-green) !important;
            color: white !important;
        }

        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
            background-color: var(--sena-green);
            color: white;
        }

        .card {
            border-top: 3px solid var(--sena-green);
        }

        .btn-primary {
            background-color: var(--sena-green);
            border-color: var(--sena-dark-green);
        }

        .btn-primary:hover {
            background-color: var(--sena-dark-green);
            border-color: var(--sena-dark-green);
        }

        .bg-primary {
            background-color: var(--sena-green) !important;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .text-green {
            color: #28a745;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark bg-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar user dropdown with welcome message -->
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item dropdown d-flex align-items-center">
                    <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#" role="button">
                        <i class="fas fa-user-circle fa-3x mr-2 text-white"></i>
                        <span class="font-weight-bold text-white">BIENVENIDO ADMINISTRADOR</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>

                    </div>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">SenaApicola</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-home text-success"></i>
                                <p>Inicio</p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-archway text-warning"></i>
                                <p>
                                    Apiario
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon text-info"></i>
                                        <p>Registrar Apiario</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-list-ul nav-icon text-primary"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-boxes text-warning"></i> <!-- Alternativa para Colmena -->
                                <p>
                                    Colmena
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon text-info"></i>
                                        <p>Ingreso</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-list-ul nav-icon text-primary"></i>
                                        <p>Listas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-wine-bottle text-warning"></i> <!-- Alternativa para Producción -->
                                <p>
                                    Producción
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon text-info"></i>
                                        <p>Ingreso</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-list-ul nav-icon text-primary"></i>
                                        <p>Listas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-plus text-success"></i>
                                <p>
                                    Agregar Usuario
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-user-edit nav-icon text-info"></i>
                                        <p>Registro</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-users nav-icon text-primary"></i>
                                        <p>Usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-check text-info"></i>
                                <p>
                                    Seguimiento
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-edit nav-icon text-info"></i>
                                        <p>Registro</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-chart-line nav-icon text-primary"></i>
                                        <p>Reportes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <H2>Bienvenido Administrador</H2>
            <br>
            <h4>Funciones del apartado de Administrador:</h4>
            <br>
            <h5>Este módulo permite al administrador agregar y listar información del apiario, <br>
                colmenas, producción (registrando entradas y salidas de miel), usuarios del sistema y <br>
                realizar el seguimiento del estado y actividad de cada colmena.
            </h5>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

        <center>
            <footer class="main-footer" style="width: 100%; position: fixed; bottom: 0; left: 0;">
                <strong>Copyright © 2024-2025
                    <a href="#" style="color: white;">SenaApicola - SENA</a>.
                </strong>
                Todos los derechos reservados.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Versión</b> 1.0.0
                </div>
            </footer>
        </center>

    </div>

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
</body>

</html>
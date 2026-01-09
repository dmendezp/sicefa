<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/flati.jpg') }}" type="image/x-icon">
    <title>Ganasoft</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom CSS -->
    <style>
        .main-footer {
            background-color: #2d5e3b;
            color: #fff;
            border-top: 3px solid #f1c40f;
        }

        .main-footer a {
            color: #f1c40f;
        }

        .main-footer a:hover {
            color: #e67e22;
        }

        .preloader img {
            animation: wobble 2s infinite;
        }

        @keyframes wobble {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(5deg);
            }

            50% {
                transform: rotate(0deg);
            }

            75% {
                transform: rotate(-5deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="sg Logo" height="100" width="150">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand" style="background: linear-gradient(white, white );">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="http://127.0.0.1:8000/sg/index" class="nav-link">Inicio</a>
                </li>
            </ul>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="http://127.0.0.1:8000/sg/admin/welcome" class="btn btn-success btn-sm ml-2">Volver</a>
            </li>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <ul class="navbar-nav ml-auto">
                    @auth
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->nickname }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                        </div>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endauth
                </ul>
        </nav>
        <!-- Main Sidebar -->
        <aside class="main-sidebar elevation-4" style="background: linear-gradient(white, white); overflow-y: auto; max-height: calc(100vh - 57px);">
            <!-- Brand Logo -->
            <div class="d-flex justify-content-center align-items-center my-3">
            <a href="#" id="logo-link" class="d-block">
                <img src="{{ asset('images/logo.jpg') }}" alt="sg" 
                style="height:110px;width:auto;max-width:180px;" 
                class="rounded-circle border border-white shadow" />
            </a>
            </div>
            <!-- Modal for displaying the image -->
            <div id="imageModal" class="modal"
            style="display: none; position: fixed; z-index: 1050; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog" style="margin: 15% auto; width: 80%; max-width: 500px;">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">sg Logo</h5>
                    <button type="button" class="close" onclick="closeImageModal()">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="sg Logo"
                    style="max-width: 100%; height: auto;">
                </div>
                </div>
            </div>
            </div>
            <script>
            function showImageModal(event) {
                event.preventDefault();
                document.getElementById('imageModal').style.display = 'block';
            }

            function closeImageModal() {
                document.getElementById('imageModal').style.display = 'none';
            }
            </script>
            <!-- Sidebar -->
            <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!-- 1. GESTIÓN DE ANIMALES -->
            <li class="nav-header text-uppercase text-bold text-info">Gestión de Animales</li>
            <li class="nav-item">
            <a href="{{ route('sg.admin.sg.animales.index') }}" class="nav-link">
                <i class="nav-icon fas fa-cow text-primary"></i>
                <p>Listado de Bovinos</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="{{ route('sg.admin.sg.animales.create') }}" class="nav-link">
                <i class="nav-icon fas fa-plus-circle text-success"></i>
                <p>Registrar Nuevo Bovino</p>
            </a>
            </li>

            <!-- 2. CATÁLOGOS BÁSICOS -->
            <li class="nav-header text-uppercase text-bold text-info mt-4">Catálogos</li>
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book text-warning"></i>
                <p>
                Catálogos Básicos
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{ route('sg.admin.sg.razas.create') }}" class="nav-link">
                    <i class="fas fa-dna nav-icon"></i>
                    <p>Razas</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{ route('sg.admin.sg.medicamentos.create') }}" class="nav-link">
                    <i class="fas fa-pills nav-icon"></i>
                    <p>Medicamentos</p>
                </a>
                </li>
            </ul>
            </li>

            <!-- 3. REPRODUCCIÓN -->
            <li class="nav-header text-uppercase text-bold text-info mt-4">Reproducción</li>
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-venus-mars text-pink"></i>
                <p>
                Reproducción
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="fas fa-syringe nav-icon"></i>
                    <p>Inseminaciones</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="fas fa-baby nav-icon"></i>
                    <p>Partos y Nacimientos</p>
                </a>
                </li>
            </ul>
            </li>

            <!-- 4. SALUD -->
            <li class="nav-header text-uppercase text-bold text-info mt-4">Salud Animal</li>
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-stethoscope text-danger"></i>
                <p>
                Salud
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{ route('sg.admin.sg.salud.create') }}" class="nav-link">
                    <i class="fas fa-notes-medical nav-icon"></i>
                    <p>Historias Clínicas</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="fas fa-prescription-bottle-alt nav-icon"></i>
                    <p>Tratamientos Aplicados</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="fas fa-vial nav-icon"></i>
                    <p>Pruebas y Diagnósticos</p>
                </a>
                </li>
            </ul>
            </li>

            <!-- 5. PRODUCCIÓN -->
            <li class="nav-header text-uppercase text-bold text-info mt-4">Producción</li>
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tint text-info"></i>
                <p>
                Producción Lechera
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{ route('sg.admin.sg.produccion.create') }}" class="nav-link">
                    <i class="fas fa-clipboard-list nav-icon"></i>
                    <p>Control Diario de Ordeño</p>
                </a>
                </li>
            </ul>
            </li>

            <!-- 6. CRECIMIENTO Y PESAJE -->
            <li class="nav-header text-uppercase text-bold text-info mt-4">Desarrollo</li>
            <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon fas fa-weight text-success"></i>
                <p>Control de Peso</p>
            </a>
            </li>

            <!-- 7. RECURSOS E INSUMOS -->
            <li class="nav-header text-uppercase text-bold text-info mt-4">Recursos</li>
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-warehouse text-orange"></i>
                <p>
                Inventario
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{ route('sg.admin.sg.insumos.create') }}" class="nav-link">
                    <i class="fas fa-boxes nav-icon"></i>
                    <p>Insumos Ganaderos</p>
                </a>
                </li>   
                <li class="nav-item">
                <a href="{{ route('sg.admin.sg.herramientas.create') }}" class="nav-link">
                    <i class="fas fa-tools nav-icon"></i>
                    <p>Herramientas</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{ route('sg.admin.sg.bodegas.create') }}" class="nav-link">
                <i class="fas fa-warehouse nav-icon"></i>
                <p>Bodegas</p>
                </a>
            </li>
            </ul>
            </li>

            <!-- 8. REPORTES (futuro) -->
            <li class="nav-header text-uppercase text-bold text-info mt-4">Reportes</li>
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar text-purple"></i>
                <p>Reportes y Estadísticas</p>
                <span class="right badge badge-warning">Próximamente</span>
            </a>
            </li>

        </ul>
        </nav>
    </div>
        </aside>
        <!-- Content Wrapper -->
        <div class="content-wrapper" style="max-width: 1600px; margin: 0 auto;">
            @yield('content')
        </div>
        <!-- Footer Mejorado -->
        <footer class="main-footer" style="background: linear-gradient(white);">
            <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between py-2">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <img src="{{ asset('images/logo.jpg') }}" alt="sg Logo" style="height:32px;width:auto;margin-right:10px;filter:drop-shadow(0 2px 4px rgba(0,0,0,0.15));">
                    <span>
                        <strong>&copy; 2023-2025 <a href="#" style="color:#e67e22;text-decoration:underline;">sg</a>.</strong>
                        Todos los derechos reservados.
                    </span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="mr-3" style="font-size:1.1em;">
                        <i class="fas fa-leaf" style="color:#8bc34a;"></i> Gestión Ganadera sostenible
                    </span>
                    <span class="badge badge-warning px-3 py-2" style="font-size:1em;box-shadow:0 1px 4px rgba(0,0,0,0.08);background:#f7c873;color:#4e342e;border:1px solid #a16c3a;">
                        <b>Versión</b> 1.1.1
                    </span>
                </div>
            </div>
        </footer>
        <style>
            /* Responsive footer */
            @media (max-width: 767.98px) {
                .main-footer .container-fluid {
                    flex-direction: column !important;
                    text-align: center;
                }

                .main-footer .d-flex.align-items-center {
                    justify-content: center !important;
                }
            }
            /* Pig farming themed colors */
            .main-footer {
                background: linear-gradient(90deg, #a16c3a 0%, #f7c873 100%);
                color: #4e342e;
                border-top: 3px solid #e67e22;
            }

            .main-footer a {
                color: #e67e22;
            }

            .main-footer a:hover {
                color: #8d5524;
            }

            .main-footer .badge-warning {
                background: #f7c873;
                color: #4e342e;
                border: 1px solid #a16c3a;
            }

            .main-footer .fa-leaf {
                color: #8bc34a !important;
            }
        </style>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
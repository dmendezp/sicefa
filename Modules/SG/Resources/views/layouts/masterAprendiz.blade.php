<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <title>Pig Management - sg</title>
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
            <img src="{{ asset('images/sg.png') }}" alt="sg Logo" height="100" width="150">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand" style="background: linear-gradient( #fff2f2, #ffe6e6);">
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
                <a href="{{ route('sg.aprendiz.panelAprendiz') }}" class="btn btn-success btn-sm ml-2">Volver</a>
            </li>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Right navbar links -->
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
        <aside class="main-sidebar elevation-4" style="background: linear-gradient( #fff2f2, #ffe6e6);">
            <!-- Brand Logo -->
            <a href="" class="brand-link" onclick="showImageModal(event)">
                <img src="{{ asset('images/sg.png') }}" alt="sg Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8; width: 50px; height: 50px;">
                <span class="brand-text font-weight-light"
                    style="font-size: 1.2rem; background: linear-gradient(to right, #000000, #434343); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">sg</span>
            </a>
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
                            <img src="{{ asset('images/sg.png') }}" alt="sg Logo"
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
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="row col-md-12">
                        <div class="image mt-2 mb-2">
                            @if (isset(Auth::user()->person->avatar))
                            <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}"
                                class="img-circle elevation-2" alt="User Image">
                            @else
                            <img src="{{ asset('modules/sica/images/blanco.png') }}"
                                class="img-circle elevation-2" alt="User Image">
                            @endif
                        </div>
                        @guest
                        <div class="col info info-user">
                            <div>{{ trans('senaempresa::menu.Welcome') }}</div>
                            <div><a href="{{ route('login', ['redirect' => url()->current()]) }}"
                                    class="d-block">{{ trans('Auth.Login') }}</a></div>
                        </div>
                        <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right"
                            title="{{ trans('Auth.Login') }}"><a
                                href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block"><i
                                    class="fas fa-sign-in-alt"></i></a>
                        </div>
                        @else
                        <div class="col info info-user">
                            <div data-toggle="tooltip" data-placement="top"
                                title="{{ Auth::user()->person->full_name }}">
                                {{ Auth::user()->nickname }}
                            </div>
                            <div class="small"><em> {{ Auth::user()->roles[0]->name }}</em></div>
                        </div>
                        <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right"
                            title="{{ trans('Auth.Logout') }}"><a href="{{ route('logout') }}" class="d-block"
                                onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i
                                    class="fas fa-sign-out-alt"></i></a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @endguest
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Gestión de la alimentación -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link text-pink">
                                <i class="nav-icon fas fa-utensils"></i>&nbsp;
                                <p>Alimentacion<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Ingreso</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- dietas -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link text-pink">
                                <i class="fas fa-apple-alt nav-icon"></i>&nbsp;
                                <p>Dietas<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Ingreso</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                                <!-- insumos alimenticios -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link text-pink">
                                        <i class="fas fa-carrot nav-icon"></i>&nbsp;
                                        <p>Insumos alimenticios<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=""
                                                class="nav-link">
                                                <i class="fas fa-plus-circle nav-icon"></i>
                                                <p>Ingreso</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=""
                                                class="nav-link">
                                                <i class="fas fa-list nav-icon"></i>
                                                <p>Listado</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!--Gestión de recursos -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link text-pink">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>Recursos <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link text-pink">
                                        <i class="fas fa-boxes nav-icon"></i>&nbsp;
                                        <p>Insumos<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=""
                                                class="nav-link">
                                                <i class="fas fa-plus-circle nav-icon"></i>
                                                <p>Ingreso</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=""
                                                class="nav-link">
                                                <i class="fas fa-list nav-icon"></i>
                                                <p>Listado</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- herramientas -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link text-pink">
                                        <i class="fas fa-tools nav-icon"></i>&nbsp;
                                        <p>Herramientas<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=""
                                                class="nav-link">
                                                <i class="fas fa-plus-circle nav-icon"></i>
                                                <p>Ingreso</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=""
                                                class="nav-link">
                                                <i class="fas fa-list nav-icon"></i>
                                                <p>Listado</p>
                                            </a>
                                        </li>
                                        <!-- Uso de herramientas -->
                                        <li class="nav-item has-treeview">
                                            <a href="#" class="nav-link text-pink">
                                                <i class="fas fa-hammer nav-icon"></i>&nbsp;
                                                <p>Uso de herramientas<i class="right fas fa-angle-left"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href=""
                                                        class="nav-link">
                                                        <i class="fas fa-plus-circle nav-icon"></i>
                                                        <p>Ingreso</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href=""
                                                        class="nav-link">
                                                        <i class="fas fa-list nav-icon"></i>
                                                        <p>Listado</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <!-- bodegas -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link text-pink">
                                        <i class="fas fa-warehouse nav-icon"></i>&nbsp;
                                        <p>Bodegas<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=""
                                                class="nav-link">
                                                <i class="fas fa-plus-circle nav-icon"></i>
                                                <p>Ingreso</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=""
                                                class="nav-link">
                                                <i class="fas fa-list nav-icon"></i>
                                                <p>Listado</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- Gestión de lotes -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link text-pink">
                                <i class="nav-icon fas fa-layer-group"></i>&nbsp;
                                <p>Lotes<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Ingreso</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Asignación de cerdos a lotes -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link text-pink">
                                <i class="nav-icon fas fa-exchange-alt"></i>&nbsp;
                                <p>Asignar cerdos a lotes<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Ingreso</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Gestión de la reproducción -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link text-pink">
                                <i class="fas fa-sync-alt nav-icon"></i>&nbsp;
                                <p>Ciclos reproductivos<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Ingreso</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                            </ul>
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
        <footer class="main-footer" style="background: linear-gradient(#fff2f2,rgb(250, 158, 158)); color: #4e342e; border-top: 3px solid #e67e22; box-shadow: 0 -2px 10px rgba(161,108,58,0.08);">
            <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between py-2">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <img src="{{ asset('images/sg.png') }}" alt="sg Logo" style="height:32px;width:auto;margin-right:10px;filter:drop-shadow(0 2px 4px rgba(0,0,0,0.15));">
                    <span>
                        <strong>&copy; 2023-2025 <a href="#" style="color:#e67e22;text-decoration:underline;">sg</a>.</strong>
                        Todos los derechos reservados.
                    </span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="mr-3" style="font-size:1.1em;">
                        <i class="fas fa-leaf" style="color:#8bc34a;"></i> Gestión porcina sostenible
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
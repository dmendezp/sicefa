<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/flati.jpg') }}" type="image/x-icon">
    <title>SG - Panel del Aprendiz</title>
    <!-- Google Font: Inter & Poppins -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap">
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
        * {
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        :root {
            --sena-primary: #228B22;
            --sena-secondary: #1a6b1a;
            --sena-light: #4caf50;
            --sena-accent: #66bb6a;
            --sidebar-bg: #0d3b0d;
            --sidebar-hover: #1a5f1a;
            --text-primary: #1a3a1a;
            --text-secondary: #5a7d5a;
            --cattle-brown: #8b6f47;
            --cattle-tan: #d4a574;
        }

        body {
            background: url('{{ asset('images/imagen5.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh;
            color: var(--text-primary);
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(232, 245, 233, 0.7) 0%, rgba(200, 230, 201, 0.6) 100%);
            pointer-events: none;
            z-index: -1;
        }

        .wrapper {
            background: transparent;
        }

        /* Preloader Mejorado */
        .preloader {
            background: linear-gradient(135deg, #228B22 0%, #1a6b1a 100%);
        }

        .preloader img {
            animation: bounce 2s infinite, glow 2s infinite;
            filter: drop-shadow(0 0 20px rgba(34, 139, 34, 0.5));
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes glow {
            0%, 100% {
                filter: drop-shadow(0 0 10px rgba(34, 139, 34, 0.5));
            }
            50% {
                filter: drop-shadow(0 0 20px rgba(34, 139, 34, 0.8));
            }
        }

        /* Navbar Mejorado */
        .main-header.navbar {
            background: linear-gradient(90deg, #ffffff 0%, #f0f7f0 100%);
            box-shadow: 0 4px 20px rgba(34, 139, 34, 0.12);
            border-bottom: 3px solid var(--sena-primary);
            padding: 0.5rem 1rem;
        }

        .main-header .navbar-nav .nav-link {
            color: var(--text-primary) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }

        .main-header .navbar-nav .nav-link:hover,
        .main-header .navbar-nav .nav-link.active {
            color: var(--sena-primary) !important;
            background: rgba(34, 139, 34, 0.1);
            border-radius: 8px;
        }

        /* Sidebar Mejorado */
        .main-sidebar {
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #0a2a0a 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            border-right: 5px solid var(--sena-primary);
        }

        .sidebar {
            background: transparent;
        }

        .brand-link {
            border-bottom: 3px solid var(--sena-accent);
            padding: 1.5rem 0.5rem;
            background: linear-gradient(135deg, rgba(34, 139, 34, 0.15) 0%, transparent 100%);
        }

        .brand-link img {
            max-height: 80px;
            transition: all 0.4s ease;
            filter: drop-shadow(0 4px 8px rgba(34, 139, 34, 0.3));
        }

        .brand-link:hover img {
            transform: scale(1.1);
            filter: drop-shadow(0 8px 16px rgba(34, 139, 34, 0.5));
        }

        /* Menú Sidebar */
        .nav-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            padding: 0.75rem 1rem !important;
            border-radius: 8px;
            margin: 0.3rem 0.5rem;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
            font-weight: 500;
        }

        .nav-sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(180deg, var(--sena-light) 0%, var(--sena-primary) 100%);
            transform: scaleY(0);
            transform-origin: top;
            transition: transform 0.3s ease;
        }

        .nav-sidebar .nav-link:hover {
            background: rgba(34, 139, 34, 0.2);
            color: #fff !important;
            padding-left: 1.3rem !important;
        }

        .nav-sidebar .nav-link:hover::before {
            transform: scaleY(1);
        }

        .nav-sidebar .nav-link.active {
            background: linear-gradient(90deg, rgba(34, 139, 34, 0.25) 0%, transparent 100%);
            color: var(--sena-light) !important;
            font-weight: 600;
        }

        .nav-sidebar .nav-link i {
            margin-right: 0.8rem;
            transition: transform 0.3s ease;
        }

        .nav-sidebar .nav-link:hover i {
            transform: rotate(8deg) scale(1.15);
        }

        /* Nav Headers */
        .nav-header {
            color: var(--sena-light) !important;
            padding: 1rem 1rem 0.5rem !important;
            font-size: 0.75rem;
            letter-spacing: 1.5px;
            font-weight: 700;
            border-top: 2px solid rgba(34, 139, 34, 0.2);
            margin-top: 1.5rem;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-header:first-child {
            border-top: none;
            margin-top: 0;
        }

        .nav-header i {
            font-size: 1rem;
            color: var(--sena-accent);
        }

        /* Treeview arrows */
        .nav-treeview {
            background: rgba(0, 0, 0, 0.1);
            border-left: 3px solid var(--sena-accent);
            margin-left: 0.5rem;
            padding-left: 0;
            border-radius: 0 8px 8px 0;
        }

        .nav-treeview .nav-link {
            padding-left: 2rem !important;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.75) !important;
        }

        .nav-treeview .nav-link:hover {
            background: rgba(34, 139, 34, 0.15);
        }

        /* Content Wrapper */
        .content-wrapper {
            background: transparent;
            padding: 2rem;
            min-height: calc(100vh - 140px);
        }

        /* Footer Mejorado */
        .main-footer {
            background: linear-gradient(90deg, var(--sidebar-bg) 0%, var(--sidebar-hover) 100%);
            color: #fff;
            border-top: 4px solid var(--sena-primary);
            padding: 1rem 2rem;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
            font-size: 0.9rem;
        }

        .main-footer a {
            color: var(--sena-light);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .main-footer a:hover {
            color: var(--sena-accent);
            text-decoration: underline;
        }

        .main-footer .badge-warning {
            background: linear-gradient(135deg, var(--sena-primary) 0%, var(--sena-light) 100%);
            color: white !important;
            border: none;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(34, 139, 34, 0.4);
            padding: 0.4rem 0.8rem !important;
            font-size: 0.85rem;
        }

        .main-footer .fa-leaf {
            color: var(--sena-light) !important;
            animation: float 3s ease-in-out infinite;
        }

        .footer-info-badge {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.95);
        }

        .footer-version {
            background: rgba(34, 139, 34, 0.2);
            border-left: 4px solid var(--sena-primary);
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            font-size: 0.85rem;
        }

        /* Botones */
        .btn-success {
            background: linear-gradient(135deg, var(--sena-primary) 0%, var(--sena-light) 100%);
            border: none;
            color: white !important;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(34, 139, 34, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(34, 139, 34, 0.5);
            background: linear-gradient(135deg, var(--sena-light) 0%, var(--sena-primary) 100%);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--cattle-brown) 0%, var(--cattle-tan) 100%);
            border: none;
            color: white !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 111, 71, 0.3);
        }

        /* Dropdown */
        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            animation: slideDown 0.3s ease;
            border-top: 3px solid var(--sena-primary);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            color: var(--text-primary);
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .dropdown-item:hover {
            background: rgba(34, 139, 34, 0.1);
            color: var(--sena-primary);
            border-left-color: var(--sena-primary);
        }

        /* Responsive */
        @media (max-width: 767.98px) {
            .content-wrapper {
                padding: 1rem;
                min-height: calc(100vh - 120px);
            }

            .main-footer {
                padding: 1.5rem 1rem;
            }

            .main-footer .container-fluid {
                flex-direction: column !important;
                text-align: center;
            }

            .main-footer .d-flex.align-items-center {
                justify-content: center !important;
                margin-bottom: 1rem;
            }

            .main-footer .d-flex.align-items-center:last-child {
                margin-bottom: 0;
            }

            .nav-header {
                padding: 0.75rem 1rem 0.5rem !important;
            }

            .nav-sidebar .nav-link {
                padding: 0.5rem 1rem !important;
            }

            .footer-info-badge {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        /* Scrollbar personalizado */
        .os-scrollbar-vertical {
            background: rgba(34, 139, 34, 0.1) !important;
        }

        .os-scrollbar-track {
            background: transparent !important;
        }

        .os-scrollbar-handle {
            background: rgba(34, 139, 34, 0.6) !important;
            border-radius: 10px !important;
        }

        .os-scrollbar-handle:hover {
            background: rgba(34, 139, 34, 0.8) !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="SG Logo" height="60" width="90" style="max-width: 90px; height: auto; object-fit: contain;">
        </div>

        <!-- Navbar Mejorado -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button" title="Alternar menú">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block ml-3">
                    <a href="http://127.0.0.1:8000/sg/index" class="nav-link" title="Ir a inicio">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block mr-3">
                    <a href="http://127.0.0.1:8000/sg/aprendiz/panelAprendiz" class="btn btn-success btn-sm" title="Volver al panel admin">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="userDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> {{ Auth::user()->nickname }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <h6 class="dropdown-header">Cuenta</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </div>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @endauth
            </ul>
        </nav>

        <!-- Main Sidebar -->
        <aside class="main-sidebar elevation-4">
            <!-- Brand Logo -->
            <div class="brand-link d-flex justify-content-center align-items-center">
                <a href="#" class="d-block text-center" onclick="showImageModal(event)">
                    <img src="{{ asset('images/logo.jpg') }}" alt="SG Logo" 
                    class="rounded-circle border border-warning shadow" 
                    style="cursor: pointer; transition: all 0.3s ease;" />
                </a>
            </div>

            <!-- Modal para mostrar imagen -->
            <div id="imageModal" class="modal"
                style="display: none; position: fixed; z-index: 1050; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6);">
                <div class="modal-dialog modal-sm" style="margin: 15% auto;">
                    <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
                        <div class="modal-header" style="background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%); color: white; border: none;">
                            <h5 class="modal-title">SG - Sistema de Ganadería</h5>
                            <button type="button" class="close" style="color: white;" onclick="closeImageModal()">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset('images/logo.jpg') }}" alt="SG Logo"
                            style="max-width: 100%; height: auto; border-radius: 8px;">
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

                window.onclick = function(event) {
                    const modal = document.getElementById('imageModal');
                    if (event.target === modal) {
                        modal.style.display = 'none';
                    }
                }
            </script>

            <!-- Sidebar Menu -->
            <div class="sidebar">
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <!-- Sección: Gestión de Animales -->
                        <li class="nav-header">
                            <i class="fas fa-cow"></i> Gestión de Animales
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sg.aprendiz.sg.ANIMALES.create') }}" class="nav-link">
                                <i class="nav-icon fas fa-plus-circle text-warning"></i>
                                <p>Registrar Bovino</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sg.aprendiz.sg.ANIMALES.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-list text-info"></i>
                                <p>Listado de Bovinos</p>
                            </a>
                        </li>

                        <!-- Sección: Producción -->
                        <li class="nav-header">
                            <i class="fas fa-chart-line"></i> Producción
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sg.aprendiz.sg.PRODUCCION.create') }}" class="nav-link">
                                <i class="nav-icon fas fa-tint text-cyan"></i>
                                <p>Control de Ordeño</p>
                            </a>
                        </li>

                        <!-- Sección: Desarrollo -->
                        <li class="nav-header">
                            <i class="fas fa-leaf"></i> Desarrollo
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sg.aprendiz.sg.PESOS.create') }}" class="nav-link">
                                <i class="nav-icon fas fa-weight text-success"></i>
                                <p>Control de Peso</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Footer Mejorado -->
        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row align-items-center mb-2 mb-sm-0">
                    <div class="col-sm-6 text-center text-sm-left">
                        <div class="footer-info-badge">
                            <img src="{{ asset('images/logo.jpg') }}" alt="SG Logo" style="height:28px;width:auto;border-radius:4px;">
                            <span>
                                <strong>&copy; 2023-2025 <a href="#" style="text-decoration: none;">GANASOFT</a></strong> • Todos los derechos reservados
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 text-center text-sm-right">
                        <div class="d-flex justify-content-center justify-content-sm-end align-items-center flex-wrap gap-2">
                            <span style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.9rem;">
                                <i class="fas fa-leaf"></i> Gestión Sostenible
                            </span>
                            <span class="badge badge-warning footer-version">
                                v 1.1.1
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
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

    @yield('scripts')
</body>
</html>
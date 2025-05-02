<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AdminLTE Verde Elegante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- AdminLTE y dependencias -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        :root {
            --verde-principal: #1a4d2e;
            --verde-secundario: #2d6a4f;
            --verde-claro: #4c956c;
            --verde-hover: #3a7d5b;
            --verde-activo: #6bbf8a;
            --texto-claro: #f1f8f5;
        }
        
        /* Reset de estilos no deseados */
        *:focus {
            outline: none !important;
            box-shadow: none !important;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f9f6;
            --webkit-tap-highlight-color: transparent;
        }
        
        /* Sidebar principal */
        .main-sidebar {
            background-color: var(--verde-principal);
            border-right: none !important;
        }
        
        /* Logo/Brand */
        .brand-link {
            background-color: var(--verde-secundario);
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            text-align: center;
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .brand-link .brand-image {
            opacity: 0.9;
            margin-right: 0.5rem;
        }
        
        /* Items del menú */
        .nav-sidebar .nav-link {
            color: var(--texto-claro);
            font-weight: 500;
            margin: 2px 0;
            border-radius: 0;
            padding: 0.75rem 1rem;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-sidebar .nav-link:hover {
            background-color: var(--verde-hover);
            color: white;
        }
        
        .nav-sidebar .nav-link.active {
            background-color: var(--verde-activo);
            color: #1a1a1a !important;
            font-weight: 600;
        }
        
        .nav-sidebar .nav-link .nav-icon {
            color: rgba(255, 255, 255, 0.7);
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }
        
        .nav-sidebar .nav-link.active .nav-icon {
            color: var(--verde-principal);
        }
        
        /* Flecha de despliegue mejorada */
        .nav-item > a > .right {
            transition: transform 0.3s ease;
            margin-left: auto; /* Empuja la flecha a la derecha */
            padding-left: 15px; /* Más espacio alrededor */
            font-size: 0.9rem; /* Tamaño adecuado */
        }
        
        .nav-item.menu-open > a > .right {
            transform: rotate(-90deg);
        }
        
        /* Submenú (Gestion de préstamos) */
        .nav-treeview {
            background-color: rgba(0, 0, 0, 0.15);
            padding-left: 10px;
        }
        
        .nav-treeview .nav-link {
            padding-left: 2rem !important;
            position: relative;
        }
        
        .nav-treeview .nav-link:before {
            content: "";
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 5px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
        }
        
        /* Barra superior */
        .main-header {
            background-color: var(--verde-secundario);
            border-bottom: none;
        }
        
        .navbar-nav .nav-link {
            color: white !important;
        }
        
        /* Botón de cerrar sesión */
        .btn-logout {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-logout:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        /* Modal de confirmación personalizado */
        .logout-modal .modal-content {
            border-radius: 0.5rem;
            border: none;
        }
        
        .logout-modal .modal-header {
            background-color: var(--verde-principal);
            color: white;
            border-bottom: none;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        
        .logout-modal .modal-body {
            padding: 2rem;
            text-align: center;
        }
        
        .logout-modal .modal-footer {
            border-top: none;
            justify-content: center;
            padding-bottom: 2rem;
        }
        
        .logout-modal .btn-cancel {
            background-color: #f8f9fa;
            color: #495057;
        }
        
        .logout-modal .btn-confirm {
            background-color: var(--verde-principal);
            color: white;
        }
        
        /* Contenido principal */
        .content-wrapper {
            background-color: #f4f9f6;
        }
        
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: none;
        }
        
        /* Eliminar efectos azules no deseados */
        a, .nav-link {
            -webkit-tap-highlight-color: transparent;
        }
        
        a:focus, a:active,
        .nav-link:focus, .nav-link:active {
            background-color: var(--verde-hover) !important;
            color: white !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        
        <!-- Navbar Superior -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Botón para colapsar sidebar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            
            <!-- Menú superior derecho -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button class="btn btn-logout text-white" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt mr-1"></i> Cerrar Sesión
                    </button>
                </li>
            </ul>
        </nav>
        
        <!-- Sidebar -->
        <aside class="main-sidebar elevation-4 sidebar-dark-primary">
            <!-- Logo -->
            <a href="index.html" class="brand-link">
                <i class="fas fa-leaf brand-image mr-2"></i>
                <span class="brand-text font-weight-light">Admin Verde</span>
            </a>
            
            <!-- Menú lateral -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        
                        <!-- Herramientas -->
                        <li class="nav-item">
                            <a href="{{ route('toolhub.admin.admin.indextools') }}" class="nav-link">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>Herramientas</p>
                            </a>
                        </li>
                        
                        <!-- Gestión de Préstamos (menú desplegable) -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <p>
                                    Gestión de Préstamos
                                    
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Préstamos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Movimientos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- Inventario -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-box-open"></i>
                                <p>Inventario</p>
                            </a>
                        </li>
                        
                        <!-- Reportes -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Reportes</p>
                            </a>
                        </li>
                        
                        <!-- Creación de Usuarios -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Creación de Usuarios</p>
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
        
     
            
           
        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023</strong>
            Todos los derechos reservados.
        </footer>
    </div>
    
    <!-- Modal de confirmación para cerrar sesión -->
    <div class="modal fade logout-modal" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Cerrar Sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-sign-out-alt fa-3x mb-3" style="color: var(--verde-principal);"></i>
                    <h4>¿Estás seguro que deseas cerrar sesión?</h4>
                    <p>Tus cambios no guardados podrían perderse.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel mr-3" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-confirm" id="confirmLogout">Sí, Cerrar Sesión</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Aceptar'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'Intentar de nuevo'
                });
            @endif

            @if (session('info'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Información',
                    text: '{{ session('info') }}',
                    confirmButtonText: 'Entendido'
                });
            @endif
        });
    </script>
    
    <script>
        $(document).ready(function() {
            // Manejo del menú desplegable
            $('.has-treeview > a').on('click', function(e) {
                e.preventDefault();
                $(this).parent().toggleClass('menu-open');
            });
            
            // Cerrar menús al hacer clic fuera
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.nav-sidebar').length) {
                    $('.has-treeview').removeClass('menu-open');
                }
            });
            
            // Prevenir cierre al hacer clic dentro del menú
            $('.nav-sidebar').on('click', function(e) {
                e.stopPropagation();
            });
            
            // Confirmar cierre de sesión
            $('#logoutModal').on('click', function() {
                // Aquí iría la lógica real para cerrar sesión
                alert('Sesión cerrada (simulación)');
                $('#logoutModal').modal('hide');
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Viveros</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css">
    <style>
        /* Custom styles for elegance and nature theme */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
        }
        .sidebar {
            background: linear-gradient(180deg, #2f855a, #1a4731);
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #38a169;
            transform: translateX(5px);
        }
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(to right, #38a169, #68d391);
        }
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
        /* Submenu styles */
        .submenu {
            display: none;
            margin-left: 1rem;
        }
        .submenu.active {
            display: block;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Header -->
    

    <!-- Main Content Area -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="sidebar w-64 h-screen fixed text-white flex flex-col shadow-lg">
            <div class="p-6 text-2xl font-bold border-b border-green-700">
                <i class="fa-solid fa-leaf mr-2"></i> GVFF
            </div>
            <header class="header w-full p-4 text-white shadow-md">
        <nav class="flex items-center justify-end space-x-4">
            @auth
                @if(checkRol('gvff.admin'))
                        Administrador
                @endif
                @if(checkRol('gvff.users'))
                    <a href="{{ route('gvff.users.users') }}" 
                       class="nav-link hover:text-gray-200 @if(Route::is('gvff.users.*')) font-bold @endif">
                        Usuario
                    </a>
                @endif
            @endauth
        </nav>
    </header>
            <nav class="flex-1 p-4">
                <a href="{{ route('gvff.index') }}" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                    <i class="fa-solid fa-home mr-2"></i> Dashboard
                </a>
                <div>
                    <a href="{{ route('gvff.admin.nurseries.index') }}" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                        <i class="fa-solid fa-leaf mr-2"></i> Viveros
                    </a>
                    <div class="submenu" id="viveros-submenu">
                        <a href="#viveros-ornamen" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                            <i class="fa-solid fa-flower mr-2"></i> Ornamental
                        </a>
                        <a href="#viveros-forestal" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                            <i class="fa-solid fa-tree mr-2"></i> Forestal
                        </a>
                    </div>
                </div>
                <div>
                    <a href="{{ route('gvff.admin.plants.index') }}"  class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition" onclick="toggleSubmenu(event, 'plantas-submenu')">
                        <i class="fa-solid fa-seedling mr-2"></i> Plantas
                    </a>
                    <div class="submenu" id="plantas-submenu">
                        <a href="{{ route('gvff.admin.plants.index') }}" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                            <i class="fa-solid fa-flower mr-2"></i> plantas
                        </a>
                        <a href="{{ route('gvff.admin.plants.ornamental.create') }}" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                            <i class="fa-solid fa-flower mr-2"></i> Crear Planta Ornamental
                        </a>
                        <a href="{{ route('gvff.admin.plants.medicinal.create') }}" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                            <i class="fa-solid fa-mortar-pestle mr-2"></i> Crear Planta Medicinal
                        </a>
                        <a href="{{ route('gvff.admin.plants.venta.create') }}" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                            <i class="fa-solid fa-shopping-cart mr-2"></i> Crear Planta en Venta
                        </a>
                        <a href="{{ route('gvff.admin.plants.forestal.create') }}" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                            <i class="fa-solid fa-tree mr-2"></i> Crear Planta Forestal
                        </a>
                    </div>
                    
                    <script>
                        function toggleSubmenu(event, submenuId) {
                            const submenu = document.getElementById(submenuId);
                        
                            if (!submenu) return;
                        
                            const isVisible = submenu.style.display === "block";
                        
                            // Si el submenú NO está visible, lo mostramos y prevenimos navegación
                            if (!isVisible) {
                                event.preventDefault();
                                submenu.style.display = "block";
                            } else {
                                // Si ya está visible, permitimos navegación (no se hace preventDefault)
                                // Opcional: podrías cerrarlo aquí si quieres
                                // submenu.style.display = "none";
                            }
                        }
                        </script>
                </div>
                <a href="#fauna" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                    <i class="fa-solid fa-paw mr-2"></i> Fauna
                </a>
                <a href="#compras" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                    <i class="fa-solid fa-receipt mr-2"></i> Compras
                </a>
                <a href="#suministros" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                    <i class="fa-solid fa-box mr-2"></i> Suministros
                </a>
                <a href="#herramientas" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                    <i class="fa-solid fa-hammer mr-2"></i> Herramientas
                </a>
                <a href="#registros" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                    <i class="fa-solid fa-book mr-2"></i> Registros
                </a>
                <a href="#seguimientos" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                    <i class="fa-solid fa-chart-line mr-2"></i> Seguimientos
                </a>

                
            </nav>
            <div class="p-4 border-t border-green-700">
                <a href="{{ route('login') }}" class="block py-2 px-4 rounded-lg hover:bg-red-600 transition">
                    <i class="fa-solid fa-sign-out-alt mr-2"></i> Cerrar Sesión
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8 bg-gray-100">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript for Submenu Toggle -->
    <script>
        function toggleSubmenu(event, submenuId) {
            event.preventDefault();
            const submenu = document.getElementById(submenuId);
            const isActive = submenu.classList.contains('active');
            // Close all submenus
            document.querySelectorAll('.submenu').forEach(sub => sub.classList.remove('active'));
            // Toggle the clicked submenu
            if (!isActive) {
                submenu.classList.add('active');
            }
            // Navigate to the parent section if submenu is closed
            const parentSection = submenuId.split('-')[0];
            if (!submenu.classList.contains('active')) {
                window.location.hash = parentSection;
            }
        }
    </script>
</body>
@stack('scripts')
</html>
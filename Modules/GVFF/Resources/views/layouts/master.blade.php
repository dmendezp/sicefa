<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Viveros</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
<body class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="sidebar w-64 h-screen fixed text-white flex flex-col shadow-lg">
        <div class="p-6 text-2xl font-bold border-b border-green-700">
            <i class="fa-solid fa-leaf mr-2"></i> GVFF
        </div>
        <nav class="flex-1 p-4">
            <a href="#dashboard" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                <i class="fa-solid fa-home mr-2"></i> Dashboard
            </a>
            <div>
                <a href="#viveros" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition" onclick="toggleSubmenu(event, 'viveros-submenu')">
                    <i class="fa-solid fa-tree mr-2"></i> Viveros
                </a>
                <div class="submenu" id="viveros-submenu">
                    <a href="#viveros-ornamental" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                        <i class="fa-solid fa-flower mr-2"></i> Ornamental
                    </a>
                    <a href="#viveros-forestal" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                        <i class="fa-solid fa-tree mr-2"></i> Forestal
                    </a>
                </div>
            </div>
            <div>
                <a href="#plantas" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition" onclick="toggleSubmenu(event, 'plantas-submenu')">
                    <i class="fa-solid fa-seedling mr-2"></i> Plantas
                </a>


                <div class="submenu" id="plantas-submenu">
                    <a href="#plantas-floral" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                        <i class="fa-solid fa-flower mr-2"></i> Floral
                    </a>
                    <a href="#plantas-medicinales" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                        <i class="fa-solid fa-mortar-pestle mr-2"></i> Plantas Medicinales
                    </a>
                    <a href="#plantas-venta" class="block py-2 px-4 rounded-lg mb-2 hover:bg-green-600 transition">
                        <i class="fa-solid fa-shopping-cart mr-2"></i> Plantas en Venta
                    </a>
                </div>
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
            <a href= "{{ route('login') }}" class="block py-2 px-4 rounded-lg hover:bg-red-600 transition">
                <i class="fa-solid fa-sign-out-alt mr-2"></i> Cerrar Sesión
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-8">
        <!-- Header -->
        <header class="header p-6 rounded-lg shadow-lg mb-8 text-white">
            <h1 class="text-3xl font-bold">Sistema de Gestión de Viveros</h1>
            <p class="mt-2">Administra viveros, plantas, ventas y más con facilidad.</p>
        </header>

        <!-- Dashboard Section -->
        <section id="dashboard">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Resumen General</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="card bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">Total Viveros</h3>
                    <p class="text-3xl font-bold text-green-600">5</p>
                    <p class="text-sm text-gray-500">Públicos: 3 | Privados: 2</p>
                </div>
                <!-- Card 2 -->
                <div class="card bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">Plantas en Inventario</h3>
                    <p class="text-3xl font-bold text-green-600">1,245</p>
                    <p class="text-sm text-gray-500">Árboles: 600 | Arbustos: 645</p>
                </div>
                <!-- Card 3 -->
                <div class="card bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">Ventas Totales</h3>
                    <p class="text-3xl font-bold text-green-600">$12,500</p>
                    <p class="text-sm text-gray-500">Este mes: $3,200</p>
                </div>
                <!-- Card 4 -->
                <div class="card bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">Especies en Seguimiento</h3>
                    <p class="text-3xl font-bold text-green-600">320</p>
                    <p class="text-sm text-gray-500">Sanas: 300 | En peligro: 20</p>
                </div>
            </div>
        </section>

        <!-- Viveros Section -->
        <section id="viveros" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Viveros</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Gestión de Viveros</h3>
                <p class="text-gray-600 mb-4">Selecciona una categoría de viveros para gestionar:</p>
                <div class="flex space-x-4">
                    <a href="#viveros-ornamental" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Viveros Ornamentales
                    </a>
                    <a href="#viveros-forestal" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Viveros Forestales
                    </a>
                </div>
            </div>
        </section>

        <!-- Viveros Ornamental Subsection -->
        <section id="viveros-ornamental" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Viveros Ornamentales</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600">Gestión de viveros ornamentales, incluyendo plantas decorativas, flores y arbustos para jardinería.</p>
                <!-- Sample Table -->
                <div class="overflow-x-auto mt-4">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-4">Nombre</th>
                                <th class="p-4">Tipo</th>
                                <th class="p-4">Inventario</th>
                                <th class="p-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-4">Rosa</td>
                                <td class="p-4">Flor</td>
                                <td class="p-4">100</td>
                                <td class="p-4">
                                    <button class="text-blue-600 hover:underline mr-2">Editar</button>
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-4">Lavanda</td>
                                <td class="p-4">Arbusto</td>
                                <td class="p-4">80</td>
                                <td class="p-4">
                                    <button class="text-blue-600 hover:underline mr-2">Editar</button>
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Viveros Forestal Subsection -->
        <section id="viveros-forestal" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Viveros Forestales</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600">Gestión de viveros forestales, incluyendo árboles y especies para reforestación y conservación.</p>
                <!-- Sample Table -->
                <div class="overflow-x-auto mt-4">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-4">Nombre</th>
                                <th class="p-4">Especie</th>
                                <th class="p-4">Inventario</th>
                                <th class="p-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-4">Pino</td>
                                <td class="p-4">Pinus sylvestris</td>
                                <td class="p-4">200</td>
                                <td class="p-4">
                                    <button class="text-blue-600 hover:underline mr-2">Editar</button>
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-4">Roble</td>
                                <td class="p-4">Quercus robur</td>
                                <td class="p-4">150</td>
                                <td class="p-4">
                                    <button class="text-blue-600 hover:underline mr-2">Editar</button>
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Plantas Section -->
        <section id="plantas" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Plantas</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Gestión de Plantas</h3>
                <p class="text-gray-600 mb-4">Selecciona una categoría de plantas para gestionar:</p>
                <div class="flex space-x-4">
                    <a href="#plantas-floral" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Plantas Florales
                    </a>
                    <a href="#plantas-medicinales" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Plantas Medicinales
                    </a>
                    <a href="#plantas-venta" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Plantas en Venta
                    </a>
                </div>
            </div>
        </section>

        <!-- Plantas Floral Subsection -->
        <section id="plantas-floral" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Plantas Florales</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600">Gestión de plantas florales, incluyendo especies decorativas y de jardinería.</p>
                <!-- Sample Table -->
                <div class="overflow-x-auto mt-4">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-4">Nombre</th>
                                <th class="p-4">Especie</th>
                                <th class="p-4">Inventario</th>
                                <th class="p-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-4">Tulipán</td>
                                <td class="p-4">Tulipa spp.</td>
                                <td class="p-4">120</td>
                                <td class="p-4">
                                    <button class="text-blue-600 hover:underline mr-2">Editar</button>
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-4">Girasol</td>
                                <td class="p-4">Helianthus annuus</td>
                                <td class="p-4">90</td>
                                <td class="p-4">
                                    <button class="text-blue-600 hover:underline mr-2">Editar</button>
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Plantas Medicinales Subsection -->
        <section id="plantas-medicinales" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Plantas Medicinales</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600">Gestión de plantas medicinales, incluyendo especies con propiedades terapéuticas.</p>
                <!-- Sample Table -->
                <div class="overflow-x-auto mt-4">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-4">Nombre</th>
                                <th class="p-4">Especie</th>
                                <th class="p-4">Inventario</th>
                                <th class="p-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-4">Manzanilla</td>
                                <td class="p-4">Matricaria chamomilla</td>
                                <td class="p-4">70</td>
                                <td class="p-4">
                                    <button class="text-blue-600 hover:underline mr-2">Editar</button>
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-4">Aloe Vera</td>
                                <td class="p-4">Aloe barbadensis</td>
                                <td class="p-4">60</td>
                                <td class="p-4">
                                    <button class="text-blue-600 hover:underline mr-2">Editar</button>
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Plantas en Venta Subsection -->
        <section id="plantas-venta" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Plantas en Venta</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Listado de Plantas</h3>
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        <i class="fa-solid fa-plus mr-2"></i> Agregar Planta
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-4">Nombre</th>
                                <th class="p-4">Especie</th>
                                <th class="p-4">Inventario</th>
                                <th class="p-4">Precio</th>
                                <th class="p-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-4">Rosa</td>
                                <td class="p-4">Rosa spp.</td>
                                <td class="p-4">50</td>
                                <td class="p-4">$10.00</td>
                                <td class="p-4">
                                    <button class="text-blue-600 hover:underline mr-2">Editar</button>
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-4">Pino</td>
                                <td class="p-4">Pinus sylvestris</td>
                                <td class="p-4">30</td>
                                <td class="p-4">$25.00</td>
                                <td class="p-4">
                                    <button class="text-blue-600 hover:underline mr-2">Editar</button>
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        @auth
                @if(checkRol('gvff.admin'))
                    <li class="nav-item d-none d-sm-inline-block" style="margin-right: 80px;">
                        <a href="{{ route('gvff.admin.welcome') }}" 
                           class="nav-link @if(Route::is('gvff.admin.*')) active @endif">
                            Administrador
                        </a>
                    </li>
                @endif
            @endauth
            @auth
            @if(checkRol('gvff.users'))
                <li class="nav-item d-none d-sm-inline-block" style="margin-right: 80px;">
                    <a href="{{ route('gvff.users.users') }}" 
                       class="nav-link @if(Route::is('gvff.users.*')) active @endif">
                        usuario
                    </a>
                </li>
            @endif
        @endauth

        <!-- Fauna Section -->
        <section id="fauna" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Fauna</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600">Aquí se mostrará la gestión de fauna.</p>
            </div>
        </section>

        <!-- Compras Section -->
        <section id="compras" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Compras</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600">Aquí se mostrará la gestión de compras.</p>
            </div>
        </section>

        <!-- Suministros Section -->
        <section id="suministros" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Suministros</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600">Aquí se mostrará la gestión de suministros.</p>
            </div>
        </section>

        <!-- Herramientas Section -->
        <section id="herramientas" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Herramientas</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600">Aquí se mostrará la gestión de herramientas.</p>
            </div>
        </section>

        <!-- Registros Section -->
        <section id="registros" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Registros</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600">Aquí se mostrará la gestión de registros.</p>
            </div>
        </section>

        <!-- Seguimientos Section -->
        <section id="seguimientos" class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Seguimientos</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600">Aquí se mostrará la gestión de seguimientos.</p>
            </div>
        </section>
    </main>

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
                window.location.hash = #${parentSection};
            }
        }
    </script>
</body>
</html>
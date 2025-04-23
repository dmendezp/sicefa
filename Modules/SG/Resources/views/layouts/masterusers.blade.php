<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Software de Ganadería</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Css Personalizado -->
    <link rel="stylesheet" href="{{ asset('modules/SG/css/masterusers.css') }}">

<style>
    .hero-bg {
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                     url('{{ asset("modules/sg/images/welcome.png") }}');
    background-size: cover;
    background-position: center;
}
</style>

</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="h-screen flex flex-col hero-bg"> <!-- Cambiado de min-h-screen a h-screen para control de altura -->
        <!-- Header -->
        <header class="w-full px-4 py-2 bg-opacity-75 bg-gray-800 fixed top-0 z-10"> <!-- Fijo arriba -->
            <div class="container mx-auto flex justify-between items-center">
                <div class="flex items-center">
                    <img src="{{ asset('modules/SG/images/logo.png') }}" alt="Logo Ganadería" class="h-8 mr-2"> <!-- Tamaño reducido -->
                    <h1 class="text-lg font-bold text-white">Gestión Ganadera</h1>
                     <!-- Tamaño de fuente reducido -->
                </div>  
                <nav class="navbar navbar-expand navbar-dark">
                    <ul class="navbar-nav">
                        <li class="nav-item d-none d-sm-inline-block">
                        @auth
                            @if(checkRol('sg.admin'))
                                <li class="nav-item d-none d-sm-inline-block" style="margin-right: 80px;">
                                    <a href="{{ route('sg.admin.welcome') }}" 
                                       class="nav-link @if(Route::is('sg.admin.welcome')) active @endif">
                                        Administrador
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </li>
                    </ul>
                    
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow flex items-center justify-center pt-16"> <!-- Padding para no tapar con el header -->
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-4"> <!-- Tamaños reducidos -->
                    Bienvenido a tu Sistema de Gestión Ganadera
                </h2>
                <p class="text-base text-gray-200 mb-6 max-w-xl mx-auto"> <!-- Tamaño reducido -->
                    Optimiza el manejo de tu ganado con nuestra solución integral: 
                    control de inventario, salud animal y productividad.
                </p>
                
                <!-- Botón CTA -->
                <a href="{{ route('login') }}" 
                   class="inline-block bg-green-600 text-white px-6 py-2 rounded-full text-base font-semibold 
                   hover:bg-green-700 transition duration-300"> <!-- Tamaño reducido -->
                    Iniciar Sesión
                </a>
            </div>
        </main>

        @yield('content')
        
        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-2"> <!-- Padding reducido -->
            <div class="container mx-auto px-4 text-center">
                <p class="text-sm">© {{ date('Y') }} Software de Ganadería. Todos los derechos reservados.</p> <!-- Tamaño reducido -->
            </div>
        </footer>
    </div>
</body>
</html>
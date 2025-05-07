<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Unidad Porcina - SIPORK</title>
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fuente profesional -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        #background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 1;
        }
    </style>
</head>
<body class="text-white">

    <!-- Fondo con video -->
    <video autoplay muted loop id="background-video" playsinline>
        <source src="{{ asset('images/unidad porcina.mp4') }}" type="video/mp4">
        Tu navegador no soporta el video.
    </video>

    <!-- Navbar flotante -->
    <nav class="fixed top-0 w-full z-50 bg-black/20 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#" class="flex items-center text-white font-bold text-2xl tracking-tight">
                <img src="{{ asset('images/sipork.png') }}" alt="SIPORK" class="w-9 h-9 mr-3">
                SIPORK
            </a>
            <div class="hidden md:flex space-x-6 text-sm font-semibold">
                @auth
                    @if(checkRol('sipork.admin'))
                        <a href="{{ route('sipork.admin.welcome') }}" class="hover:text-green-400 transition">Administrador</a>
                    @endif
                    @if(checkRol('sipork.liderDeUnidad'))
                        <a href="{{ route('sipork.liderDeUnidad.panelLider') }}" class="hover:text-green-400 transition">Líder de Unidad</a>
                    @endif
                    @if(checkRol('sipork.aprendiz'))
                        <a href="{{ route('sipork.aprendiz.panelAprendiz') }}" class="hover:text-green-400 transition">Aprendiz</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="flex items-center justify-center min-h-screen px-6 pt-24 text-center">
        <div class="space-y-8 max-w-3xl">
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight drop-shadow-[0_3px_6px_rgba(0,0,0,0.7)]">
                Bienvenido a <span class="text-green-400">SIPORK</span>
            </h1>
            <p class="text-xl md:text-2xl text-white/90 font-light drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)] leading-relaxed">
                Una plataforma profesional para la gestión estratégica de tu unidad porcina.
                Control total, monitoreo inteligente y toma de decisiones basada en datos reales.
            </p>
            @guest
                <a href="{{ route('login') }}"
                   class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 shadow-lg text-lg">
                    Iniciar Sesión
                </a>
            @else
                <a href="{{ url('/') }}"
                   class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 shadow-lg text-lg">
                    Ir al Panel
                </a>
            @endguest
        </div>
    </main>

    <!-- Footer -->
    <footer class="fixed bottom-0 w-full bg-black/20 backdrop-blur-md py-3 text-sm text-white">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between px-6">
            <div class="mb-2 md:mb-0">
                <strong>© 2023-2025 <a href="#" class="text-green-400 underline hover:text-green-300">SIPORK</a></strong> — Todos los derechos reservados.
            </div>
            <div class="font-semibold">Versión 3.2.0</div>
        </div>
    </footer>

</body>
</html>
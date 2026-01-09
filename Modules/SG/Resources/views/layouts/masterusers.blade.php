<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGANA - Sistema de Gestión Ganadera</title>
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; }
        html { scroll-behavior: smooth; }
        .fade-up { animation: fadeUp 1s ease-out; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px);} to {opacity:1; transform:translateY(0);} }
        #bg-video { position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1; opacity: 0.35; }
    </style>
</head>
<body class="text-slate-100">

<!-- Fondo con video -->
<video autoplay muted loop id="bg-video" playsinline>
    <source src="{{ asset('images/ganaderia.mp4') }}" type="video/mp4">
</video>

<!-- Navbar -->
<nav class="fixed top-0 w-full z-50 bg-black/20 backdrop-blur-md">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
    <div class="flex items-center">
      <!-- Modifica el enlace del logo y agrega el modal -->
<a href="#" id="logo-link" class="flex items-center text-white font-bold text-2xl tracking-tight">
  <img src="{{ asset('images/logo.jpg') }}" alt="sg" class="w-20 h-20 mr-3 rounded-full object-cover border-2 border-white shadow">
</a>

<!-- Modal oculto por defecto, solo el logo en círculo y sin fondo blanco -->
<div id="logo-modal" class="fixed inset-0 bg-black bg-opacity-70 flex items-start justify-center z-50 hidden">
  <div class="relative mt-32">
    <button id="close-logo-modal" class="absolute -top-8 right-0 text-gray-200 hover:text-red-400 text-3xl font-bold">&times;</button>
    <img src="{{ asset('images/logo.jpg') }}" alt="Logo grande" class="w-64 h-64 rounded-full object-cover border-4 border-white shadow-xl mx-auto">
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const logoLink = document.getElementById('logo-link');
    const logoModal = document.getElementById('logo-modal');
    const closeModal = document.getElementById('close-logo-modal');

    logoLink.addEventListener('click', function(e) {
      e.preventDefault();
      logoModal.classList.remove('hidden');
    });

    closeModal.addEventListener('click', function() {
      logoModal.classList.add('hidden');
    });

    // Opcional: cerrar el modal al hacer clic fuera de la imagen
    logoModal.addEventListener('click', function(e) {
      if (e.target === logoModal) {
        logoModal.classList.add('hidden');
      }
    });
  });
</script>
      <!-- Modal para mostrar el logo -->
      <a href="" class="ml-4 hover:text-green-400 transition text-base font-normal flex items-center">
        <!-- Icono de usuario/desarrollador -->
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-8 0v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/>
        </svg>
        Desarrolladores
      </a>
    </div>
    <div class="hidden md:flex space-x-6 text-sm font-semibold">
      @auth
        @if(checkRol('sg.admin'))
          <a href="{{ route('sg.admin.welcome') }}" class="hover:text-green-400 transition">Administrador</a>
        @endif
        @if(checkRol('sg.liderDeUnidad'))
          <a href="{{ route('sg.liderDeUnidad.panelLider') }}" class="hover:text-green-400 transition">Líder de Unidad</a>
        @endif
        @if(checkRol('sg.aprendiz'))
          <a href="{{ route('sg.aprendiz.panelAprendiz') }}" class="hover:text-green-400 transition">Aprendiz</a>
        @endif
      @endauth
    </div>
  </div>
</nav>

<!-- Hero con carrusel de fondo -->
<section id="inicio" class="relative flex items-center justify-center min-h-screen text-center px-6 pt-24 overflow-hidden">

    <!-- Carrusel de fondo usando <img> en lugar de background-image -->
    <div id="hero-carousel" class="absolute inset-0 z-0">
      <div class="slide absolute inset-0 opacity-0 animate-fade" style="animation-delay: 0s">
        <img src="{{ asset('images/imagen1.jpg') }}" alt="imagen1" class="w-full h-full object-cover">
      </div>
      <div class="slide absolute inset-0 opacity-0 animate-fade" style="animation-delay: 5s">
        <img src="{{ asset('images/imagen2.jpg') }}" alt="imagen2" class="w-full h-full object-cover">
      </div>
      <div class="slide absolute inset-0 opacity-0 animate-fade" style="animation-delay: 10s">
        <img src="{{ asset('images/imagen3.jpg') }}" alt="imagen3" class="w-full h-full object-cover">
      </div>
      <div class="absolute inset-0 bg-black/50"></div>
      <div class="slide absolute inset-0 opacity-0 animate-fade" style="animation-delay: 0s">
        <img src="{{ asset('images/imagen4.jpg') }}" alt="imagen4" class="w-full h-full object-cover">
      </div>
    </div>

    <!-- Contenido principal -->
    <div class="relative z-10 max-w-3xl space-y-6 fade-up">
        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">
            Gestión Integral de tu <span class="text-green-400">Unidad Ganadera</span>
        </h1>
        <p class="text-lg text-slate-200/90 leading-relaxed">
            Monitorea, organiza y mejora tus procesos productivos con la plataforma GANASOFT.
            Datos reales, decisiones inteligentes.
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
</section>

<!-- Animaciones del carrusel -->
<style>
@keyframes fade {
  0%, 33.33%, 100% { opacity: 0; }
  10%, 23.33% { opacity: 1; }
}
.slide:nth-child(1) { animation-delay: 0s; }
.slide:nth-child(2) { animation-delay: 5s; }
.slide:nth-child(3) { animation-delay: 10s; }
.animate-fade {
  animation: fade 15s infinite;
  transition: opacity 1s ease-in-out;
}
</style>


<!-- Sección módulos -->
<section id="modulos" class="py-20 bg-black/40 backdrop-blur-md fade-up">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold text-green-400 mb-12">Módulos Principales</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="p-8 bg-slate-900/70 rounded-2xl shadow-lg hover:scale-105 transition">
        <img src="{{ asset('images/imagen5.jpg') }}" class="rounded-lg h-40 w-full object-cover mb-4">
        <h3 class="text-xl font-semibold mb-2">Gestión Eficiente</h3>
        <p class="text-slate-300 text-sm">Controla la reproducción, alimentación y salud del ganado.</p>
      </div>
      <div class="p-8 bg-slate-900/70 rounded-2xl shadow-lg hover:scale-105 transition">
        <img src="{{ asset('images/imagen6.webp') }}" class="rounded-lg h-40 w-full object-cover mb-4">
        <h3 class="text-xl font-semibold mb-2">Estadísticas Inteligentes</h3>
        <p class="text-slate-300 text-sm">Analiza indicadores clave y toma decisiones precisas.</p>
      </div>
      <div class="p-8 bg-slate-900/70 rounded-2xl shadow-lg hover:scale-105 transition">
        <img src="{{ asset('images/imagen7.jpg') }}" class="rounded-lg h-40 w-full object-cover mb-4">
        <h3 class="text-xl font-semibold mb-2">Control de Actividades</h3>
        <p class="text-slate-300 text-sm">Registra tareas diarias y optimiza tu productividad.</p>
      </div>
    </div>
  </div>
</section>

<!-- Estadísticas -->
<section id="estadisticas" class="py-20 fade-up bg-black/60 backdrop-blur-md">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold text-green-400 mb-12">Monitoreo en Tiempo Real</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
      <div class="bg-slate-900/70 p-6 rounded-xl shadow text-center">
        <p class="text-3xl font-bold text-green-400">95%</p>
        <p class="text-slate-400 text-sm">Salud Animal</p>
      </div>
      <div class="bg-slate-900/70 p-6 rounded-xl shadow text-center">
        <p class="text-3xl font-bold text-green-400">+320</p>
        <p class="text-slate-400 text-sm">Cabezas Registradas</p>
      </div>
      <div class="bg-slate-900/70 p-6 rounded-xl shadow text-center">
        <p class="text-3xl font-bold text-green-400">4.2kg</p>
        <p class="text-slate-400 text-sm">Ganancia Diaria Promedio</p>
      </div>
      <div class="bg-slate-900/70 p-6 rounded-xl shadow text-center">
        <p class="text-3xl font-bold text-green-400">12</p>
        <p class="text-slate-400 text-sm">Alertas Activas</p>
      </div>
    </div>
  </div>
</section>

<!-- Contacto / Footer -->
<footer class="bg-green-900 text-green-100">
    <!-- Mapa -->
    <div class="w-full h-96">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3977.2237987706496!2d-75.3637138!3d2.6132906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3b3f4b1c54ddc5%3A0x6a0d5a458d5d190d!2sCentro%20de%20Formaci%C3%B3n%20Agroindustrial%20La%20Angostura!5e0!3m2!1ses!2sco!4v1715222177168!5m2!1ses!2sco"
        width="100%"
        height="100%"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        class="w-full h-full">
      </iframe>
    </div>

    <!-- Info -->
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8 border-t border-gray-700">
      <!-- Sobre -->
      <div>
        <h3 class="text-xl font-semibold mb-4">Sobre Nosotros</h3>
        <p class="text-gray-400 text-sm">
          Centro de Formación Agroindustrial La Angostura – SENA. Comprometidos con la formación integral para el desarrollo agroindustrial del país.
        </p>
      </div>

      {{-- <!-- Enlaces -->
      <div>
        <h3 class="text-xl font-semibold mb-4">Enlaces Rápidos</h3>
        <ul class="text-gray-400 text-sm space-y-2">
          <li><a href="#" class="hover:text-white transition">Inicio</a></li>
          <li><a href="#" class="hover:text-white transition">Programas</a></li>
          <li><a href="#" class="hover:text-white transition">Contacto</a></li>
          <li><a href="#" class="hover:text-white transition">Términos y Condiciones</a></li>
        </ul>
      </div> --}}


    <!-- Redes -->
    <div>
        <h3 class="text-xl font-semibold mb-4">Síguenos</h3>
        <div class="flex space-x-4">
          <!-- Facebook -->
          <a href="https://www.facebook.com/share/1Dt2viGR4v/" class="text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M22.675 0H1.325C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24 1.326 24h11.495V14.706h-3.13v-3.622h3.13V8.413c0-3.1 1.894-4.788 4.66-4.788 1.325 0 2.463.098 2.794.142v3.24l-1.917.001c-1.504 0-1.794.715-1.794 1.763v2.312h3.587l-.467 3.622h-3.12V24h6.116C23.4 24 24 23.4 24 22.674V1.326C24 .6 23.4 0 22.675 0z"/>
            </svg>
          </a>

          <!-- Instagram -->
          <a href="https://www.instagram.com/cefa_angostura?igsh=Y2gwbng3MGYwb25l" class="text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.33 3.608 1.304.975.974 1.242 2.242 1.305 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.33 2.633-1.305 3.608-.974.975-2.242 1.242-3.608 1.305-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.33-3.608-1.305-.975-.974-1.242-2.242-1.305-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.33-2.633 1.305-3.608C4.517 2.493 5.784 2.226 7.15 2.163c1.266-.058 1.646-.07 4.85-.07zm0-2.163C8.741 0 8.332.012 7.052.07 5.697.129 4.417.391 3.293 1.515 2.169 2.639 1.907 3.919 1.848 5.274.79 6.552.778 6.962.778 12c0 5.038.012 5.448.07 6.726.059 1.355.321 2.635 1.445 3.759 1.124 1.124 2.404 1.386 3.759 1.445 1.278.058 1.687.07 6.726.07s5.448-.012 6.726-.07c1.355-.059 2.635-.321 3.759-1.445 1.124-1.124 1.386-2.404 1.445-3.759.058-1.278.07-1.687.07-6.726s-.012-5.448-.07-6.726c-.059-1.355-.321-2.635-1.445-3.759C20.635.391 19.355.129 18 .07 16.722.012 16.313 0 12 0z"/>
              <path d="M12 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a3.999 3.999 0 1 1 0-7.998 3.999 3.999 0 0 1 0 7.998zM18.406 4.594a1.44 1.44 0 1 0 0 2.879 1.44 1.44 0 0 0 0-2.879z"/>
            </svg>
          </a>

          {{-- <!-- TikTok -->
          <a href="#" class="text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M16.5 1.5H13.5V14.25C13.5 16.3211 11.8211 18 9.75 18C7.67893 18 6 16.3211 6 14.25C6 12.1789 7.67893 10.5 9.75 10.5C10.2361 10.5 10.6939 10.6053 11.1015 10.7978V7.65318C10.7235 7.58249 10.337 7.54688 9.94531 7.54688C6.85362 7.54688 4.3125 10.088 4.3125 13.1797C4.3125 16.2714 6.85362 18.8125 9.94531 18.8125C13.037 18.8125 15.5781 16.2714 15.5781 13.1797V6.8025C16.0733 7.0986 16.6194 7.30728 17.1995 7.41562C17.7776 7.52408 18.3719 7.53089 18.9492 7.43594V4.48125C18.2635 4.52988 17.5793 4.42789 16.9375 4.18125C16.2961 3.93483 15.7111 3.54774 15.2188 3.04688C14.7263 2.54584 14.3361 1.94777 14.0709 1.29375H16.5V1.5Z"/>
            </svg>
          </a> --}}

          <!-- X (Twitter) -->
          <a href="https://x.com/SENAComunica?t=hrAJagK-mGfI1n321dVquA&s=09" class="text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M22.254 0L13.768 9.073l10.646 14.927h-5.052L12.106 14.51 4.735 24H0l9.094-10.067L-.03 0h5.128l7.203 9.819L19.247 0z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>

    <!-- Créditos -->
    <div class="bg-gray-800 text-center py-4 text-sm text-gray-400">
      © 2025 Centro de Formación Agroindustrial La Angostura – SENA. Todos los derechos reservados. version:3.2.0
    </div>
  </footer>

</body>
</html>

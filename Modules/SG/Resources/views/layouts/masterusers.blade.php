<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GANASOFT</title>
    <link rel="icon" href="{{ asset('images/icono2.jpg') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; }
        html { scroll-behavior: smooth; }
        .fade-up { animation: fadeUp 0.8s ease-out; }
        .fade-in { animation: fadeIn 0.8s ease-out; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px);} to {opacity:1; transform:translateY(0);} }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideInLeft { from { opacity: 0; transform: translateX(-50px);} to {opacity:1; transform:translateX(0);} }
        @keyframes slideInRight { from { opacity: 0; transform: translateX(50px);} to {opacity:1; transform:translateX(0);} }
        @keyframes pulse-scale { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        .slide-left { animation: slideInLeft 0.8s ease-out; }
        .slide-right { animation: slideInRight 0.8s ease-out; }
        .pulse-animation { animation: pulse-scale 2s ease-in-out infinite; }
        .float-animation { animation: float 3s ease-in-out infinite; }
        #bg-video { position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1; opacity: 0.35; }
        .carousel-dots { display: flex; justify-content: center; gap: 8px; margin-top: 16px; }
        .dot { width: 12px; height: 12px; border-radius: 50%; background-color: rgba(255,255,255,0.4); cursor: pointer; transition: all 0.3s ease; }
        .dot.active { background-color: #22c55e; width: 30px; border-radius: 6px; }
        .carousel-nav-btn { position: absolute; top: 50%; transform: translateY(-50%); z-index: 20; background-color: rgba(0,0,0,0.5); color: white; border: none; padding: 12px 16px; cursor: pointer; font-size: 20px; border-radius: 4px; transition: all 0.3s ease; }
        .carousel-nav-btn:hover { background-color: rgba(0,0,0,0.8); }
        .stat-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .stat-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(34, 197, 94, 0.2); }
    </link>
</head>
<body class="text-slate-100">

<!-- Fondo con video -->
<video autoplay muted loop id="bg-video" playsinline>
    <source src="{{ asset('images/ganaderia.mp4') }}" type="video/mp4">
</video>

<!-- Navbar -->
<nav class="fixed top-0 w-full z-50 bg-gradient-to-b from-black/40 to-black/20 backdrop-blur-lg border-b border-green-500/10">
  <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
    <!-- Logo Section -->
    <div class="flex items-center gap-6">
      <button id="logo-link" class="group flex items-center hover:opacity-80 transition duration-300">
        <img src="{{ asset('images/logo.jpg') }}" alt="GANASOFT" class="w-14 h-14 rounded-full object-cover border-2 border-green-500/50 group-hover:border-green-400 shadow-lg transition duration-300">
        <span class="ml-3 text-white font-bold text-lg hidden sm:inline">GANASOFT</span>
      </button>

      <!-- Modal Logo Expandido -->
      <div id="logo-modal" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div class="relative">
          <button id="close-logo-modal" class="absolute -top-10 right-0 text-slate-300 hover:text-red-400 text-3xl font-bold transition">×</button>
          <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-80 h-80 rounded-full object-cover border-4 border-green-500 shadow-2xl">
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

          logoModal.addEventListener('click', function(e) {
            if (e.target === logoModal) {
              logoModal.classList.add('hidden');
            }
          });
        });
      </script>

      <!-- Dropdown Menu -->
      <div class="relative group">
        <button class="flex items-center gap-2 text-slate-300 hover:text-green-400 transition duration-300 text-sm font-medium px-3 py-2 rounded-lg hover:bg-green-500/10">
          <i class="fas fa-ellipsis-v mr-1"></i>
          <span>Recursos</span>
        </button>
        
        <!-- Dropdown Items -->
        <div class="absolute left-0 mt-0 w-48 bg-slate-900/95 backdrop-blur-lg border border-green-500/30 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-300 z-40">
          <a href="{{ route('sg.desarrolladores') }}" class="flex items-center gap-2 text-slate-300 hover:text-green-400 hover:bg-green-500/10 transition duration-300 text-sm font-medium px-4 py-3 first:rounded-t-lg">
            <i class="fas fa-code"></i>
            <span>Desarrolladores</span>
          </a>
          <a href="{{ route('sg.manual') }}" class="flex items-center gap-2 text-slate-300 hover:text-green-400 hover:bg-green-500/10 transition duration-300 text-sm font-medium px-4 py-3 last:rounded-b-lg">
            <i class="fas fa-book"></i>
            <span>Manual de Usuario</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Navigation Links -->
    <div class="hidden md:flex items-center gap-2">
      @auth
        @if(checkRol('sg.admin'))
          <a href="{{ route('sg.admin.welcome') }}" class="text-slate-300 hover:text-green-400 transition duration-300 text-sm font-medium px-4 py-2 rounded-lg hover:bg-green-500/10">
            <i class="fas fa-shield-alt mr-1.5"></i>Admin
          </a>
        @endif
        @if(checkRol('sg.liderDeUnidad'))
          <a href="{{ route('sg.liderDeUnidad.panelLider') }}" class="text-slate-300 hover:text-green-400 transition duration-300 text-sm font-medium px-4 py-2 rounded-lg hover:bg-green-500/10">
            <i class="fas fa-users mr-1.5"></i>Líder
          </a>
        @endif
        @if(checkRol('sg.aprendiz'))
          <a href="{{ route('sg.aprendiz.panelAprendiz') }}" class="text-slate-300 hover:text-green-400 transition duration-300 text-sm font-medium px-4 py-2 rounded-lg hover:bg-green-500/10">
            <i class="fas fa-graduation-cap mr-1.5"></i>Aprendiz
          </a>
        @endif
      @endauth
    </div>
  </div>
</nav>

<!-- Hero con carrusel mejorado -->
<section id="inicio" class="relative flex items-center justify-center min-h-screen text-center px-6 pt-24 overflow-hidden">

    <!-- Carrusel de fondo con indicadores -->
    <div id="hero-carousel" class="absolute inset-0 z-0">
      <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000" data-slide="0">
        <img src="{{ asset('images/imagen1.jpg') }}" alt="Ganadería" class="w-full h-full object-cover">
      </div>
      <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000" data-slide="1">
        <img src="{{ asset('images/imagen2.jpg') }}" alt="Ganado" class="w-full h-full object-cover">
      </div>
      <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000" data-slide="2">
        <img src="{{ asset('images/imagen3.jpg') }}" alt="Producción" class="w-full h-full object-cover">
      </div>
      <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000" data-slide="3">
        <img src="{{ asset('images/imagen4.jpg') }}" alt="Gestión" class="w-full h-full object-cover">
      </div>
      <div class="absolute inset-0 bg-black/40"></div>

      <!-- Controles del carrusel -->
      <button id="prev-carousel" class="carousel-nav-btn left-4"><i class="fas fa-chevron-left"></i></button>
      <button id="next-carousel" class="carousel-nav-btn right-4"><i class="fas fa-chevron-right"></i></button>

      <!-- Indicadores -->
      <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 carousel-dots" id="carousel-dots"></div>
    </div>

    <!-- Contenido principal -->
    <div class="relative z-10 max-w-3xl space-y-6 fade-up">
        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">
            Gestión Integral de tu <span class="text-green-400">Unidad Ganadera</span>
        </h1>
        <p class="text-lg text-slate-200/90 leading-relaxed">
            Monitorea, organiza y mejora tus procesos productivos con la plataforma GANASOFT.
            Datos reales, decisiones inteligentes. Resultados extraordinarios.
        </p>

        @guest
            <a href="{{ route('login') }}"
               class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 shadow-lg text-lg transform hover:scale-105">
                <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
            </a>
        @else
            <a href="{{ url('/') }}"
               class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 shadow-lg text-lg transform hover:scale-105">
                <i class="fas fa-dashboard mr-2"></i>Ir al Panel
            </a>
        @endguest
    </div>
</section>

<!-- Script del carrusel mejorado -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.carousel-slide');
    const dotsContainer = document.getElementById('carousel-dots');
    const prevBtn = document.getElementById('prev-carousel');
    const nextBtn = document.getElementById('next-carousel');
    let currentSlide = 0;
    let autoplayInterval;

    // Crear indicadores
    slides.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.className = 'dot' + (index === 0 ? ' active' : '');
        dot.onclick = () => goToSlide(index);
        dotsContainer.appendChild(dot);
    });

    function showSlide(n) {
        slides.forEach((slide, index) => {
            slide.style.opacity = index === n ? '1' : '0';
        });
        
        const dots = document.querySelectorAll('.dot');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === n);
        });
    }

    function goToSlide(n) {
        currentSlide = n % slides.length;
        showSlide(currentSlide);
        resetAutoplay();
    }

    function nextSlide() {
        goToSlide(currentSlide + 1);
    }

    function prevSlide() {
        goToSlide(currentSlide - 1 + slides.length);
    }

    function resetAutoplay() {
        clearInterval(autoplayInterval);
        autoplayInterval = setInterval(nextSlide, 6000);
    }

    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);

    showSlide(0);
    resetAutoplay();

    // Pausar autoplay al pasar mouse
    document.getElementById('hero-carousel').addEventListener('mouseenter', () => clearInterval(autoplayInterval));
    document.getElementById('hero-carousel').addEventListener('mouseleave', resetAutoplay);
});
</script>


<!-- Sección módulos mejorada -->
<section id="modulos" class="py-20 bg-black/40 backdrop-blur-md fade-up">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold text-green-400 mb-4">Módulos Principales</h2>
    <p class="text-slate-300 mb-12 text-lg">Herramientas especializadas para maximizar tu productividad ganadera</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="p-8 bg-gradient-to-br from-slate-900/80 to-slate-900/40 rounded-2xl shadow-lg hover:shadow-2xl hover:shadow-green-500/20 transition-all duration-300 border border-green-500/10 hover:border-green-500/40">
        <div class="relative mb-4 h-40 rounded-lg overflow-hidden">
          <img src="{{ asset('images/imagen5.jpg') }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
          <div class="absolute inset-0 bg-black/40"></div>
          <i class="fas fa-cow absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl text-green-400"></i>
        </div>
        <h3 class="text-xl font-semibold mb-2 text-green-400">Gestión de Ganado</h3>
        <p class="text-slate-300 text-sm leading-relaxed">Controla la reproducción, alimentación, salud y bienestar de tu rebaño con fichas individuales detalladas.</p>
      </div>
      <div class="p-8 bg-gradient-to-br from-slate-900/80 to-slate-900/40 rounded-2xl shadow-lg hover:shadow-2xl hover:shadow-green-500/20 transition-all duration-300 border border-green-500/10 hover:border-green-500/40">
        <div class="relative mb-4 h-40 rounded-lg overflow-hidden">
          <img src="{{ asset('images/imagen6.webp') }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
          <div class="absolute inset-0 bg-black/40"></div>
          <i class="fas fa-chart-line absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl text-green-400"></i>
        </div>
        <h3 class="text-xl font-semibold mb-2 text-green-400">Análisis de Datos</h3>
        <p class="text-slate-300 text-sm leading-relaxed">Analiza indicadores clave, tendencias y toma decisiones precisas basadas en datos reales de tu operación.</p>
      </div>
      <div class="p-8 bg-gradient-to-br from-slate-900/80 to-slate-900/40 rounded-2xl shadow-lg hover:shadow-2xl hover:shadow-green-500/20 transition-all duration-300 border border-green-500/10 hover:border-green-500/40">
        <div class="relative mb-4 h-40 rounded-lg overflow-hidden">
          <img src="{{ asset('images/imagen7.jpg') }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
          <div class="absolute inset-0 bg-black/40"></div>
          <i class="fas fa-tasks absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl text-green-400"></i>
        </div>
        <h3 class="text-xl font-semibold mb-2 text-green-400">Gestión de Actividades</h3>
        <p class="text-slate-300 text-sm leading-relaxed">Registra tareas diarias, establece recordatorios y optimiza la productividad de tu equipo de trabajo.</p>
      </div>
    </div>
  </div>
</section>

<!-- Sección de Beneficios -->
<section id="beneficios" class="py-20 bg-gradient-to-b from-black/60 to-black/40 backdrop-blur-md">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-green-400 mb-4 text-center">¿Por qué elegir GANASOFT?</h2>
    <p class="text-slate-300 text-center mb-12 text-lg">Potencia tu unidad ganadera con tecnología pensada para ti</p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="p-6 bg-slate-900/70 rounded-xl border border-green-500/20 hover:border-green-500/50 transition-all duration-300">
        <div class="text-4xl text-green-400 mb-3"><i class="fas fa-tachometer-alt"></i></div>
        <h3 class="text-lg font-semibold mb-2">Control en Tiempo Real</h3>
        <p class="text-slate-400 text-sm">Monitorea cada aspecto de tu unidad en vivo desde cualquier dispositivo.</p>
      </div>
      <div class="p-6 bg-slate-900/70 rounded-xl border border-green-500/20 hover:border-green-500/50 transition-all duration-300">
        <div class="text-4xl text-green-400 mb-3"><i class="fas fa-shield-alt"></i></div>
        <h3 class="text-lg font-semibold mb-2">Seguridad de Datos</h3>
        <p class="text-slate-400 text-sm">Tus datos están protegidos con encriptación de nivel empresarial.</p>
      </div>
      <div class="p-6 bg-slate-900/70 rounded-xl border border-green-500/20 hover:border-green-500/50 transition-all duration-300">
        <div class="text-4xl text-green-400 mb-3"><i class="fas fa-mobile-alt"></i></div>
        <h3 class="text-lg font-semibold mb-2">Acceso Móvil</h3>
        <p class="text-slate-400 text-sm">Gestiona tu operación desde el campo con nuestra app responsive.</p>
      </div>
      <div class="p-6 bg-slate-900/70 rounded-xl border border-green-500/20 hover:border-green-500/50 transition-all duration-300">
        <div class="text-4xl text-green-400 mb-3"><i class="fas fa-headset"></i></div>
        <h3 class="text-lg font-semibold mb-2">Soporte 24/7</h3>
        <p class="text-slate-400 text-sm">Equipo técnico disponible siempre que lo necesites para ayudarte.</p>
      </div>
    </div>
  </div>
</section>

<!-- Sección de Procesos Ganaderos -->
<section id="procesos" class="py-20 bg-black/60 backdrop-blur-md fade-up">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-green-400 mb-4 text-center">Procesos Ganaderos Integrados</h2>
    <p class="text-slate-300 text-center mb-12 text-lg">Gestiona todos los aspectos de tu operación desde una plataforma unificada</p>
    
    <div class="space-y-8">
      <!-- Proceso 1 -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="slide-left">
          <h3 class="text-2xl font-bold text-green-400 mb-4"><i class="fas fa-heart mr-3"></i>Salud Animal</h3>
          <p class="text-slate-300 mb-4">Mantén registros completos de vacunaciones, tratamientos veterinarios, revisiones clínicas y estado sanitario de cada animal. Recibe alertas automáticas para intervenciones preventivas.</p>
          <ul class="space-y-2 text-slate-300">
            <li><i class="fas fa-check text-green-400 mr-2"></i>Historial médico individual</li>
            <li><i class="fas fa-check text-green-400 mr-2"></i>Alertas de vacunación</li>
            <li><i class="fas fa-check text-green-400 mr-2"></i>Control de medicamentos</li>
          </ul>
        </div>
        <div class="rounded-lg overflow-hidden shadow-lg">
          <img src="{{ asset('images/imagen1.jpg') }}" alt="Salud Animal" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-300">
        </div>
      </div>

      <!-- Proceso 2 -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="rounded-lg overflow-hidden shadow-lg order-2 md:order-1">
          <img src="{{ asset('images/imagen2.jpg') }}" alt="Reproducción" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-300">
        </div>
        <div class="slide-right order-1 md:order-2">
          <h3 class="text-2xl font-bold text-green-400 mb-4"><i class="fas fa-dna mr-3"></i>Reproducción</h3>
          <p class="text-slate-300 mb-4">Planifica estratégicamente tu programa reproductivo con herramientas para identificar hembras en celo, registrar servicios, y monitorear embarazos.</p>
          <ul class="space-y-2 text-slate-300">
            <li><i class="fas fa-check text-green-400 mr-2"></i>Calendario reproductivo</li>
            <li><i class="fas fa-check text-green-400 mr-2"></i>Seguimiento de preñez</li>
            <li><i class="fas fa-check text-green-400 mr-2"></i>Genealogía familiar</li>
          </ul>
        </div>
      </div>

      <!-- Proceso 3 -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="slide-left">
          <h3 class="text-2xl font-bold text-green-400 mb-4"><i class="fas fa-leaf mr-3"></i>Nutrición y Alimentación</h3>
          <p class="text-slate-300 mb-4">Diseña planes nutricionales equilibrados, registra consumos, y optimiza costos de alimentación con recomendaciones basadas en datos de tu rebaño.</p>
          <ul class="space-y-2 text-slate-300">
            <li><i class="fas fa-check text-green-400 mr-2"></i>Planes de alimentación</li>
            <li><i class="fas fa-check text-green-400 mr-2"></i>Control de pastos</li>
            <li><i class="fas fa-check text-green-400 mr-2"></i>Análisis de costos</li>
          </ul>
        </div>
        <div class="rounded-lg overflow-hidden shadow-lg">
          <img src="{{ asset('images/imagen3.jpg') }}" alt="Nutrición" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-300">
        </div>
      </div>

      <!-- Proceso 4 -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="rounded-lg overflow-hidden shadow-lg order-2 md:order-1">
          <img src="{{ asset('images/imagen4.jpg') }}" alt="Producción" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-300">
        </div>
        <div class="slide-right order-1 md:order-2">
          <h3 class="text-2xl font-bold text-green-400 mb-4"><i class="fas fa-industry mr-3"></i>Producción</h3>
          <p class="text-slate-300 mb-4">Registra volúmenes de producción de leche o carne, analiza tendencias de productividad y calidad, e identifica oportunidades de mejora.</p>
          <ul class="space-y-2 text-slate-300">
            <li><i class="fas fa-check text-green-400 mr-2"></i>Registro de producción</li>
            <li><i class="fas fa-check text-green-400 mr-2"></i>Control de calidad</li>
            <li><i class="fas fa-check text-green-400 mr-2"></i>Análisis de rendimiento</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Estadísticas mejoradas -->
<section id="estadisticas" class="py-20 fade-up bg-black/60 backdrop-blur-md">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold text-green-400 mb-4">Monitoreo en Tiempo Real</h2>
    <p class="text-slate-300 mb-12 text-lg">Métricas clave de tu unidad ganadera</p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="stat-card bg-gradient-to-br from-green-500/10 to-green-900/20 p-8 rounded-xl shadow-lg border border-green-500/30">
        <div class="text-5xl font-bold text-green-400 mb-2 pulse-animation">95%</div>
        <p class="text-slate-400 text-sm font-semibold">Salud Animal</p>
        <p class="text-xs text-slate-500 mt-2">Rebaño en óptimas condiciones</p>
      </div>
      <div class="stat-card bg-gradient-to-br from-blue-500/10 to-blue-900/20 p-8 rounded-xl shadow-lg border border-blue-500/30">
        <div class="text-5xl font-bold text-blue-400 mb-2 pulse-animation">+320</div>
        <p class="text-slate-400 text-sm font-semibold">Cabezas Registradas</p>
        <p class="text-xs text-slate-500 mt-2">Ganado en la operación</p>
      </div>
      <div class="stat-card bg-gradient-to-br from-yellow-500/10 to-yellow-900/20 p-8 rounded-xl shadow-lg border border-yellow-500/30">
        <div class="text-5xl font-bold text-yellow-400 mb-2 pulse-animation">4.2kg</div>
        <p class="text-slate-400 text-sm font-semibold">Ganancia Diaria Promedio</p>
        <p class="text-xs text-slate-500 mt-2">Por animal en crecimiento</p>
      </div>
      <div class="stat-card bg-gradient-to-br from-red-500/10 to-red-900/20 p-8 rounded-xl shadow-lg border border-red-500/30">
        <div class="text-5xl font-bold text-red-400 mb-2">12</div>
        <p class="text-slate-400 text-sm font-semibold">Alertas Activas</p>
        <p class="text-xs text-slate-500 mt-2">Requieren atención inmediata</p>
      </div>
    </div>
  </div>
</section>

<!-- Sección de Testimonios -->
<section id="testimonios" class="py-20 bg-gradient-to-b from-black/40 to-black/60 backdrop-blur-md">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-green-400 mb-4 text-center">Lo que dicen nuestros Usuarios</h2>
    <p class="text-slate-300 text-center mb-12 text-lg">Transformando operaciones ganaderas en toda la región</p>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="p-6 bg-slate-900/70 rounded-lg border border-green-500/20 hover:border-green-500/50 transition-all duration-300">
        <div class="flex items-center mb-4">
          <div class="flex text-yellow-400">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
        </div>
        <p class="text-slate-300 mb-4 italic">"GANASOFT cambió completamente la forma en que gestiono mi unidad. Los datos en tiempo real me permiten tomar decisiones mucho más inteligentes."</p>
        <div class="font-semibold text-green-400">Juan Pérez</div>
        <div class="text-xs text-slate-500">Ganadero, Ganadería Versalles</div>
      </div>
      
      <div class="p-6 bg-slate-900/70 rounded-lg border border-green-500/20 hover:border-green-500/50 transition-all duration-300">
        <div class="flex items-center mb-4">
          <div class="flex text-yellow-400">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
        </div>
        <p class="text-slate-300 mb-4 italic">"Hemos reducido costos significativamente. El control de alimentación es mucho más preciso y los registros de salud nos ahorran problemas."</p>
        <div class="font-semibold text-green-400">María González</div>
        <div class="text-xs text-slate-500">Administradora, Finca Santa Cruz</div>
      </div>
      
      <div class="p-6 bg-slate-900/70 rounded-lg border border-green-500/20 hover:border-green-500/50 transition-all duration-300">
        <div class="flex items-center mb-4">
          <div class="flex text-yellow-400">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
        </div>
        <p class="text-slate-300 mb-4 italic">"La interfaz es muy intuitiva. Mis trabajadores aprendieron a usarla sin dificultad. Excelente inversión para el futuro."</p>
        <div class="font-semibold text-green-400">Carlos López</div>
        <div class="text-xs text-slate-500">Gerente General, Hacienda el Roble</div>
      </div>
    </div>
  </div>
</section>

<!-- Sección CTA (Call to Action) -->
<section id="cta" class="py-24 bg-gradient-to-r from-green-600/20 to-green-900/20 backdrop-blur-md border-t border-b border-green-500/30">
  <div class="max-w-4xl mx-auto px-6 text-center">
    <h2 class="text-4xl md:text-5xl font-bold mb-6">
      ¿Listo para transformar tu Unidad Ganadera?
    </h2>
    <p class="text-lg text-slate-300 mb-8">
      Únete a cientos de ganaderos que ya confían en GANASOFT para gestionar sus operaciones de forma profesional y eficiente.
    </p>
    <div class="flex flex-col md:flex-row gap-4 justify-center">
      @guest
        <a href="{{ route('login') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-12 rounded-full transition-all duration-300 shadow-lg text-lg transform hover:scale-105">
          <i class="fas fa-rocket mr-2"></i>Comenzar Ahora
        </a>
        <a href="#modulos" class="inline-block bg-slate-700 hover:bg-slate-600 text-white font-bold py-4 px-12 rounded-full transition-all duration-300">
          <i class="fas fa-info-circle mr-2"></i>Conocer Más
        </a>
      @else
        <a href="{{ url('/') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-12 rounded-full transition-all duration-300 shadow-lg text-lg transform hover:scale-105">
          <i class="fas fa-dashboard mr-2"></i>Ir a mi Panel
        </a>
      @endguest
    </div>
  </div>
</section>

<!-- Contacto / Footer Mejorado -->
<footer class="bg-gradient-to-b from-slate-900 to-black text-slate-100">
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

    <!-- Info mejorada -->
    <div class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-4 gap-8 border-t border-slate-700">
      <!-- Sobre -->
      <div>
        <h3 class="text-xl font-semibold mb-4 text-green-400">Sobre GANASOFT</h3>
        <p class="text-slate-400 text-sm leading-relaxed">
          Plataforma integral de gestión ganadera creada en alianza con el Centro de Formación Agroindustrial La Angostura – SENA. Comprometidos con la innovación agropecuaria.
        </p>
      </div>

      <!-- Enlaces Rápidos -->
      <div>
        <h3 class="text-xl font-semibold mb-4 text-green-400">Enlaces Rápidos</h3>
        <ul class="text-slate-400 text-sm space-y-2">
          <li><a href="#inicio" class="hover:text-green-400 transition"><i class="fas fa-arrow-right mr-2"></i>Inicio</a></li>
          <li><a href="#modulos" class="hover:text-green-400 transition"><i class="fas fa-arrow-right mr-2"></i>Módulos</a></li>
          <li><a href="#procesos" class="hover:text-green-400 transition"><i class="fas fa-arrow-right mr-2"></i>Procesos</a></li>
          <li><a href="#testimonios" class="hover:text-green-400 transition"><i class="fas fa-arrow-right mr-2"></i>Testimonios</a></li>
        </ul>
      </div>

      <!-- Características -->
      <div>
        <h3 class="text-xl font-semibold mb-4 text-green-400">Características</h3>
        <ul class="text-slate-400 text-sm space-y-2">
          <li><i class="fas fa-check text-green-400 mr-2"></i>Gestión de ganado</li>
          <li><i class="fas fa-check text-green-400 mr-2"></i>Análisis de datos</li>
          <li><i class="fas fa-check text-green-400 mr-2"></i>Reportes en tiempo real</li>
          <li><i class="fas fa-check text-green-400 mr-2"></i>Soporte técnico</li>
        </ul>
      </div>

      <!-- Redes -->
      <div>
        <h3 class="text-xl font-semibold mb-4 text-green-400">Síguenos</h3>
        <div class="flex flex-col space-y-3">
          <!-- Facebook -->
          <a href="https://www.facebook.com/share/1Dt2viGR4v/" class="text-slate-400 hover:text-green-400 transition flex items-center">
            <i class="fab fa-facebook mr-3"></i>Facebook
          </a>

          <!-- Instagram -->
          <a href="https://www.instagram.com/cefa_angostura?igsh=Y2gwbng3MGYwb25l" class="text-slate-400 hover:text-green-400 transition flex items-center">
            <i class="fab fa-instagram mr-3"></i>Instagram
          </a>

          <!-- X (Twitter) -->
          <a href="https://x.com/SENAComunica?t=hrAJagK-mGfI1n321dVquA&s=09" class="text-slate-400 hover:text-green-400 transition flex items-center">
            <i class="fab fa-x-twitter mr-3"></i>X (Twitter)
          </a>
        </div>
      </div>
    </div>

    <!-- Créditos mejorados -->
    <div class="bg-black/80 backdrop-blur-md text-center py-6 text-sm text-slate-500 border-t border-slate-700">
      <p>© 2025 Centro de Formación Agroindustrial La Angostura – SENA. Todos los derechos reservados.</p>
      <p class="mt-2">Versión 3.2.0 | GANASOFT - Sistema de Gestión Ganadera</p>
    </div>
</footer>

<!-- Script adicional para scroll suave y animaciones -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animaciones al scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observar secciones
    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });

    // Smooth scroll para enlaces
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                document.querySelector(href).scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>

</body>
</html>

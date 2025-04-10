<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Avicontrol2025 - Gestión Avícola') }}</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <!-- AOS (Animate on Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Estilos Personalizados -->
    <style>
        :root {
            --primary: #6c757d; /* Gris suave */
            --secondary: #f8f9fa; /* Blanco suave */
            --light-bg: #e9ecef; /* Gris claro */
            --text-dark: #343a40; /* Gris oscuro */
            --hover: #5a6268; /* Gris más oscuro */
            --accent: #ffc107; /* Amarillo suave */
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            line-height: 1.6;
        }
        .navbar {
            background-color: var(--primary) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .navbar-brand, .nav-link {
            color: white !important;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: var(--accent) !important;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c');
            background-size: cover;
            background-position: center;
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .hero-content {
            z-index: 2;
            text-align: center;
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
        }
        .feature-box {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid var(--primary);
        }
        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .feature-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .btn-custom {
            background-color: var(--primary);
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: var(--hover);
            transform: scale(1.1);
            color: var(--accent);
        }
        .info-section {
            background-color: var(--primary);
            color: white;
            padding: 60px 0;
        }
        footer {
            background-color: var(--secondary);
            color: var(--text-dark);
            padding: 30px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand animate__animated animate__bounceInLeft" href="#">Avicontrol2025</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto animate__animated animate__bounceInRight">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Características</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Sobre Nosotros</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Iniciar Sesión</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">Registrarse</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content animate__animated animate__fadeInDown">
            <h1 class="display-3 fw-bold">Avicontrol2025</h1>
            <p class="lead mb-4">Controla, optimiza y crece con el mejor sistema de gestión avícola</p>
            <div class="d-flex justify-content-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-custom">Ir al Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-custom">Comenzar Ahora</a>
                        <a href="#features" class="btn btn-outline-light">Explorar</a>
                    @endauth
                @endif
            </div>
        </div>
    </section>

    <!-- Carrusel de Imágenes -->
    <section class="py-5">
        <div class="container">
            <div id="carouselAvicola" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" class="d-block w-100" alt="Gallinas" style="height: 400px; object-fit: cover;">
                        <div class="carousel-caption">
                            <h5>Producción de Calidad</h5>
                            <p>Gestión eficiente para resultados superiores.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1591123120675-6f7f1aae2e00" class="d-block w-100" alt="Huevos" style="height: 400px; object-fit: cover;">
                        <div class="carousel-caption">
                            <h5>Control de Huevos</h5>
                            <p>Seguimiento detallado de la postura diaria.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d" class="d-block w-100" alt="Granja" style="height: 400px; object-fit: cover;">
                        <div class="carousel-caption">
                            <h5>Galpones Modernos</h5>
                            <p>Optimiza el espacio y la producción.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselAvicola" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselAvicola" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Características -->
    <section class="py-5" id="features">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="zoom-in">Características Principales</h2>

            <!-- Filtro de Búsqueda -->
            <div class="search-bar" data-aos="fade-up">
                <div class="input-group">
                    <input type="text" id="feature-search" class="form-control" placeholder="Buscar características...">
                    <button class="btn btn-custom" type="button"><i class="fas fa-search"></i> Buscar</button>
                </div>
            </div>

            <div class="row" id="features-container">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-warehouse"></i></div>
                        <h4>Gestión de Galpones</h4>
                        <p>Crea, edita y monitorea tus galpones con información detallada sobre capacidad, dimensiones y estado.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-egg"></i></div>
                        <h4>Producción Diaria</h4>
                        <p>Registra mortalidad, postura, consumo de alimento y agua con análisis en tiempo real.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-balance-scale"></i></div>
                        <h4>Normativas</h4>
                        <p>Establece umbrales de calidad y recibe alertas si se superan los límites.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-users"></i></div>
                        <h4>Gestión de Usuarios</h4>
                        <p>Asigna roles (administrador, operario, pasante) y controla permisos específicos.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-cog"></i></div>
                        <h4>Configuraciones</h4>
                        <p>Personaliza parámetros globales como mortalidad máxima o nombre del sistema.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-bell"></i></div>
                        <h4>Alertas Inteligentes</h4>
                        <p>Notificaciones automáticas para eventos críticos como stock bajo o incumplimiento de normativas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Informativa -->
    <section class="info-section">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">¿Por qué elegir Avicontrol2025?</h2>
            <div class="row">
                <div class="col-md-4" data-aos="fade-right">
                    <div class="stats-box">
                        <h3><i class="fas fa-feather-alt"></i> +10 Años</h3>
                        <p>Experiencia en el sector avícola con el respaldo del SENA.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stats-box">
                        <h3><i class="fas fa-egg"></i> 99% Precisión</h3>
                        <p>Datos confiables para tomar decisiones informadas.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-left" data-aos-delay="400">
                    <div class="stats-box">
                        <h3><i class="fas fa-users-cog"></i> Soporte 24/7</h3>
                        <p>Asistencia técnica para garantizar tu éxito.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Sobre Nosotros -->
    <section class="py-5" id="about">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="zoom-in">Sobre Nosotros</h2>
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d" class="img-fluid rounded shadow" alt="Granja Avícola" style="max-height: 400px; object-fit: cover;">
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <h3>Avicontrol: Innovación en la Avicultura</h3>
                    <p>Desarrollado por el SENA, Avicontrol2025 es el resultado de años de investigación y experiencia en la producción avícola. Nuestro objetivo es empoderar a los productores con herramientas modernas para maximizar la eficiencia, reducir costos y garantizar la calidad.</p>
                    <p>Desde la gestión de galpones hasta el análisis de datos, ofrecemos una solución integral que se adapta a las necesidades de pequeñas, medianas y grandes granjas.</p>
                    <a href="#features" class="btn btn-custom mt-3">Descubre Más</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 text-dark">
        <div class="container text-center">
            <p class="mb-2">Avicontrol2025 © {{ date('Y') }} - Desarrollado por SENA</p>
            <div class="social-icons">
                <a href="#" class="text-dark mx-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-dark mx-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-dark mx-2"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Inicializar AOS
        AOS.init({
            duration: 1200,
            once: true
        });

        // Filtro de características
        $('#feature-search').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('#features-container .feature-box').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(value) > -1);
            });
        });

        // Alerta de bienvenida
        $(document).ready(function() {
            Swal.fire({
                title: '¡Bienvenido a Avicontrol2025!',
                text: 'La herramienta definitiva para tu granja avícola.',
                icon: 'success',
                confirmButtonColor: '#6c757d',
                background: '#e9ecef',
                customClass: {
                    popup: 'animate__animated animate__fadeIn'
                }
            });
        });
    </script>
</body>
</html>     
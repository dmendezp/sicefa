<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sena Apicola - Sistema de Gestión Apícola</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #FFA500; /* Naranja miel */
            --secondary-color: #8B4513; /* Marrón colmena */
            --dark-color: #1A1A1A;
            --light-color: #F8F9FA;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #FFF9E6;
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--secondary-color);
            font-size: 2.5rem;
        }
        
        .navbar-brand span {
            color: var(--primary-color);
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--dark-color);
            margin: 0 10px;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
        }
        
        .nav-link.active {
            color: var(--primary-color);
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 8px 20px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #e69500;
            border-color: #e69500;
        }
        
        .btn-outline-secondary {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
        }
        
        .btn-outline-secondary:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1587049352851-8d4e89133924?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            text-align: center;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 30px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .feature-card {
            padding: 30px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            transition: transform 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .section-title {
            font-weight: 700;
            color: var(--secondary-color);
            position: relative;
            display: inline-block;
            margin-bottom: 40px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50%;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 50px 0 20px;
        }
        
        .footer-logo {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .footer-links h5 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .footer-links ul {
            list-style: none;
            padding-left: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.2rem;
            margin-right: 15px;
            transition: color 0.3s;
        }
        
        .social-icons a:hover {
            color: var(--primary-color);
        }
        
        .copyright {
            border-top: 1px solid #495057;
            padding-top: 20px;
            margin-top: 30px;
        }
        
        .honeycomb-bg {
            position: absolute;
            opacity: 0.05;
            z-index: -1;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0L100 25V75L50 100L0 75V25L50 0Z' fill='%23FFA500'/%3E%3C/svg%3E");
            background-size: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <span>Sena</span>Apicola
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Infórmate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Conócenos</a>
                    </li>
                    @if(Auth::check() && checkRol('senaapicola.admin'))
                    <li class="nav-item">
                        <a href="{{ route('senaapicola.admin.welcome') }}" class="nav-link @if (Route::is('senaapicola.admin.*')) active @endif">Administrador</a>
                    </li>
                @endif
                @if(Auth::check() && checkRol('senaapicola.intern'))
                    <li class="nav-item">
                        <a href="{{ route('senaapicola.intern.panelpas') }}" class="nav-link @if (Route::is('senaapicola.intern.*')) active @endif">Pasante</a>
                    </li>
                @endif
                </ul>
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Gestión Inteligente para tu Producción Apícola</h1>
            <p class="hero-subtitle">Optimiza el manejo de tus colmenas, producción de miel y análisis de datos con nuestra plataforma especializada para apicultores modernos.</p>
            <div class="mt-4">
                <a href="#" class="btn btn-primary btn-lg me-2">Ver Demo</a>
                <a href="#" class="btn btn-outline-light btn-lg">Más Información</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5" style="background-color: #FFF9E6;">
        <div class="honeycomb-bg"></div>
        <div class="container py-5">
            <h2 class="text-center section-title">Características Principales</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bee"></i>
                        </div>
                        <h3>Manejo de Colmenas</h3>
                        <p>Registro detallado de cada colmena, incluyendo ubicación, producción, salud y tratamientos aplicados.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-honey-pot"></i>
                        </div>
                        <h3>Control de Producción</h3>
                        <p>Seguimiento preciso de la producción de miel, polen, propóleos y otros productos de la colmena.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Análisis y Reportes</h3>
                        <p>Generación de reportes personalizados y análisis de tendencias para mejorar tu producción.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title">Sobre Nuestro Sistema</h2>
                    <p>HiveMaster es una solución integral desarrollada por expertos en apicultura y tecnología, diseñada para simplificar y optimizar la gestión de tu unidad apícola.</p>
                    <p>Nuestra plataforma combina años de experiencia en el campo con las últimas tecnologías para ofrecerte herramientas que realmente necesitas.</p>
                    <a href="#" class="btn btn-primary mt-3">Conoce más</a>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1587049352851-8d4e89133924?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Apicultura" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-logo">
                        <span>Hive</span>Master
                    </div>
                    <p>Sistema de Gestión Apícola diseñado para profesionales que buscan eficiencia, control y crecimiento en su producción.</p>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-links">
                        <h5>Enlaces</h5>
                        <ul>
                            <li><a href="#">Inicio</a></li>
                            <li><a href="#">Infórmate</a></li>
                            <li><a href="#">Conócenos</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-links">
                        <h5>Legal</h5>
                        <ul>
                            <li><a href="#">Términos</a></li>
                            <li><a href="#">Privacidad</a></li>
                            <li><a href="#">Cookies</a></li>
                            <li><a href="#">Licencias</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="footer-links">
                        <h5>Contacto</h5>
                        <ul>
                            <li><i class="fas fa-map-marker-alt me-2"></i> Av. Apícola 123, Colmenar</li>
                            <li><i class="fas fa-phone me-2"></i> +1 234 567 890</li>
                            <li><i class="fas fa-envelope me-2"></i> info@hivemaster.com</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright text-center">
                <p class="mb-0">&copy; 2025 Sena Apicola. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
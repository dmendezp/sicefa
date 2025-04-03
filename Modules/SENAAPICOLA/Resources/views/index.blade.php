@extends('senaapicola::layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Apícola | Bienvenido</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #FFA500;
            --secondary-color: #4a7729;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: var(--dark-color);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: white !important;
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1587049352851-8d4e89133924?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            margin-bottom: 50px;
        }
        
        .hero-title {
            font-weight: 700;
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        .hero-subtitle {
            font-weight: 300;
            font-size: 1.5rem;
            margin-bottom: 30px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 25px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #e69500;
            border-color: #e69500;
        }
        
        .btn-outline-light {
            padding: 10px 25px;
            font-weight: 500;
            margin-left: 15px;
        }
        
        .feature-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            height: 100%;
            background-color: white;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .section-title {
            color: var(--secondary-color);
            font-weight: 700;
            margin-bottom: 50px;
            position: relative;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 50px 0 20px;
        }
        
        .footer-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .footer-links a {
            color: #ddd;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: var(--primary-color);
        }
        
        .social-icon {
            color: white;
            font-size: 1.2rem;
            margin-right: 15px;
            transition: color 0.3s;
        }
        
        .social-icon:hover {
            color: var(--primary-color);
        }
        
        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-honeycomb me-2"></i>ApiManager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Características</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
                <div class="ms-lg-3">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="hero-title">Gestión Inteligente para tu Producción Apícola</h1>
            <p class="hero-subtitle">Optimiza y controla todos los aspectos de tu unidad apícola con nuestra solución integral</p>
            <div class="d-flex justify-content-center">
                <a href="#features" class="btn btn-primary btn-lg">Conoce más</a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Demo</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mb-5" id="features">
        <h2 class="text-center section-title">Nuestras Características</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card p-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Seguimiento de Producción</h3>
                    <p>Monitorea en tiempo real la producción de miel, polen y otros productos de tus colmenas con informes detallados.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Calendario de Manejo</h3>
                    <p>Programa y registra todas las actividades de manejo apícola con alertas y recordatorios automáticos.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-vial"></i>
                    </div>
                    <h3>Control Sanitario</h3>
                    <p>Registra tratamientos, enfermedades y realiza seguimiento a la salud de tus colmenas.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3>Geolocalización</h3>
                    <p>Administra la ubicación de tus apiarios con mapas interactivos y registros detallados.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h3>Gestión Comercial</h3>
                    <p>Controla ventas, inventarios y costos de producción con informes financieros automatizados.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Acceso Móvil</h3>
                    <p>Accede a tu información desde cualquier dispositivo con nuestra aplicación responsive.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4">¿Listo para transformar tu gestión apícola?</h2>
            <p class="lead mb-4">Regístrate hoy y comienza a optimizar tu producción con nuestras herramientas especializadas.</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Comenzar ahora</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="footer-title">ApiManager</h4>
                    <p>Solución profesional para la gestión integral de unidades apícolas. Optimiza tus procesos y aumenta tu productividad.</p>
                    <div class="mt-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h4 class="footer-title">Enlaces</h4>
                    <div class="footer-links">
                        <a href="#">Inicio</a>
                        <a href="#">Características</a>
                        <a href="#">Precios</a>
                        <a href="#">FAQ</a>
                        <a href="#">Blog</a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h4 class="footer-title">Legal</h4>
                    <div class="footer-links">
                        <a href="#">Términos</a>
                        <a href="#">Privacidad</a>
                        <a href="#">Cookies</a>
                        <a href="#">Licencias</a>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <h4 class="footer-title">Contacto</h4>
                    <div class="footer-links">
                        <a href="#"><i class="fas fa-map-marker-alt me-2"></i> Av. Apícola 123, Ciudad</a>
                        <a href="#"><i class="fas fa-phone me-2"></i> +1 234 567 890</a>
                        <a href="#"><i class="fas fa-envelope me-2"></i> info@apimanager.com</a>
                    </div>
                </div>
            </div>
            <div class="text-center copyright">
                <p class="mb-0">&copy; 2023 ApiManager. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection

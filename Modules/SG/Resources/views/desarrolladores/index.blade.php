@extends('layouts.app')

@section('content')
<div class="developers-container">
    <!-- Header Section -->
    <div class="developers-header">
        <div class="header-content">
            <h1 class="title">Nuestro Equipo de Desarrollo</h1>
            <p class="subtitle">Profesionales dedicados a optimizar la gestión ganadera</p>
            <div class="ms-auto">
                <a href="{{ route('cefa.sg.index') }}" class="btn btn-gradient-green px-4 py-2 fw-bold shadow-sm" style="border-radius:2rem; font-size:1.1rem;">
                    <i class="fas fa-home me-2"></i>Inicio
                </a>
            </div>
        </div>
    </div>

    <!-- Tech Stack Section -->
    <div class="tech-stack-section">
        <div class="container">
            <h2>Tecnologías Utilizadas</h2>
            <div class="tech-grid">
                <div class="tech-card">
                    <i class="fas fa-php"></i>
                    <h3>Laravel</h3>
                    <p>Framework robusto para backend</p>
                </div>
                <div class="tech-card">
                    <i class="fas fa-database"></i>
                    <h3>MySQL</h3>
                    <p>Base de datos confiable</p>
                </div>
                <div class="tech-card">
                    <i class="fas fa-code"></i>
                    <h3>Blade Templates</h3>
                    <p>Vistas dinámicas y eficientes</p>
                </div>
                <div class="tech-card">
                    <i class="fas fa-palette"></i>
                    <h3>Tailwind CSS</h3>
                    <p>Diseño responsivo moderno</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Developers Section -->
    <div class="developers-section">
        <div class="container">
            <h2>Desarrolladores</h2>
            <div class="developers-grid">
                <!-- Developer 1 -->
                <div class="developer-card">
                    <div class="card-image">
                        <div class="avatar-placeholder" style="background: linear-gradient(135deg, #1B5E20 0%, #2E7D32 100%);">
                            <img src="{{ asset('images/gt4.jpg') }}" class="rounded-circle mb-3" alt="Darwin Martinez" style="width: 140px; height: 140px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="card-content">
                        <h3>Darwin Martinez</h3>
                        <p class="role">Líder de Proyecto-Desarrollador Full Stack</p>
                        <p class="description">Arquitecto de soluciones ganaderas, especialista en gestión de bases de datos y optimización de sistemas</p>
                        <div class="skills">
                            <span class="skill-badge">Laravel</span>
                            <span class="skill-badge">PHP</span>
                            <span class="skill-badge">MySQL</span>
                            <span class="skill-badge">Diseño de BD</span>
                        </div>
                        <div class="social-links">
                            <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            <a href="#" title="Email"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Developer 2 -->
                <div class="developer-card">
                    <div class="card-image">
                        <div class="avatar-placeholder" style="background: linear-gradient(135deg, #388E3C 0%, #43A047 100%);">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3>Breiny Yiseth</h3>
                        <p class="role">Desarrolladora Full Stack</p>
                        <p class="description">Especialista en interfaces dinámicas y experiencia de usuario, experta en frontend y lógica de negocio</p>
                        <div class="skills">
                            <span class="skill-badge">Frontend</span>
                            <span class="skill-badge">Blade</span>
                            <span class="skill-badge">CSS</span>
                            <span class="skill-badge">UX/UI</span>
                        </div>
                        <div class="social-links">
                            <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            <a href="#" title="Email"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Info -->
    <div class="project-info-section">
        <div class="container">
            <h2>Sobre el Proyecto</h2>
            <div class="info-content">
                <div class="info-box">
                    <i class="fas fa-cow"></i>
                    <h4>Gestión Ganadera Integral</h4>
                    <p>Plataforma completa para administración de rebaños, control de producción y análisis de datos ganaderos</p>
                </div>
                <div class="info-box">
                    <i class="fas fa-chart-line"></i>
                    <h4>Análisis en Tiempo Real</h4>
                    <p>Dashboard interactivo con métricas de producción, sanidad animal y rentabilidad</p>
                </div>
                <div class="info-box">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Seguridad y Confiabilidad</h4>
                    <p>Datos protegidos con estándares de seguridad profesionales para la industria ganadera</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .developers-container {
        background: linear-gradient(135deg, #f0f5f0 0%, #e8f5e9 100%);
        min-height: 100vh;
    }

    /* Header */
    .developers-header {
        background: linear-gradient(135deg, #1B5E20 0%, #2E7D32 100%);
        color: white;
        padding: 80px 20px;
        text-align: center;
    }

    .developers-header .title {
        font-size: 3rem;
        margin-bottom: 10px;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .developers-header .subtitle {
        font-size: 1.3rem;
        opacity: 0.95;
    }

    /* Tech Stack */
    .tech-stack-section {
        padding: 60px 0;
        background: white;
    }

    .tech-stack-section h2 {
        text-align: center;
        font-size: 2.2rem;
        color: #1B5E20;
        margin-bottom: 40px;
    }

    .tech-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }

    .tech-card {
        background: linear-gradient(135deg, #f9f9f9 0%, #e8f5e9 100%);
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        border-left: 4px solid #66BB6A;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .tech-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(27, 94, 32, 0.15);
    }

    .tech-card i {
        font-size: 2.5rem;
        color: #2E7D32;
        margin-bottom: 15px;
    }

    .tech-card h3 {
        color: #1B5E20;
        margin-bottom: 10px;
    }

    .tech-card p {
        color: #558B2F;
        font-size: 0.95rem;
    }

    /* Developers Section */
    .developers-section {
        padding: 60px 0;
    }

    .developers-section h2 {
        text-align: center;
        font-size: 2.2rem;
        color: #1B5E20;
        margin-bottom: 50px;
    }

    .developers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
    }

    .developer-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-top: 5px solid #66BB6A;
    }

    .developer-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(27, 94, 32, 0.2);
    }

    .card-image {
        background: linear-gradient(135deg, #1B5E20 0%, #2E7D32 100%);
        padding: 40px;
        text-align: center;
    }

    .avatar-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .card-content {
        padding: 30px;
    }

    .card-content h3 {
        font-size: 1.5rem;
        color: #1B5E20;
        margin-bottom: 5px;
    }

    .role {
        color: #2E7D32;
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }

    .description {
        color: #558B2F;
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .skills {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .skill-badge {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        color: #1B5E20;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        border: 1px solid #66BB6A;
    }

    .social-links {
        display: flex;
        gap: 15px;
        padding-top: 15px;
        border-top: 1px solid #e8f5e9;
    }

    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #2E7D32 0%, #66BB6A 100%);
        color: white;
        border-radius: 50%;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .social-links a:hover {
        transform: scale(1.1);
    }

    /* Project Info */
    .project-info-section {
        padding: 60px 0;
        background: #f1f8f5;
    }

    .project-info-section h2 {
        text-align: center;
        font-size: 2.2rem;
        color: #1B5E20;
        margin-bottom: 40px;
    }

    .info-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    .info-box {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        border-top: 4px solid #2E7D32;
        transition: transform 0.3s ease;
    }

    .info-box:hover {
        transform: translateY(-5px);
    }

    .info-box i {
        font-size: 2.5rem;
        color: #1B5E20;
        margin-bottom: 15px;
    }

    .info-box h4 {
        color: #1B5E20;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .info-box p {
        color: #558B2F;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .developers-header .title {
            font-size: 2rem;
        }

        .developers-header .subtitle {
            font-size: 1rem;
        }

        .developers-grid {
            grid-template-columns: 1fr;
        }

        .tech-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection
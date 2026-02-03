@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: rgb(15, 84, 153);
    }

    body {
        background: url('{{ asset('images/imagen5.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        background-attachment: fixed;
        position: relative;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(26, 60, 94, 0.2) 0%, rgba(40, 167, 69, 0.1) 100%);
        pointer-events: none;
        z-index: -1;
    }

    /* Animaciones */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-12px);
        }
    }

    @keyframes pulse-glow {
        0% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
        }
        70% {
            box-shadow: 0 0 0 15px rgba(40, 167, 69, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
        }
    }

    .lider-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        padding-top: 2rem;
    }

    /* Sección Hero */
    .hero-section {
        padding: 3rem 2rem;
        text-align: center;
        animation: fadeInDown 0.8s ease-out;
    }

    .hero-welcome-card {
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        padding: 4rem 3rem;
        max-width: 700px;
        margin: 0 auto;
        border: 2px solid rgba(40, 167, 69, 0.15);
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .hero-welcome-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .hero-welcome-card:hover::before {
        left: 100%;
    }

    .hero-welcome-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3), 0 0 50px rgba(40, 167, 69, 0.2);
        border-color: rgba(40, 167, 69, 0.3);
    }

    .hero-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        animation: float 3s ease-in-out infinite;
        display: inline-block;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 900;
        color: #1a3c5e;
        margin: 1rem 0;
        letter-spacing: -1px;
        background: linear-gradient(135deg, #1a3c5e 0%, #28a745 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.15rem;
        color: #5a6c7d;
        max-width: 600px;
        margin: 1.5rem auto;
        line-height: 1.8;
        font-weight: 500;
    }

    .hero-badge {
        font-size: 1rem;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        display: inline-block;
        font-weight: 700;
        letter-spacing: 0.5px;
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
        animation: pulse-glow 2s infinite;
        transition: all 0.3s ease;
    }

    .hero-badge:hover {
        transform: scale(1.08);
        box-shadow: 0 12px 30px rgba(40, 167, 69, 0.5);
    }

    /* Sección Principal de Contenido */
    .main-content-section {
        flex-grow: 1;
        padding: 3rem 2rem;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.12) 100%);
    }

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: 3rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 0.8s ease-out;
        letter-spacing: -0.5px;
    }

    .content-grid {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: center;
    }

    /* Tarjeta de Imagen */
    .image-container {
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        animation: slideInLeft 0.8s ease-out;
        position: relative;
        border: 3px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.6s ease;
    }

    .image-container:hover {
        transform: scale(1.05);
    }

    .image-container img {
        width: 100%;
        height: auto;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        display: block;
    }

    .image-container:hover img {
        transform: scale(1.1) rotate(1deg);
    }

    /* Tarjeta de Contenido */
    .info-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 3.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        animation: slideInRight 0.8s ease-out;
        border: 2px solid rgba(40, 167, 69, 0.1);
        transition: all 0.4s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        border-color: rgba(40, 167, 69, 0.2);
    }

    .info-title {
        font-size: 2.2rem;
        font-weight: 900;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.5px;
    }

    .info-description {
        color: #5a6c7d;
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 2.5rem;
        font-weight: 500;
    }

    /* Rol Badge */
    .rol-badge {
        display: inline-block;
        padding: 0.6rem 1.5rem;
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        letter-spacing: 0.5px;
    }

    .divider {
        height: 3px;
        background: linear-gradient(90deg, transparent, #28a745, transparent);
        margin: 2rem 0;
        border-radius: 2px;
    }

    /* Lista de Responsabilidades */
    .responsibility-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .responsibility-list li {
        color: #5a6c7d;
        margin-bottom: 1.5rem;
        padding-left: 2.5rem;
        position: relative;
        font-size: 1.05rem;
        line-height: 1.6;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .responsibility-list li:hover {
        color: #28a745;
        transform: translateX(8px);
    }

    .responsibility-list li::before {
        content: "👨‍💼";
        position: absolute;
        left: 0;
        font-size: 1.4rem;
        animation: fadeInDown 0.6s ease-out;
    }

    /* Sección de Stats */
    .stats-grid-section {
        padding: 3rem 2rem;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.12) 0%, rgba(0, 0, 0, 0.05) 100%);
    }

    .stats-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 2.5rem 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        transition: all 0.4s ease;
        border: 2px solid rgba(40, 167, 69, 0.1);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #28a745 0%, #20c997 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        border-color: rgba(40, 167, 69, 0.3);
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        animation: float 3s ease-in-out infinite;
    }

    .stat-label {
        font-size: 1.1rem;
        color: #5a6c7d;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 900;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .content-grid {
            gap: 2.5rem;
        }

        .image-container img {
            height: 400px;
        }

        .info-card {
            padding: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 2rem 1.5rem;
        }

        .hero-welcome-card {
            padding: 2.5rem 1.5rem;
            border-radius: 20px;
        }

        .hero-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero-title {
            font-size: 2.2rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .content-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .image-container img {
            height: 300px;
        }

        .info-card {
            padding: 2rem;
        }

        .info-title {
            font-size: 1.8rem;
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 2rem;
        }

        .main-content-section {
            padding: 2rem 1.5rem;
        }

        .stats-grid-section {
            padding: 2rem 1.5rem;
        }

        .responsibility-list li {
            margin-bottom: 1rem;
            padding-left: 2rem;
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 1.8rem;
        }

        .info-title {
            font-size: 1.5rem;
        }

        .hero-subtitle {
            font-size: 0.95rem;
        }

        .hero-welcome-card {
            padding: 1.5rem 1rem;
        }

        .stats-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="lider-container">
    <!-- Sección Hero -->
    <section class="hero-section">
        <div class="hero-welcome-card">
            <div class="hero-icon">👨‍🌾</div>
            <h1 class="hero-title">Bienvenido Líder de Unidad</h1>
            <p class="hero-subtitle">
                Sistema integral para gestionar operaciones ganaderas con autoridad y supervisión. 
                Dirige, supervisa y optimiza el control de inventario, registros sanitarios y producción.
            </p>
            <span class="hero-badge">{!! config('sg.name') !!}</span>
        </div>
    </section>

    <!-- Sección Principal de Contenido -->
    <section class="main-content-section">
        <h2 class="section-title">Rol del Líder de Unidad Ganadera</h2>
        <div class="content-grid">
            <!-- Imagen -->
            <div class="image-container">
                <img src="{{ asset('images/lider.jpeg') }}" alt="Líder de unidad ganadera">
            </div>

            <!-- Información -->
            <div class="info-card">
                <span class="rol-badge">👨‍💼 Rol Directivo</span>
                <h2 class="info-title">Responsabilidades Estratégicas</h2>
                <p class="info-description">
                    El líder de unidad es responsable de la supervisión, planificación y ejecución de todas las 
                    actividades ganaderas. Lidera equipos, toma decisiones críticas y asegura el cumplimiento de 
                    metas de producción y bienestar animal.
                </p>
                <div class="divider"></div>
                <ul class="responsibility-list">
                    <li>Supervisión y coordinación de equipos de trabajo</li>
                    <li>Planificación estratégica de operaciones ganaderas</li>
                    <li>Toma de decisiones en manejo sanitario y productivo</li>
                    <li>Control de presupuestos y recursos de la unidad</li>
                    <li>Generación de reportes ejecutivos y análisis de desempeño</li>
                    <li>Capacitación y evaluación de personal operativo</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Sección de Stats -->
    <section class="stats-grid-section">
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-label">Análisis Estratégico</div>
                <div class="stat-value">Avanzado</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-label">Supervisión de Equipo</div>
                <div class="stat-value">Total</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📈</div>
                <div class="stat-label">Productividad</div>
                <div class="stat-value">Máxima</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-label">Control de Calidad</div>
                <div class="stat-value">Integral</div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const listItems = document.querySelectorAll('.responsibility-list li');
        listItems.forEach((item, index) => {
            item.style.animation = `slideInLeft 0.6s ease-out ${index * 0.1}s both`;
        });

        window.addEventListener('scroll', () => {
            const container = document.querySelector('.lider-container');
            if (container) {
                const scrollPosition = window.pageYOffset;
                const heroSection = document.querySelector('.hero-section');
                if (heroSection) {
                    heroSection.style.transform = `translateY(${scrollPosition * 0.5}px)`;
                }
            }
        });

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = `${entry.target.dataset.animation || 'fadeInUp'} 0.8s ease-out forwards`;
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('[data-animation]').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endsection

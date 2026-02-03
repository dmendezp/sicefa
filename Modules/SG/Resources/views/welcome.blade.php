@extends('sg::layouts.master')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body, html {
        color: rgb(15, 84, 153);
        background: url('{{ asset('images/imagen5.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Animaciones globales */
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
            transform: translateY(-15px);
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

    .welcome-container {
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.1) 100%);
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Sección Hero */
    .hero-section {
        padding: 4rem 2rem;
        text-align: center;
        animation: fadeInDown 0.8s ease-out;
    }

    .welcome-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25), 0 0 40px rgba(40, 167, 69, 0.1);
        padding: 4rem 3rem;
        max-width: 700px;
        margin: 3rem auto 0;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: 2px solid rgba(40, 167, 69, 0.15);
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .welcome-card:hover::before {
        left: 100%;
    }

    .welcome-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3), 0 0 50px rgba(40, 167, 69, 0.2);
        border-color: rgba(40, 167, 69, 0.3);
    }

    .welcome-icon {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        animation: float 3s ease-in-out infinite;
        display: inline-block;
    }

    .welcome-title {
        font-size: 3rem;
        font-weight: 900;
        color: #0f5499;
        margin: 1.5rem 0 1rem 0;
        letter-spacing: -1px;
        background: linear-gradient(135deg, #0f5499 0%, #28a745 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .welcome-subtitle {
        font-size: 1.15rem;
        color: #5a6c7d;
        max-width: 600px;
        margin: 0 auto 2rem;
        line-height: 1.8;
        font-weight: 500;
    }

    .welcome-badge {
        font-size: 1rem;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        color: white;
        display: inline-block;
        margin-bottom: 0;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
        animation: pulse-glow 2s infinite;
    }

    .welcome-badge:hover {
        transform: scale(1.08);
        box-shadow: 0 12px 30px rgba(40, 167, 69, 0.5);
    }

    /* Sección de Estadísticas */
    .stats-section {
        padding: 4rem 2rem;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.15) 100%);
        flex-grow: 1;
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

    .stats-grid {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: center;
    }

    .stats-image-container {
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        animation: slideInLeft 0.8s ease-out;
        position: relative;
        border: 3px solid rgba(255, 255, 255, 0.1);
    }

    .stats-image-container::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.2) 0%, transparent 50%);
        pointer-events: none;
    }

    .stats-image {
        width: 100%;
        height: 480px;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        display: block;
    }

    .stats-image-container:hover .stats-image {
        transform: scale(1.1) rotate(1deg);
    }

    .stats-content {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 3.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        animation: slideInRight 0.8s ease-out;
        border: 2px solid rgba(40, 167, 69, 0.1);
        transition: all 0.4s ease;
    }

    .stats-content:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        border-color: rgba(40, 167, 69, 0.2);
    }

    .stats-title {
        font-size: 2.5rem;
        font-weight: 900;
        margin: 0 0 1.5rem 0;
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.5px;
    }

    .stats-description {
        color: #5a6c7d;
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 2.5rem;
        font-weight: 500;
    }

    .stats-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .stats-list li {
        color: #5a6c7d;
        margin-bottom: 1.5rem;
        padding-left: 2.5rem;
        position: relative;
        font-size: 1.05rem;
        line-height: 1.6;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .stats-list li:hover {
        color: #28a745;
        transform: translateX(8px);
    }

    .stats-list li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #28a745;
        font-weight: bold;
        font-size: 1.4rem;
        animation: fadeInDown 0.6s ease-out;
    }

    /* Divisor decorativo */
    .stats-divider {
        height: 3px;
        background: linear-gradient(90deg, transparent, #28a745, transparent);
        margin: 2rem 0;
        border-radius: 2px;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .stats-grid {
            gap: 2.5rem;
        }

        .stats-image {
            height: 400px;
        }

        .stats-content {
            padding: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .welcome-container {
            min-height: auto;
        }

        .hero-section {
            padding: 2rem 1.5rem;
        }

        .welcome-card {
            padding: 2.5rem 1.5rem;
            margin: 1.5rem 1rem 0;
            border-radius: 20px;
        }

        .welcome-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .welcome-title {
            font-size: 2.2rem;
            margin: 1rem 0 0.8rem 0;
        }

        .welcome-subtitle {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .stats-image {
            height: 300px;
        }

        .stats-content {
            padding: 2rem;
        }

        .stats-title {
            font-size: 1.8rem;
        }

        .stats-section {
            padding: 2rem 1.5rem;
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 2rem;
        }

        .stats-list li {
            margin-bottom: 1rem;
            padding-left: 2rem;
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .welcome-title {
            font-size: 1.8rem;
        }

        .stats-title {
            font-size: 1.5rem;
        }

        .welcome-subtitle {
            font-size: 0.95rem;
        }

        .welcome-card {
            padding: 1.5rem 1rem;
            margin: 1rem 0.5rem 0;
        }
    }
</style>

<div class="welcome-container">

    <section class="hero-section">
        <div class="welcome-card">
            <div class="welcome-icon">🐄</div>
            <h1 class="welcome-title">Bienvenido Administrator</h1>
            <p class="welcome-subtitle">
                Administre eficientemente su ganadería con nuestro sistema integral. Gestione el control de ganado,
                seguimiento de peso, registros sanitarios y producción de manera efectiva y centralizada.
            </p>
            <span class="welcome-badge">{!! config('sg.name') !!}</span>
        </div>
    </section>

    <section class="stats-section">
        <h2 class="section-title">Sistema Integral de Ganadería</h2>
        <div class="stats-grid">
            <div class="stats-image-container">
                <img src="{{ asset('images/imagen6.webp') }}" alt="Unidad Porcina" class="stats-image">
            </div>

            <div class="stats-content">
                <h2 class="stats-title">Estadísticas Inteligentes</h2>
                <p class="stats-description">
                    Visualiza indicadores clave como tasas de conversión alimenticia, ganancia diaria de peso y más.
                    Nuestra tecnología avanzada te permite tomar decisiones informadas para optimizar tu producción.
                </p>
                <div class="stats-divider"></div>
                <ul class="stats-list">
                    <li>Monitoreo en tiempo real de parámetros críticos.</li>
                    <li>Reportes detallados para análisis de rendimiento.</li>
                    <li>Integración con sistemas automatizados de alimentación.</li>
                    <li>Foco en sostenibilidad y bienestar animal.</li>
                </ul>
            </div>
        </div>
    </section>
</div>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Animar elementos de lista con delay
            const listItems = document.querySelectorAll('.stats-list li');
            listItems.forEach((item, index) => {
                item.style.animation = `slideInLeft 0.6s ease-out ${index * 0.1}s both`;
            });

            // Efecto parallax suave en scroll
            window.addEventListener('scroll', () => {
                const container = document.querySelector('.welcome-container');
                if (container) {
                    const scrollPosition = window.pageYOffset;
                    const heroSection = document.querySelector('.hero-section');
                    if (heroSection) {
                        heroSection.style.transform = `translateY(${scrollPosition * 0.5}px)`;
                    }
                }
            });

            // Animación de contador para números (si hay)
            const animateCounters = () => {
                const elements = document.querySelectorAll('[data-count]');
                elements.forEach(element => {
                    const target = parseInt(element.dataset.count);
                    let current = 0;
                    const increment = target / 50;
                    
                    const counter = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            element.textContent = target;
                            clearInterval(counter);
                        } else {
                            element.textContent = Math.floor(current);
                        }
                    }, 30);
                });
            };

            // Trigger de animación al hacer scroll
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

            // Observar elementos animables
            document.querySelectorAll('[data-animation]').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
@endsection

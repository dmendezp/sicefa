@extends('sg::layouts.master')

@section('content')
<br><br><br>
<style>
    body, html {
        color: rgb(15, 84, 153);
        margin: 0;
        padding: 0;
        background: url('{{ asset('images/imagen5.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        background-attachment: fixed;
    }

    .welcome-container {
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.05) 100%);
        padding: 0;
    }

    .welcome-card {
        background: rgba(255, 255, 255, 0.92);
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        padding: 3rem 2rem;
        max-width: 650px;
        margin: 2.5rem auto 0;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .welcome-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
    }

    .welcome-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1a3c5e;
        margin: 0 0 1.2rem 0;
        letter-spacing: -0.5px;
    }

    .welcome-subtitle {
        font-size: 1rem;
        color: #5a6c7d;
        max-width: 550px;
        margin: 0 auto 1.8rem;
        line-height: 1.6;
    }

    .welcome-badge {
        font-size: 0.95rem;
        padding: 0.6rem 1.5rem;
        border-radius: 25px;
        background: #28a745;
        color: white;
        display: inline-block;
        margin-bottom: 0;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .stats-section {
        padding: 3rem 2rem 2rem;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.02) 0%, rgba(0, 0, 0, 0.08) 100%);
    }

    .stats-grid {
        max-width: 1100px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2.5rem;
        align-items: center;
    }

    .stats-image-container {
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.2);
    }

    .stats-image {
        width: 100%;
        height: 450px;
        object-fit: cover;
        transition: transform 0.4s ease;
        display: block;
    }

    .stats-image:hover {
        transform: scale(1.05);
    }

    .stats-content {
        background: rgba(255, 255, 255, 0.96);
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
    }

    .stats-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0 0 1.5rem 0;
        color: #28a745;
        letter-spacing: -0.5px;
    }

    .stats-description {
        color: #5a6c7d;
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 1.8rem;
    }

    .stats-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .stats-list li {
        color: #5a6c7d;
        margin-bottom: 1.2rem;
        padding-left: 1.8rem;
        position: relative;
        font-size: 1rem;
        line-height: 1.5;
    }

    .stats-list li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #28a745;
        font-weight: bold;
        font-size: 1.2rem;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .stats-image {
            height: 350px;
        }

        .welcome-card {
            padding: 2rem 1.5rem;
            margin: 1.5rem 1rem 0;
        }

        .welcome-title {
            font-size: 2rem;
        }

        .stats-title {
            font-size: 1.8rem;
        }

        .stats-section {
            padding: 2rem 1rem 1.5rem;
        }
    }
</style>

<div class="welcome-container">

    <section>
        <div class="welcome-card">
            <h1 class="welcome-title">Bienvenido Administrator</h1>
            <p class="welcome-subtitle">
                Administre eficientemente su ganadería con nuestro sistema integral. Gestione el control de ganado,
                seguimiento de peso, registros sanitarios y producción de manera efectiva y centralizada.
            </p>
            <span class="welcome-badge">{!! config('sg.name') !!}</span>
        </div>
    </section>

    <section class="stats-section">
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
            const card = document.querySelector('.welcome-card');
            card.style.opacity = '0';
            setTimeout(() => {
                card.style.opacity = '1';
            }, 100);
        });
    </script>
@endsection

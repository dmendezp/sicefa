@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body {
        margin: 0;
        padding: 0;
        height: auto; /* Cambiado de min-height: 100vh */
        overflow-x: hidden; /* Permite scroll horizontal si necesario */
        overflow-y: auto; /* Permite scroll vertical */
        background: url('{{ asset("/images/Bioseguridad-porcina.jpg") }}') no-repeat center center fixed;
        background-size: cover;
        color: rgb(15, 84, 153);
    }

    .wrapper {
        position: relative;
        height: auto; /* Cambiado de min-height: 100vh */
    }

    .main-footer {
        background-color: #2d5e3b;
        color: #fff;
        border-top: 3px solid #f1c40f;
        position: relative; /* Asegura que el footer no cree espacio extra */
    }

    .main-footer a {
        color: #f1c40f;
    }

    .main-footer a:hover {
        color: #e67e22;
    }

    .preloader img {
        animation: wobble 2s infinite;
    }

    @keyframes wobble {
        0% { transform: rotate(0deg); }
        25% { transform: rotate(5deg); }
        50% { transform: rotate(0deg); }
        75% { transform: rotate(-5deg); }
        100% { transform: rotate(0deg); }
    }

    .content-wrapper {
        background: transparent;
        padding-bottom: 20px; /* Reducido desde 100px */
    }

    .content-image {
        display: none;
    }

    .welcome-card {
        background: linear-gradient(to bottom, #f2f9ff, #e6f3ff);
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 2.5rem;
        max-width: 800px;
        margin: 4rem auto;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .welcome-card:hover {
        transform: translateY(-5px);
    }

    .welcome-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a3c5e;
        margin-bottom: 1rem;
    }

    .welcome-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto 1.5rem;
    }

    .welcome-badge {
        font-size: 1rem;
        padding: 0.5rem 1.25rem;
        border-radius: 20px;
        background: #007bff;
        color: white;
        display: inline-block;
        margin-bottom: 2rem;
    }

    .quick-links {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .quick-link-btn {
        background: #1a3c5e;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        font-size: 0.95rem;
        font-weight: 500;
        border-radius: 8px;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .quick-link-btn:hover {
        background: #152e47;
        transform: translateY(-2px);
    }

    .icon-prefix {
        margin-right: 0.5rem;
    }

    @media (max-width: 576px) {
        .welcome-card {
            margin: 2rem 1rem;
            padding: 1.5rem;
        }

        .welcome-title {
            font-size: 1.75rem;
        }

        .welcome-subtitle {
            font-size: 1rem;
        }

        .quick-links {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
<br><br><br>

<section class="container my-5">
    <div class="welcome-card animate__animated animate__slideInUp">
        <h1 class="welcome-title">Welcome, Unit Leader</h1>
        <p class="welcome-subtitle">
            Manage your unit's operations efficiently with sg. Access tools to oversee pigs, monitor inventory, and generate reports tailored to your unit.
        </p>
        <div>
            <span class="welcome-badge">{!! config('sg.name') !!}</span>
        </div>
        <div class="quick-links">
            <a href="" class="btn quick-link-btn">
                <i class="fas fa-piggy-bank icon-prefix"></i>Unit Pig Management
            </a>
            <a href="" class="btn quick-link-btn">
                <i class="fas fa-warehouse icon-prefix"></i>Unit Inventory
            </a>
            <a href="" class="btn quick-link-btn">
                <i class="fas fa-chart-line icon-prefix"></i>Unit Reports
            </a>
        </div>
    </div>
</section>

<!-- Nueva sección: Información adicional sobre la unidad -->
<section class="py-10 px-6 bg-gray-900 bg-opacity-75">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Tarjeta izquierda: imagen representativa -->
        <div class="overflow-hidden rounded-2xl shadow-lg">
            <img src="{{ asset('/images/unidad porcina.jpg') }}" alt="Unidad Porcina"
                 class="w-full h-72 object-cover transition-transform duration-300 hover:scale-105">
        </div>

        <!-- Tarjeta derecha: contenido informativo -->
        <div class="bg-white rounded-xl p-8 shadow-lg">
            <h2 class="text-4xl font-extrabold mb-6 text-green-600">Análisis Avanzado de Producción</h2>
            <p class="text-gray-700 text-lg leading-relaxed mb-6">
               Obtén una visión completa de tu unidad con métricas clave como eficiencia reproductiva, índices de mortalidad y rendimiento por lote. Nuestra plataforma te empodera con datos precisos para maximizar la productividad.
            <ul class="text-gray-700 list-disc pl-6 space-y-3">
                <li>Seguimiento instantáneo de indicadores de desempeño.</li>
                <li>Informes personalizados para decisiones estratégicas.</li>
                <li>Conexión con tecnologías de monitoreo ambiental.</li>
                <li>Compromiso con prácticas éticas y sostenibles.</li>
            </ul>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    // Ensure card animation triggers on page load
    document.addEventListener('DOMContentLoaded', () => {
        const card = document.querySelector('.welcome-card');
        card.style.opacity = '0';
        setTimeout(() => {
            card.style.opacity = '1';
        }, 100);
    });
</script>
@endsection
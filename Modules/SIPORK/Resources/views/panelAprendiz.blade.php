@extends('sipork::layouts.masterAprendiz')

@section('content')
<br><br><br>
<style>
    body {
        color: rgb(34, 139, 34);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: flex-start; /* Cambiado para alinear a la izquierda */
        align-items: center;
        min-height: 100vh;
        background-color: #f4f4f4;
        padding-left: 31%; /* Ajusta este valor para mover más hacia la derecha */
    }
    .welcome-card {
        background: linear-gradient(to bottom, #e8f5e9, #c8e6c9);
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 2.5rem;
        max-width: 800px;
        width: 90%;
        text-align: center;
        transition: transform 0.3s ease;
    }
    .welcome-card:hover {
        transform: translateY(-5px);
    }
    .welcome-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2e7d32;
        margin-bottom: 1rem;
    }
    .welcome-subtitle {
        font-size: 1.1rem;
        color: #4caf50;
        max-width: 600px;
        margin: 0 auto 1.5rem;
    }
    .welcome-badge {
        font-size: 1rem;
        padding: 0.5rem 1.25rem;
        border-radius: 20px;
        background: #388e3c;
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
        background: #2e7d32;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        font-size: 0.95rem;
        font-weight: 500;
        border-radius: 8px;
        transition: background 0.3s ease, transform 0.2s ease;
        text-decoration: none;
    }
    .quick-link-btn:hover {
        background: #1b5e20;
        transform: translateY(-2px);
    }
    .icon-prefix {
        margin-right: 0.5rem;
    }
    @media (max-width: 576px) {
        body {
            padding: 1rem;
        }
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

<section class="container my-5">
    <div class="welcome-card animate__animated animate__slideInUp">
        <h1 class="welcome-title">Welcome, Apprentice</h1>
        <p class="welcome-subtitle">
            Learn and grow with SIPORK. Access tools to understand pig management, inventory tracking, and reporting processes.
        </p>
        <div>
            <span class="welcome-badge">{!! config('sipork.name') !!}</span>
        </div>
        <div class="quick-links">
            <a href="" class="btn quick-link-btn">
                <i class="fas fa-book icon-prefix"></i>Learning Resources
            </a>
            <a href="" class="btn quick-link-btn">
                <i class="fas fa-tools icon-prefix"></i>Practice Tools
            </a>
            <a href="" class="btn quick-link-btn">
                <i class="fas fa-question-circle icon-prefix"></i>FAQs
            </a>
        </div>
    </div>
</section>

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
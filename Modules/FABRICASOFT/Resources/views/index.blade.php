@extends('fabricasoft::layouts.master')

@section('content')
<div class="software-factory-container">
    <!-- Hero Section -->
    <header class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-icon">
                <!-- Ícono de fábrica (industry) -->
                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zM10 4h4v2h-4V4zm10 15H4V8h16v11z"/>
                </svg>
            </div>
            <h1 class="hero-title animate-fade-in">
                FábricaSoft: <span class="highlight">Tu Socio en Innovación Digital</span>
            </h1>
            <p class="hero-subtitle animate-slide-up">
                Creamos soluciones de software a medida que impulsan tu negocio al siguiente nivel
            </p>
            <div class="hero-cta animate-scale">
                <a href="#contact" class="cta-button primary">
                    <!-- Ícono de sobre (envelope) -->
                    <svg class="button-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                    Contáctanos
                </a>
                <a href="#services" class="cta-button secondary">
                    <!-- Ícono de lupa (search) -->
                    <svg class="button-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                    Explora Servicios
                </a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="section-container">
            <h2 class="section-title">Nuestros Servicios</h2>
            <p class="section-subtitle">Soluciones integrales para tus necesidades digitales</p>
            <div class="services-grid">
                <div class="service-card animate-card">
                    <div class="service-icon">
                        <!-- Ícono de laptop con código (laptop-code) -->
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z"/>
                            <path d="M10 9l-2 2 2 2m4-4l2 2-2 2"/>
                        </svg>
                    </div>
                    <h3>Desarrollo de Software</h3>
                    <p>Aplicaciones web, móviles y de escritorio a medida con tecnologías de punta</p>
                </div>
                <div class="service-card animate-card">
                    <div class="service-icon">
                        <!-- Ícono de nube con carga (cloud-upload-alt) -->
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.35 10.04A7.49 7.49 0 0 0 12 4a7.49 7.49 0 0 0-7.35 6.04A5.5 5.5 0 0 0 0 15.5C0 18.54 2.46 21 5.5 21h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                        </svg>
                    </div>
                    <h3>Soluciones en la Nube</h3>
                    <p>Arquitecturas escalables y seguras en AWS, Azure y Google Cloud</p>
                </div>
                <div class="service-card animate-card">
                    <div class="service-icon">
                        <!-- Ícono de robot -->
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2a5 5 0 0 0-5 5v2H5v11h14V9h-2V7a5 5 0 0 0-5-5zm0 2a3 3 0 0 1 3 3v2h-6V7a3 3 0 0 1 3-3zm-2 12h-2v-2h2v2zm4 0h-2v-2h2v2z"/>
                        </svg>
                    </div>
                    <h3>Transformación Digital</h3>
                    <p>Automatización, IA y modernización de procesos empresariales</p>
                </div>
                <div class="service-card animate-card">
                    <div class="service-icon">
                        <!-- Ícono de escudo (shield-alt) -->
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 2.18l7 3.12v5.7c0 4.83-3.36 9.36-8 10.54-4.64-1.18-8-5.71-8-10.54V6.3l7-3.12z"/>
                        </svg>
                    </div>
                    <h3>Ciberseguridad</h3>
                    <p>Protección avanzada para tus sistemas y datos</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us">
        <div class="section-container">
            <h2 class="section-title">¿Por Qué Elegirnos?</h2>
            <p class="section-subtitle">Tu éxito es nuestra prioridad</p>
            <div class="why-grid">
                <div class="why-item">
                    <div class="why-icon">
                        <!-- Ícono de trofeo -->
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4h-2V2H6v2H4c-1.1 0-2 .9-2 2v3c0 2.21 1.79 4 4 4h1v3h10v-3h1c2.21 0 4-1.79 4-4V6c0-1.1-.9-2-2-2zm-14 5V6h2v5H6zm12 0V6h2v3h-2zM12 22c-1.1 0-2-.9-2-2h4c0 1.1-.9 2-2 2z"/>
                        </svg>
                    </div>
                    <div class="why-content">
                        <h3>Experiencia Comprobada</h3>
                        <p>Más de 10 años entregando proyectos exitosos a nivel global</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon">
                        <!-- Ícono de equipo (users-gear) -->
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                        </svg>
                    </div>
                    <div class="why-content">
                        <h3>Equipo Certificado</h3>
                        <p>Ingenieros expertos en metodologías ágiles y DevOps</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon">
                        <!-- Ícono de reloj -->
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6l4.5 2.7.75-1.23L14 12.5V7h-3z"/>
                        </svg>
                    </div>
                    <div class="why-content">
                        <h3>Entrega a Tiempo</h3>
                        <p>Cumplimos plazos con calidad garantizada</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon">
                        <!-- Ícono de auriculares (headset) -->
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 1a9 9 0 0 0-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2a7 7 0 0 1 14 0v2h-4v8h3c1.66 0 3-1.34 3-3v-7a9 9 0 0 0-9-9z"/>
                        </svg>
                    </div>
                    <div class="why-content">
                        <h3>Soporte 24/7</h3>
                        <p>Asistencia continua para tus soluciones</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="section-container">
            <h2 class="section-title">Contáctanos</h2>
            <p class="section-subtitle">Estamos listos para ayudarte con tu próximo proyecto</p>
            <form class="contact-form">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" placeholder="Tu nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="Tu correo" required>
                </div>
                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" name="message" placeholder="¿En qué podemos ayudarte?" required></textarea>
                </div>
                <button type="submit" class="cta-button primary">
                    <!-- Ícono de avión de papel (paper-plane) -->
                    <svg class="button-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                    </svg>
                    Enviar Mensaje
                </button>
            </form>
        </div>
    </section>
</div>

<style>
    .software-factory-container {
        width: 100%;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
        color: #333;
    }

    /* Estilo para los íconos SVG */
    .icon {
        width: 2.5rem;
        height: 2.5rem;
        display: inline-block;
    }

    .button-icon {
        width: 1.2rem;
        height: 1.2rem;
        display: inline-block;
        vertical-align: middle;
        margin-right: 0.5rem;
    }

    /* Hero Styles */
    .hero-section {
        position: relative;
        min-height: 90vh;
        background: url('https://images.unsplash.com/photo-1518770660439-4636190af475') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(30, 60, 114, 0.7);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 2rem;
        max-width: 900px;
    }

    .hero-icon {
        margin-bottom: 1.5rem;
    }

    .hero-icon .icon {
        color: #00c4cc;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        color: white;
    }

    .highlight {
        color: #00c4cc;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .hero-subtitle {
        font-size: 1.6rem;
        margin-bottom: 2rem;
        font-weight: 300;
        color: white;
    }

    .hero-cta {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .cta-button {
        padding: 1rem 2.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .cta-button.primary {
        background: #00c4cc;
        color: white;
        border: none;
    }

    .cta-button.secondary {
        background: transparent;
        color: white;
        border: 2px solid #00c4cc;
    }

    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 196, 204, 0.4);
    }

    /* Services Styles */
    .services {
        padding: 6rem 2rem;
        background: #f8fafc;
    }

    .section-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-title {
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 1rem;
        color: #1e3c72;
    }

    .section-subtitle {
        text-align: center;
        margin-bottom: 3rem;
        color: #666;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .service-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .service-icon {
        margin-bottom: 1rem;
    }

    .service-icon .icon {
        color: #00c4cc;
    }

    .service-card h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: #1e3c72;
    }

    .service-card p {
        font-size: 0.95rem;
        color: #666;
    }

    /* Why Choose Us Styles */
    .why-choose-us {
        padding: 6rem 2rem;
        background: white;
    }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .why-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .why-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f0f5ff;
        border-radius: 50%;
        padding: 0.8rem;
    }

    .why-icon .icon {
        color: #1e3c72;
        width: 1.8rem;
        height: 1.8rem;
    }

    .why-item:hover .why-icon .icon {
        transform: scale(1.1);
    }

    .why-content h3 {
        font-size: 1.2rem;
        margin-bottom: 0.3rem;
        color: #1e3c72;
    }

    .why-content p {
        font-size: 0.9rem;
        color: #666;
    }

    /* Contact Section Styles */
    .contact-section {
        padding: 6rem 2rem;
        background: #f8fafc;
    }

    .contact-form {
        max-width: 600px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: #1e3c72;
    }

    .form-group input,
    .form-group textarea {
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
        font-family: inherit;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 150px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #00c4cc;
        box-shadow: 0 0 5px rgba(0, 196, 204, 0.3);
    }

    /* Animaciones */
    .animate-fade-in { animation: fadeIn 1s ease-in; }
    .animate-slide-up { animation: slideUp 1s ease-in; }
    .animate-scale { animation: scaleIn 1s ease-in; }

    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { transform: translateY(50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    @keyframes scaleIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }

    @media (max-width: 768px) {
        .hero-title { font-size: 2.5rem; }
        .hero-subtitle { font-size: 1.2rem; }
        .hero-cta { flex-direction: column; }
        .hero-icon .icon { width: 2rem; height: 2rem; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Smooth Scroll
        document.querySelectorAll('.cta-button').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(btn.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Intersection Observer para tarjetas
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-card');
                }
            });
        }, { threshold: 0.3 });

        document.querySelectorAll('.service-card').forEach(card => observer.observe(card));

        // Manejo del formulario (simulación de envío)
        const form = document.querySelector('.contact-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                alert('Mensaje enviado con éxito. ¡Gracias por contactarnos!');
                form.reset();
            });
        }
    });
</script>
@endsection

@extends('cafeto::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/customStyles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">Inicio</li>
@endpush

@section('content')
    <h5 class="display-4">Bienvenido a CAFETO</h5>
    <h5 data-aos="fade-down">CAFETO permite la administración de la estación de café del centro de formación
        agroindustrial "La Angostura", incluyendo los procesos que se realizan desde la parte de ventas,
        inventariado y organización general.</h5>
    <div class="row">
        <div class="col-6">
            <div class="carousel-container">
                <div class="card-carousel">
                    <div class="card" style="width: 18rem;">
                        <div class="text-center">
                            <img src="{{ asset('modules/cafeto/images/gifs/capuccino.gif') }}" class="card-img-top img-size"
                                alt="...">
                        </div>
                        <div class="card-body text-center">
                            <h5>Capuccino</h5>
                            <p class="card-text">"Sumérgete en la suavidad del Capuchino: Una danza perfecta de espresso intenso y espuma sedosa, coronada con un toque de arte en cada taza."</p>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <div class="text-center">
                            <img src="{{ asset('modules/cafeto/images/gifs/maquina-de-cafe.gif') }}"
                                class="card-img-top img-size" alt="...">
                        </div>
                        <div class="card-body text-center">
                            <h5>Deliciosos y recien salidos</h5>
                            <p class="card-text">"Tu aliada en la búsqueda de la taza perfecta. Nuestra máquina cafetera combina elegancia y precisión para ofrecerte el mejor café en cada sorbo, convirtiendo cada momento en una experiencia sensorial única."</p>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <div class="text-center">
                            <img src="{{ asset('modules/cafeto/images/gifs/cafefast.gif') }}" class="card-img-top img-size"
                                alt="...">
                        </div>
                        <div class="card-body text-center">
                            <h5>Granizado</h5>
                            <p class="card-text">"Refrescante indulgencia con un giro. Nuestro Granizado de Café fusiona la energía del café con la frescura de un deleite helado, llevando tu paladar en un emocionante paseo de sabores y texturas."</p>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <div class="text-center">
                            <img src="{{ asset('modules/cafeto/images/gifs/cafe.gif') }}" class="card-img-top img-size"
                                alt="...">
                        </div>
                        <div class="card-body text-center">
                            <h5>Campesino</h5>
                            <p class="card-text">"El corazón aromático de cada taza. Nuestras pepas de café son cuidadosamente seleccionadas y tostadas para liberar un abanico de sabores cautivadores, llevándote en un viaje desde la plantación hasta tu taza con cada exquisito sorbo."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="info-box shadow-lg">
                <span class="info-box-icon bg-olive"><i class="fa-solid fa-mug-saucer"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Nuestros Cafés</span>
                    <span class="info-box-number">Explora un mundo de sabores: Capuccino, Latte Frío, Campesino, Granizado, Americano y Cerezada.</span>
                </div>
            </div>
            <div class="info-box shadow-lg">
                <span class="info-box-icon bg-olive"><i class="fa-solid fa-mug-hot"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Servicio Personalizado</span>
                    <span class="info-box-number">Disfruta en la estación o llévalo contigo, siempre con un toque de perfección en cada taza.</span>
                </div>
            </div>
            <div class="info-box shadow-lg">
                <span class="info-box-icon bg-olive"><i class="far fa-star"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Calidad Destacada</span>
                    <span class="info-box-number">Sumérgete en la grandeza de nuestros cafés, donde cada sombra es una obra maestra.</span>
                </div>
            </div>            
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const cardCarousel = $('.card-carousel');
        const containerWidth = $('.carousel-container').width(); // Ancho del contenedor
        let animationDirection = 1; // 1 para izquierda a derecha, -1 para derecha a izquierda

        // Función para invertir la dirección de la animación
        function reverseAnimation() {
            animationDirection = -animationDirection;
            cardCarousel.css('animation-play-state', 'paused'); // Pausar la animación
            cardCarousel.css('animation-direction', animationDirection === 1 ? 'normal' : 'reverse'); // Cambiar dirección
            cardCarousel.css('transform', animationDirection === 1 ? 'translateX(0)' : `translateX(-${containerWidth}px)`); // Cambiar posición
            void cardCarousel.width(); // Forzar un reflow
            cardCarousel.css('animation-play-state', 'running'); // Reanudar la animación
        }

        // Iniciar la inversión de la animación al final de cada iteración
        cardCarousel.on('animationiteration', function() {
            reverseAnimation();
        });
    });
</script>

@endpush

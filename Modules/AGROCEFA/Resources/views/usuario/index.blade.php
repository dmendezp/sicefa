@extends('agrocefa::layouts.master')

@section('content')
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Acerca de AGROCEFA</title>
        <link rel="stylesheet" href="{{ asset('agrocefa/css/usuario/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('agrocefa/css/usuario/usuario.css') }}">
        <style>
            .hero {
                background-image: linear-gradient(180deg, #0000008c 0%, #0000008c 100%), url('{{ asset('agrocefa/images/usuario/img5.jpg') }}');
                background-size: cover;
                background-repeat: no-repeat;
                /* Evita la repetición de la imagen */
                clip-path: polygon(100% 0, 100% 82%, 51% 100%, 0 80%, 0 0);}
        </style>
    </head>

    <body>
        <!-- Navbar -->
        <header class="hero">
            <nav class="nav container">
                <img src="{{ asset('agrocefa/images/usuario/tractor.png') }}" class="logo">
                <br>
                <div class="nav_logo">
                    <h2 class="nav_title" id="inicio">AGROCEFA</h2>
                </div>
                <ul class="nav_link nav_link--menu">
                    <li class="nav_items">
                        <a href="#que_es" class="nav_links">¿Qué és?</a>
                    </li>
                    <li class="nav_items">
                        <a href="#proposito" class="nav_links">Propósito</a>
                    </li>
                    <li class="nav_items">
                        <a href="#mision" class="nav_links">Misión </a>
                    </li>
                    <li class="nav_items">
                        <a href="#vision" class="nav_links">Visión</a>
                    </li>
                    </li>
                    <li class="nav_items">
                        <a href="#codigo" class="nav_links">Otros</a>
                    </li>


                    {{-- <img src="./imagenes/svg/close.svg" class="nav_close" > --}}
                </ul>

                {{-- <div class="nav_menu">
                <img src="./imagenes/svg/menu.svg" class="nav_img">
            </div> --}}
            </nav>
            </nav>
            <section class="hero_container container">
                <h1 class="hero_title">Acerca de Agrocefa</h1>
                <p class="hero_paragraph">"Adéntrate en nuestro software y conoce el maravilloso mundo de la programación".
                </p>
            </section>
        </header>

        <section>
            <div class="knowledge_container container" id="que_es">
                <div class="knowledge_texts">
                    <h2 class="subtitle">¿Qué es AGROCEFA?</h2>
                    <p class="residuo">AGROCEFA es un software web diseñado para el control y gestión de unidades agrícolas
                        en el Centro de Formación Agroindustrial La Angostura.</p>
                </div>
                <div class="knowledge_picture">
                    <img src="{{ asset('agrocefa/images/usuario/img7.jpg') }}" class="knowledge_img">
                </div>
            </div>
        </section>


        <section class="container about" id="r">
            <h2 class="subtitle">¿Qué descubrirás en esta sección?</h2>
            <p class="about_paragraph">"Software Web AGROCEFA".</p>
            <div class="about_main">
                <article class="about_icons">
                    <img src="{{ asset('agrocefa/images/usuario/proposito.png') }}" class="about_icon">
                    <h3 class="about_title">Propósito</h3>
                    <p class="about_paragraph">Facilitar el control y gestión de unidades agrícolas de Centro de Formación.</p>
                    <button id="verMasBoton">Ver Más</button>
                </article>
                <article class="about_icons">
                    <img src="{{ asset('agrocefa/images/usuario/mision.png') }}" class="about_icon">
                    <h3 class="about_title">Misión</h3>
                    <p class="about_paragraph">Apoyar tanto a aprendices como a instructores en la formación teórica y práctica.</p>
                    <button id="verMasBotonn"><a>Ver Más</a></button>
                </article>
                <article class="about_icons">
                    <img src="{{ asset('agrocefa/images/usuario/vision.png') }}" class="about_icon">
                    <h3 class="about_title">Visión</h3>
                    <p class="about_paragraph">Convertirse en la herramienta líder en la gestión agrícola en el Centro de Formación.</p>
                    <button><a>Ver Más</a></button>
                </article>
            </div>
        </section>
        
        <section>
            <div class="knowledge_container container" id="proposito">
                <div class="knowledge_picture">
                    <img src="{{ asset('agrocefa/images/usuario/img8.png') }}" class="knowledge_img">
                </div>
                <div class="knowledge_texts">
                    <h2 class="subtitle">PROPÓSITO AGROCEFA</h2>
                    <p class="residuo">AGROCEFA tiene como objetivo principal 
                        simplificar y mejorar la gestión de las unidades agrícolas 
                        dentro del Centro de Formación Agroindustrial La Angostura. 
                        Para lograrlo, se propone:</p>
                </div>
                
            </div>
        </section>

        <section class="testimony"  id="clasificacion">
        <div class="testimony_container container">
            <img src="{{ asset('agrocefa/images/usuario/izquierda.svg') }}" class="testimony_arrow" id="before">
<!-- Facilitar el Control -->
            <section class="testimony_body  testimony_body--show" data-id="1">
                <div class="testimony_texts">
                    <h2 class="subtitle">Facilitar el Control</h2>
                        <p class="testimony_review">AGROCEFA permite un control efectivo al proporcionar herramientas para supervisar y monitorear todas las actividades agrícolas en tiempo real. Esto incluye un seguimiento minucioso de los recursos utilizados, como insumos y mano de obra.</p></div>
                <figure class="testimony_picture">
                    <img src="{{ asset('agrocefa/images/usuario/tractor.jpg') }}" class="testimony_img">
                </figure>
            </section>
<!-- Optimizar la Gestión -->
            <section class="testimony_body" data-id="2">
                <div class="testimony_texts">
                    <h2 class="subtitle">Optimizar la Gestión</h2>
                        <p class="testimony_review">El software ofrece una plataforma integral que abarca desde el registro hasta la gestión de datos críticos relacionados con las operaciones agrícolas. Esto abarca desde la planificación de cultivos hasta la cosecha, lo que permite una toma de decisiones más precisa.</p>
                </div>
                <figure class="testimony_picture">
                    <img src="{{ asset('agrocefa/images/usuario/espiga.jpg') }}" class="testimony_img">
                </figure>
            </section>
<!-- Centralizar la Información -->
            <section class="testimony_body" data-id="3">
                <div class="testimony_texts">
                    <h2 class="subtitle">Centralizar la Información</h2>
                        <p class="testimony_review">AGROCEFA centraliza la información esencial relacionada con las actividades agrícolas en un solo lugar accesible. Esto significa que tanto instructores como aprendices pueden acceder a datos actualizados y relevantes en cualquier momento, mejorando la comunicación y la coordinación.</p>
                </div>
                <figure class="testimony_picture">
                    <img src="{{ asset('agrocefa/images/usuario/arroz.jpg') }}" class="testimony_img">
                </figure>
            </section>
<!-- Mejorar la Eficiencia -->
            <section class="testimony_body" data-id="4">
                <div class="testimony_texts">
                    <h2 class="subtitle">Mejorar la Eficiencia</h2>
                        <p class="testimony_review">Al simplificar la gestión agrícola, AGROCEFA reduce la carga de trabajo administrativo y evita la duplicación de esfuerzos. Esto permite a los usuarios enfocarse en tareas críticas para el éxito de las unidades agrícolas.</p>
                </div>
                <figure class="testimony_picture">
                    <img src="{{ asset('agrocefa/images/usuario/naranja.jpg') }}" class="testimony_img">
                </figure>
            </section>
<!-- Apoyar la Formación -->
            <section class="testimony_body" data-id="5">
                <div class="testimony_texts">
                    <h2 class="subtitle">Apoyar la Formación</h2>
                        <p class="testimony_review">GROCEFA se utiliza como una herramienta educativa para los aprendices del centro. Proporciona una plataforma práctica para aprender sobre las mejores prácticas agrícolas y desarrollar habilidades en un entorno real.</p>
                </div>
                <figure class="testimony_picture">
                    <img src="{{ asset('agrocefa/images/usuario/tierra.jpg') }}" class="testimony_img">
                </figure>
            </section>
            <img src="{{ asset('agrocefa/images/usuario/derecha.svg') }}" class="testimony_arrow"  id="next">
        </div>
</section> 


{{-- mision --}}
<section>
    <div class="knowledge_container container" id="mision">
        <div class="knowledge_texts">
            <h2 class="subtitle">MISIÓN AGROCEFA</h2>
            <p class="residuo">Apoyar tanto a aprendices como a instructores 
                en la formación teórica y práctica en el campo de la agricultura, 
                promoviendo la eficiencia y el control en la 
                gestión de las actividades agrícolas en el centro.</p>
        </div>
        <div class="knowledge_pictures">
            <div class="image-container">
                <img src="{{ asset('agrocefa/images/usuario/img9.jpg') }}" class="knowledge_img1" id="imagen1">
                <img src="{{ asset('agrocefa/images/usuario/img10.jpg') }}" class="knowledge_img2" id="imagen2">
            </div>
        </div>
    </div>
</section>

<!-- Imagen del cerco horizontal -->
<img src="{{ asset('agrocefa/images/usuario/hoja.png') }}" alt="Cerco Horizontal" class="cerco-horizontal">


<!-- vision -->
<section class="knowledge" id="vision">
    <div class="knowledge_container container">
        <figure class="knowledge_picture">
            <img src="{{ asset('agrocefa/images/usuario/img10.jpg') }}" alt="" class="knowledge_img">
        </figure>
        <div class="knowledge_texts">
            <h2 class="subtitle">Vision AGROCEFA</h2>
            <p class="knowledge_paragraph">Convertirse en la herramienta líder en la 
                gestión agrícola en centros de formación, ofreciendo constantemente 
                nuevas funcionalidades y adaptándose a las necesidades cambiantes 
                de la agricultura moderna.</p>
            
        </div>
    </div>
        </section>






    </body>


    {{-- script para los objetivos de agrocefa --}}
    <script>(function(){

        const sliders = [...document.querySelectorAll('.testimony_body')];
        const buttonNext =document.querySelector('#next');
        const buttonBefore =document.querySelector('#before');
        let value;
        
    
        buttonNext.addEventListener('click',()=>{
            changePosition(1);
        });
        
        buttonBefore.addEventListener('click',()=>{7
            changePosition(-1);
        });
    
        const changePosition = (add)=>{
            const currentTestimony = document.querySelector('.testimony_body--show').dataset.id;
            value = Number(currentTestimony);
            value+= add;
    
    
            sliders[Number(currentTestimony)-1].classList.remove('testimony_body--show');
            if(value === sliders.length+1 || value === 0){
                value = value === 0 ? sliders.length : 1;
            }
    
            sliders[value-1].classList.add('testimony_body--show');
        }
    
    })();</script>

    {{-- script para proposito --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Buscar el botón por su identificador
            var verMasBoton = document.getElementById("verMasBoton");
    
            // Agregar un controlador de eventos al botón
            verMasBoton.addEventListener("click", function() {
                // Encontrar la posición de la sección de propósito
                var proposito = document.getElementById("proposito");
    
                // Realizar un desplazamiento suave hasta la sección de propósito
                if (proposito) {
                    proposito.scrollIntoView({ behavior: "smooth" });
                }
            });
        });
    </script>

    {{-- script para mision --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Buscar el botón por su identificador
            var verMasBoton = document.getElementById("verMasBotonn");
    
            // Agregar un controlador de eventos al botón
            verMasBoton.addEventListener("click", function() {
                // Encontrar la posición de la sección de propósito
                var proposito = document.getElementById("mision");
    
                // Realizar un desplazamiento suave hasta la sección de propósito
                if (proposito) {
                    proposito.scrollIntoView({ behavior: "smooth" });
                }
            });
        });
    </script>
    
    

<script>
$(document).ready(function() {
    $("#imagen1").hover(function() {
        $(this).css("opacity", "0"); // Oculta la primera imagen
        $("#imagen2").css("opacity", "1"); // Muestra la segunda imagen
    }, function() {
        $(this).css("opacity", "1"); // Restaura la primera imagen cuando se quita el cursor
        $("#imagen2").css("opacity", "0"); // Oculta la segunda imagen cuando se quita el cursor
    });
});
</script>



    </html>
    
@endsection


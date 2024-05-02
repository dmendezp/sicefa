@extends('agrocefa::layouts.master')
<link rel="stylesheet" href="{{ asset('modules/agrocefa/css/usuario/usuario.css') }}">
<link rel="stylesheet" href="{{ asset('modules/agrocefa/css/usuario/normalize.css') }}">
@section('content')
    <html lang="es">

    <head>
        <title>Acerca de AGROCEFA</title>
        <style>
            .hero {
                width: 115%;
                background-image: linear-gradient(180deg, #0000008c 0%, #0000008c 100%), url('{{ asset('modules/agrocefa/images/usuario/img5.jpg') }}');
                background-size: cover;
                background-repeat: no-repeat;
                /* Evita la repetición de la imagen */
                clip-path: polygon(100% 0, 100% 82%, 51% 100%, 0 80%, 0 0);
            }
        </style>
    </head>
    <main>

        <body>
            <!-- Navbar -->
            <header class="hero">
                <nav class="nav container">
                    <img src="{{ asset('modules/agrocefa/images/usuario/tractor.png') }}" class="logo">
                    <br>
                    <div class="nav_logo">
                        <h2 class="nav_title" id="inicio">AGROCEFA</h2>
                    </div>
                    <ul class="nav_link nav_link--menu">
                        <li class="nav_items">
                            <a href="#que_es" class="nav_links">{{trans('agrocefa::vusuario.What is it?')}}</a>
                        </li>
                        <li class="nav_items">
                            <a href="#proposito" class="nav_links">{{trans('agrocefa::vusuario.Purpose')}}</a>
                        </li>
                        <li class="nav_items">
                            <a href="#mision" class="nav_links">{{trans('agrocefa::vusuario.Mission')}}</a>
                        </li>
                        <li class="nav_items">
                            <a href="#vision" class="nav_links">{{trans('agrocefa::vusuario.Vision')}}</a>
                        </li>
                        </li>
                        <li class="nav_items">
                            <a href="#otros" class="nav_links">{{trans('agrocefa::vusuario.Others')}}</a>
                        </li>
                        <img src="{{ asset('modules/agrocefa/images/usuario/close.svg') }}" class="nav_close" >
                    </ul>
                    <img src="{{ asset('modules/agrocefa/images/usuario/menu.svg') }}" class="nav_close" >
                </nav>
                </nav>
                <section class="hero_container container">
                    <h1 class="hero_title">{{trans('agrocefa::vusuario.About Agrocefa')}}</h1>
                    <p class="hero_paragraph">{{trans('agrocefa::vusuario.Delve into our software and discover the wonderful world of programming')}}
                    </p>
                </section>
            </header>
            <section>
                <div class="knowledge_container container" id="que_es">
                    <div class="knowledge_texts">
                        <h2 class="subtitle">{{trans('agrocefa::vusuario.What is AGROCEFA?')}}</h2>
                        <p class="residuo">{{trans('agrocefa::vusuario.AGROCEFA is a web software designed for the control and management of agricultural units at the La Angostura Agroindustrial Training Center.')}}</p>
                    </div>
                    <div class="knowledge_picture">
                        <img src="{{ asset('modules/agrocefa/images/usuario/img7.jpg') }}" class="knowledge_img">
                    </div>
                </div>
            </section>
            <section class="container about" id="r">
                <h2 class="subtitle"><img src="{{ asset('modules/agrocefa/images/usuario/hoja.png') }}" alt="Cerco Horizontal"
                        class="cerco-horizontal">{{trans('agrocefa::vusuario.What will you discover in this section?')}}<img
                        src="{{ asset('modules/agrocefa/images/usuario/hoja.png') }}" alt="Cerco Horizontal"
                        class="cerco-horizontal">
                </h2>
                <p class="about_paragraph">{{trans('agrocefa::vusuario.AGROCEFA Web Software')}}</p>
                <div class="about_main">
                    <article class="about_icons">
                        <img src="{{ asset('modules/agrocefa/images/usuario/proposito.png') }}" class="about_icon">
                        <h3 class="about_title">{{trans('agrocefa::vusuario.Purpose')}}</h3>
                        <p class="about_paragraph">{{trans('agrocefa::vusuario.Facilitate the control and management of agricultural units of the Training Center.')}}
                        </p>
                        <button id="verMasBoton">{{trans('agrocefa::vusuario.see more')}}</button>
                    </article>
                    <article class="about_icons">
                        <img src="{{ asset('modules/agrocefa/images/usuario/mision.png') }}" class="about_icon">
                        <h3 class="about_title">{{trans('agrocefa::vusuario.Mission')}}</h3>
                        <p class="about_paragraph">{{trans('agrocefa::vusuario.Support both trainees and instructors in theoretical and practical training.')}}</p>
                        <button id="verMasBotonn"><a>{{trans('agrocefa::vusuario.see more')}}</a></button>
                    </article>
                    <article class="about_icons">
                        <img src="{{ asset('modules/agrocefa/images/usuario/vision.png') }}" class="about_icon">
                        <h3 class="about_title">{{trans('agrocefa::vusuario.Vision')}}</h3>
                        <p class="about_paragraph">{{trans('agrocefa::vusuario.Become the leading tool in agricultural management in the Training Center.')}}</p>
                        <button id="verMasBotonnn"><a>{{trans('agrocefa::vusuario.see more')}}</a></button>
                    </article>
                </div>
            </section>
            <section>
                <div class="knowledge_container container" id="proposito">
                    <div class="knowledge_picture">
                        <img src="{{ asset('modules/agrocefa/images/usuario/img8.png') }}" class="knowledge_img">
                    </div>
                    <div class="knowledge_texts">
                        <h2 class="subtitle"><img src="{{ asset('modules/agrocefa/images/usuario/hoja.png') }}"
                                alt="Cerco Horizontal" class="cerco-horizontal">{{trans('agrocefa::vusuario.AGROCEFA PURPOSE')}}</h2>
                        <p class="residuo">{{trans('agrocefa::vusuario.AGROCEFA is main objective is to simplify and improve the management of agricultural units within the La Angostura Agroindustrial Training Center. To achieve this, it is proposed:')}}</p>
                    </div>
                </div>
            </section>
            <section class="testimony" id="clasificacion">
                <div class="testimony_container container">
                    <img src="{{ asset('modules/agrocefa/images/usuario/izquierda.svg') }}" class="testimony_arrow" id="before">
                    <!-- Facilitar el Control -->
                    <section class="testimony_body  testimony_body--show" data-id="1">
                        <div class="testimony_texts">
                            <h2 class="subtitle">{{trans('agrocefa::vusuario.Facilitate Control')}}</h2>
                            <p class="testimony_review">{{trans('agrocefa::vusuario.AGROCEFA enables effective control by providing tools to supervise and monitor all agricultural activities in real time. This includes careful monitoring of resources used, such as supplies and labor.')}}</p>
                        </div>
                        <figure class="testimony_picture">
                            <img src="{{ asset('modules/agrocefa/images/usuario/tractor.jpg') }}" class="testimony_img">
                        </figure>
                    </section>
                    <!-- Optimizar la Gestión -->
                    <section class="testimony_body" data-id="2">
                        <div class="testimony_texts">
                            <h2 class="subtitle">{{trans('agrocefa::vusuario.Optimize Management')}}</h2>
                            <p class="testimony_review">{{trans('agrocefa::vusuario.The software offers a comprehensive platform that ranges from registration to management of critical data related to agricultural operations. This ranges from crop planning to harvesting, allowing for more accurate decision making.')}}</p>
                        </div>
                        <figure class="testimony_picture">
                            <img src="{{ asset('modules/agrocefa/images/usuario/espiga.jpg') }}" class="testimony_img">
                        </figure>
                    </section>
                    <!-- Centralizar la Información -->
                    <section class="testimony_body" data-id="3">
                        <div class="testimony_texts">
                            <h2 class="subtitle">{{trans('agrocefa::vusuario.Centralize Information')}}</h2>
                            <p class="testimony_review">{{trans('agrocefa::vusuario.AGROCEFA centralizes essential information related to agricultural activities in a single accessible place. This means that both instructors and trainees can access up-to-date and relevant data at any time, improving communication and coordination.')}}</p>
                        </div>
                        <figure class="testimony_picture">
                            <img src="{{ asset('modules/agrocefa/images/usuario/arroz.jpg') }}" class="testimony_img">
                        </figure>
                    </section>
                    <!-- Mejorar la Eficiencia -->
                    <section class="testimony_body" data-id="4">
                        <div class="testimony_texts">
                            <h2 class="subtitle">{{trans('agrocefa::vusuario.Improve the eficiency')}}</h2>
                            <p class="testimony_review">{{trans('agrocefa::vusuario.By simplifying agricultural management, AGROCEFA reduces the administrative workload and avoids duplication of efforts. This allows users to focus on tasks critical to the success of agricultural units.')}}</p>
                        </div>
                        <figure class="testimony_picture">
                            <img src="{{ asset('modules/agrocefa/images/usuario/naranja.jpg') }}" class="testimony_img">
                        </figure>
                    </section>
                    <!-- Apoyar la Formación -->
                    <section class="testimony_body" data-id="5">
                        <div class="testimony_texts">
                            <h2 class="subtitle">{{trans('agrocefa::vusuario.Support Training')}}</h2>
                            <p class="testimony_review">{{trans('agrocefa::vusuario.AGROCEFA is used as an educational tool for center apprentices. It provides a practical platform for learning about best agricultural practices and developing skills in a real-world environment.')}}</p>
                            </div>
                        <figure class="testimony_picture">
                            <img src="{{ asset('modules/agrocefa/images/usuario/tierra.jpg') }}" class="testimony_img">
                        </figure>
                    </section>
                    <img src="{{ asset('modules/agrocefa/images/usuario/derecha.svg') }}" class="testimony_arrow"
                        id="next">
                </div>
            </section>
            {{-- mision --}}
            <section>
                <div class="knowledge_container container" id="mision">
                    <div class="knowledge_texts">
                        <h2 class="subtitle"><img src="{{ asset('modules/agrocefa/images/usuario/hoja.png') }}"
                                alt="Cerco Horizontal" class="cerco-horizontal">{{trans('agrocefa::vusuario.AGROCEFA MISSION')}}</h2>
                        <p class="residuo">{{trans('agrocefa::vusuario.Support both apprentices and instructors in theoretical and practical training in the field of agriculture, promoting efficiency and control in the management of agricultural activities at the center.')}}</p>
                    </div>
                    <div class="knowledge_pictures">
                        <div class="image-container">
                            <img src="{{ asset('modules/agrocefa/images/usuario/img9.jpg') }}" class="knowledge_img1"
                                id="imagen1">
                            <img src="{{ asset('modules/agrocefa/images/usuario/img10.jpg') }}" class="knowledge_img2"
                                id="imagen2">
                        </div>
                    </div>
                </div>
            </section>
            <!-- vision -->
            <section class="knowledge" id="vision">
                <div class="knowledge_container container">
                    <figure class="knowledge_picture">
                        <div class="knowledge_pictures">
                            <div class="image-container">
                                <img src="{{ asset('modules/agrocefa/images/usuario/img6.jpg') }}" class="knowledge_img1"
                                    id="imagen1">
                                <img src="{{ asset('modules/agrocefa/images/usuario/img11.jpg') }}" class="knowledge_img2"
                                    id="imagen2">
                            </div>
                    </figure>
                    <div class="knowledge_texts">
                        <h2 class="subtitle">
                            <img src="{{ asset('modules/agrocefa/images/usuario/hoja.png') }}" alt="Cerco Horizontal"
                                class="cerco-horizontal">
                                {{trans('agrocefa::vusuario.AGROCEFA VISION')}}
                        </h2>
                        <p class="knowledge_paragraph">{{trans('agrocefa::vusuario.To become the leading tool in agricultural management in the training center, constantly offering new functionalities and adapting to the changing needs of modern agriculture.')}}</p>
                    </div>
                </div>
            </section>
            <!-- Características Adicionales de AGROCEFA -->
            <section class="price container" id="otros">
                <h2 class="subtitle"><img src="{{ asset('modules/agrocefa/images/usuario/hoja.png') }}" alt="Cerco Horizontal"
                        class="cerco-horizontal"> {{trans('agrocefa::vusuario.Additional Features of AGROCEFA')}}<img
                        src="{{ asset('modules/agrocefa/images/usuario/hoja.png') }}" alt="Cerco Horizontal"
                        class="cerco-horizontal"></h2>
                <div class="price_table">
                    <div class="price_element price_element--beste">
                        <div class="cardc-container">
                            <div class="cardc">
                                <div class="front-content">
                                    <p>{{trans('agrocefa::vusuario.Cost tracking')}}</p>
                                </div>
                                <div class="content">
                                    <p>
                                        {{trans('agrocefa::vusuario.AGROCEFA allows users to calculate and control the expenses associated with each agricultural activity, from planting to harvesting.')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="price_element price_element--beste">
                        <div class="cardc-container">
                            <div class="cardc">
                                <div class="front-content">
                                    <p>{{trans('agrocefa::vusuario.Crop Rotation Planning')}}</p>
                                </div>
                                <div class="content">
                                    <p>
                                        {{trans('agrocefa::vusuario.It facilitates the planning and management of crop rotations, helping to improve soil fertility and prevent plant diseases.')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="price_element price_element--beste">
                        <div class="cardc-container">
                            <div class="cardc">
                                <div class="front-content">
                                    <p>{{trans('agrocefa::vusuario.Alerts and Notifications')}}</p>
                                </div>
                                <div class="content">
                                    <p>{{trans('agrocefa::vusuario.AGROCEFA offers automated alerts and notifications to remind you of important tasks, such as irrigation, fertilizer applications or harvest dates.')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="price_table">
                        <div class="price_element price_element--beste">
                            <div class="cardc-container">
                                <div class="cardc">
                                    <div class="front-content">
                                        <p>{{trans('agrocefa::vusuario.Crop History')}}</p>
                                    </div>
                                    <div class="content">
                                        <p>
                                            {{trans('agrocefa::vusuario.It allows users to keep a detailed history of each crop, making it easy to analyze trends and make decisions based on historical data.')}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="price_element price_element--beste">
                            <div class="cardc-container">
                                <div class="cardc">
                                    <div class="front-content">
                                        <p>{{trans('agrocefa::vusuario.Report generation')}}</p>
                                    </div>
                                    <div class="content">
                                        <p>
                                            {{trans('agrocefa::vusuario.AGROCEFA generates customizable reports that summarize the performance of agricultural units, facilitating evaluation and analysis.')}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="price_element price_element--beste">
                            <div class="cardc-container">
                                <div class="cardc">
                                    <div class="front-content">
                                        <p>{{trans('agrocefa::vusuario.Mobile Access')}}</p>
                                    </div>
                                    <div class="content">
                                        <p>{{trans('agrocefa::vusuario.Users can access AGROCEFA from mobile devices, allowing them to manage agricultural activities on the go.')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
            </section>
        </body>
        @include('agrocefa::partials.footer')
    </main>

    {{-- script para los objetivos de agrocefa --}}
    <script>
        (function() {

            const sliders = [...document.querySelectorAll('.testimony_body')];
            const buttonNext = document.querySelector('#next');
            const buttonBefore = document.querySelector('#before');
            let value;


            buttonNext.addEventListener('click', () => {
                changePosition(1);
            });

            buttonBefore.addEventListener('click', () => {
                7
                changePosition(-1);
            });

            const changePosition = (add) => {
                const currentTestimony = document.querySelector('.testimony_body--show').dataset.id;
                value = Number(currentTestimony);
                value += add;


                sliders[Number(currentTestimony) - 1].classList.remove('testimony_body--show');
                if (value === sliders.length + 1 || value === 0) {
                    value = value === 0 ? sliders.length : 1;
                }

                sliders[value - 1].classList.add('testimony_body--show');
            }

        })();
    </script>

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
                    proposito.scrollIntoView({
                        behavior: "smooth"
                    });
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
                    proposito.scrollIntoView({
                        behavior: "smooth"
                    });
                }
            });
        });
    </script>

    {{-- script para vision --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Buscar el botón por su identificador
            var verMasBoton = document.getElementById("verMasBotonnn");

            // Agregar un controlador de eventos al botón
            verMasBoton.addEventListener("click", function() {
                // Encontrar la posición de la sección de propósito
                var proposito = document.getElementById("vision");

                // Realizar un desplazamiento suave hasta la sección de propósito
                if (proposito) {
                    proposito.scrollIntoView({
                        behavior: "smooth"
                    });
                }
            });
        });
    </script>



    {{-- estilo de las imagenes --}}
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

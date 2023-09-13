@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a la vista desarrolladores</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            text-align: center;
        }

        /* Carrusel */
        .carousel {
           max-width: 1500px; /* Ancho máximo igual al ancho de las imágenes */
           max-height: 800px; /* Reducir el alto del carrusel */
           margin: 0 auto; /* Centrar el carrusel horizontalmente */
           overflow: hidden;
           position: relative;
        }


        .carousel-container {
            display: flex;
            overflow: hidden;
        }

        .carousel img {
            max-width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease-in-out;
        }

        /* Tarjetas */
        .card-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin: 20px;
        }
        /* Estilos para las tarjetas */
        .developer-card {
            background-color: #ecd8d800;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0);
            max-width: calc(25% - 20px);
            margin: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.2s; /* Agregamos una transición a la propiedad transform */
            border-radius: 15%; /* Forma de semi círculo */
        }

/* Agregamos el efecto de escala en hover */
.developer-card:hover {
    transform: scale(1.05); /* Escalar la tarjeta en un 5% más grande en hover */
}


        .developer-card {
            background-color: #ecd8d800;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0);
            max-width: calc(25% - 20px);
            margin: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.2s;
            border-radius: 15%; /* Forma de semi círculo */
        }

        .developer-card img {
            width: 250px; /* Ancho fijo para las imágenes */
            height: 250px; /* Altura fija para todas las imágenes */
            border-radius: 25%; /* Forma de semi círculo */
            margin-bottom: 10px;
        }

        h1 {
            font-size: 24px;
            margin-top: 10px;
        }

        p {
            font-size: 16px;
            margin-top: 10px;
        }

        /* Botón de herramientas */
        .tools-button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin: 10px auto;
            border-radius: 0%; /* Forma de semi círculo */
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 24px;
            transform: translateY(-50%);
            display: block;
        }

        .tools-button:hover {
            background-color: #0056b3;
        }

        /* Estilos para ocultar la lista de herramientas al principio */
        .hidden {
            display: none;
        }

        /* Estilos para la lista de herramientas */
        <!-- Estilos para la tabla de imágenes -->
        .tools-table {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .tools-table img {
            max-width: 50px; /* Ancho máximo de las imágenes */
            margin: 0 10px; /* Espacio entre las imágenes */
        }

    </style>
</head>
<body>
    <p>Desarrolladores</p>
    <div class="carousel">
        <div class="carousel-container">
            <img src="{{ asset('agrocefa/images/desar/centro.jpg') }}" class="knowledge_img">
            <img src="{{ asset('agrocefa/images/desar/caru2.jpg') }}" class="knowledge_img">   
            <img src="{{ asset('agrocefa/images/desar/.jpg') }}" class="knowledge_img">
            <img src="{{ asset('agrocefa/images/desar/.jpg') }}" class="knowledge_img">
        </div>
    </div>
    
    <div class="carousel-container">
        <button class="carousel-button" onclick="prevSlide()">&#10094;</button>
        <button class="carousel-button" onclick="nextSlide()">&#10095;</button>
    </div>

    <div class="card-container">
        <div class="developer-card">
            <img src="{{ asset('agrocefa/images/desar/caru.jpg') }}" class="knowledge_img">
            <h1>Andres Almario</h1>
        </div>

        <div class="developer-card">
            <img src="{{ asset('agrocefa/images/desar/yaya.jpg') }}" class="knowledge_img">   
            <h1>Dayana Valenzuela</h1>
        </div>

        <div class="developer-card">
            <img src="{{ asset('agrocefa/images/desar/sapuy.jpg') }}" class="knowledge_img">
            <h1>Yuderly Sapuy</h1>
        </div>

        <div class="developer-card">
            <img src="{{ asset('agrocefa/images/desar/.jpg') }}" class="knowledge_img">
            <h1>Laura Rodriguez</h1>
        </div>
    </div>

    <button class="tools-button" onclick="showTools()">herramientas uttlizadas para el desarrollo</button>

    <div class="tools-list hidden">
        <h2>Herramientas Utilizadas:</h2>
        <div class="tools-table">
            <img src="ruta-de-la-imagen-1.jpg" alt="Herramienta 1">
            <img src="ruta-de-la-imagen-2.jpg" alt="Herramienta 2">
            <img src="ruta-de-la-imagen-3.jpg" alt="Herramienta 3">
            <!-- Agrega más imágenes según sea necesario -->
        </div>
    </div>
    

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel img');

        function showSlide(index) {
            if (index < 0) {
                index = slides.length - 1;
            } else if (index >= slides.length) {
                index = 0;
            }

            slides.forEach((slide) => {
                slide.style.transform = 'translateX(-' + (index * 100) + '%)';
            });

            currentSlide = index;
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function showTools() {
            const toolsList = document.querySelector('.tools-list');
            toolsList.classList.toggle('hidden');
        }
    </script>
</body>
</html>
@endsection

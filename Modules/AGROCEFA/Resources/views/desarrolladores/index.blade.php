@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a la vista desarrolladores</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-JCHmOKJsZwJzoyY9vgZKLDjp/0sopofWt3IkL5uaz5PzU2Oyj8S+oUi7vQ34lX5wWcHhV1xVfQw28RfWb5NzZsQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            text-align: center;
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
            background-color: #07000000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0);
            max-width: calc(25% - 20px);
            margin: 20px;
            padding: 5px;
            text-align: center;
            transition: transform 0.2s; /* Agregamos una transición a la propiedad transform */
            border-radius: 10%; /* Forma de semi círculo */
        }

        /* Agregamos el efecto de escala en hover */
            .developer-card:hover {
            transform: scale(1.05); /* Escalar la tarjeta en un 5% más grande en hover */
        }

        .developer-card img {
            width: 251.9px; 
            height: 400px;      
            border-radius: 15.9%; 
            margin-bottom: 4%;
        }

        h1 {
            font-size: 24px;
            margin-top: 10px;
        }


        /* Botón de herramientas */
        .glitch-button {
            padding: 10px 50px;
            font-size: 20px;
            border: none;
            border-radius: 5px;
            color: #fffafa; /* Letras en negro */
            background: linear-gradient(to right, #004916, #009688); /* Degradado similar al del pie de página */
            position: relative;
            overflow: hidden;
            margin-top: 40px;
            margin-bottom: 50px; /* Ajusta el margen inferior según sea necesario */
        }

        .glitch-button::after {
            --move1: inset(50% 50% 50% 50%);
            --move2: inset(31% 0 40% 0);
            --move3: inset(39% 0 15% 0);
            --move4: inset(45% 0 40% 0);
            --move5: inset(45% 0 6% 0);
            --move6: inset(14% 0 61% 0);
            clip-path: var(--move1);
            content: 'GLITCH';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: block;
        }

        .glitch-button:hover::after {
            animation: glitch_4011 1s;
            text-shadow: 10px 10px 10px black;
            animation-timing-function: steps(2, end);
            text-shadow: -3px -3px 0px black, 3px 3px 0px black;
            background-color: transparent;
            border: 3px solid rgb(0, 0, 0);
        }

        .glitch-button:hover {
            text-shadow: -1px -1px 0px black, 1px 1px 0px ;
            background: linear-gradient(to right, #004916, #009688); /* Degradado similar al del pie de página */
            border: 1px solid rgba(0, 0, 0, 0.922);
            box-shadow: 0px 10px 10px -10px rgb(0, 0, 0);
        }

        /* Estilos para la tabla y los iconos */
        .hidden {
            display: none;
        }

        .tools-table {
            display: table;
            width: 100%;
        }

        .icon-row {
            display: table-row;
        }

        .icono-grande {
            font-size: 10em; /* Ajusta el tamaño de los iconos  */
            margin: 10px;   
        }

        /* Estilo para la imagen de abajo */
        .tuclase {
            text-align: center;
            font-family: 'Comic Sans MS', sans-serif;
            font-weight: bold;
            font-size: 100px;
            color: #19aa05;
            text-shadow: -1px 0 #414D68, 0 1px #414D68, 1px 0 #414D68, 0 -1px #414D68, -2px 2px 0 #414D68, 2px 2px 0 #414D68, 1px 1px #414D68, 2px 2px #414D68, 3px 3px #414D68, 4px 4px #414D68, 5px 5px #414D68;
        }

        /* Estilo para los iconos */
        .icono-grande {
            font-size: 100px; 
            margin: 20px; 
        }

    </style>
</head>
<body>
   
    <!-- Título con imagen curvada -->
    <h1 class="curved-title tuclase">{{ trans('agrocefa::desarrolladores.Developers')}}</h1>

    <div class="card-container">
        <div class="developer-card">
            <img src="{{ asset('agrocefa/images/desar/mario.jpg') }}" class="knowledge_img">
            <h1>Andres Felipe Almario</h1>
        </div>

        <div class="developer-card">
            <img src="{{ asset('agrocefa/images/desar/ya.jpg') }}" class="knowledge_img">   
            <h1>Dayana Valenzuela</h1>
        </div>

        <div class="developer-card">
            <img src="{{ asset('agrocefa/images/desar/sapuy.jpg') }}" class="knowledge_img">
            <h1>Yuderly Sapuy</h1>
        </div>

        <div class="developer-card">
            <img src="{{ asset('agrocefa/images/desar/lau.jpg') }}" class="knowledge_img">
            <h1>Laura Rodriguez</h1>
        </div>
    </div>

    <button class="btn glitch-button" onclick="showTools()" style="margin-bottom: 10px;">{{ trans('agrocefa::desarrolladores.Tools used for development')}}</button>
    <br>
    <br>
    
    <div class="hidden">
        <div class="tools-table">
            <div class="icon-row">
                <i class="fab fa-html5 icono-grande" title="HTML"></i>
                <i class="fab fa-js icono-grande" title="JavaScript"></i>
                <i class="fab fa-php icono-grande" title="PHP"></i>
                <i class="fab fa-laravel icono-grande" title="Laravel"></i>
            </div>
            <div class="icon-row">
                <i class="fab fa-bootstrap icono-grande" title="Bootstrap"></i>
                <i class="fab fa-css3 icono-grande" title="CSS"></i>
                <i class="fab fa-git icono-grande" title="Git"></i>
                <i class="fas fa-comment-alt icono-grande" title="Chat GPT"></i>
            </div>
        </div>
    </div>
    
    <script>
        function showTools() {
            const toolsList = document.querySelector('.hidden');
            toolsList.classList.toggle('hidden');
        }
    </script>
    @include('agrocefa::partials.footer')
</body>
</html>
@endsection

@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Página de Desarrolladores</title>
    <style>
        /* Estilos CSS en línea */
        body {
            font-family: Arial, sans-serif;
            background-color: #eff3ec;
            margin: 0;
            padding: 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            background-color: #f9fbfa;
            padding: 20px;
            border: 1px solid #fdfffe;
        }

        header {
            text-align: center;
            color: #18bd1b;
            padding: 20px 0;
        }

        /* Estilos para las tarjetas */
        .card {
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 5%; /* Hace que la tarjeta sea redonda */
            overflow: hidden;
            margin: 20px;
            display: inline-block;
            transition: transform 0.3s ease; /* Agrega una transición  */
        }

        .card img {
            width: 150%;
            height: auto;
        }

        /* Estilo cuando por ensima de la tarjeta */
        .card:hover {
            transform: scale(1.8); /* Escala la tarjeta para que la targeta aumente y dismiñuya su tamalo */
        }

        /* Estilo para el contenido desplegable */
        .content {
            display: none;
        }

        /* Estilo para  mostrar/ocultar */
        .toggle-link {
            text-decoration: underline;
            color: rgb(83, 4, 186);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h2>Biqnvenido a la sección de Desarroladores</h2>
    </header>   
    
    <main>
        <h3>Contenido para Desarrolladors</h3>
        <!--modificar para poder ver la imagen de cada desarrollador-->
        <!-- Tarjeta 1 -->

        <div class="card">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/003/492/377/small/closeup-male-studio-portrait-of-happy-man-looking-at-the-camera-image-free-photo.jpg" alt="Imagen 1">
            <p class="toggle-link" onclick="toggleContent(this)">andres felipe almario</p>
            <div class="content">
                <p></p>
            </div>
        </div>
        
        <!-- Tarjeta 2 -->
        <div class="card">
            <img src="https://img.freepik.com/foto-gratis/como-puedo-ayudarte-suave-encantador-cabello-rizado-encantador-joven-tomar-manos-bolsillos-pantalones-vaqueros-confianza-amistosa-sonrisa-inclinando-cabeza-escuchar-al-cliente-interesante-historia-escuchar-fondo-blanco_176420-34898.jpg?w=2000" alt="Imagen 2">
            <p class="toggle-link" onclick="toggleContent(this)">dayana marcela valenzuela</p>
            <div class="content">
                <p></p>
            </div>
        </div>
         <!-- Tarjeta 3 -->
         <div class="card">
            <img src="data:image/jpeg;base64,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" alt="Imagen 2">
            <p class="toggle-link" onclick="toggleContent(this)">yuderly sapy</p>
            <div class="content">
                <p></p>
            </div>
        </div>
         <!-- Tarjeta 4 -->
         <div class="card">
            <img src="data:image/jpeg;base64,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" alt="Imagen 2">
            <p class="toggle-link" onclick="toggleContent(this)">laura rodriguez</p>
            <div class="content">
                <p></p>
            </div>
        </div>
    </main>

    <script>
        // Función para mostrar y  ocultar el contenido de la tarjeta
        //modificar el tamaño para poder ver el contenido mas grande 
        function toggleContent(link) {
            var content = link.nextElementSibling;
            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                link.innerHTML = "Ocultar Contenido";
            } else {
                content.style.display = "none";
                link.innerHTML = "Mostrar Contenido";
            }
        }
    </script>
</body>
</html>

@endsection

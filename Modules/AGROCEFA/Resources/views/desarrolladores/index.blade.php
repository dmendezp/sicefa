@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Página de Desarrolladores</title>
    <style>
        /* Estilos CSS en línea */

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
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
            border-radius: 5%;
            overflow: hidden;
            margin: 20px;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .card img {
            width: 150%;
            height: auto;
        }

        .column {
            float: left;
            width: 50%;
            padding: 0 10px;
        }

        /* Estilo cuando por encima de la tarjeta */
        .card:hover {
            transform: scale(1.1);
        }

        /* Estilo para el contenido desplegable */
        .content {
            display: none;
        }

        /* Estilo para mostrar/ocultar */
        .toggle-link {
            text-decoration: underline;
            color: rgb(83, 4, 186);
            cursor: pointer;
        }
        /* Estilos para la cuadrícula de imágenes */
.image-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 columnas */
    grid-gap: 10px; /* Espacio entre las imágenes */
    justify-content: center; /* Centrar las columnas */
    align-items: center; /* Centrar verticalmente */
    margin: 20px;
}

.grid-item img {
    max-width: 100%; /* Ajusta el tamaño de las imágenes */
    height: auto; /* Mantiene la proporción original */
}

    </style>
</head>
<body>
    <header>
        <h2>Bienvenido a la sección de Desarrolladores</h2>
    </header>

    

        <div class="column">
            <!-- Tarjeta 1 -->
            <div class="card">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/003/492/377/small/closeup-male-studio-portrait-of-happy-man-looking-at-the-camera-image-free-photo.jpg" alt="Imagen 1">
                <p class="toggle-link" onclick="toggleContent(this)">Andres Felipe Almario</p>
                <div class="content">
                    <p>Información sobre Andres Felipe Almario.</p>
                </div>
            </div>

            <!-- Tarjeta 3 -->
            <div class="card">
                <img src="yaya.jpg=" alt="Imagen 3">
                <p class="toggle-link" onclick="toggleContent(this)">Nombre del miembro 3</p>
                <div class="content">
                    <p>Información sobre el miembro 3.</p>
                </div>
            </div>
        </div>

        <div class="column">
            <!-- Tarjeta 2 -->
            <div class="card">
                <img src="sapuy.jpg" alt="Imagen 2">
                <p class="toggle-link" onclick="toggleContent(this)">Nombre del miembro 2</p>
                <div class="content">
                    <p>Información sobre el miembro 2.</p>
                </div>
            </div>

            <!-- Tarjeta 4 -->
            <div class="card">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/003/492/377/small/closeup-male-studio-portrait-of-happy-man-looking-at-the-camera-image-free-photo.jpg" alt="Imagen 4">
                <p class="toggle-link" onclick="toggleContent(this)">Nombre del miembro 4</p>
                <div class="content">
                    <p>Información sobre el miembro 4.</p>
                </div>
            </div> 
        </div>

    <script>
        function toggleContent(element) {
            var content = element.nextElementSibling;
            content.style.display = (content.style.display === "block") ? "none" : "block";
        }
    </script>
</body>
            <!--imagenes de las herramientas utilizadas-->
            <div class="container">
                <div class="image-grid">
                    <!-- Fila 1 -->
                    <div class="grid-item">
                        <img src="imagen1.jpg" alt="Imagen 1">
                    </div>
                    <div class="grid-item">
                        <img src="imagen2.jpg" alt="Imagen 2">
                    </div>
                    <div class="grid-item">
                        <img src="imagen3.jpg" alt="Imagen 3">
                    </div>
                    <div class="grid-item">
                        <img src="imagen4.jpg" alt="Imagen 4">
                    </div>
            
                    <!-- Fila 2 -->
                    <div class="grid-item">
                        <img src="imagen5.jpg" alt="Imagen 5">
                    </div>
                    <div class="grid-item">
                        <img src="imagen6.jpg" alt="Imagen 6">
                    </div>
                    <div class="grid-item">
                        <img src="imagen7.jpg" alt="Imagen 7">
                    </div>
                    <div class="grid-item">
                        <img src="imagen8.jpg" alt="Imagen 8">
                    </div>
                </div>
            </div>  
</html>
</body>
</html>
@endsection
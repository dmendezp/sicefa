@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desarrolladores</title>
   
    <!-- Estilos CSS personalizados -->
    <style>
        /* Estilos para las tarjetas de desarrolladores */
        .developer-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            height: 100%; /* Altura máxima para las tarjetas */
        }
        /* Estilos para las imágenes */
        .developer-card img {
            max-width: 100%;
            height: 300px;
            width: 350px;
            object-fit: cover; /* Para mantener la relación de aspecto y recortar las imágenes */
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .credit-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            height: 90%; /* Altura máxima para las tarjetas */
            text-align: center;
        }
        /* Estilos para las imágenes */
        .credit-card img {
            max-width: 100%;
            height: 170px;
            width: 170px;
            object-fit: cover; /* Para mantener la relación de aspecto y recortar las imágenes */
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .container{
            margin-left:100px
        }
        /* Estilos para los enlaces */
        .developer-card a {
            color: #535353; /* Cambiar el color del enlace */
            text-decoration: none; /* Eliminar el subrayado */
        }
        .developer-card a:hover {
            color: #0056b3; /* Cambiar el color del enlace al pasar el ratón por encima */
            text-decoration: none; /* Mantener el subrayado eliminado */
        }

        .credit-card a {
            color: #535353; /* Cambiar el color del enlace */
            text-decoration: none; /* Eliminar el subrayado */
        }
        .credit-card a:hover {
            color: #0056b3; /* Cambiar el color del enlace al pasar el ratón por encima */
            text-decoration: none; /* Mantener el subrayado eliminado */
        }

    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5 mb-4">{{ trans('agrocefa::universal.Developers')}}</h1>
        <div class="row">
            <!-- Tarjetas de desarrolladores -->
            <div class="col-md-6 col-lg-3">
                <div class="developer-card">
                    <img src="{{ asset('modules/agrocefa/images/desar/mario.jpg') }}" alt="Andres">
                    <h5 class="text-center">Andres Felipe Almario Navarro</h5>
                    <p class="text-center">Aprendiz</p>
                    <!-- Agregar enlaces a LinkedIn y GitHub -->
                    <div class="text-center">
                        <a href="https://www.linkedin.com/in/andres-felipe-almario-178bb92b2/" target="_blank">LinkedIn</a> |
                        <a href="https://github.com/Afandres" target="_blank">GitHub</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de desarrollador 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="developer-card">
                    <img src="{{ asset('modules/agrocefa/images/desar/ya.jpg') }}" alt="Dayana">
                    <h5 class="text-center">Dayana Marcela Valenzuela Erazo</h5>
                    <p class="text-center">Aprendiz</p>
                    <!-- Agregar enlaces a LinkedIn y GitHub -->
                    <div class="text-center">
                        <a href="#" target="_blank">LinkedIn</a> |
                        <a href="https://github.com/Yayis24" target="_blank">GitHub</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de desarrollador 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="developer-card">
                    <img src="{{ asset('modules/agrocefa/images/desar/sapuy.jpg') }}" alt="Yuderly">
                    <h5 class="text-center">Yuderly Sapuy Chavarro</h5>
                    <p class="text-center">Aprendiz</p>
                    <!-- Agregar enlaces a LinkedIn y GitHub -->
                    <div class="text-center">
                        <a href="#" target="_blank">LinkedIn</a> |
                        <a href="https://github.com/DerlySapuy27" target="_blank">GitHub</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de desarrollador 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="developer-card">
                    <img src="{{ asset('modules/agrocefa/images/desar/lau.jpg') }}" alt="Laura">
                    <h5 class="text-center">Laura Vanesa Rodriguez Chimbaco</h5>
                    <p class="text-center">Aprendiz</p>
                    <!-- Agregar enlaces a LinkedIn y GitHub -->
                    <div class="text-center">
                        <a href="#" target="_blank">LinkedIn</a> |
                        <a href="https://github.com/vlaurac" target="_blank">GitHub</a>
                    </div>
                </div>
            </div>
            <!-- Fin del bloque de repetición -->

            <!-- Sección de créditos -->
            <div class="col-12 mt-5">
                <h2 class="text-center">{{ trans('agrocefa::universal.Credits')}}</h2>
                <br>
                <br>
            </div>
        
            <!-- Tarjetas de créditos -->
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/laravel.png') }}" alt="Laravel 8">
                    <h5 class="text-center">Laravel 8</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://laravel.com/docs/8.x" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/php.png') }}" alt="Nombre del desarrollador">
                    <h5 class="text-center">PHP</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://www.php.net/" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/bootstrap.png') }}" alt="Nombre del desarrollador">
                    <h5 class="text-center">Bootstrap</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://getbootstrap.com/" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/sweetalert.png') }}" alt="Nombre del desarrollador">
                    <h5 class="text-center">SweetAlert</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://sweetalert2.github.io/" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/datatables.png') }}" alt="Nombre del desarrollador">
                    <h5 class="text-center">Datatable</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://datatables.net/" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/collective.png') }}" alt="Nombre del desarrollador">
                    <h5 class="text-center">Laravel Collective</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://laravelcollective.com/" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/visual.png') }}" alt="Nombre del desarrollador">
                    <h5 class="text-center">Visual Studio Code</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://code.visualstudio.com/" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/javascript.png') }}" alt="Nombre del desarrollador">
                    <h5 class="text-center">JavaScript</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://lenguajejs.com/" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/github.png') }}" alt="Nombre del desarrollador">
                    <h5 class="text-center">GitHub</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://github.com/" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/ajax.png') }}" alt="Nombre del desarrollador">
                    <h5 class="text-center">Ajax</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://lenguajejs.com/javascript/peticiones-http/ajax/" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/fontawesome.png') }}" alt="Nombre del desarrollador">
                    <h5 class="text-center">FontAwesome</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://fontawesome.com/" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="credit-card">
                    <img src="{{ asset('modules/agrocefa/images/credits/css.png') }}" alt="Nombre del desarrollador">
                    <h5 class="text-center">CSS</h5>
                    <!-- Agregar enlaces a más información -->
                    <div class="text-center">
                        <a href="https://lenguajecss.com/css/introduccion/que-es-css/" target="_blank">Más información</a>
                    </div>
                </div>
            </div>
            <!-- Fin del bloque de repetición -->
        </div>
        <br>
    </div>
</body>
</html>
@endsection

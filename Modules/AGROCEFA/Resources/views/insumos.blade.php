@extends('agrocefa::layouts.master')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insumos</title>
    <link rel="stylesheet" href="{{ asset('agrocefa/css/styleinsumos.css') }}">
    <script src="{{ asset('agrocefa/master/js/jquery-3.6.4.js') }}"></script>   
    <script src="{{ asset('agrocefa/master/js/script.js') }}"></script>
</head>
<body>
    <div class="wrap">
        <h1 class="titulo">Categorias de insumos</h1>
        <div class="store-wrapper">
            <div class="category_list">
                <a href="#" class="category_items" category="all">Todo</a>
                <a href="#" class="category_items" category="herramientas">Herramientas</a>
                <a href="#" class="category_items" category="equipos">Equipos</a>
                <a href="#" class="category_items" category="maquinaria">Maquinaria</a>
                <a href="#" class="category_items" category="fertilizantes">Fertilizantes</a>

            </div>
            <section class="products-list">
                <!-- Herramientas -->
                <div class="product-item" category="herramientas">
                    <img src="{{ asset('agrocefa/images/PALA.jpg') }}" alt="">
                    <a href="#">Pala</a>
                </div>

                <div class="product-item" category="herramientas">
                    <img src="{{ asset('agrocefa/images/machete.jpg') }}" alt="">
                    <a href="#">Machete</a>
                </div>

                <div class="product-item" category="herramientas">
                    <img src="{{ asset('agrocefa/images/rastrillo.jpeg') }}" alt="">
                    <a href="#">Rastrillos</a>
                </div>

                <div class="product-item" category="herramientas">
                    <img src="{{ asset('agrocefa/images/carretilla.jpg') }}" alt="">
                    <a href="#">Carretillas</a>
                </div>

                <div class="product-item" category="herramientas">
                    <img src="{{ asset('agrocefa/images/azadon.jpg') }}" alt="">
                    <a href="#">Azadón</a>
                </div>

                <div class="product-item" category="herramientas">
                    <img src="{{ asset('agrocefa/images/pico.jpg') }}" alt="">
                    <a href="#">Pico</a>
                </div>

                <!-- Equipos -->   
                <div class="product-item" category="equipos">
                    <img src="{{ asset('agrocefa/images/guadaña.jpg') }}" alt="">
                    <a href="#">Guadaña</a>
                </div>

                <div class="product-item" category="equipos">
                    <img src="{{ asset('agrocefa/images/pulidora.jpg') }}" alt="">
                    <a href="#">Pulidora</a>
                </div>

                <div class="product-item" category="equipos">
                    <img src="{{ asset('agrocefa/images/bomba.jpg') }}" alt="">
                    <a href="#">Bomba</a>
                </div>

                <!-- Maquinaria -->
                <div class="product-item" category="maquinaria">
                    <img src="{{ asset('agrocefa/images/PALA.jpg') }}" alt="">
                    <a href="#">Tractor</a>
                </div>

                <div class="product-item" category="maquinaria">
                    <img src="{{ asset('agrocefa/images/cosechadora.jpg') }}" alt="">
                    <a href="#">Cosechadora</a>
                </div>

                <div class="product-item" category="maquinaria">
                    <img src="{{ asset('agrocefa/images/PALA.jpg') }}" alt="">
                    <a href="#">Fumigadora</a>
                </div>

                <!-- Fertilizantes -->
                <div class="product-item" category="fertilizantes">
                    <img src="{{ asset('agrocefa/images/urea.jpg') }}" alt="">
                    <a href="#">Urea</a>
                </div>
                




            </section>
        </div>
    </div>
    
</body>
</html>

@endsection
@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>

    <link rel="stylesheet" href="{{ asset('agrocefa/css/estilos.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario AgroCEFA</title>

<body>

<section>
<h2 class="titulo">Inventario AgroCEFA</h2>

<div class="table">
            
            <div class="price_element">
            <div class="cardi">
    <div class="imgi-container">
        <div class="imgi">
        <img src=" {{ asset('agrocefa/images/agroinsumos.jpg') }}" width="100%">
        </div>
        <div class="description cardi">
            <span class="titlei">
                AGROINSUMOS
            </span>
        </div>
    </div>
</div>  

            </div>


            <div class="price_element">
            <div class="cardi">
    <div class="imgi-container">
        <div class="imgi">
        <img src=" {{ asset('agrocefa/images/planta.jpg') }}" width="100%">
        </div>
        <div class="description cardi">
            <span class="titlei">
                FERTILIZANTES
            </span>
        </div>
    </div>
</div>  

            </div>


    
        
            <div class="price_element">
            <div class="cardi">
    <div class="imgi-container">
        <div class="imgi">
        <img src=" {{ asset('agrocefa/images/herramienta.png') }}" width="100%">
        </div>
        <div class="description cardi">
            <span class="titlei">
            HERRAMIENTAS
            </span>
        </div>
    </div>
</div>
        </div>
    
    

            <div class="price_element">
            <div class="cardi">
    <div class="imgi-container">
        <div class="imgi">
            <img src=" {{ asset('agrocefa/images/tractor.jpg') }}" width="100%">
        </div>
        <div class="description cardi">
            <span class="titlei">
            MAQUINARIA
            </span>
        </div>
    </div>
</div>
            </div>

            
            
        </div>
</section>







    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.1.o.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
@endsection
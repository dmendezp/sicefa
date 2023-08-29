@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- ... tus metadatos ... -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    @auth
    
    <div class="container">
        <h2>Unidades Productivas Disponibles</h2>
        <div class="row">
            @if(isset($units) && $units->count() > 0)
                @foreach($units as $unit)
                    <div class="col-md-4">
                        <div class="unit-card" data-unit-id="{{ $unit->id }}">
                            {{ $unit->name }}
                        </div>
                    </div>
                @endforeach
            @else
                <p>No hay unidades productivas disponibles.</p>
            @endif
        </div>
    </div>

	<style>
        .unit-card {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100px;
            font-size: 18px;
            cursor: pointer; /* Cambia el cursor para indicar que es clickeable */
        }
    </style>
    
    <script>
        var baseUrl = "{{ url('/') }}";
    
        document.addEventListener('DOMContentLoaded', function() {
            const unitCards = document.querySelectorAll('.unit-card');
    
            unitCards.forEach(function(card) {
                card.addEventListener('click', function() {
                    const unitId = card.getAttribute('data-unit-id');
                    window.location.href = baseUrl + '/agrocefa/home/' + unitId; // Genera la URL con el ID de la unidad
                });
            });
        });
    </script>
    @endauth
    @guest
    <section class="banner">
        <div class="banner-content">
            <h1>{{ trans('agrocefa::universal.maintitle')}}</h1>  
                @if(isset($unit))
                    <h1>Unidad Productiva {{ $unit->name }}</h1>
                @endif 
        </div>
    </section>
    <br>

    <!--Footer-->
    @include('agrocefa::partials.footer')
    @endguest
    
</body>
</html>
@endsection

@extends('agrocefa::partials.head')
<link rel="shortcut icon" href="{{ asset('modules/agrocefa/images/usuario/tractor.png') }}">
@extends('agrocefa::partials.navbar')

@section('selectproductive')
<div class="container" style="margin-left: 20px">
    <h2>Unidades Productivas Disponibles</h2>
    <br>
    <div class="row">
        @if(isset($units) && $units->count() > 0)
            @foreach($units as $unit)
                <div class="col-md-4 col-sm-6"> <!-- Utiliza col-sm-6 para dispositivos pequeños y col-md-4 para dispositivos medianos -->
                    <div class="e-card playing" data-unit-id="{{ $unit->id }}" data-unit-route="{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.select-unit', ['id' => $unit->id]) }}">
                        <div class="image"></div>
                        <div class="wave"></div>
                        <div class="wave"></div>
                        <div class="wave"></div>
                        <div class="infotop">
                            <i class="{{$unit->icon}} icon" style="color: #ffffff;"></i>
                            <br>
                            {{ $unit->name }}
                            <br>
                            <div class="name">{{ $unit->description }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No hay unidades productivas disponibles.</p>
        @endif
    </div>
</div>

<style>
    .e-card {
        margin: 20px auto;
        background: transparent;
        box-shadow: 0px 8px 28px -9px rgba(0,0,0,0.45);
        position: relative;
        width: 100%; /* Cambia el ancho a 100% para que se ajuste al contenedor padre */
        max-width: 340px; /* Define un ancho máximo */
        height: 300px;
        border-radius: 16px;
        overflow: hidden;
    }

    /* Utiliza media queries para ajustar el tamaño de las tarjetas en dispositivos más pequeños */
    @media (max-width: 767px) {
        .e-card {
            max-width: none; /* Elimina el ancho máximo */
        }
    }

    .wave {
        position: absolute;
        width: 540px;
        height: 700px;
        opacity: 0.6;
        left: 0;
        top: 0;
        margin-left: -50%;
        margin-top: -70%;
        background: linear-gradient(744deg,#00ff0a,#277621 60%,#fff);
    }

    .icon {
        width: 3em;
        margin-top: -1em;
        padding-bottom: 1em;
    }

    .infotop {
        text-align: center;
        font-size: 20px;
        position: absolute;
        top: 5.6em;
        left: 0;
        right: 0;
        color: rgb(255, 255, 255);
        font-weight: 600;
    }

    .name {
        font-size: 14px;
        font-weight: 100;
        position: relative;
        top: 1em;
        text-transform: lowercase;
    }

    .wave:nth-child(2),
    .wave:nth-child(3) {
        top: 210px;
    }

    .playing .wave {
        border-radius: 40%;
        animation: wave 3000ms infinite linear;
    }

    .wave {
        border-radius: 40%;
        animation: wave 55s infinite linear;
    }

    .playing .wave:nth-child(2) {
        animation-duration: 4000ms;
    }

    .wave:nth-child(2) {
        animation-duration: 50s;
    }

    .playing .wave:nth-child(3) {
        animation-duration: 5000ms;
    }

    .wave:nth-child(3) {
        animation-duration: 45s;
    }

    @keyframes wave {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const unitCards = document.querySelectorAll('.e-card');

        unitCards.forEach(function(card) {
            card.addEventListener('click', function() {
                const unitRoute = card.getAttribute('data-unit-route');
                window.location.href = unitRoute;
            });
        });
    });
</script>
@endsection

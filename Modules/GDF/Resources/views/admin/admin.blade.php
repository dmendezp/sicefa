@extends('gdf::layouts.master')

@section('content')
<div class="center-container">
    <div class="card">
        {{-- Icono de mapa --}}
        <svg class="icon" fill="none" stroke="currentColor" stroke-width="1.5"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 20l-5.447-2.724A2 2 0 013 15.382V5.618a2 2 0 011.553-1.947L9 2m0 0l6 2m-6-2v18m6-16l5.447 2.724A2 2 0 0121 8.618v9.764a2 2 0 01-1.553 1.947L15 22m0 0V4"/>
        </svg>

        <h1 class="title">¡Hola, {{ Auth::user()->nickname }}!</h1>
        <h2 class="subtitle">Sistema de Gestión de Desplazamiento</h2>
        <p class="description">
            Queremos darte la bienvenida a la plataforma. Desde aquí puedes gestionar de forma <strong>fácil</strong> y <strong>segura</strong>
            los desplazamientos institucionales. Navega por el menú para comenzar.
        </p>

        <button class="button" onclick="window.location.href='#'">
            Ingresar al sistema
        </button>
    </div>
</div>
@endsection

@extends('gdf::layouts.master')
<link rel="stylesheet" href="{{asset('modules/gdf/css/layouts/masterusers.css')}}">
@section('content')
 <!-- Contenido principal -->
 <br>
 <section class="hero">
    @auth
        <h1>Hola, {{ Auth::user()->nickname }}</h1>
        <h2>Bienvenido al Sistema de Gestión de Desplazamiento de Funcionarios</h2>
        <p>Una solución integral para la administración eficiente de tus solicitudes. Optimiza tus procesos, incrementa la
            productividad y toma decisiones informadas con nuestra plataforma diseñada para el éxito.</p>

        <p>Con nuestro software todo se hará de manera más rápida, con respuestas eficientes y satisfactorias.</p>
    @else
        <h1>Hola, Querido Usuario</h1>
        <h2>Bienvenido al Sistema de Gestión de Desplazamiento de Funcionarios</h2>
        <p>Una solución integral para la administración eficiente de tus solicitudes. Optimiza tus procesos, incrementa la
            productividad y toma decisiones informadas con nuestra plataforma diseñada para el éxito.</p>

        <p>Con nuestro software todo se hará de manera más rápida, con respuestas eficientes y satisfactorias.</p>
        <a href="{{ route('login') }}" class="btn-primary">Iniciar Sesión</a>
    @endauth
</section>
@endsection

@extends('dicsena::layouts.master')

@section('contenido')
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">
        <i class="fas fa-globe"></i> Dicsena
    </a>
    <div class="collapse navbar-collapse justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}">Traductor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guidepost') }}">Guía</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('glossaries') }}">Glosario</a>
            </li>
        </ul>
    </div>
</nav>
hola guia

    hola glosario
    <footer>2023</footer>
@endsection

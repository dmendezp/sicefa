@extends('dicsena::layouts.master')

@section('content')
<nav class="navbar navbar-expand-lg navbar-rojo">
    <a class="navbar-brand" href="#">
        <i class="fas fa-globe"></i> Dicsena
    </a>
    <div class="collapse navbar-collapse justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cefa.dicsena.home.index') }}">Traductor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cefa.dicsena.guideposts') }}">Guía</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cefa.dicsena.glossaries') }}">Glosario</a>
            </li>
        </ul>
    </div>
</nav>
<div id="container">
        <div id="language-select">
            <label for="from-language">De:</label>
            <select id="from-language">
                <option value="es">Español</option>
                <option value="en">Inglés</option>
                <!-- Agrega más opciones de idiomas aquí -->
            </select>
            <button id="swap-button"><i class="fas fa-exchange-alt"></i></button>
            <label for="to-language">A:</label>
            <select id="to-language">
                <option value="en">Inglés</option>
                <option value="es">Español</option>
                <!-- Agrega más opciones de idiomas aquí -->
            </select>
        </div>
        <div id="translation-boxes">
            <textarea id="input-box" placeholder="Escribe un texto"></textarea>
            <button id="translate-button">Traducir</button>
            <textarea id="output-box" placeholder="Traducción"></textarea>
            {{ route('index') }}
        </div>
    </div>

@endsection

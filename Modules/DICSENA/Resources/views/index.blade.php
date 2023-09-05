@extends('dicsena::layouts.master')

@section('content')
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
            </select>
        </div>
        <div id="translation-boxes">
            <textarea id="input-box" placeholder="Escribe un texto"></textarea>
            <button id="translate-button">Traducir</button>
            <textarea id="output-box" placeholder="Traducción"></textarea>
        </div>
    </div>

@endsection

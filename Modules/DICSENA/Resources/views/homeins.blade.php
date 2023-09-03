@extends('dicsena::layouts.master')

@section('content')
<nav class="metal-navbar">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Acerca de</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
    </nav>
    <div class="tarjeta">
        <div class="icono">
            <i class="fas fa-file-upload"></i> <!-- Icono "Subir Guías" -->
        </div>
        <h2>Título 1</h2>
        <a href="enlace1.html">Enlace 1</a>
        <a href="enlace2.html">Enlace 2</a>
    </div>

    <div class="tarjeta">
        <div class="icono">
            <i class="fas fa-plus"></i> <!-- Icono "Añadir Palabras" -->
        </div>
        <h2>Título 2</h2>
        <a href="">Enlace 3</a>
        <a href="">Enlace 4</a>
    </div>
@endsection
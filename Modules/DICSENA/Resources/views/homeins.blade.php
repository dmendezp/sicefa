@extends('dicsena::layouts.master')

@section('content')
<nav class="metal-navbar">
<a class="navbar-brand" href="#">
        <i class="fas fa-globe"></i> Dicsena
    </a>
    </nav>

    <div class="tarjeta">
        <div class="icono">
            <i class="fas fa-file-upload"></i> 
        </div>
        <h2>GUIAS</h2>
        <a href="{{ route('dicsena.guide.formgui') }}">Subir Guia</a>
        <a href="{{ route('dicsena.guide.vistagui') }}">Ver guia</a>
    </div>

    <div class="tarjeta">
        <div class="icono">
            <i class="fas fa-plus"></i> 
        </div>
        <h2>GLOSARIO</h2>
        <a href="{{ route('dicsena.glosary.formglo') }}">Subir Glosario</a>
        <a href="{{ route('dicsena.glosary.vistaglo') }}">Ver gloario</a>
    </div>
@endsection
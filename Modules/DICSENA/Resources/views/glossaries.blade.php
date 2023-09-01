@extends('dicsena::layouts.master')

@section('content')
<nav class="navbar navbar-expand-lg navbar-blue">
    <a class="navbar-brand" href="#">
        <i class="fas fa-globe"></i> DICSENA
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
<form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
hola glosario

    hola guia
@endsection
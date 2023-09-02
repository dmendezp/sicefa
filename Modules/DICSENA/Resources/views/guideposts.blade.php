@extends('dicsena::layouts.master')

@section('content')
<nav class="navbar navbar-expand-lg navbar-gris">
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
hola guia

    <footer>2023</footer>
@endsection

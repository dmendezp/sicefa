@extends('dicsena::layouts.master')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav d-flex flex-row justify-content-start">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        <i class="fas fa-globe"></i> DICSENA
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="{{ url('lang', ['es']) }}" class="dropdown-item">Español</a>
                        <a href="{{ url('lang', ['en']) }}" class="dropdown-item">English</a>
                        <a href="{{ route('cefa.welcome') }}" class="dropdown-item">Volver a SICEFA</a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.home.index') }}" style="color: white;">Traductor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.guide')}}" style="color: white;">Guia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.gloss')}}" style="color: white;">Glosario</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @if(Auth::user())
                @if(Auth::user()->havePermission('dicsena.instructor.menu'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dicsena.instructor.menu') }}" style="color: white;">Panel</a>
                </li>
                @endif
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="wrapper">
        <div class="text-input">
            <textarea spellcheck="false" class="from-text" placeholder="Ingresa el texto a traducir"></textarea>
            <textarea spellcheck="false" readonly disabled class="to-text" placeholder="Traducción"></textarea>
        </div>
        <ul class="controls">
            <li class="row from">
                <div class="icons">
                    <i id="from" class="fas fa-volume-up"></i>
                    <i id="from" class="fas fa-copy"></i>
                </div>
                <select></select>
            </li>
            <li class="exchange"><i class="fas fa-exchange-alt"></i></li>
            <li class="row to">
                <select></select>
                <div class="icons">
                    <i id="to" class="fas fa-volume-up"></i>
                    <i id="to" class="fas fa-copy"></i>
                </div>
            </li>
        </ul>
    </div>
    <button class="buttontranslate">Traducir el Texto</button>
</div>
<script src="{{ asset('modules/dicsena/js/countries.js') }}"></script>
<script src="{{ asset('modules/dicsena/js/script.js') }}"></script>

@endsection
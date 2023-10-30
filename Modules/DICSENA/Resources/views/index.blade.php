@extends('dicsena::layouts.userview')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe"></i>DICSENA
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="{{ url('lang', ['es']) }}" class="dropdown-item">Español</a>
                        <a href="{{ url('lang', ['en']) }}" class="dropdown-item">English</a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.home.index') }}">Traductor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.guide')}}">Guia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.gloss')}}">Glosario</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @if(Auth::user())
                @if(Auth::user()->havePermission('dicsena.instructor.menu'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dicsena.instructor.menu') }}">Panel</a>
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
            <textarea spellcheck="false" class="from-text" placeholder="Enter text"></textarea>
            <textarea spellcheck="false" readonly disabled class="to-text" placeholder="Translation"></textarea>
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
    <button class="btn">Translate Text</button>
</div>
<script src="{{ asset('modules/dicsena/js/countries.js') }}"></script>
<script src="{{ asset('modules/dicsena/js/script.js') }}"></script>
<footer style="background-color: #3C3B6E; color: white; padding: 20px;">
    <p style="text-align: center;">Use exclusive for apprentices of SENA</p>
    <p style="text-align: center;">&copy; 2023</p>
</footer>
@endsection
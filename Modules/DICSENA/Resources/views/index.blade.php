@extends('dicsena::layouts.userview')

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
                <a class="nav-link" href="{{ route('cefa.dicsena.guide')}}">Guía</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cefa.dicsena.gloss')}}">Glosario</a>
            </li>
        </ul>
    </div>
    <a class="navbar-brand" href="{{ route('cefa.dicsena.menu')}}">
        <i class="fas fa-user"></i>Login
    </a>
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
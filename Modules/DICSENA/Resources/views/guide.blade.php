@extends('dicsena::layouts.userview')

@section('content')
<nav class="navbar navbar-expand-lg navbar-azul">
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
    <h1>Guidepost Details</h1>
    <h2>Title: {{ $guidepost->title }}</h2>
    <p>Description: {{ $guidepost->description }}</p>
    <p>Program: {{ $guidepost->program->name }}</p>

    <div>
        <a href="{{ asset('guidepost_file/' . $guidepost->url) }}" download>Download PDF</a>
    </div>
</div>
<footer style="background-color: #3C3B6E; color: white; padding: 20px;">
    <p style="text-align: center;">Use exclusive for apprentices of SENA</p>
    <p style="text-align: center;">&copy; 2023</p>
</footer>
@endsection
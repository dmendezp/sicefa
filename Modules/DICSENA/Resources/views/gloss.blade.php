@extends('dicsena::layouts.userview')

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
<form action="{{ route('cefa.dicsena.glossary.search') }}" method="GET">
    <div class="form-group">
        <label for="program_id">Selecciona un programa:</label>
        <select name="program_id" id="program_id" class="form-control">
            @foreach ($programs as $program)
            <option value="{{ $program->id }}">{{ $program->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<footer style="background-color: #3C3B6E; color: white; padding: 20px;">
    <p style="text-align: center;">Use exclusive for apprentices of SENA</p>
    <p style="text-align: center;">&copy; 2023</p>
</footer>
@endsection
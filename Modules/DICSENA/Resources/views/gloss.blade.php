@extends('dicsena::layouts.master')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav d-flex flex-row justify-content-start">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('cefa.dicsena.gloss') }}" method="get">
                <div class="form-group">
                    <label for="program_id">Selecciona un programa:</label>
                    <select name="program_id" id="program_id" class="form-control">
                        <option value="">------</option>
                        @foreach ($programs as $program)
                        <option value="{{ $program->id }}" @if($selectedProgramId==$program->id) selected @endif>
                            {{ $program->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if($glossaries->isNotEmpty())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Palabra</th>
                        <th>Traducción</th>
                        <th>Significado</th>
                        <th>Programa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($glossaries as $glossary)
                    <tr>
                        <td>{{ $glossary->word }}</td>
                        <td>{{ $glossary->traduction }}</td>
                        <td>{{ $glossary->meaning }}</td>
                        <td>{{ $glossary->program->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No se encontraron resultados para la búsqueda.</p>
            @endif
        </div>
    </div>
</div>
<style>
    .form-group {
        text-align: center;
    }

    button.btn-primary {
        margin-left: auto;
        margin-right: auto;
        display: block;
    }
</style>
@endsection
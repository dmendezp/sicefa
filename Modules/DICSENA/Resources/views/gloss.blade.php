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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        <i class="fas fa-globe"></i> DICSENA
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

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
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cefa.dicsena.aprendiz') }}" data-toggle="tooltip" data-placement="top" data-title="¿Necesitas ayuda en el uso?" data-color="#ffffff" style="color: white;">
                    <i class="fas fa-book-open"></i> Ayuda
                </a>
            </li>
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
<div class="container mt-4 d-flex justify-content-center">
    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <form action="{{ route('cefa.dicsena.gloss') }}" method="get">
                <div class="form-group">
                    <label for="program_name" style="text-align: center;">Selecciona un programa:</label>
                    <select name="program_name" id="program_name" class="form-control program-filter" style="border: blue solid 1px;">
                        <option value="">------</option>
                        @foreach ($programs as $program)
                        <option value="{{ $program->name }}" {{ $selectedProgram == $program->name ? 'selected' : '' }}>
                            {{ $program->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Filtrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-container">
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
    .container button {
        width: 100%;
        padding: 14px;
        outline: none;
        border: none;
        color: #fff;
        cursor: pointer;
        margin-top: 20px;
        font-size: 17px;
        border-radius: 5px;
        background: #1c80bb;
    }

    p {
        text-align: center;
    }

    .table-container {
        margin-left: 50px;
        /* Ajusta el valor según tus necesidades */
        margin-right: 50px;
        /* Ajusta el valor según tus necesidades */
    }
</style>
@endsection
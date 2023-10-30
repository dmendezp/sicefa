@extends('dicsena::layouts.userview')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe"></i> DICSENA
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dicsena.instructor.menu') }}">Panel</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('cefa.dicsena.guide') }}" method="get">
                <div class="form-group">
                    <label for="program_name">Selecciona un programa:</label>
                    <select name="program_name" id="program_name" class="form-control">
                        <option value="">{{ trans('dicsena::menu.selectprogram:') }}</option>
                        @foreach ($programs as $program)
                        <option value="{{ $program->name }}" {{ $selectedProgram == $program->name ? 'selected' : '' }}>
                            {{ $program->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if($guideposts->isNotEmpty())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Programa</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guideposts as $guidepost)
                    <tr>
                        <td>{{ $guidepost->id }}</td>
                        <td>{{ $guidepost->title }}</td>
                        <td>{{ $guidepost->description }}</td>
                        <td>{{ $guidepost->program->name }}</td>
                        <td>
                            <a href="{{ asset('guideposts_file/' . $guidepost->url) }}" target="_blank" title="{{ $guidepost->url }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            &nbsp; | &nbsp;
                            <a href="{{ asset('guideposts_file/' . $guidepost->url) }}" download title="{{ $guidepost->url }}">
                                <i class="fa fa-download"></i>
                            </a>
                        </td>
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


<footer style="background-color: #3C3B6E; color: white; padding: 20px;">
    <p style="text-align: center;">Use exclusive for apprentices of SENA</p>
    <p style="text-align: center;">&copy; 2023</p>
</footer>
@endsection
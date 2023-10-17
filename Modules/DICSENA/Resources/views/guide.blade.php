@extends('dicsena::layouts.userview')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <i class="fas fa-globe"></i> Dicsena
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav justify-content-center">
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
        <i class="fas fa-user"></i> Panel
    </a>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('cefa.dicsena.guide') }}" method="get">
                <div class="form-group">
                    <label for="program_name">Selecciona un programa:</label>
                    <select name="program_name" id="program_name" class="form-control">
                        <option value="">Selecciona un programa</option>
                        @foreach ($programs as $program)
                        <option value="{{ $program->id }}" {{ $selectedProgram == $program->id ? 'selected' : '' }}>
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
        </div>
    </div>
</div>

<footer style="background-color: #3C3B6E; color: white; padding: 20px;">
    <p style="text-align: center;">Use exclusive for apprentices of SENA</p>
    <p style="text-align: center;">&copy; 2023</p>
</footer>
@endsection
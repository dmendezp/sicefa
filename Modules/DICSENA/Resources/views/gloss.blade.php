@extends('dicsena::layouts.master')

@section('content')
<div class="container">
    <h1 align="center">Glossary</h1>
    <form action="{{ route('cefa.dicsena.glossary.search') }}" method="GET" class="ml-auto">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por palabra">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary" id="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</div>

@if (isset($glossaries))
<div class="container">
    <h1 align="center">Resultado de busqueda</h1>
    <table class="table mt-4">
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
</div>
@elseif (isset($searched) && !$searched)
<div class="container">
    <div class="alert alert-warning" role="alert">
        No se encontraron palabras.
    </div>
</div>
@endif

<script>
    document.getElementById('search-button').addEventListener('click', function() {
        setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
        }, 3000);
    });
</script>
@endsection
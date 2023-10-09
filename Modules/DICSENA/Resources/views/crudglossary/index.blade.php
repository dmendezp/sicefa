@extends('dicsena::layouts.master')

@section('content')
<div class="container">
    <h1 align="center">Glosarios</h1>
    <div class="d-flex align-items-center mb-3">
        <a href="{{ route('cefa.dicsena.glossary.create') }}" class="btn btn-primary">Crear Glosario</a>
        @if (session('success'))
        <div class="alert alert-success ml-3">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('cefa.dicsena.glossary.search') }}" method="GET" class="ml-auto">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar por tec">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <table id="index" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
        <thead>
            <tr>
                <th>Palabra</th>
                <th>Traducción</th>
                <th>Significado</th>
                <th>Programa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($glossaries as $glossary)
            <tr>
                <td>{{ $glossary->word }}</td>
                <td>{{ $glossary->traduction }}</td>
                <td>{{ $glossary->meaning }}</td>
                <td>{{ $glossary->program->name }}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('cefa.dicsena.glossary.edit', $glossary->id) }}" class="btn btn-sm btn-primary mr-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('cefa.dicsena.destroy', $glossary->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este glosario?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $glossaries->links() }}
</div>
<footer style="background-color: #3C3B6E; color: white; padding: 20px;">
    <p style="text-align: center;">Use exclusive for apprentices of SENA</p>
    <p style="text-align: center;">&copy; 2023</p>
</footer>
@endsection
@extends('dicsena::layouts.master')
@section('css')

@endsection
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
    </div>
    <table id="tblglossary" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">Palabra</th>
                <th scope="col">Traducción</th>
                <th scope="col">Significado</th>
                <th scope="col">Programa</th>
                <th scope="col">Acciones</th>
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
                        <div style="width: 10px;"></div>
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
</div>
<script src="{{ asset('libs/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('Datatables-1.13.4/datatables.js') }}"></script>
<script>
    new DataTable('#tblglossary');
</script>
@endsection
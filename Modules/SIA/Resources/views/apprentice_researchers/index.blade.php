@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Lista de Aprendices Investigadores</h1>

    @if (session('message'))
        <div class="alert alert-{{ session('typealert') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('sia.apprentice_researchers.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Aprendiz</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nickname</th>
                <th>Nombre Completo</th>
                <th>Correo Electrónico</th>
                <th>Programa</th>
                <th>Ficha</th>
                <th>Grupo</th>
                <th>Proyecto</th>
                <th>Institución</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($apprentices as $apprentice)
                <tr>
                    <td>{{ $apprentice->user->nickname }}</td>
                    <td>{{ $apprentice->person->full_name }}</td>
                    <td>{{ $apprentice->user->email }}</td>
                    <td>{{ $apprentice->program->name }}</td>
                    <td>{{ $apprentice->course->code }}</td>
                    <td>{{ $apprentice->group->name }}</td>
                    <td>{{ $apprentice->project ? $apprentice->project->name : 'Sin proyecto' }}</td>
                    <td>{{ $apprentice->institution }}</td>
                    <td>
                        <a href="{{ route('sia.apprentice_researchers.edit', $apprentice->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('sia.apprentice_researchers.destroy', $apprentice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este aprendiz?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
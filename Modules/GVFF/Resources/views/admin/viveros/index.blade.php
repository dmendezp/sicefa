@extends('gvff::layouts.master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Gestión de Viveros</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-3">

    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Ubicación</th>
                <th scope="col">Descripción</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($viveros as $vivero)
                <tr>
                    <td>{{ $vivero->name }}</td>
                    <td>{{ $vivero->location }}</td>
                    <td>{{ $vivero->description ?? 'Sin descripción' }}</td>
                    <td>
                        <a href="{{ route('gvff.viveros.edit', $vivero) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('gvff.viveros.destroy', $vivero) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este vivero?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay viveros registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
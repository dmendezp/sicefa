@extends('gvff::layouts.master')

@push('styles')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@endpush

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Gestión de vivero</h1>
    <a href="{{ route('gvff.admin.nurseries.create') }}" class="btn btn-primary btn-sm">Crear nuevo vivero</a>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Ubicación</th>
                <th scope="col">Capacidad Máxima</th>
                <th scope="col">Clasificación</th>
                <th scope="col">Descripción</th>
                <th scope="col">Imagen</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($nurseries as $nursery)
                <tr>
                    <td>{{ $nursery->name }}</td>
                    <td>{{ $nursery->location }}</td>
                    <td>{{ $nursery->max_capacity }}</td>
                    <td>{{ ucfirst($nursery->classification) }}</td>
                    <td>{{ $nursery->description ?? 'Sin descripción' }}</td>
                    <td>
                        @if ($nursery->image)
                            <img src="{{ asset('storage/' . $nursery->image) }}" alt="{{ $nursery->name }}" class="img-thumbnail" style="max-width: 100px;">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('gvff.admin.nurseries.showPlants', $nursery) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('gvff.admin.nurseries.edit', $nursery) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('gvff.admin.nurseries.destroy', $nursery) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este vivero?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay viveros registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endpush
@endsection
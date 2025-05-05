@extends('gvff::layouts.master')

@push('styles')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@endpush

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Plantas en el vivero: {{ $nurseries->name }}</h1>
    <p><strong>Clasificación del vivero:</strong> {{ ucfirst($nurseries->classification) }}</p>
    <a href="{{ route('gvff.admin.nurseries.index') }}" class="btn btn-secondary btn-sm mb-3">Volver a viveros</a>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nombre Común</th>
                <th scope="col">Nombre Científico</th>
                <th scope="col">Tipo de Planta</th>
                <th scope="col">Inventario</th>
                <th scope="col">Precio</th>
                <th scope="col">Disponible</th>
                <th scope="col">Imagen</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($plants as $plant)
                <tr>
                    <td>{{ $plant->common_name }}</td>
                    <td>{{ $plant->scientific_name }}</td>
                    <td>{{ ucfirst($plant->plant_type) }}</td>
                    <td>{{ $plant->inventory }}</td>
                    <td>{{ $plant->price ? number_format($plant->price, 2) : 'N/A' }}</td>
                    <td>{{ $plant->available ? 'Sí' : 'No' }}</td>

                    <td>
                        @if ($plant->image)
                            <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->common_name }}" class="img-thumbnail" style="max-width: 100px;">
                        @else
                            Sin imagen
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay plantas registradas en este vivero.</td>
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
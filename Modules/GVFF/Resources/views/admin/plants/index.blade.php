@extends('gvff::layouts.master')

@section('content')
    <div class="container">
        <h1>Gestión de Plantas</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('gvff.admin.plants.create') }}" class="btn btn-primary mb-3">Crear Nueva Planta</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre Común</th>
                    <th>Nombre Científico</th>
                    <th>Vivero</th>
                    <th>Tipo</th>
                    <th>Inventario</th>
                    <th>Disponible</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plants as $plant)
                    <tr>
                        <td>{{ $plant->common_name }}</td>
                        <td>{{ $plant->scientific_name }}</td>
                        <td>{{ $plant->nurseries->name ?? 'Sin vivero' }}</td>
                        <td>{{ $plant->plant_type }}</td>
                        <td>{{ $plant->inventory }}</td>
                        <td>{{ $plant->available ? 'Sí' : 'No' }}</td>
                        <td>
                        <img src="{{ asset($plant->image) }}" alt="{{ $plant->common_name }}" width="80">
                        </td>
                        <td>
                        <a href="{{ route('gvff.admin.plants.edit', $plant) }}" class="btn btn-warning btn-sm">Editar</a>

<form action="{{ route('gvff.admin.plants.destroy', $plant) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
</form>

<a href="{{ route('gvff.admin.plants.sell', $plant) }}" class="btn btn-success btn-sm">Vender</a> <!-- NUEVO BOTÓN -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
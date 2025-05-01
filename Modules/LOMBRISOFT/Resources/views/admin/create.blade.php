@extends('lombrisoft::layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Crear Nueva Cama</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('lombrisoft.admin.camas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="numero" class="form-label">Número de la Cama</label>
                            <input type="number" class="form-control" id="numero" name="numero" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="Disponible">Disponible</option>
                                <option value="Ocupada">Ocupada</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <button type="submit" class="btn btn-success">Crear</button>
                        <a href="{{ route('lombrisoft.admin.camas.store') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
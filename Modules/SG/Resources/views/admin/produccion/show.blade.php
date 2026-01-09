@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">Detalle de Producción Lechera</h3>
            <small class="text-muted">Información detallada del ordeño</small>
        </div>
        <a href="{{ route('sg.admin.sg.produccion.edit', $milkProduction) }}" class="btn btn-warning btn-lg shadow-sm">
            <i class="fas fa-edit"></i> Editar Registro
        </a>
    </div>

    {{-- Información del Animal --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h3 class="font-weight-bold">Información del Animal</h3>
            <p><strong>Código:</strong> <span class="font-mono text-indigo-600">{{ $milkProduction->animal->id }}</span></p>
            <p><strong>Nombre:</strong> {{ $milkProduction->animal->name ?: 'Sin nombre' }}</p>
            <p><strong>Raza:</strong> {{ $milkProduction->animal->breed?->name }}</p>
            <p><strong>Edad:</strong> {{ $milkProduction->animal->age_text }}</p>
        </div>
    </div>

    {{-- Detalles del Ordeño --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h3 class="font-weight-bold">Detalles del Ordeño</h3>
            <p><strong>Turno:</strong> {{ $milkProduction->shift_in_spanish ?: 'Sin turno' }}</p>
            <p><strong>Calidad:</strong> {{ $milkProduction->quality_in_spanish }}</p>
            <p><strong>Temperatura:</strong> {{ $milkProduction->milk_temperature ? $milkProduction->milk_temperature . '°C' : 'No registrada' }}</p>
            <p><strong>Responsable:</strong> {{ $milkProduction->responsible ?: 'No especificado' }}</p>
        </div>
    </div>

    {{-- Observaciones --}}
    @if($milkProduction->observations)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h3 class="font-weight-bold">Observaciones</h3>
                <p class="text-gray-700">{{ $milkProduction->observations }}</p>
            </div>
        </div>
    @endif

    {{-- Botón Volver --}}
    <div class="mt-4">
        <a href="{{ route('sg.admin.sg.produccion.index') }}" class="btn btn-secondary">
            ← Volver al Control
        </a>
    </div>
</div>
@endsection

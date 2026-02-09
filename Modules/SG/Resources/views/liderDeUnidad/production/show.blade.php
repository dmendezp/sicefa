@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<br>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">🥛 Producción Lechera</h3>
            <small class="text-muted">
                {{ $milkProduction->production_date->format('d/m/Y') }} • 
                {{ $milkProduction->shift_in_spanish }}
            </small>
        </div>

        <div>
            <a href="{{ route('sg.liderDeUnidad.sg.production.edit', $milkProduction) }}"
               class="btn btn-warning btn-lg shadow-sm">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>

    {{-- KPIs --}}
    <div class="row mb-4">

        {{-- LITROS --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-left-success">
                <div class="card-body text-center">
                    <h6 class="text-muted">Litros Producidos</h6>
                    <h2 class="font-weight-bold text-success">
                        {{ $milkProduction->liters }} L
                    </h2>
                </div>
            </div>
        </div>

        {{-- CALIDAD --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-left-info">
                <div class="card-body text-center">
                    <h6 class="text-muted">Calidad</h6>
                    <span class="badge badge-pill px-4 py-2
                        {{ $milkProduction->quality === 'HIGH' ? 'badge-success' : 
                           ($milkProduction->quality === 'MEDIUM' ? 'badge-warning' : 'badge-danger') }}">
                        {{ $milkProduction->quality_in_spanish }}
                    </span>
                </div>
            </div>
        </div>

        {{-- TURNO --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-left-primary">
                <div class="card-body text-center">
                    <h6 class="text-muted">Turno</h6>
                    <h4 class="font-weight-bold text-primary">
                        {{ $milkProduction->shift_in_spanish }}
                    </h4>
                </div>
            </div>
        </div>

        {{-- TEMPERATURA --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-left-secondary">
                <div class="card-body text-center">
                    <h6 class="text-muted">Temperatura</h6>
                    <h4 class="font-weight-bold">
                        {{ $milkProduction->milk_temperature ? $milkProduction->milk_temperature . ' °C' : '—' }}
                    </h4>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        {{-- INFO ANIMAL --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light font-weight-bold">
                    🐄 Animal
                </div>
                <div class="card-body">
                    <p><strong>Placa:</strong> {{ $milkProduction->animal->plate }}</p>
                    <p><strong>Nombre:</strong> {{ $milkProduction->animal->name ?: 'Sin nombre' }}</p>
                    <p><strong>Raza:</strong> {{ $milkProduction->animal->breed?->name }}</p>
                    <p><strong>Edad:</strong> {{ $milkProduction->animal->age_text }}</p>
                    <p>
                        <strong>Etapa:</strong>
                        <span class="badge badge-info">
                            {{ $milkProduction->animal->production_stage }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        {{-- DETALLES ORDEÑO --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light font-weight-bold">
                    🧑‍🌾 Detalles del Ordeño
                </div>
                <div class="card-body">
                    <p><strong>Fecha:</strong> {{ $milkProduction->production_date->format('d/m/Y') }}</p>
                    <p><strong>Turno:</strong> {{ $milkProduction->shift_in_spanish }}</p>
                    <p><strong>Responsable:</strong> {{ $milkProduction->responsible ?: 'No especificado' }}</p>
                    <p><strong>Registro:</strong> {{ $milkProduction->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- OBSERVACIONES --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light font-weight-bold">
                    📝 Observaciones
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        {{ $milkProduction->observations ?: 'Sin observaciones registradas' }}
                    </p>
                </div>
            </div>
        </div>

    </div>

    {{-- ACCIONES --}}
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('sg.liderDeUnidad.sg.production.index') }}"
           class="btn btn-outline-secondary btn-lg">
            ← Volver al Control
        </a>

        <form action="{{ route('sg.liderDeUnidad.sg.production.destroy', $milkProduction) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger btn-lg"
                    onclick="return confirm('¿Eliminar este registro?')">
                🗑 Eliminar
            </button>
        </form>
    </div>

</div>
@endsection

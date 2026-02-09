@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<br>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold text-dark">
            💊 Detalle del Tratamiento
        </h3>

        <a href="{{ route('sg.liderDeUnidad.sg.treatments.index') }}"
           class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="card shadow-sm">

        {{-- CABECERA --}}
        <div class="card-header bg-primary text-white text-center py-4">
            <h4 class="mb-1 font-weight-bold">
                Tratamiento Aplicado
            </h4>
            <span class="badge badge-light text-primary px-3 py-2 mt-2">
                {{ $treatment->healthRecord->animal->id }} ·
                {{ $treatment->treatment_date->format('d/m/Y') }}
            </span>
        </div>

        {{-- CONTENIDO --}}
        <div class="card-body p-4">

            <div class="row">

                {{-- INFO BOVINO --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-primary shadow-sm">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-primary mb-3">
                                🐄 Información del Bovino
                            </h5>

                            <p class="mb-2">
                                <strong>Placa:</strong>
                                <span class="badge badge-info">
                                    {{ $treatment->healthRecord->animal->plate }}
                                </span>
                            </p>

                            <p class="mb-2">
                                <strong>Nombre:</strong>
                                {{ $treatment->healthRecord->animal->name ?: 'Sin nombre' }}
                            </p>

                            <p class="mb-0">
                                <strong>Fecha Historia Clínica:</strong>
                                {{ $treatment->healthRecord->record_date->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- DETALLES TRATAMIENTO --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-success shadow-sm">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-success mb-3">
                                💉 Detalles del Tratamiento
                            </h5>

                            <p><strong>Fecha:</strong> {{ $treatment->treatment_date->format('d/m/Y') }}</p>
                            <p><strong>Medicamento:</strong> {{ $treatment->medicine_name ?: 'No especificado' }}</p>
                            <p><strong>Dosis:</strong> {{ $treatment->dose ?: '-' }}</p>
                            <p><strong>Vía:</strong> {{ $treatment->administration_route ?: '-' }}</p>
                            <p class="mb-0"><strong>Frecuencia:</strong> {{ $treatment->frequency ?: '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- OBSERVACIONES --}}
                <div class="col-md-12">
                    <div class="card border-left-warning shadow-sm">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-warning mb-3">
                                📝 Observaciones
                            </h5>

                            <p class="mb-0 text-muted">
                                {{ $treatment->observations ?: 'Sin observaciones adicionales.' }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ACCIONES --}}
            <div class="d-flex justify-content-center mt-5">
                <a href="{{ route('sg.liderDeUnidad.sg.treatments.edit', $treatment) }}"
                   class="btn btn-warning btn-lg mr-3">
                    <i class="fas fa-edit"></i> Editar Tratamiento
                </a>

                <a href="{{ route('sg.liderDeUnidad.sg.treatments.index') }}"
                   class="btn btn-secondary btn-lg">
                    <i class="fas fa-list"></i> Volver al Listado
                </a>
            </div>

        </div>
    </div>

</div>
@endsection

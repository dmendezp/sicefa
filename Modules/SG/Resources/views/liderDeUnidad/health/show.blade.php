@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<br>
<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">
            Historia Clínica
            <small class="text-muted">
                #{{ $healthRecord->animal->id }} | {{ $healthRecord->record_date->format('d/m/Y') }}
            </small>
        </h3>

        <div>
            <a href="{{ route('sg.liderDeUnidad.sg.health.edit', $healthRecord) }}"
               class="btn btn-warning mr-2">
                <i class="fas fa-edit"></i> Editar
            </a>

            <a href="{{ route('sg.liderDeUnidad.sg.health.index') }}"
               class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    {{-- IDENTIFICACIÓN DEL BOVINO --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white font-weight-bold">
            <i class="fas fa-cow"></i> Información del Bovino
        </div>

        <div class="card-body">
            <div class="row text-center">

                <div class="col-md-4">
                    <h6 class="text-muted">Placa</h6>
                    <h4 class="font-weight-bold text-primary">
                        {{ $healthRecord->animal->plate }}
                    </h4>
                </div>

                <div class="col-md-4">
                    <h6 class="text-muted">Nombre</h6>
                    <h4 class="font-weight-bold">
                        {{ $healthRecord->animal->name ?: 'Sin nombre' }}
                    </h4>
                </div>

                <div class="col-md-4">
                    <h6 class="text-muted">Sexo</h6>
                    <span class="badge badge-pill badge-info px-4 py-2">
                        {{ $healthRecord->animal->sex === 'FEMALE' ? 'Hembra' : 'Macho' }}
                    </span>
                </div>

            </div>
        </div>
    </div>

    {{-- SIGNOS VITALES --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light font-weight-bold">
            <i class="fas fa-heartbeat"></i> Signos Vitales
        </div>

        <div class="card-body">
            <div class="row text-center">

                <div class="col-md-3">
                    <h6 class="text-muted">Temperatura</h6>
                    <h4 class="font-weight-bold">
                        {{ $healthRecord->temperature ? $healthRecord->temperature.' °C' : '—' }}
                    </h4>
                </div>

                <div class="col-md-3">
                    <h6 class="text-muted">Frecuencia Cardíaca</h6>
                    <h4 class="font-weight-bold">
                        {{ $healthRecord->heart_rate ? $healthRecord->heart_rate.' lat/min' : '—' }}
                    </h4>
                </div>

                <div class="col-md-3">
                    <h6 class="text-muted">Frecuencia Respiratoria</h6>
                    <h4 class="font-weight-bold">
                        {{ $healthRecord->respiratory_rate ? $healthRecord->respiratory_rate.' resp/min' : '—' }}
                    </h4>
                </div>

                <div class="col-md-3">
                    <h6 class="text-muted">Mov. Ruminales</h6>
                    <h4 class="font-weight-bold">
                        {{ $healthRecord->ruminal_movements ?: '—' }}
                    </h4>
                </div>

            </div>
        </div>
    </div>

    {{-- EVALUACIÓN CLÍNICA --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light font-weight-bold">
            <i class="fas fa-stethoscope"></i> Evaluación Clínica
        </div>

        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Consistencia Fecal:</strong><br>
                    {{ $healthRecord->fecal_consistency ?: '—' }}
                </div>

                <div class="col-md-6">
                    <strong>Descripción de Orina:</strong><br>
                    {{ $healthRecord->urine_description ?: '—' }}
                </div>
            </div>

            <div class="mb-3">
                <strong>Síntomas:</strong>
                <div class="border rounded p-3 bg-light">
                    {{ $healthRecord->symptoms ?: 'Sin síntomas registrados' }}
                </div>
            </div>

            <div>
                <strong>Diagnóstico:</strong>
                <div class="border rounded p-3 bg-light">
                    {{ $healthRecord->diagnosis ?: 'Sin diagnóstico registrado' }}
                </div>
            </div>

        </div>
    </div>

    {{-- RESPONSABLES --}}
    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-light font-weight-bold">
            <i class="fas fa-user-md"></i> Responsables
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <strong>Veterinario:</strong><br>
                    {{ $healthRecord->veterinarian ?: 'No especificado' }}
                </div>

                <div class="col-md-6">
                    <strong>Responsable del Registro:</strong><br>
                    {{ $healthRecord->responsible ?: 'No especificado' }}
                </div>

            </div>

            <hr>

            <strong>Observaciones:</strong>
            <div class="border rounded p-3 bg-light mt-2">
                {{ $healthRecord->observations ?: 'Sin observaciones' }}
            </div>
        </div>
    </div>

</div>
@endsection

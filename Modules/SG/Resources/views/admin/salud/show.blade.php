@extends('sg::layouts.master')

@section('content')
<br><br>
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
            <a href="{{ route('sg.admin.sg.salud.edit', $healthRecord) }}"
               class="btn btn-warning mr-2">
                <i class="fas fa-edit"></i> Editar
            </a>

            <a href="{{ route('sg.admin.sg.tratamientos.index', ['health_record_id' => $healthRecord->id]) }}"
               class="btn btn-info mr-2">
                <i class="fas fa-pills"></i> Tratamientos
            </a>

            <a href="{{ route('sg.admin.sg.salud.index') }}"
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
                    <div class="p-3 bg-light rounded">
                        <h6 class="text-muted small">Temperatura</h6>
                        <h3 class="font-weight-bold text-primary">
                            {{ $healthRecord->temperature ? $healthRecord->temperature.' °C' : '—' }}
                        </h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="p-3 bg-light rounded">
                        <h6 class="text-muted small">Frecuencia Cardíaca</h6>
                        <h3 class="font-weight-bold text-success">
                            {{ $healthRecord->heart_rate ? $healthRecord->heart_rate.' lat/min' : '—' }}
                        </h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="p-3 bg-light rounded">
                        <h6 class="text-muted small">Frecuencia Respiratoria</h6>
                        <h3 class="font-weight-bold text-info">
                            {{ $healthRecord->respiratory_rate ? $healthRecord->respiratory_rate.' resp/min' : '—' }}
                        </h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="p-3 bg-light rounded">
                        <h6 class="text-muted small">Mov. Ruminales</h6>
                        <h3 class="font-weight-bold text-warning">
                            {{ $healthRecord->ruminal_movements ?: '—' }}
                        </h3>
                    </div>
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

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded">
                        <h6 class="text-muted small font-weight-bold">Consistencia Fecal</h6>
                        <p class="mb-0 text-dark">{{ $healthRecord->fecal_consistency ?: '—' }}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-light rounded">
                        <h6 class="text-muted small font-weight-bold">Descripción de Orina</h6>
                        <p class="mb-0 text-dark">{{ $healthRecord->urine_description ?: '—' }}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-light rounded">
                        <h6 class="text-muted small font-weight-bold">Movimientos Ruminales</h6>
                        <p class="mb-0 text-dark">{{ $healthRecord->ruminal_movements ?: '—' }}</p>
                    </div>
                </div>
            </div>

            @if($healthRecord->symptoms)
            <div class="mb-3">
                <h6 class="font-weight-bold text-danger">
                    <i class="fas fa-exclamation-circle"></i> Síntomas
                </h6>
                <div class="alert alert-light border border-danger p-3" style="border-left: 4px solid #dc3545;">
                    {{ $healthRecord->symptoms }}
                </div>
            </div>
            @endif

            @if($healthRecord->diagnosis)
            <div>
                <h6 class="font-weight-bold text-info">
                    <i class="fas fa-microscope"></i> Diagnóstico
                </h6>
                <div class="alert alert-light border border-info p-3" style="border-left: 4px solid #17a2b8;">
                    {{ $healthRecord->diagnosis }}
                </div>
            </div>
            @endif

        </div>
    </div>

    {{-- RESPONSABLES --}}
    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-light font-weight-bold">
            <i class="fas fa-user-md"></i> Responsables y Observaciones
        </div>

        <div class="card-body">
            <div class="row mb-4">

                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <h6 class="text-muted small font-weight-bold">
                            <i class="fas fa-stethoscope"></i> Veterinario
                        </h6>
                        <h5 class="mb-0 text-dark">{{ $healthRecord->veterinarian ?: 'No especificado' }}</h5>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <h6 class="text-muted small font-weight-bold">
                            <i class="fas fa-user"></i> Responsable del Registro
                        </h6>
                        <h5 class="mb-0 text-dark">{{ $healthRecord->responsible ?: 'No especificado' }}</h5>
                    </div>
                </div>

            </div>

            @if($healthRecord->observations)
            <div>
                <h6 class="font-weight-bold text-secondary">
                    <i class="fas fa-sticky-note"></i> Observaciones
                </h6>
                <div class="alert alert-light border border-secondary p-3" style="border-left: 4px solid #6c757d;">
                    {{ $healthRecord->observations }}
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- HISTORIAL DE CAMBIOS - EXPEDIENTE CLÍNICO --}}
    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white font-weight-bold">
            <i class="fas fa-history"></i> Expediente Clínico - Historial de Atenciones
        </div>

        <div class="card-body">
            @if($healthRecord->histories && $healthRecord->histories->count())
                <div class="timeline">
                    @foreach($healthRecord->histories->sortByDesc('created_at') as $index => $history)
                        @php 
                            $s = (array) $history->snapshot;
                            $isFirst = $index === 0;
                        @endphp
                        <div class="timeline-item {{ !$isFirst ? 'mt-4' : '' }}">
                            {{-- Timeline marker --}}
                            <div class="timeline-marker {{ $isFirst ? 'bg-info' : 'bg-secondary' }}">
                                <i class="fas fa-file-medical"></i>
                            </div>

                            {{-- Card de atención --}}
                            <div class="card border-left border-info shadow-sm timeline-content">
                                {{-- Header --}}
                                <div class="card-header bg-white border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-md-9">
                                            <div class="d-flex align-items-center">
                                                <span class="badge badge-primary mr-2">
                                                    <i class="fas fa-calendar"></i> {{ $history->created_at->format('d/m/Y') }}
                                                </span>
                                                <span class="badge badge-secondary mr-2">
                                                    <i class="fas fa-clock"></i> {{ $history->created_at->format('H:i') }}
                                                </span>
                                                @if($history->created_by)
                                                    <span class="badge badge-light text-dark">
                                                        <i class="fas fa-user-md"></i> {{ $history->created_by }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <button class="btn btn-sm btn-outline-primary" type="button" 
                                                    data-toggle="collapse" data-target="#hist-detail-{{ $history->id }}" 
                                                    aria-expanded="false">
                                                <i class="fas fa-expand-alt"></i> Expandir
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Main Content --}}
                                <div class="card-body">
                                    <div class="row">
                                        {{-- Signos Vitales --}}
                                        <div class="col-md-4">
                                            <h6 class="font-weight-bold text-primary mb-3">
                                                <i class="fas fa-heartbeat"></i> Signos Vitales
                                            </h6>
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Temperatura:</small></td>
                                                    <td class="text-right"><strong>{{ $s['temperature'] ?? '—' }}°C</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">F. Cardíaca:</small></td>
                                                    <td class="text-right"><strong>{{ $s['heart_rate'] ?? '—' }} lat/min</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">F. Respiratoria:</small></td>
                                                    <td class="text-right"><strong>{{ $s['respiratory_rate'] ?? '—' }} resp/min</strong></td>
                                                </tr>
                                            </table>
                                        </div>

                                        {{-- Evaluación Clínica --}}
                                        <div class="col-md-4">
                                            <h6 class="font-weight-bold text-success mb-3">
                                                <i class="fas fa-stethoscope"></i> Evaluación
                                            </h6>
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Mov. Ruminales:</small></td>
                                                    <td class="text-right"><strong>{{ $s['ruminal_movements'] ?? '—' }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Consist. Fecal:</small></td>
                                                    <td class="text-right"><strong>{{ $s['fecal_consistency'] ?? '—' }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Descripción Orina:</small></td>
                                                    <td class="text-right"><strong>{{ $s['urine_description'] ?? '—' }}</strong></td>
                                                </tr>
                                            </table>
                                        </div>

                                        {{-- Profesionales --}}
                                        <div class="col-md-4">
                                            <h6 class="font-weight-bold text-warning mb-3">
                                                <i class="fas fa-user-md"></i> Profesionales
                                            </h6>
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Veterinario:</small></td>
                                                    <td class="text-right"><strong>{{ $s['veterinarian'] ?? '—' }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Responsable:</small></td>
                                                    <td class="text-right"><strong>{{ $s['responsible'] ?? '—' }}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- Síntomas y Diagnóstico (collapsible) --}}
                                    <div id="hist-detail-{{ $history->id }}" class="collapse mt-3">
                                        <hr>
                                        
                                        @if($s['symptoms'] ?? null)
                                        <div class="mb-3">
                                            <h6 class="font-weight-bold text-danger">
                                                <i class="fas fa-exclamation-circle"></i> Síntomas
                                            </h6>
                                            <div class="alert alert-light border border-danger p-3" style="border-left: 4px solid #dc3545;">
                                                {{ $s['symptoms'] }}
                                            </div>
                                        </div>
                                        @endif

                                        @if($s['diagnosis'] ?? null)
                                        <div class="mb-3">
                                            <h6 class="font-weight-bold text-info">
                                                <i class="fas fa-microscope"></i> Diagnóstico
                                            </h6>
                                            <div class="alert alert-light border border-info p-3" style="border-left: 4px solid #17a2b8;">
                                                {{ $s['diagnosis'] }}
                                            </div>
                                        </div>
                                        @endif

                                        @if($s['observations'] ?? null)
                                        <div>
                                            <h6 class="font-weight-bold text-secondary">
                                                <i class="fas fa-sticky-note"></i> Observaciones
                                            </h6>
                                            <div class="alert alert-light border border-secondary p-3" style="border-left: 4px solid #6c757d;">
                                                {{ $s['observations'] }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Footer con Fecha de Registro --}}
                                <div class="card-footer bg-white border-top small text-muted">
                                    <i class="fas fa-sticky-note"></i> Fecha del registro clínico: 
                                    <strong>{{ isset($s['record_date']) ? (\Carbon\Carbon::parse($s['record_date'])->format('d/m/Y')) : '—' }}</strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <style>
                    .timeline {
                        position: relative;
                        padding-left: 30px;
                    }

                    .timeline-item {
                        position: relative;
                    }

                    .timeline-marker {
                        position: absolute;
                        left: -45px;
                        top: 20px;
                        width: 30px;
                        height: 30px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-size: 12px;
                        z-index: 5;
                        border: 3px solid white;
                        box-shadow: 0 0 0 3px #e3e6f0;
                    }

                    .timeline-content {
                        border-left: 3px solid #0051ba !important;
                        border-radius: 8px;
                    }

                    .timeline-item:not(:last-child) .timeline-content::after {
                        content: '';
                        position: absolute;
                        left: -3px;
                        top: 100%;
                        width: 3px;
                        height: 30px;
                        background-color: #e3e6f0;
                    }
                </style>
            @else
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-info-circle fa-2x mb-3" style="color: #0c5460;"></i>
                    <p class="mb-0">Esta historia clínica no tiene historial de actualizaciones previas.</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
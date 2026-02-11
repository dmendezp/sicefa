@extends('sg::layouts.master')

@section('content')
<br><br><br><br>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold text-dark">
            💊 Detalle del Tratamiento
        </h3>

        <a href="{{ route('sg.admin.sg.tratamientos.index') }}"
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
                <a href="{{ route('sg.admin.sg.tratamientos.edit', $treatment) }}"
                   class="btn btn-warning btn-lg mr-3">
                    <i class="fas fa-edit"></i> Editar Tratamiento
                </a>

                <a href="{{ route('sg.admin.sg.tratamientos.index') }}"
                   class="btn btn-secondary btn-lg">
                    <i class="fas fa-list"></i> Volver al Listado
                </a>
            </div>

        </div>
    </div>
</div>

{{-- HISTORIAL DE CAMBIOS - EXPEDIENTE CLÍNICO --}}
    <div class="card mb-5 shadow-sm mt-4">
        <div class="card-header bg-primary text-white font-weight-bold">
            <i class="fas fa-history"></i> Historial de Cambios
        </div>

        <div class="card-body">
            @if($treatment->histories && $treatment->histories->count())
                <div class="timeline">
                    @foreach($treatment->histories->sortByDesc('created_at') as $index => $history)
                        @php 
                            $s = (array) $history->snapshot;
                            $isFirst = $index === 0;
                        @endphp
                        <div class="timeline-item {{ !$isFirst ? 'mt-4' : '' }}">
                            {{-- Timeline marker --}}
                            <div class="timeline-marker {{ $isFirst ? 'bg-info' : 'bg-secondary' }}">
                                <i class="fas fa-pills"></i>
                            </div>

                            {{-- Card de cambio --}}
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
                                        {{-- Detalles Tratamiento --}}
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold text-primary mb-3">
                                                <i class="fas fa-pills"></i> Detalles del Tratamiento
                                            </h6>
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Medicamento:</small></td>
                                                    <td class="text-right"><strong>{{ $treatment->medicine_name ?: 'No especificado' }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Dosis:</small></td>
                                                    <td class="text-right"><strong>{{ $s['dose'] ?? '—' }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Vía Admin.:</small></td>
                                                    <td class="text-right"><strong>{{ $s['administration_route'] ?? '—' }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Frecuencia:</small></td>
                                                    <td class="text-right"><strong>{{ $s['frequency'] ?? '—' }}</strong></td>
                                                </tr>
                                            </table>
                                        </div>

                                        {{-- Fecha --}}
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold text-success mb-3">
                                                <i class="fas fa-calendar-alt"></i> Fechas
                                            </h6>
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Fecha Tratamiento:</small></td>
                                                    <td class="text-right"><strong>{{ isset($s['treatment_date']) ? (\Carbon\Carbon::parse($s['treatment_date'])->format('d/m/Y')) : '—' }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0"><small class="text-muted">Creado:</small></td>
                                                    <td class="text-right"><strong>{{ isset($s['created_at']) ? (\Carbon\Carbon::parse($s['created_at'])->format('d/m/Y H:i')) : '—' }}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- Observaciones (collapsible) --}}
                                    <div id="hist-detail-{{ $history->id }}" class="collapse mt-3">
                                        <hr>
                                        
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
                    <p class="mb-0">Este tratamiento no tiene historial de cambios registrados.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

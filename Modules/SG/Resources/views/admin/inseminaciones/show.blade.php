@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Detalle de Inseminación</h3>
        <a href="{{ route('sg.admin.sg.inseminaciones.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    {{-- Card principal --}}
    <div class="card shadow-sm">

        {{-- Encabezado --}}
        <div class="card-header bg-info text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 font-weight-bold">
                        Inseminación · {{ $insemination->insemination_date->format('d/m/Y') }}
                    </h5>
                    <small>
                        Vaca {{ $insemination->animal->id }} -
                        {{ $insemination->animal->name ?: 'Sin nombre' }}
                    </small>
                </div>

                <div>
                    <span class="badge badge-pill
                        {{ $insemination->palpation_result === 'POSITIVE' ? 'badge-success' : '' }}
                        {{ $insemination->palpation_result === 'NEGATIVE' ? 'badge-danger' : '' }}
                        {{ $insemination->palpation_result === 'PENDING' ? 'badge-warning' : '' }}">
                        {{ $insemination->gestation_status }}
                    </span>
                </div>
            </div>
        </div>

        <div class="card-body">

            <div class="row">

                {{-- Datos de la vaca --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-primary">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-primary mb-3">
                                <i class="fas fa-cow"></i> Información de la Vaca
                            </h6>

                            <p><strong>Código:</strong> {{ $insemination->animal->id }}</p>
                            <p><strong>Nombre:</strong> {{ $insemination->animal->name ?: 'Sin nombre' }}</p>
                            <p class="mb-0"><strong>Raza:</strong> {{ $insemination->animal->breed?->name ?? '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Datos de la inseminación --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-info">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-info mb-3">
                                <i class="fas fa-syringe"></i> Datos de la Inseminación
                            </h6>

                            <p><strong>Fecha:</strong> {{ $insemination->insemination_date->format('d/m/Y') }}</p>
                            <p><strong>Método:</strong> {{ $insemination->method ?: '—' }}</p>
                            <p><strong>Técnico:</strong> {{ $insemination->technician ?: '—' }}</p>
                            <p class="mb-0"><strong>Parto estimado:</strong>
                                {{ $insemination->expected_birth_date
                                    ? $insemination->expected_birth_date->format('d/m/Y')
                                    : '—' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Material genético --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-secondary">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-secondary mb-3">
                                <i class="fas fa-dna"></i> Material Genético
                            </h6>

                            <p><strong>Toro:</strong> {{ $insemination->bull_name ?: 'No especificado' }}</p>
                            <p class="mb-0"><strong>Pajuela:</strong> {{ $insemination->straw_code ?: '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Observaciones --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-success">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-success mb-3">
                                <i class="fas fa-notes-medical"></i> Observaciones
                            </h6>

                            <p class="mb-0">
                                {{ $insemination->observations ?: 'Sin observaciones registradas' }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- Acciones --}}
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('sg.admin.sg.inseminaciones.edit', $insemination) }}"
               class="btn btn-warning mr-2">
                <i class="fas fa-edit"></i> Editar
            </a>

            <a href="{{ route('sg.admin.sg.inseminaciones.index') }}"
               class="btn btn-outline-secondary">
                Volver al listado
            </a>
        </div>

    </div>

</div>
@endsection

@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Detalle de Herramienta: {{ $tool->code }}</h3>
        <a href="{{ route('sg.admin.sg.herramientas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver al Inventario
        </a>
    </div>

    {{-- Contenido Principal --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $tool->name }}</h4>
            <small>{{ $tool->type_in_spanish }}</small>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Identificación --}}
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-light">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 font-weight-bold">Identificación</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Código:</strong> <span class="badge badge-info">{{ $tool->code }}</span></p>
                            <p><strong>Nombre:</strong> {{ $tool->name }}</p>
                            <p><strong>Tipo:</strong> {{ $tool->type_in_spanish }}</p>
                            <p><strong>Marca:</strong> {{ $tool->brand ?: '—' }}</p>
                            <p><strong>Modelo:</strong> {{ $tool->model ?: '—' }}</p>
                            <p><strong>Serie:</strong> {{ $tool->serial_number ?: '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Estado y Ubicación --}}
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-light">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 font-weight-bold">Estado y Ubicación</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Estado:</strong>
                                <span class="badge badge-pill
                                    {{ $tool->status === 'OPERATIONAL' ? 'badge-success' : '' }}
                                    {{ $tool->status === 'MAINTENANCE' ? 'badge-warning' : '' }}
                                    {{ $tool->status === 'DAMAGED' ? 'badge-danger' : '' }}
                                    {{ $tool->status === 'OUT_OF_SERVICE' ? 'badge-secondary' : '' }}">
                                    {{ $tool->status_in_spanish }}
                                </span>
                            </p>
                            <p><strong>Ubicación:</strong> {{ $tool->location ?: '—' }}</p>
                            <p><strong>Responsable:</strong> {{ $tool->current_responsible ?: '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Adquisición --}}
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-light">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 font-weight-bold">Adquisición</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Fecha:</strong> {{ $tool->acquisition_date?->format('d/m/Y') ?? '—' }}</p>
                            <p><strong>Valor:</strong> {{ $tool->purchase_value ? '$'.number_format($tool->purchase_value, 2) : '—' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Observaciones --}}
            @if($tool->observations)
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card border-light">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 font-weight-bold">Observaciones</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">{{ $tool->observations }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('sg.admin.sg.herramientas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('sg.admin.sg.herramientas.edit', $tool) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>

</div>
@endsection
@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-tools text-primary"></i>
                Detalle de Herramienta
            </h3>
            <small class="text-muted">
                Código: <span class="badge badge-info">{{ $tool->code }}</span>
            </small>
        </div>

        <div>
            <a href="{{ route('sg.admin.sg.herramientas.index') }}" class="btn btn-secondary mr-2">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('sg.admin.sg.herramientas.edit', $tool) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="card shadow-lg border-0">

        {{-- CABECERA --}}
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $tool->name }}</h4>
            <small class="opacity-75">{{ $tool->type_in_spanish }}</small>
        </div>

        <div class="card-body">

            <div class="row">

                {{-- IDENTIFICACIÓN --}}
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-primary mb-3">
                                🔎 Identificación
                            </h6>

                            <p><strong>Código:</strong> {{ $tool->code }}</p>
                            <p><strong>Nombre:</strong> {{ $tool->name }}</p>
                            <p><strong>Tipo:</strong> {{ $tool->type_in_spanish }}</p>
                            <p><strong>Marca:</strong> {{ $tool->brand ?: '—' }}</p>
                            <p><strong>Modelo:</strong> {{ $tool->model ?: '—' }}</p>
                            <p><strong>N° Serie:</strong> {{ $tool->serial_number ?: '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- ESTADO Y UBICACIÓN --}}
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-primary mb-3">
                                📍 Estado y Ubicación
                            </h6>

                            <p>
                                <strong>Estado:</strong>
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

                {{-- ADQUISICIÓN --}}
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-primary mb-3">
                                💰 Adquisición
                            </h6>

                            <p>
                                <strong>Fecha:</strong>
                                {{ $tool->acquisition_date?->format('d/m/Y') ?? '—' }}
                            </p>

                            <p>
                                <strong>Valor de Compra:</strong>
                                {{ $tool->purchase_value ? '$'.number_format($tool->purchase_value, 2) : '—' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- OBSERVACIONES --}}
            @if($tool->observations)
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h6 class="font-weight-bold text-primary mb-3">
                                    📝 Observaciones
                                </h6>
                                <p class="text-muted mb-0">{{ $tool->observations }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        {{-- FOOTER --}}
        <div class="card-footer d-flex justify-content-between bg-white">
            <a href="{{ route('sg.admin.sg.herramientas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a>

            <a href="{{ route('sg.admin.sg.herramientas.edit', $tool) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar Herramienta
            </a>
        </div>

    </div>
</div>
@endsection

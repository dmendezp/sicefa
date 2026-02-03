@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-box-open text-success"></i>
                Detalle del Insumo
            </h3>
            <small class="text-muted">
                Código: {{ $supply->code }}
            </small>
        </div>

        <div>
            <a href="{{ route('sg.admin.sg.insumos.index') }}" class="btn btn-secondary mr-2">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('sg.admin.sg.insumos.edit', $supply) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>

    {{-- ALERTAS --}}
    @if($supply->current_stock <= $supply->minimum_stock)
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            Stock bajo: el nivel actual está por debajo del mínimo permitido.
        </div>
    @endif

    @if($supply->expiration_date && $supply->expiration_date < now())
        <div class="alert alert-warning">
            <i class="fas fa-clock"></i>
            Este insumo se encuentra vencido.
        </div>
    @endif

    {{-- CARD PRINCIPAL --}}
    <div class="card shadow-lg border-0">

        {{-- CABECERA --}}
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">{{ $supply->name }}</h4>
            <small>{{ $supply->type_in_spanish }}</small>
        </div>

        <div class="card-body">

            <div class="row">

                {{-- INFORMACIÓN GENERAL --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3">
                                📦 Información General
                            </h5>

                            <p>
                                <strong>Código:</strong><br>
                                <span class="badge badge-primary">{{ $supply->code }}</span>
                            </p>

                            <p><strong>Nombre:</strong><br>{{ $supply->name }}</p>

                            <p>
                                <strong>Tipo:</strong><br>
                                <span class="badge
                                    {{ $supply->type==='MEDICINE' ? 'badge-danger' : '' }}
                                    {{ $supply->type==='VACCINE' ? 'badge-info' : '' }}
                                    {{ $supply->type==='FEED' ? 'badge-success' : '' }}
                                    {{ $supply->type==='SUPPLEMENT' ? 'badge-warning' : '' }}
                                    {{ $supply->type==='OTHER' ? 'badge-secondary' : '' }}">
                                    {{ $supply->type_in_spanish }}
                                </span>
                            </p>

                            <p><strong>Presentación:</strong><br>
                                {{ $supply->presentation ?: 'No especificada' }}
                            </p>

                            <p><strong>Unidad:</strong><br>{{ strtoupper($supply->unit) }}</p>
                        </div>
                    </div>
                </div>

                {{-- INVENTARIO --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3">
                                📊 Inventario
                            </h5>

                            <p>
                                <strong>Stock Actual:</strong><br>
                                <span class="font-weight-bold
                                    {{ $supply->current_stock <= $supply->minimum_stock ? 'text-danger' : 'text-success' }}">
                                    {{ number_format($supply->current_stock, 2) }} {{ $supply->unit }}
                                </span>
                            </p>

                            <p>
                                <strong>Stock Mínimo:</strong><br>
                                {{ number_format($supply->minimum_stock, 2) }} {{ $supply->unit }}
                            </p>

                            <p>
                                <strong>Precio Unitario:</strong><br>
                                {{ $supply->unit_price ? '$'.number_format($supply->unit_price, 2) : '—' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- PROVEEDOR Y TRAZABILIDAD --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3">
                                🧾 Trazabilidad
                            </h5>

                            <p>
                                <strong>Proveedor:</strong><br>
                                {{ $supply->supplier ?: 'No registrado' }}
                            </p>

                            <p>
                                <strong>Número de Lote:</strong><br>
                                {{ $supply->batch_number ?: 'Sin lote' }}
                            </p>

                            <p>
                                <strong>Fecha de Vencimiento:</strong><br>
                                @if($supply->expiration_date)
                                    <span class="{{ $supply->expiration_date < now() ? 'text-danger font-weight-bold' : '' }}">
                                        {{ $supply->expiration_date->format('d/m/Y') }}
                                    </span>
                                @else
                                    —
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- OBSERVACIONES --}}
            @if($supply->observations)
                <div class="card border-0 bg-light mt-3">
                    <div class="card-body">
                        <h5 class="font-weight-bold mb-2">
                            📝 Observaciones
                        </h5>
                        <p class="mb-0">{{ $supply->observations }}</p>
                    </div>
                </div>
            @endif

        </div>

        {{-- FOOTER --}}
        <div class="card-footer d-flex justify-content-between bg-white">
            <small class="text-muted">
                Creado: {{ $supply->created_at->format('d/m/Y H:i') }} |
                Última actualización: {{ $supply->updated_at->format('d/m/Y H:i') }}
            </small>

            <a href="{{ route('sg.admin.sg.insumos.edit', $supply) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
</div>
@endsection

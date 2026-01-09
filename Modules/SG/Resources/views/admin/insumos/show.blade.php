@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Detalle del Insumo: {{ $supply->code }}</h3>
        <a href="{{ route('sg.admin.sg.insumos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver al Inventario
        </a>
    </div>

    {{-- Card Principal --}}
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">{{ $supply->name }}</h4>
            <p class="mb-0 small">{{ $supply->type_in_spanish }}</p>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Información General --}}
                <div class="col-md-4 mb-4">
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-3">Información General</h5>
                            <p><strong>Código:</strong> <span class="badge badge-primary">{{ $supply->code }}</span></p>
                            <p><strong>Nombre:</strong> {{ $supply->name }}</p>
                            <p><strong>Tipo:</strong> 
                                <span class="badge badge-pill
                                    {{ $supply->type==='MEDICINE' ? 'badge-danger' : '' }}
                                    {{ $supply->type==='VACCINE' ? 'badge-info' : '' }}
                                    {{ $supply->type==='FEED' ? 'badge-success' : '' }}
                                    {{ $supply->type==='SUPPLEMENT' ? 'badge-purple' : '' }}
                                    {{ $supply->type==='OTHER' ? 'badge-secondary' : '' }}">
                                    {{ $supply->type }}
                                </span>
                            </p>
                            <p><strong>Presentación:</strong> {{ $supply->presentation ?: 'No especificada' }}</p>
                            <p><strong>Unidad:</strong> {{ $supply->unit }}</p>
                        </div>
                    </div>
                </div>

                {{-- Inventario --}}
                <div class="col-md-4 mb-4">
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-3">Inventario</h5>
                            <p><strong>Stock Actual:</strong> 
                                <span class="{{ $supply->current_stock <= $supply->minimum_stock ? 'text-danger font-weight-bold' : '' }}">
                                    {{ number_format($supply->current_stock, 2) }} {{ $supply->unit }}
                                </span>
                            </p>
                            <p><strong>Stock Mínimo:</strong> {{ number_format($supply->minimum_stock, 2) }} {{ $supply->unit }}</p>
                            <p><strong>Precio Unitario:</strong> {{ $supply->unit_price ? '$'.number_format($supply->unit_price, 2) : '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Proveedor y Lote --}}
                <div class="col-md-4 mb-4">
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-3">Proveedor y Lote</h5>
                            <p><strong>Proveedor:</strong> {{ $supply->supplier ?: 'No registrado' }}</p>
                            <p><strong>Lote:</strong> {{ $supply->batch_number ?: 'Sin lote' }}</p>
                            <p><strong>Vencimiento:</strong> 
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

            {{-- Observaciones --}}
            @if($supply->observations)
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold mb-3">Observaciones</h5>
                                <p class="text-gray-700">{{ $supply->observations }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('sg.admin.sg.insumos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('sg.admin.sg.insumos.edit', $supply->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar Insumo
            </a>
        </div>
    </div>
</div>
@endsection
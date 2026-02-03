@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="font-weight-bold text-dark">
            💊 Detalle del Medicamento
        </h3>
        <p class="text-muted">
            Información completa del medicamento registrado
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-lg border-0">

                {{-- CABECERA --}}
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 font-weight-bold">
                        {{ $medicine->name }}
                    </h5>

                    {{-- ALERTAS --}}
                    <div>
                        @if($medicine->expiration_date < now())
                            <span class="badge badge-danger">
                                VENCIDO
                            </span>
                        @elseif($medicine->expiration_date < now()->addDays(30))
                            <span class="badge badge-warning">
                                Por vencer
                            </span>
                        @endif

                        @if($medicine->stock <= $medicine->minimum_stock)
                            <span class="badge badge-danger ml-2">
                                Stock bajo
                            </span>
                        @endif
                    </div>
                </div>

                <div class="card-body p-4">

                    <div class="row">

                        {{-- Nombre --}}
                        <div class="col-md-6 mb-4">
                            <h6 class="text-muted">Nombre Comercial</h6>
                            <p class="h5 font-weight-bold">{{ $medicine->name }}</p>
                        </div>

                        {{-- Principio activo --}}
                        <div class="col-md-6 mb-4">
                            <h6 class="text-muted">Principio Activo</h6>
                            <p class="h5">{{ $medicine->active_principle }}</p>
                        </div>

                        {{-- Presentación --}}
                        <div class="col-md-4 mb-4">
                            <h6 class="text-muted">Presentación</h6>
                            <p>{{ $medicine->presentation }}</p>
                        </div>

                        {{-- Unidad --}}
                        <div class="col-md-4 mb-4">
                            <h6 class="text-muted">Unidad de Dosis</h6>
                            <p>{{ $medicine->dose_unit }}</p>
                        </div>

                        {{-- Laboratorio --}}
                        <div class="col-md-4 mb-4">
                            <h6 class="text-muted">Laboratorio</h6>
                            <p>{{ $medicine->manufacturer ?: 'No especificado' }}</p>
                        </div>

                        {{-- Lote --}}
                        <div class="col-md-4 mb-4">
                            <h6 class="text-muted">Lote</h6>
                            <p>{{ $medicine->batch ?: 'Sin lote' }}</p>
                        </div>

                        {{-- Vencimiento --}}
                        <div class="col-md-4 mb-4">
                            <h6 class="text-muted">Fecha de Vencimiento</h6>
                            <p class="{{ $medicine->expiration_date < now() ? 'text-danger font-weight-bold' : '' }}">
                                {{ $medicine->expiration_date->format('d/m/Y') }}
                            </p>
                        </div>

                        {{-- Stock --}}
                        <div class="col-md-4 mb-4">
                            <h6 class="text-muted">Stock Actual</h6>
                            <p class="{{ $medicine->stock <= $medicine->minimum_stock ? 'text-danger font-weight-bold' : 'text-success font-weight-bold' }}">
                                {{ $medicine->stock }} {{ $medicine->dose_unit }}
                            </p>
                            <small class="text-muted">
                                Mínimo: {{ $medicine->minimum_stock }}
                            </small>
                        </div>

                    </div>

                    {{-- OBSERVACIONES --}}
                    <div class="mt-4">
                        <h6 class="text-muted">Observaciones</h6>
                        <div class="border rounded p-3 bg-light">
                            {{ $medicine->observations ?: 'Sin observaciones registradas' }}
                        </div>
                    </div>

                    {{-- BOTONES --}}
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('sg.admin.sg.medicamentos.index') }}"
                           class="btn btn-outline-secondary">
                            ← Volver al listado
                        </a>

                        <a href="{{ route('sg.admin.sg.medicamentos.edit', $medicine) }}"
                           class="btn btn-warning">
                            ✏️ Editar Medicamento
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection

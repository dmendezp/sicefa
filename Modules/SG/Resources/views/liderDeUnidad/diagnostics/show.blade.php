@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Detalle de Prueba Diagnóstica</h3>
        <a href="{{ route('sg.liderDeUnidad.sg.diagnostics.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    {{-- Card principal --}}
    <div class="card shadow-sm">

        {{-- Encabezado visual --}}
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1 font-weight-bold">Prueba Diagnóstica</h4>
                    <small>
                        Bovino {{ $test->animal->id }} ·
                        {{ $test->test_date->format('d/m/Y') }}
                    </small>
                </div>

                <div>
                    @if($test->result)
                        <span class="badge badge-pill
                            {{ str_contains(strtolower($test->result), 'negativo') ? 'badge-danger' : '' }}
                            {{ str_contains(strtolower($test->result), 'positivo') ? 'badge-success' : '' }}
                            {{ str_contains(strtolower($test->result), 'indeterminado') ? 'badge-warning' : '' }}">
                            {{ $test->result }}
                        </span>
                    @else
                        <span class="badge badge-secondary">Pendiente</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-body">

            <div class="row">

                {{-- Información del Bovino --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-primary">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-primary mb-3">
                                <i class="fas fa-cow"></i> Información del Bovino
                            </h5>

                            <p class="mb-2">
                                <strong>Placa:</strong>
                                <span class="text-primary font-weight-bold">
                                    {{ $test->animal->plate }}
                                </span>
                            </p>

                            <p class="mb-2">
                                <strong>Nombre:</strong>
                                {{ $test->animal->name ?: 'Sin nombre' }}
                            </p>

                            <p class="mb-2">
                                <strong>Raza:</strong>
                                {{ $test->animal->breed?->name ?? '—' }}
                            </p>

                            <p class="mb-0">
                                <strong>Sexo:</strong>
                                {{ $test->animal->sex === 'FEMALE' ? 'Hembra' : 'Macho' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Detalles de la Prueba --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-left-info">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-info mb-3">
                                <i class="fas fa-vial"></i> Detalles de la Prueba
                            </h5>

                            <p class="mb-2">
                                <strong>Fecha:</strong>
                                {{ $test->test_date->format('d/m/Y') }}
                            </p>

                            <p class="mb-2">
                                <strong>Tipo de Prueba:</strong>
                                {{ $test->test_type }}
                            </p>

                            <p class="mb-0">
                                <strong>Resultado:</strong>
                                @if($test->result)
                                    <span class="badge badge-pill
                                        {{ str_contains(strtolower($test->result), 'negativo') ? 'badge-danger' : '' }}
                                        {{ str_contains(strtolower($test->result), 'positivo') ? 'badge-success' : '' }}
                                        {{ str_contains(strtolower($test->result), 'indeterminado') ? 'badge-warning' : '' }}">
                                        {{ $test->result }}
                                    </span>
                                @else
                                    <span class="badge badge-secondary">Pendiente</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Observaciones --}}
                <div class="col-md-12">
                    <div class="card border-left-success">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-success mb-3">
                                <i class="fas fa-notes-medical"></i> Observaciones
                            </h5>

                            <p class="mb-0">
                                {{ $test->observations ?: 'Sin observaciones adicionales' }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- Acciones --}}
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('sg.liderDeUnidad.sg.diagnostics.edit', $test) }}"
               class="btn btn-warning mr-2">
                <i class="fas fa-edit"></i> Editar
            </a>

            <a href="{{ route('sg.liderDeUnidad.sg.diagnostics.index') }}"
               class="btn btn-outline-secondary">
                Volver al listado
            </a>
        </div>

    </div>

</div>
@endsection

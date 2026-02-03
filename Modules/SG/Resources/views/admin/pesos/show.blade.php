@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="font-weight-bold text-dark">
                ⚖️ Detalle del Pesaje
            </h3>
            <p class="text-muted mb-0">
                Información completa del registro de peso
            </p>
        </div>

        <a href="{{ route('sg.admin.sg.pesos.index') }}"
           class="btn btn-secondary">
            ← Volver
        </a>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="card shadow-lg">
        <div class="card-body p-4">

            <div class="row">

                {{-- ANIMAL --}}
                <div class="col-md-6 mb-4">
                    <div class="border rounded p-3 h-100 bg-light">
                        <small class="text-muted d-block">Animal</small>
                        <h5 class="font-weight-bold text-primary mb-0">
                            {{ $record->animal->id }} - {{ $record->animal->name ?: 'Sin nombre' }}
                        </h5>
                    </div>
                </div>

                {{-- FECHA --}}
                <div class="col-md-6 mb-4">
                    <div class="border rounded p-3 h-100 bg-light">
                        <small class="text-muted d-block">Fecha del Pesaje</small>
                        <h5 class="font-weight-bold mb-0">
                            {{ $record->weigh_date->format('d/m/Y') }}
                        </h5>
                    </div>
                </div>

                {{-- PESO --}}
                <div class="col-md-4 mb-4">
                    <div class="border rounded p-3 h-100 text-center bg-white">
                        <small class="text-muted d-block">Peso Registrado</small>
                        <h2 class="font-weight-bold text-success mb-0">
                            {{ $record->weight_kg }} kg
                        </h2>
                    </div>
                </div>

                {{-- CONDICIÓN CORPORAL --}}
                <div class="col-md-4 mb-4">
                    <div class="border rounded p-3 h-100 bg-white">
                        <small class="text-muted d-block">Condición Corporal</small>
                        <h5 class="font-weight-bold mb-0">
                            {{ $record->body_condition_score ?: '-' }}
                        </h5>
                    </div>
                </div>

                {{-- OBSERVACIONES --}}
                <div class="col-md-12 mb-4">
                    <div class="border rounded p-3 bg-white">
                        <small class="text-muted d-block">Observaciones</small>
                        <p class="mb-0">
                            {{ $record->observations ?: 'Sin observaciones registradas.' }}
                        </p>
                    </div>
                </div>

            </div>

            {{-- ACCIONES --}}
            <div class="d-flex justify-content-end mt-4">

                <a href="{{ route('sg.admin.sg.pesos.edit', $record) }}"
                   class="btn btn-warning btn-lg mr-3">
                    ✏️ Editar
                </a>

                <form action="{{ route('sg.admin.sg.pesos.destroy', $record) }}"
                      method="POST"
                      onsubmit="return confirm('¿Está seguro de eliminar este registro de peso?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-danger btn-lg">
                        🗑 Eliminar
                    </button>
                </form>

            </div>

        </div>
    </div>

</div>
@endsection

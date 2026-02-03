@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-edit text-warning"></i>
                Editar Herramienta
            </h3>
            <small class="text-muted">
                {{ $tool->code }} · {{ $tool->name }}
            </small>
        </div>

        <a href="{{ route('sg.admin.sg.herramientas.show', $tool) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    {{-- CARD --}}
    <div class="card shadow-lg border-0">
        <div class="card-body p-4">

            <form action="{{ route('sg.admin.sg.herramientas.update', $tool) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- INFORMACIÓN GENERAL --}}
                <h5 class="font-weight-bold mb-3 text-warning">
                    📦 Información General
                </h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Código *</label>
                        <input type="text" name="code" value="{{ old('code', $tool->code) }}" required
                               class="form-control @error('code') is-invalid @enderror">
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Nombre *</label>
                        <input type="text" name="name" value="{{ old('name', $tool->name) }}" required
                               class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Tipo *</label>
                        <select name="type" required class="form-control">
                            <option value="SCALE" {{ $tool->type === 'SCALE' ? 'selected' : '' }}>Báscula</option>
                            <option value="EAR_TAG" {{ $tool->type === 'EAR_TAG' ? 'selected' : '' }}>Arete / Marcador</option>
                            <option value="SYRINGE" {{ $tool->type === 'SYRINGE' ? 'selected' : '' }}>Jeringa</option>
                            <option value="THERMOMETER" {{ $tool->type === 'THERMOMETER' ? 'selected' : '' }}>Termómetro</option>
                            <option value="OTHER" {{ $tool->type === 'OTHER' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                </div>

                <hr>

                {{-- DETALLES DEL EQUIPO --}}
                <h5 class="font-weight-bold mb-3 text-warning">
                    🛠 Detalles del Equipo
                </h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Marca</label>
                        <input type="text" name="brand" value="{{ old('brand', $tool->brand) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Modelo</label>
                        <input type="text" name="model" value="{{ old('model', $tool->model) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Número de Serie</label>
                        <input type="text" name="serial_number"
                               value="{{ old('serial_number', $tool->serial_number) }}"
                               class="form-control">
                    </div>
                </div>

                <hr>

                {{-- ESTADO Y UBICACIÓN --}}
                <h5 class="font-weight-bold mb-3 text-warning">
                    📍 Estado y Ubicación
                </h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Estado *</label>
                        <select name="status" required class="form-control">
                            <option value="OPERATIONAL" {{ $tool->status === 'OPERATIONAL' ? 'selected' : '' }}>Operativa</option>
                            <option value="MAINTENANCE" {{ $tool->status === 'MAINTENANCE' ? 'selected' : '' }}>En Mantenimiento</option>
                            <option value="DAMAGED" {{ $tool->status === 'DAMAGED' ? 'selected' : '' }}>Dañada</option>
                            <option value="OUT_OF_SERVICE" {{ $tool->status === 'OUT_OF_SERVICE' ? 'selected' : '' }}>Fuera de Servicio</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Ubicación</label>
                        <input type="text" name="location" value="{{ old('location', $tool->location) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Responsable Actual</label>
                        <input type="text" name="current_responsible"
                               value="{{ old('current_responsible', $tool->current_responsible) }}"
                               class="form-control">
                    </div>
                </div>

                <hr>

                {{-- ADQUISICIÓN --}}
                <h5 class="font-weight-bold mb-3 text-warning">
                    💰 Información de Adquisición
                </h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Fecha de Adquisición</label>
                        <input type="date" name="acquisition_date"
                               value="{{ old('acquisition_date', $tool->acquisition_date?->format('Y-m-d')) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Valor de Compra</label>
                        <input type="number" step="0.01" name="purchase_value"
                               value="{{ old('purchase_value', $tool->purchase_value) }}"
                               class="form-control">
                    </div>
                </div>

                <hr>

                {{-- OBSERVACIONES --}}
                <div class="form-group">
                    <label class="font-weight-bold">Observaciones</label>
                    <textarea name="observations" rows="4"
                              class="form-control">{{ old('observations', $tool->observations) }}</textarea>
                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('sg.admin.sg.herramientas.show', $tool) }}"
                       class="btn btn-secondary mr-2">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-warning btn-lg shadow">
                        <i class="fas fa-save"></i> Actualizar Herramienta
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

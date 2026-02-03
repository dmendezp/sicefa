@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-tools text-success"></i>
                Nueva Herramienta
            </h3>
            <small class="text-muted">
                Registro de herramientas y equipos ganaderos
            </small>
        </div>

        <a href="{{ route('sg.admin.sg.herramientas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    {{-- CARD --}}
    <div class="card shadow-lg border-0">
        <div class="card-body p-4">

            <form action="{{ route('sg.admin.sg.herramientas.store') }}" method="POST">
                @csrf

                {{-- INFORMACIÓN GENERAL --}}
                <h5 class="font-weight-bold mb-3 text-success">
                    📦 Información General
                </h5>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Código *</label>
                        <input type="text" name="code" value="{{ old('code') }}" required
                               class="form-control @error('code') is-invalid @enderror"
                               placeholder="HER-001, BAL-2025">
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Nombre *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Báscula Electrónica 1000kg">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Tipo *</label>
                        <select name="type" required class="form-control">
                            <option value="">Seleccionar tipo</option>
                            <option value="SCALE">Báscula</option>
                            <option value="EAR_TAG">Arete / Marcador</option>
                            <option value="SYRINGE">Jeringa</option>
                            <option value="THERMOMETER">Termómetro</option>
                            <option value="OTHER">Otro</option>
                        </select>
                    </div>

                </div>

                <hr>

                {{-- DETALLES DEL EQUIPO --}}
                <h5 class="font-weight-bold mb-3 text-success">
                    🛠 Detalles del Equipo
                </h5>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Marca</label>
                        <input type="text" name="brand" value="{{ old('brand') }}"
                               class="form-control"
                               placeholder="Tru-Test, Allflex">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Modelo</label>
                        <input type="text" name="model" value="{{ old('model') }}"
                               class="form-control"
                               placeholder="XR5000">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Número de Serie</label>
                        <input type="text" name="serial_number" value="{{ old('serial_number') }}"
                               class="form-control">
                    </div>

                </div>

                <hr>

                {{-- ESTADO Y UBICACIÓN --}}
                <h5 class="font-weight-bold mb-3 text-success">
                    📍 Estado y Ubicación
                </h5>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Estado *</label>
                        <select name="status" required class="form-control">
                            <option value="OPERATIONAL">Operativa</option>
                            <option value="MAINTENANCE">En Mantenimiento</option>
                            <option value="DAMAGED">Dañada</option>
                            <option value="OUT_OF_SERVICE">Fuera de Servicio</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Ubicación</label>
                        <input type="text" name="location" value="{{ old('location') }}"
                               class="form-control"
                               placeholder="Corral de pesaje">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Responsable Actual</label>
                        <input type="text" name="current_responsible" value="{{ old('current_responsible') }}"
                               class="form-control"
                               placeholder="Juan Pérez">
                    </div>

                </div>

                <hr>

                {{-- ADQUISICIÓN --}}
                <h5 class="font-weight-bold mb-3 text-success">
                    💰 Información de Adquisición
                </h5>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Fecha de Adquisición</label>
                        <input type="date" name="acquisition_date" value="{{ old('acquisition_date') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Valor de Compra</label>
                        <input type="number" step="0.01" name="purchase_value" value="{{ old('purchase_value') }}"
                               class="form-control">
                    </div>

                </div>

                <hr>

                {{-- OBSERVACIONES --}}
                <div class="form-group">
                    <label class="font-weight-bold">Observaciones</label>
                    <textarea name="observations" rows="4"
                              class="form-control"
                              placeholder="Notas adicionales sobre el estado o uso de la herramienta">{{ old('observations') }}</textarea>
                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('sg.admin.sg.herramientas.index') }}" class="btn btn-secondary mr-2">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-success btn-lg shadow">
                        <i class="fas fa-save"></i> Guardar Herramienta
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

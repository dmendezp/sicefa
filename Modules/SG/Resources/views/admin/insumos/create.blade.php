@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-boxes text-success"></i> Nuevo Insumo Ganadero
            </h3>
            <small class="text-muted">Registro de medicamentos, vacunas, alimentos y suplementos</small>
        </div>
        <span class="badge badge-success p-2">Nuevo Registro</span>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-body p-4">

            <form action="{{ route('sg.admin.sg.insumos.store') }}" method="POST">
                @csrf

                {{-- SECCIÓN GENERAL --}}
                <h5 class="font-weight-bold text-success border-bottom pb-2 mb-4">
                    📦 Información General
                </h5>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>Código <span class="text-danger">*</span></label>
                        <input type="text" name="code" value="{{ old('code') }}"
                               class="form-control @error('code') is-invalid @enderror"
                               placeholder="INS-001" required>
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Albendazol 10%" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label>Tipo <span class="text-danger">*</span></label>
                        <select name="type" class="form-control" required>
                            <option value="">Seleccionar tipo</option>
                            <option value="MEDICINE">Medicamento</option>
                            <option value="VACCINE">Vacuna</option>
                            <option value="FEED">Alimento</option>
                            <option value="SUPPLEMENT">Suplemento</option>
                            <option value="OTHER">Otro</option>
                        </select>
                    </div>

                </div>

                {{-- PRESENTACIÓN --}}
                <h5 class="font-weight-bold text-info border-bottom pb-2 mt-4 mb-4">
                    🧴 Presentación y Unidad
                </h5>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>Unidad <span class="text-danger">*</span></label>
                        <select name="unit" class="form-control" required>
                            <option value="ml">Mililitros</option>
                            <option value="cm³">cm³</option>
                            <option value="g">Gramos</option>
                            <option value="kg">Kilogramos</option>
                            <option value="units">Unidades</option>
                            <option value="liters">Litros</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Presentación</label>
                        <input type="text" name="presentation"
                               value="{{ old('presentation') }}"
                               class="form-control"
                               placeholder="Frasco 500 ml">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Proveedor</label>
                        <input type="text" name="supplier"
                               value="{{ old('supplier') }}"
                               class="form-control"
                               placeholder="AgroVeterinaria Central">
                    </div>

                </div>

                {{-- STOCK --}}
                <h5 class="font-weight-bold text-warning border-bottom pb-2 mt-4 mb-4">
                    📊 Control de Stock
                </h5>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>Stock Actual <span class="text-danger">*</span></label>
                        <input type="number" step="0.001" name="current_stock"
                               value="{{ old('current_stock', 0) }}"
                               class="form-control text-success font-weight-bold" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Stock Mínimo <span class="text-danger">*</span></label>
                        <input type="number" step="0.001" name="minimum_stock"
                               value="{{ old('minimum_stock', 10) }}"
                               class="form-control text-danger font-weight-bold" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Precio Unitario</label>
                        <input type="number" step="0.01" name="unit_price"
                               value="{{ old('unit_price') }}"
                               class="form-control"
                               placeholder="0.00">
                    </div>

                </div>

                {{-- TRAZABILIDAD --}}
                <h5 class="font-weight-bold text-secondary border-bottom pb-2 mt-4 mb-4">
                    🧾 Trazabilidad
                </h5>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>Fecha de Vencimiento</label>
                        <input type="date" name="expiration_date"
                               value="{{ old('expiration_date') }}"
                               class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Número de Lote</label>
                        <input type="text" name="batch_number"
                               value="{{ old('batch_number') }}"
                               class="form-control">
                    </div>

                </div>

                {{-- OBSERVACIONES --}}
                <div class="form-group mt-4">
                    <label>Observaciones</label>
                    <textarea name="observations" rows="3"
                              class="form-control"
                              placeholder="Notas adicionales...">{{ old('observations') }}</textarea>
                </div>

                {{-- ACCIONES --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('sg.admin.sg.insumos.index') }}"
                       class="btn btn-secondary mr-3">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>

                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save"></i> Guardar Insumo
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

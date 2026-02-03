@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-edit text-warning"></i>
                Editar Insumo
            </h3>
            <small class="text-muted">
                {{ $supply->code }} • {{ $supply->name }}
            </small>
        </div>

        <span class="badge badge-warning p-2">
            Edición
        </span>
    </div>

    {{-- ALERTAS CONTEXTUALES --}}
    @if($supply->current_stock <= $supply->minimum_stock)
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            Stock bajo: el nivel actual está por debajo del mínimo.
        </div>
    @endif

    @if($supply->expiration_date && $supply->expiration_date < now())
        <div class="alert alert-warning">
            <i class="fas fa-clock"></i>
            Este insumo se encuentra vencido.
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-body p-4">

            <form action="{{ route('sg.admin.sg.insumos.update', $supply) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- INFO GENERAL --}}
                <h5 class="font-weight-bold text-success border-bottom pb-2 mb-4">
                    📦 Información General
                </h5>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>Código <span class="text-danger">*</span></label>
                        <input type="text" name="code"
                               value="{{ old('code', $supply->code) }}"
                               class="form-control @error('code') is-invalid @enderror"
                               required>
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="name"
                               value="{{ old('name', $supply->name) }}"
                               class="form-control @error('name') is-invalid @enderror"
                               required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label>Tipo <span class="text-danger">*</span></label>
                        <select name="type" class="form-control" required>
                            @foreach(['MEDICINE'=>'Medicamento','VACCINE'=>'Vacuna','FEED'=>'Alimento','SUPPLEMENT'=>'Suplemento','OTHER'=>'Otro'] as $key=>$label)
                                <option value="{{ $key }}" {{ $supply->type === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
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
                            @foreach(['ml','cm³','g','kg','units','liters'] as $unit)
                                <option value="{{ $unit }}" {{ $supply->unit === $unit ? 'selected' : '' }}>
                                    {{ strtoupper($unit) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Presentación</label>
                        <input type="text" name="presentation"
                               value="{{ old('presentation', $supply->presentation) }}"
                               class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Proveedor</label>
                        <input type="text" name="supplier"
                               value="{{ old('supplier', $supply->supplier) }}"
                               class="form-control">
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
                               value="{{ old('current_stock', $supply->current_stock) }}"
                               class="form-control font-weight-bold
                               {{ $supply->current_stock <= $supply->minimum_stock ? 'text-danger' : 'text-success' }}"
                               required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Stock Mínimo <span class="text-danger">*</span></label>
                        <input type="number" step="0.001" name="minimum_stock"
                               value="{{ old('minimum_stock', $supply->minimum_stock) }}"
                               class="form-control font-weight-bold"
                               required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Precio Unitario</label>
                        <input type="number" step="0.01" name="unit_price"
                               value="{{ old('unit_price', $supply->unit_price) }}"
                               class="form-control">
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
                               value="{{ old('expiration_date', optional($supply->expiration_date)->format('Y-m-d')) }}"
                               class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Número de Lote</label>
                        <input type="text" name="batch_number"
                               value="{{ old('batch_number', $supply->batch_number) }}"
                               class="form-control">
                    </div>

                </div>

                {{-- OBSERVACIONES --}}
                <div class="form-group mt-4">
                    <label>Observaciones</label>
                    <textarea name="observations" rows="3"
                              class="form-control">{{ old('observations', $supply->observations) }}</textarea>
                </div>

                {{-- ACCIONES --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('sg.admin.sg.insumos.show', $supply) }}"
                       class="btn btn-secondary mr-3">
                        <i class="fas fa-times"></i> Cancelar
                    </a>

                    <button type="submit" class="btn btn-warning px-4">
                        <i class="fas fa-save"></i> Actualizar Insumo
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

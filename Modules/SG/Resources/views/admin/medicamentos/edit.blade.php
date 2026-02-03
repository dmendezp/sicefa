@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="font-weight-bold text-dark">
            ✏️ Editar Medicamento
        </h3>
        <p class="text-muted">
            {{ $medicine->name }}
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-lg border-0">

                {{-- CABECERA --}}
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 font-weight-bold">
                        Actualizar Información del Medicamento
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('sg.admin.sg.medicamentos.update', $medicine->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            {{-- Nombre --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Nombre Comercial *
                                </label>
                                <input type="text" name="name"
                                       value="{{ old('name', $medicine->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Principio activo --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Principio Activo *
                                </label>
                                <input type="text" name="active_principle"
                                       value="{{ old('active_principle', $medicine->active_principle) }}"
                                       class="form-control @error('active_principle') is-invalid @enderror">
                                @error('active_principle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Presentación --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Presentación *
                                </label>
                                <input type="text" name="presentation"
                                       value="{{ old('presentation', $medicine->presentation) }}"
                                       class="form-control">
                            </div>

                            {{-- Unidad --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Unidad de Dosis *
                                </label>
                                <input type="text" name="dose_unit"
                                       value="{{ old('dose_unit', $medicine->dose_unit) }}"
                                       class="form-control">
                            </div>

                            {{-- Laboratorio --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Laboratorio
                                </label>
                                <input type="text" name="manufacturer"
                                       value="{{ old('manufacturer', $medicine->manufacturer) }}"
                                       class="form-control">
                            </div>

                            {{-- Lote --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Lote
                                </label>
                                <input type="text" name="batch"
                                       value="{{ old('batch', $medicine->batch) }}"
                                       class="form-control">
                            </div>

                            {{-- Vencimiento --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Fecha de Vencimiento *
                                </label>
                                <input type="date" name="expiration_date"
                                       value="{{ old('expiration_date', $medicine->expiration_date?->format('Y-m-d')) }}"
                                       class="form-control @error('expiration_date') is-invalid @enderror">
                                @error('expiration_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Stock --}}
                            <div class="col-md-3 mb-4">
                                <label class="font-weight-bold">
                                    Stock Actual *
                                </label>
                                <input type="number" step="0.01" name="stock"
                                       value="{{ old('stock', $medicine->stock) }}"
                                       class="form-control">
                            </div>

                            {{-- Stock mínimo --}}
                            <div class="col-md-3 mb-4">
                                <label class="font-weight-bold">
                                    Stock Mínimo *
                                </label>
                                <input type="number" name="minimum_stock"
                                       value="{{ old('minimum_stock', $medicine->minimum_stock) }}"
                                       class="form-control">
                            </div>

                        </div>

                        {{-- Observaciones --}}
                        <div class="form-group">
                            <label class="font-weight-bold">
                                Observaciones
                            </label>
                            <textarea name="observations" rows="4"
                                      class="form-control">{{ old('observations', $medicine->observations) }}</textarea>
                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('sg.admin.sg.medicamentos.index') }}"
                               class="btn btn-outline-secondary">
                                ← Cancelar
                            </a>

                            <button type="submit"
                                    class="btn btn-success px-4">
                                💾 Actualizar Medicamento
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection

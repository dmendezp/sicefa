@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="font-weight-bold text-dark">
            💊 Nuevo Medicamento
        </h3>
        <p class="text-muted">
            Registrar un nuevo medicamento en el inventario veterinario
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-lg border-0">

                {{-- CABECERA --}}
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 font-weight-bold">
                        Datos del Medicamento
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('sg.admin.sg.medicamentos.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            {{-- Nombre --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Nombre Comercial *
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Ej: Oxitetraciclina LA 20%">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Principio activo --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Principio Activo *
                                </label>
                                <input type="text" name="active_principle" value="{{ old('active_principle') }}"
                                       class="form-control @error('active_principle') is-invalid @enderror"
                                       placeholder="Ej: Oxitetraciclina">
                                @error('active_principle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Presentación --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Presentación *
                                </label>
                                <input type="text" name="presentation" value="{{ old('presentation') }}"
                                       class="form-control @error('presentation') is-invalid @enderror"
                                       placeholder="Ej: Frasco 100 ml">
                                @error('presentation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Unidad dosis --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Unidad de Dosis *
                                </label>
                                <input type="text" name="dose_unit" value="{{ old('dose_unit') }}"
                                       class="form-control @error('dose_unit') is-invalid @enderror"
                                       placeholder="Ej: ml, mg, UI">
                                @error('dose_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Laboratorio --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Laboratorio
                                </label>
                                <input type="text" name="manufacturer" value="{{ old('manufacturer') }}"
                                       class="form-control"
                                       placeholder="Ej: Zoetis, MSD">
                            </div>

                            {{-- Lote --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Lote
                                </label>
                                <input type="text" name="batch" value="{{ old('batch') }}"
                                       class="form-control">
                            </div>

                            {{-- Vencimiento --}}
                            <div class="col-md-6 mb-4">
                                <label class="font-weight-bold">
                                    Fecha de Vencimiento *
                                </label>
                                <input type="date" name="expiration_date" value="{{ old('expiration_date') }}"
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
                                       value="{{ old('stock', 0) }}"
                                       class="form-control">
                            </div>

                            {{-- Stock mínimo --}}
                            <div class="col-md-3 mb-4">
                                <label class="font-weight-bold">
                                    Stock Mínimo *
                                </label>
                                <input type="number" name="minimum_stock"
                                       value="{{ old('minimum_stock', 10) }}"
                                       class="form-control">
                            </div>

                        </div>

                        {{-- Observaciones --}}
                        <div class="form-group">
                            <label class="font-weight-bold">
                                Observaciones
                            </label>
                            <textarea name="observations" rows="4"
                                      class="form-control"
                                      placeholder="Notas adicionales del medicamento">{{ old('observations') }}</textarea>
                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('sg.admin.sg.medicamentos.index') }}"
                               class="btn btn-outline-secondary">
                                ← Cancelar
                            </a>

                            <button type="submit"
                                    class="btn btn-success px-4">
                                💾 Guardar Medicamento
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection

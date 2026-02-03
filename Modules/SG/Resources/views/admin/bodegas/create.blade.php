@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-warehouse text-indigo-600"></i>
                Nueva Bodega
            </h3>
            <small class="text-muted">
                Registro de una nueva bodega o almacén
            </small>
        </div>

        <a href="{{ route('sg.admin.sg.bodegas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="card shadow-lg border-0">
        <div class="card-body p-5">

            <form action="{{ route('sg.admin.sg.bodegas.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- CÓDIGO --}}
                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold text-gray-700">
                            Código <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="code"
                               value="{{ old('code') }}"
                               class="form-control @error('code') is-invalid @enderror"
                               placeholder="Ej: BOD-01, FARM-01">
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NOMBRE --}}
                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold text-gray-700">
                            Nombre <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Ej: Bodega Principal">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- UBICACIÓN --}}
                    <div class="col-md-12 mb-4">
                        <label class="font-weight-bold text-gray-700">Ubicación</label>
                        <input type="text"
                               name="location"
                               value="{{ old('location') }}"
                               class="form-control"
                               placeholder="Ej: Al lado del corral de ordeño">
                    </div>

                    {{-- DESCRIPCIÓN --}}
                    <div class="col-md-12 mb-4">
                        <label class="font-weight-bold text-gray-700">Descripción</label>
                        <textarea name="description"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Información adicional sobre la bodega">{{ old('description') }}</textarea>
                    </div>

                    {{-- ESTADO --}}
                    <div class="col-md-12 mb-2">
                        <div class="custom-control custom-switch">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="is_active"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="is_active">
                                Bodega activa
                            </label>
                        </div>
                    </div>

                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-end mt-5">
                    <a href="{{ route('sg.admin.sg.bodegas.index') }}"
                       class="btn btn-secondary mr-3">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-indigo px-4">
                        <i class="fas fa-save"></i> Guardar Bodega
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

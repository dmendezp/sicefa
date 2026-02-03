@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-warehouse text-indigo-600"></i>
                Editar Bodega
            </h3>
            <small class="text-muted">
                {{ $warehouse->code }} · {{ $warehouse->name }}
            </small>
        </div>

        <a href="{{ route('sg.admin.sg.bodegas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    {{-- CARD FORM --}}
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <form action="{{ route('sg.admin.sg.bodegas.update', $warehouse) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            {{-- Código --}}
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Código *</label>
                                <input type="text"
                                       name="code"
                                       value="{{ old('code', $warehouse->code) }}"
                                       class="form-control @error('code') is-invalid @enderror">
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nombre --}}
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Nombre *</label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name', $warehouse->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Ubicación --}}
                            <div class="col-md-12 mb-3">
                                <label class="font-weight-bold">Ubicación</label>
                                <input type="text"
                                       name="location"
                                       value="{{ old('location', $warehouse->location) }}"
                                       class="form-control"
                                       placeholder="Ej: Área de ordeño, almacén principal">
                            </div>

                            {{-- Descripción --}}
                            <div class="col-md-12 mb-3">
                                <label class="font-weight-bold">Descripción</label>
                                <textarea name="description"
                                          rows="4"
                                          class="form-control"
                                          placeholder="Descripción general de la bodega">{{ old('description', $warehouse->description) }}</textarea>
                            </div>

                            {{-- Estado --}}
                            <div class="col-md-12 mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="is_active"
                                           name="is_active"
                                           value="1"
                                           {{ old('is_active', $warehouse->is_active) ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold" for="is_active">
                                        Bodega activa
                                    </label>
                                </div>
                            </div>

                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('sg.admin.sg.bodegas.index') }}"
                               class="btn btn-outline-secondary mr-3">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Actualizar Bodega
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection

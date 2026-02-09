@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">
            {{ isset($treatment->id) ? 'Editar Tratamiento' : 'Nuevo Tratamiento' }}
        </h3>

        <a href="{{ route('sg.admin.sg.tratamientos.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <form action="{{ isset($treatment->id)
            ? route('sg.admin.sg.tratamientos.update', $treatment->id)
            : route('sg.admin.sg.tratamientos.store') }}"
          method="POST">

        @csrf
        @isset($treatment->id) @method('PUT') @endisset

        {{-- DATOS GENERALES --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light font-weight-bold">
                <i class="fas fa-pills"></i> Datos del Tratamiento
            </div>

            <div class="card-body">
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label class="block text-lg font-bold text-gray-700 mb-3">Historia Clínica *</label>
                        <div class="px-5 py-4 bg-gray-100 rounded-lg text-xl font-bold">
                            {{ $treatment->healthRecord->animal->plate }} - {{ $treatment->healthRecord->record_date->format('d/m/Y') }}
                        </div>
                        <input type="hidden" name="health_record_id" value="{{ old('health_record_id', $treatment->health_record_id ?? '') }}">
                        @error('health_record_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Fecha del Tratamiento *</label>
                        <input type="date"
                               name="treatment_date"
                               value="{{ old('treatment_date', $treatment->treatment_date ?? now()->format('Y-m-d')) }}"
                               class="form-control @error('treatment_date') is-invalid @enderror"
                               required>
                        @error('treatment_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- MEDICAMENTO --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light font-weight-bold">
                <i class="fas fa-prescription-bottle"></i> Medicamento
            </div>

            <div class="card-body">
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label class="block text-lg font-bold text-gray-700 mb-3">Medicamento</label>
                        <select name="medicine_id" class="form-control @error('medicine_id') is-invalid @enderror">
                            <option value="">Sin medicamento específico</option>
                            @foreach($medicines as $med)
                                <option value="{{ $med->id }}" {{ old('medicine_id', $treatment->medicine_id ?? '') == $med->id ? 'selected' : '' }}>
                                    {{ $med->name }} ({{ $med->active_principle }})
                                </option>
                            @endforeach
                        </select>
                        @error('medicine_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label>Dosis</label>
                        <input type="text"
                               name="dose"
                               placeholder="Ej: 10ml, 5g"
                               value="{{ old('dose', $treatment->dose ?? '') }}"
                               class="form-control">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label>Vía de Administración</label>
                        <input type="text"
                               name="administration_route"
                               placeholder="Ej: Intramuscular, Oral"
                               value="{{ old('administration_route', $treatment->administration_route ?? '') }}"
                               class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Frecuencia</label>
                        <input type="text"
                               name="frequency"
                               placeholder="Ej: Cada 24h, 3 días seguidos"
                               value="{{ old('frequency', $treatment->frequency ?? '') }}"
                               class="form-control">
                    </div>

                </div>
            </div>
        </div>

        {{-- OBSERVACIONES --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light font-weight-bold">
                <i class="fas fa-clipboard-list"></i> Observaciones
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label>Observaciones Adicionales</label>
                    <textarea name="observations" rows="4"
                              class="form-control">{{ old('observations', $treatment->observations ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ACCIONES --}}
        <div class="text-right mb-5">
            <a href="{{ route('sg.admin.sg.tratamientos.index') }}"
               class="btn btn-secondary btn-lg mr-2">
                Cancelar
            </a>

            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-save"></i>
                {{ isset($treatment->id) ? 'Actualizar Tratamiento' : 'Guardar Tratamiento' }}
            </button>
        </div>

    </form>

</div>
@endsection

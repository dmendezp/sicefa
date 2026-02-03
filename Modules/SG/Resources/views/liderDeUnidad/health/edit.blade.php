@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<br>
<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">
            {{ isset($healthRecord->id) ? 'Editar Historia Clínica' : 'Nueva Historia Clínica' }}
        </h3>

        <a href="{{ route('sg.liderDeUnidad.sg.health.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <form action="{{ isset($healthRecord->id)
            ? route('sg.liderDeUnidad.sg.health.update', $healthRecord->id)
            : route('sg.liderDeUnidad.sg.health.store') }}"
          method="POST">

        @csrf
        @isset($healthRecord->id) @method('PUT') @endisset

        {{-- DATOS GENERALES --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light font-weight-bold">
                <i class="fas fa-cow"></i> Datos Generales
            </div>

            <div class="card-body">
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Bovino *</label>
                        <input type="text"
                               name="animal_id"
                               value="{{ old('animal_id', $healthRecord->animal_id ?? '') }}"
                               class="form-control @error('animal_id') is-invalid @enderror"
                               required>
                        @error('animal_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Fecha del Registro *</label>
                        <input type="date"
                               name="record_date"
                               value="{{ old('record_date', $healthRecord->record_date ?? now()->format('Y-m-d')) }}"
                               class="form-control @error('record_date') is-invalid @enderror"
                               required>
                        @error('record_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- SIGNOS VITALES --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light font-weight-bold">
                <i class="fas fa-heartbeat"></i> Signos Vitales
            </div>

            <div class="card-body">
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>Temperatura (°C)</label>
                        <input type="number" step="0.1"
                               name="temperature"
                               value="{{ old('temperature', $healthRecord->temperature ?? '') }}"
                               class="form-control text-center">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Frecuencia Cardíaca (lat/min)</label>
                        <input type="number"
                               name="heart_rate"
                               value="{{ old('heart_rate', $healthRecord->heart_rate ?? '') }}"
                               class="form-control text-center">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Frecuencia Respiratoria (resp/min)</label>
                        <input type="number"
                               name="respiratory_rate"
                               value="{{ old('respiratory_rate', $healthRecord->respiratory_rate ?? '') }}"
                               class="form-control text-center">
                    </div>

                </div>
            </div>
        </div>

        {{-- EVALUACIÓN CLÍNICA --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light font-weight-bold">
                <i class="fas fa-stethoscope"></i> Evaluación Clínica
            </div>

            <div class="card-body">

                <div class="form-group">
                    <label>Síntomas</label>
                    <textarea name="symptoms" rows="3"
                              class="form-control">{{ old('symptoms', $healthRecord->symptoms ?? '') }}</textarea>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>Movimientos Ruminales</label>
                        <input type="text"
                               name="ruminal_movements"
                               value="{{ old('ruminal_movements', $healthRecord->ruminal_movements ?? '') }}"
                               class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Consistencia Fecal</label>
                        <input type="text"
                               name="fecal_consistency"
                               value="{{ old('fecal_consistency', $healthRecord->fecal_consistency ?? '') }}"
                               class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Descripción de Orina</label>
                        <input type="text"
                               name="urine_description"
                               value="{{ old('urine_description', $healthRecord->urine_description ?? '') }}"
                               class="form-control">
                    </div>

                </div>

                <div class="form-group">
                    <label>Diagnóstico</label>
                    <textarea name="diagnosis" rows="3"
                              class="form-control">{{ old('diagnosis', $healthRecord->diagnosis ?? '') }}</textarea>
                </div>

            </div>
        </div>

        {{-- RESPONSABLE --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light font-weight-bold">
                <i class="fas fa-user-md"></i> Responsables
            </div>

            <div class="card-body">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Veterinario</label>
                        <input type="text"
                               name="veterinarian"
                               value="{{ old('veterinarian', $healthRecord->veterinarian ?? '') }}"
                               class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Responsable</label>
                        <input type="text"
                               name="responsible"
                               value="{{ old('responsible', $healthRecord->responsible ?? auth()->user()->name ?? '') }}"
                               class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea name="observations" rows="4"
                              class="form-control">{{ old('observations', $healthRecord->observations ?? '') }}</textarea>
                </div>

            </div>
        </div>

        {{-- ACCIONES --}}
        <div class="text-right mb-5">
            <a href="{{ route('sg.liderDeUnidad.sg.health.index') }}"
               class="btn btn-secondary btn-lg mr-2">
                Cancelar
            </a>

            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-save"></i>
                {{ isset($healthRecord->id) ? 'Actualizar Historia Clínica' : 'Guardar Historia Clínica' }}
            </button>
        </div>

    </form>

</div>
@endsection

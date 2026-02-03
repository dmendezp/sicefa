@extends('sg::layouts.master')

@section('content')
<br><br><br><br>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold text-dark">
            💉 Nuevo Tratamiento
        </h3>

        <a href="{{ route('sg.admin.sg.tratamientos.index') }}"
           class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    {{-- FORMULARIO --}}
    <div class="card shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('sg.admin.sg.tratamientos.store') }}" method="POST">
                @csrf

                <div class="form-row">

                    {{-- HISTORIA CLÍNICA --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">
                            Historia Clínica <span class="text-danger">*</span>
                        </label>
                        <select name="health_record_id" required class="form-control form-control-lg">
                            <option value="">Seleccionar historia clínica</option>
                            @foreach($healthRecords as $hr)
                                <option value="{{ $hr->id }}">
                                    {{ $hr->animal->id }} - {{ $hr->record_date->format('d/m/Y') }}
                                    ({{ Str::limit($hr->diagnosis ?: 'Sin diagnóstico', 40) }})
                                </option>
                            @endforeach
                        </select>
                        @error('health_record_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- FECHA --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">
                            Fecha del Tratamiento <span class="text-danger">*</span>
                        </label>
                        <input type="date"
                               name="treatment_date"
                               value="{{ old('treatment_date', today()->format('Y-m-d')) }}"
                               required
                               class="form-control form-control-lg">
                    </div>

                    {{-- MEDICAMENTO --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Medicamento</label>
                        <select name="medicine_id" class="form-control form-control-lg">
                            <option value="">Sin medicamento específico</option>
                            @foreach($medicines as $med)
                                <option value="{{ $med->id }}">
                                    {{ $med->name }} ({{ $med->active_principle }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- DOSIS --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Dosis</label>
                        <input type="text"
                               name="dose"
                               value="{{ old('dose') }}"
                               class="form-control form-control-lg"
                               placeholder="Ej: 10 ml, 5 g">
                    </div>

                    {{-- VÍA --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Vía de Administración</label>
                        <input type="text"
                               name="administration_route"
                               value="{{ old('administration_route') }}"
                               class="form-control form-control-lg"
                               placeholder="Ej: Intramuscular, Oral, Subcutánea">
                    </div>

                    {{-- FRECUENCIA --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Frecuencia</label>
                        <input type="text"
                               name="frequency"
                               value="{{ old('frequency') }}"
                               class="form-control form-control-lg"
                               placeholder="Ej: Cada 24 h, 3 días seguidos">
                    </div>

                    {{-- OBSERVACIONES --}}
                    <div class="form-group col-md-12">
                        <label class="font-weight-bold">Observaciones</label>
                        <textarea name="observations"
                                  rows="4"
                                  class="form-control form-control-lg"
                                  placeholder="Detalles adicionales del tratamiento">{{ old('observations') }}</textarea>
                    </div>

                </div>

                {{-- ACCIONES --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('sg.admin.sg.tratamientos.index') }}"
                       class="btn btn-secondary btn-lg mr-3">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn btn-success btn-lg shadow-sm">
                        <i class="fas fa-save"></i> Guardar Tratamiento
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

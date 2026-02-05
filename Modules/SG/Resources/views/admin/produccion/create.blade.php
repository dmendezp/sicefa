@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="mb-4">
        <h3 class="font-weight-bold">Registrar Producción de Leche</h3>
        <small class="text-muted">Complete los datos del ordeño realizado</small>
    </div>

    <form action="{{ route('sg.admin.sg.produccion.store') }}" method="POST">
        @csrf

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                {{-- Datos principales --}}
                <div class="row">

                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold">Vaca *</label>
                        <select name="animal_id" class="form-control form-control-lg" required>
                            <option value="">Seleccione una vaca</option>
                            @forelse($animals as $animal)
                                <option value="{{ $animal->id }}">
                                    #{{ $animal->id }} - {{ $animal->name ?? 'Sin nombre' }}
                                    ({{ $animal->breed?->name }})
                                </option>
                            @empty
                                <option disabled>No hay vacas disponibles</option>
                            @endforelse
                        </select>
                        @error('animal_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold">Fecha *</label>
                        <input type="date"
                               name="production_date"
                               value="{{ old('production_date', today()->format('Y-m-d')) }}"
                               class="form-control form-control-lg"
                               required>
                    </div>

                </div>

                {{-- Turno --}}
                <div class="mb-5">
                    <label class="font-weight-bold d-block mb-3">Turno *</label>
                    <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                        <label class="btn btn-outline-primary btn-lg active w-33">
                            <input type="radio" name="shift" value="MORNING" checked> 🌅 Mañana
                        </label>
                        <label class="btn btn-outline-warning btn-lg w-33">
                            <input type="radio" name="shift" value="AFTERNOON"> ☀️ Tarde
                        </label>
                        <label class="btn btn-outline-dark btn-lg w-33">
                            <input type="radio" name="shift" value="NIGHT"> 🌙 Noche
                        </label>
                    </div>
                </div>

                {{-- Producción --}}
                <div class="row">

                    <div class="col-md-4 mb-4">
                        <label class="font-weight-bold">Litros producidos *</label>
                        <input type="number"
                               step="0.01"
                               name="liters"
                               value="{{ old('liters') }}"
                               class="form-control form-control-lg text-center font-weight-bold text-success"
                               placeholder="0.00"
                               required>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="font-weight-bold">Calidad *</label>
                        <select name="quality" class="form-control form-control-lg" required>
                            <option value="HIGH">Alta</option>
                            <option value="MEDIUM" selected>Media</option>
                            <option value="LOW">Baja</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="font-weight-bold">Temperatura (°C)</label>
                        <input type="number"
                               step="0.1"
                               name="milk_temperature"
                               value="{{ old('milk_temperature') }}"
                               class="form-control form-control-lg text-center"
                               placeholder="36.5">
                    </div>

                </div>

                {{-- Responsable --}}
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold">Responsable</label>
                        <input type="text"
                               name="responsible"
                               value="{{ old('responsible', auth()->user()->name ?? '') }}"
                               class="form-control form-control-lg">
                    </div>
                </div>

                {{-- Observaciones --}}
                <div class="mb-4">
                    <label class="font-weight-bold">Observaciones</label>
                    <textarea name="observations"
                              rows="4"
                              class="form-control form-control-lg"
                              placeholder="Notas adicionales del ordeño...">{{ old('observations') }}</textarea>
                </div>

            </div>
        </div>

        {{-- Acciones --}}
        <div class="d-flex justify-content-end mb-5">
            <a href="{{ route('sg.admin.sg.produccion.index') }}"
               class="btn btn-secondary btn-lg mr-3">
                Listado
            </a>

            <button type="submit"
                    class="btn btn-success btn-lg shadow-sm px-5">
                <i class="fas fa-save"></i> Guardar Producción
            </button>
        </div>

    </form>
</div>
@endsection

@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Nueva Prueba Diagnóstica</h3>
        <a href="{{ route('sg.admin.sg.diagnosticos.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('sg.admin.sg.diagnosticos.store') }}" method="POST">
                @csrf

                <div class="form-row">

                    {{-- Bovino --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Bovino *</label>
                        <select name="animal_id" class="form-control" required>
                            <option value="">Seleccionar bovino</option>
                            @foreach($animals as $animal)
                                <option value="{{ $animal->id }}" {{ old('animal_id') == $animal->id ? 'selected' : '' }}>
                                    {{ $animal->id }} - {{ $animal->name ?: 'Sin nombre' }}
                                    {{ $animal->breed ? '(' . $animal->breed->name . ')' : '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('animal_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Fecha --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Fecha de la Prueba *</label>
                        <input type="date"
                               name="test_date"
                               value="{{ old('test_date', now()->format('Y-m-d')) }}"
                               class="form-control"
                               required>
                        @error('test_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tipo --}}
                    <div class="form-group col-md-12">
                        <label class="font-weight-bold">Tipo de Prueba *</label>
                        <input type="text"
                               name="test_type"
                               value="{{ old('test_type') }}"
                               class="form-control"
                               placeholder="Ej: Tuberculosis, Brucelosis, Leptospirosis"
                               required>
                        @error('test_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Resultado --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Resultado</label>
                        <input type="text"
                               name="result"
                               value="{{ old('result') }}"
                               class="form-control"
                               placeholder="Ej: Negativo, Positivo, En proceso">
                        @error('result')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Observaciones --}}
                    <div class="form-group col-md-12">
                        <label class="font-weight-bold">Observaciones</label>
                        <textarea name="observations"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Observaciones adicionales">{{ old('observations') }}</textarea>
                        @error('observations')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                {{-- Acciones --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('sg.admin.sg.diagnosticos.index') }}"
                       class="btn btn-outline-secondary mr-2">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Prueba Diagnóstica
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Editar Prueba Diagnóstica</h3>
        <a href="{{ route('sg.admin.sg.diagnosticos.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('sg.admin.sg.diagnosticos.update', $test) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-row">

                    {{-- Bovino --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Bovino *</label>
                        <select name="animal_id" class="form-control" required>
                            @foreach($animals as $animal)
                                <option value="{{ $animal->id }}"
                                    {{ old('animal_id', $test->animal_id) == $animal->id ? 'selected' : '' }}>
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
                               class="form-control"
                               value="{{ old('test_date', $test->test_date->format('Y-m-d')) }}"
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
                               class="form-control"
                               value="{{ old('test_type', $test->test_type) }}"
                               placeholder="Ej: Tuberculosis, Brucelosis"
                               required>
                        @error('test_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Resultado --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Resultado</label>
                        <select name="result" class="form-control">
                            <option value="">Pendiente</option>
                            <option value="Negativo" {{ old('result', $test->result) === 'Negativo' ? 'selected' : '' }}>Negativo</option>
                            <option value="Positivo" {{ old('result', $test->result) === 'Positivo' ? 'selected' : '' }}>Positivo</option>
                            <option value="Indeterminado" {{ old('result', $test->result) === 'Indeterminado' ? 'selected' : '' }}>Indeterminado</option>
                            <option value="En proceso" {{ old('result', $test->result) === 'En proceso' ? 'selected' : '' }}>En proceso</option>
                        </select>
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
                                  placeholder="Notas adicionales">{{ old('observations', $test->observations) }}</textarea>
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

                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Actualizar Prueba
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@extends('sg::layouts.masterAprendiz')

@section('content')
<br>

<div class="container">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="font-weight-bold text-dark">
            ⚖️ Nuevo Registro de Peso
        </h3>
        <p class="text-muted">
            Registra el peso del animal para seguimiento productivo y sanitario.
        </p>
    </div>

    {{-- CARD --}}
    <div class="card shadow-lg">
        <div class="card-body p-4">

            <form action="{{ route('sg.aprendiz.sg.PESOS.store') }}" method="POST">
                @csrf

                <div class="form-row">

                    {{-- ANIMAL --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">
                            Animal <span class="text-danger">*</span>
                        </label>
                        <select name="animal_id"
                                class="form-control form-control-lg"
                                required>
                            <option value="">Seleccione un animal</option>
                            @foreach($animals as $animal)
                                <option value="{{ $animal->id }}"
                                    {{ old('animal_id') == $animal->id ? 'selected' : '' }}>
                                    {{ $animal->id }} - {{ $animal->name ?: 'Sin nombre' }}
                                </option>
                            @endforeach
                        </select>
                        @error('animal_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- FECHA --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">
                            Fecha de Pesaje <span class="text-danger">*</span>
                        </label>
                        <input type="date"
                               name="weigh_date"
                               value="{{ old('weigh_date', now()->format('Y-m-d')) }}"
                               class="form-control form-control-lg"
                               required>
                        @error('weigh_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="form-row">

                    {{-- PESO --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">
                            Peso (kg) <span class="text-danger">*</span>
                        </label>
                        <input type="number"
                               step="0.01"
                               name="weight_kg"
                               value="{{ old('weight_kg') }}"
                               class="form-control form-control-lg"
                               placeholder="Ej: 450.50"
                               required>
                        @error('weight_kg')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- CONDICIÓN CORPORAL --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">
                            Condición Corporal
                        </label>
                        <input type="text"
                               name="body_condition_score"
                               value="{{ old('body_condition_score') }}"
                               class="form-control form-control-lg"
                               placeholder="Ej: Buena, Regular, 3.5">
                        @error('body_condition_score')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                {{-- OBSERVACIONES --}}
                <div class="form-group">
                    <label class="font-weight-bold">
                        Observaciones
                    </label>
                    <textarea name="observations"
                              rows="4"
                              class="form-control form-control-lg"
                              placeholder="Observaciones adicionales del pesaje">{{ old('observations') }}</textarea>
                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-end mt-4">

                    <a href="{{ route('sg.aprendiz.sg.PESOS.index') }}"
                       class="btn btn-secondary btn-lg mr-3">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn btn-success btn-lg shadow-sm">
                        💾 Guardar Registro
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection

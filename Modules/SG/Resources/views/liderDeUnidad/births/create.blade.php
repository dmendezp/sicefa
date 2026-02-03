@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold text-dark">
            🐄 Registrar Nuevo Parto
        </h3>

        <a href="{{ route('sg.liderDeUnidad.sg.births.index') }}"
           class="btn btn-secondary">
            ← Volver al listado
        </a>
    </div>

    {{-- FORM CARD --}}
    <div class="card shadow-lg">
        <div class="card-body">

            <form action="{{ route('sg.liderDeUnidad.sg.births.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- MADRE --}}
                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold">
                            Madre (Vaca) <span class="text-danger">*</span>
                        </label>
                        <select name="animal_id" class="form-control form-control-lg" required>
                            <option value="">Seleccionar vaca</option>
                            @foreach($animals as $animal)
                                <option value="{{ $animal->id }}" {{ old('animal_id') == $animal->id ? 'selected' : '' }}>
                                    {{ $animal->id }} - {{ $animal->name ?: 'Sin nombre' }}
                                    ({{ $animal->breed?->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('animal_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- FECHA PARTO --}}
                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold">
                            Fecha del Parto <span class="text-danger">*</span>
                        </label>
                        <input type="date"
                               name="birth_date"
                               value="{{ old('birth_date', today()->format('Y-m-d')) }}"
                               class="form-control form-control-lg"
                               required>
                    </div>

                    {{-- SEXO --}}
                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold">
                            Sexo de la Cría <span class="text-danger">*</span>
                        </label>

                        <div class="d-flex mt-2">
                            <div class="custom-control custom-radio mr-4">
                                <input type="radio" id="male" name="calf_sex"
                                       value="MALE"
                                       class="custom-control-input"
                                       {{ old('calf_sex') === 'MALE' ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold" for="male">
                                    ♂ Macho
                                </label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="female" name="calf_sex"
                                       value="FEMALE"
                                       class="custom-control-input"
                                       {{ old('calf_sex') === 'FEMALE' ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold" for="female">
                                    ♀ Hembra
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- CRÍA --}}
                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold">
                            Código de la Cría (opcional)
                        </label>
                        <select name="calf_id" class="form-control form-control-lg">
                            <option value="">Crear cría nueva</option>
                            @foreach($newCalves as $calf)
                                <option value="{{ $calf->id }}" {{ old('calf_id') == $calf->id ? 'selected' : '' }}>
                                    {{ $calf->id }} - {{ $calf->name ?: 'Sin nombre' }}
                                </option>
                            @endforeach
                        </select>
                        @error('calf_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- INSEMINACIÓN --}}
                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold">
                            Fecha de Inseminación Relacionada
                        </label>
                        <input type="date"
                               name="insemination_date"
                               value="{{ old('insemination_date') }}"
                               class="form-control form-control-lg">
                    </div>

                    {{-- TORO --}}
                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold">
                            Toro (opcional)
                        </label>
                        <select name="bull_id" class="form-control form-control-lg">
                            <option value="">Seleccionar toro</option>
                            @foreach($bulls as $bull)
                                <option value="{{ $bull->id }}" {{ old('bull_id') == $bull->id ? 'selected' : '' }}>
                                    {{ $bull->id }} - {{ $bull->name ?: 'Sin nombre' }}
                                    ({{ $bull->breed?->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('bull_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- OBSERVACIONES --}}
                    <div class="col-md-12 mb-4">
                        <label class="font-weight-bold">
                            Observaciones del Parto
                        </label>
                        <textarea name="observations"
                                  rows="4"
                                  class="form-control form-control-lg"
                                  placeholder="Complicaciones, estado de la madre, observaciones clínicas...">{{ old('observations') }}</textarea>
                    </div>

                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('sg.liderDeUnidad.sg.births.index') }}"
                       class="btn btn-outline-secondary btn-lg mr-3">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn btn-success btn-lg px-5">
                        💾 Registrar Parto
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

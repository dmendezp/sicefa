@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Nueva Inseminación</h3>
        <a href="{{ route('sg.liderDeUnidad.sg.inseminations.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('sg.liderDeUnidad.sg.inseminations.store') }}" method="POST">
                @csrf

                <div class="form-row">

                    {{-- Vaca --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Vaca a Inseminar *</label>
                        <select name="animal_id" class="form-control" required>
                            <option value="">Seleccionar vaca</option>
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
                        <label class="font-weight-bold">Fecha de Inseminación *</label>
                        <input type="date"
                               name="insemination_date"
                               value="{{ old('insemination_date', now()->format('Y-m-d')) }}"
                               class="form-control"
                               required>
                        @error('insemination_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Pajuela --}}
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Código de Pajuela</label>
                        <input type="text"
                               name="straw_code"
                               value="{{ old('straw_code') }}"
                               class="form-control"
                               placeholder="Ej: 123456789">
                    </div>

                    {{-- Toro sistema --}}
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Toro (Sistema)</label>
                        <select name="bull_id" class="form-control">
                            <option value="">Seleccionar (opcional)</option>
                            @foreach($bulls as $bull)
                                <option value="{{ $bull->id }}" {{ old('bull_id') == $bull->id ? 'selected' : '' }}>
                                    {{ $bull->id }} - {{ $bull->name ?: 'Sin nombre' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Toro libre --}}
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Nombre del Toro (externo)</label>
                        <input type="text"
                               name="bull_name"
                               value="{{ old('bull_name') }}"
                               class="form-control"
                               placeholder="Ej: Toro Brahman Elite">
                    </div>

                    {{-- Técnico --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Técnico / Inseminador</label>
                        <input type="text"
                               name="technician"
                               value="{{ old('technician') }}"
                               class="form-control"
                               placeholder="Ej: Juan Pérez">
                    </div>

                    {{-- Método --}}
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Método *</label>
                        <div class="mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="method_ai" name="method" value="AI"
                                       class="custom-control-input"
                                       {{ old('method', 'AI') === 'AI' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="method_ai">Inseminación Artificial</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="method_et" name="method" value="ET"
                                       class="custom-control-input"
                                       {{ old('method') === 'ET' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="method_et">Transferencia de Embriones</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="method_nm" name="method" value="NM"
                                       class="custom-control-input"
                                       {{ old('method') === 'NM' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="method_nm">Monta Natural</label>
                            </div>
                        </div>
                        @error('method')
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
                    </div>

                </div>

                {{-- Acciones --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('sg.liderDeUnidad.sg.inseminations.index') }}"
                       class="btn btn-outline-secondary mr-2">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Registrar Inseminación
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

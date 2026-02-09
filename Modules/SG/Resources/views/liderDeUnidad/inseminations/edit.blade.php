@extends('sg::layouts.masterLiderDeUnidad')

@section('content')
<br>
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">Editar Inseminación</h3>
        <a href="{{ route('sg.liderDeUnidad.sg.inseminations.show', $insemination) }}"
           class="btn btn-outline-secondary">
            <i class="fas fa-eye"></i> Ver detalle
        </a>
    </div>

    <form action="{{ route('sg.liderDeUnidad.sg.inseminations.update', $insemination) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- Información de la vaca --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-left-primary">
                    <div class="card-header bg-white font-weight-bold text-primary">
                        <i class="fas fa-cow"></i> Vaca
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Placa del animal *</label>
                            <input type="text"
                                   class="form-control @error('animal_plate') is-invalid @enderror"
                                   name="animal_plate"
                                   value="{{ old('animal_plate', $insemination->animal->plate) }}"
                                   required>
                            @error('animal_plate')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="alert alert-info mb-0">
                            <strong>Nombre:</strong> {{ $insemination->animal->name ?: 'Sin nombre' }} <br>
                            <strong>Raza:</strong> {{ $insemination->animal->breed?->name ?? '—' }}
                        </div>

                    </div>
                </div>
            </div>

            {{-- Datos de inseminación --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-left-info">
                    <div class="card-header bg-white font-weight-bold text-info">
                        <i class="fas fa-syringe"></i> Inseminación
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Fecha de inseminación *</label>
                            <input type="date"
                                   class="form-control @error('insemination_date') is-invalid @enderror"
                                   name="insemination_date"
                                   value="{{ old('insemination_date', $insemination->insemination_date?->format('Y-m-d')) }}"
                                   required>
                            @error('insemination_date')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Método *</label>
                            <select name="method"
                                    class="form-control @error('method') is-invalid @enderror"
                                    required>
                                <option value="AI" {{ old('method', $insemination->method) === 'AI' ? 'selected' : '' }}>Inseminación Artificial (IA)</option>
                                <option value="ET" {{ old('method', $insemination->method) === 'ET' ? 'selected' : '' }}>Transferencia de Embriones (TE)</option>
                                <option value="NM" {{ old('method', $insemination->method) === 'NM' ? 'selected' : '' }}>Monta Natural (MN)</option>
                            </select>
                            @error('method')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group mb-0">
                            <label>Técnico / Inseminador</label>
                            <input type="text"
                                   class="form-control"
                                   name="technician"
                                   value="{{ old('technician', $insemination->technician) }}">
                        </div>

                    </div>
                </div>
            </div>

            {{-- Material genético --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-left-secondary">
                    <div class="card-header bg-white font-weight-bold text-secondary">
                        <i class="fas fa-dna"></i> Material genético
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Código de pajuela</label>
                            <input type="text"
                                   class="form-control"
                                   name="straw_code"
                                   value="{{ old('straw_code', $insemination->straw_code) }}">
                        </div>

                        <div class="form-group">
                            <label>ID del toro</label>
                            <input type="text"
                                   class="form-control"
                                   name="bull_id"
                                   value="{{ old('bull_id', $insemination->bull_id) }}">
                        </div>

                        <div class="form-group mb-0">
                            <label>Nombre del toro</label>
                            <input type="text"
                                   class="form-control"
                                   name="bull_name"
                                   value="{{ old('bull_name', $insemination->bull_name) }}">
                        </div>

                    </div>
                </div>
            </div>

            {{-- Palpación y resultado --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-left-success">
                    <div class="card-header bg-white font-weight-bold text-success">
                        <i class="fas fa-heartbeat"></i> Palpación
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Resultado</label>
                            <select name="palpation_result"
                                    class="form-control">
                                <option value="PENDING" {{ old('palpation_result', $insemination->palpation_result) === 'PENDING' ? 'selected' : '' }}>Pendiente</option>
                                <option value="POSITIVE" {{ old('palpation_result', $insemination->palpation_result) === 'POSITIVE' ? 'selected' : '' }}>Preñada</option>
                                <option value="NEGATIVE" {{ old('palpation_result', $insemination->palpation_result) === 'NEGATIVE' ? 'selected' : '' }}>No preñada</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Fecha de palpación</label>
                            <input type="date"
                                   class="form-control"
                                   name="palpation_date"
                                   value="{{ old('palpation_date', $insemination->palpation_date) }}">
                        </div>

                        <div class="form-group mb-0">
                            <label>Fecha estimada de parto</label>
                            <input type="date"
                                   class="form-control"
                                   name="expected_birth_date"
                                   value="{{ old('expected_birth_date', $insemination->expected_birth_date) }}">
                        </div>

                    </div>
                </div>
            </div>

            {{-- Observaciones --}}
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white font-weight-bold">
                        <i class="fas fa-notes-medical"></i> Observaciones
                    </div>
                    <div class="card-body">
                        <textarea name="observations"
                                  rows="4"
                                  class="form-control">{{ old('observations', $insemination->observations) }}</textarea>
                    </div>
                </div>
            </div>

        </div>

        {{-- Acciones --}}
        <div class="d-flex justify-content-end">
            <a href="{{ route('sg.liderDeUnidad.sg.inseminations.index') }}"
               class="btn btn-outline-secondary mr-2">
                Cancelar
            </a>

            <button type="submit"
                    class="btn btn-success px-4">
                <i class="fas fa-save"></i> Guardar cambios
            </button>
        </div>

    </form>

</div>
@endsection

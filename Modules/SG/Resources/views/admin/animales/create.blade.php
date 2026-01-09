@extends('sg::layouts.master')

@section('content')
<br><br>
<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold mb-0">
            Registrar Nuevo Bovino
        </h3>

        <a href="{{ route('sg.admin.sg.animales.index') }}"
           class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <form action="{{ route('sg.admin.sg.animales.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        {{-- FOTO --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light font-weight-bold">
                <i class="fas fa-camera"></i> Fotografía del Bovino
            </div>

            <div class="card-body text-center">
                <div class="mb-3">
                    <img id="preview"
                         src="{{ asset('images/default-cow.jpg') }}"
                         class="img-thumbnail"
                         style="max-width: 220px;">
                </div>

                <input type="file"
                       name="photo"
                       id="photo"
                       accept="image/*"
                       class="form-control-file">

                <small class="text-muted d-block mt-2">
                    JPG / PNG · Máx. 2MB
                </small>
            </div>
        </div>

        {{-- INFORMACIÓN GENERAL --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white font-weight-bold">
                <i class="fas fa-info-circle"></i> Información General
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Nombre (opcional)</label>
                        <input type="text" name="name"
                               value="{{ old('name') }}"
                               class="form-control"
                               placeholder="Ej: Luna, Estrella">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Raza *</label>
                        <select name="breed_id" class="form-control" required>
                            <option value="">Seleccionar raza</option>
                            @foreach($breeds as $id => $name)
                                <option value="{{ $id }}" {{ old('breed_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('breed_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Sexo *</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                       type="radio"
                                       name="sex"
                                       value="FEMALE"
                                       {{ old('sex', 'FEMALE') === 'FEMALE' ? 'checked' : '' }}>
                                <label class="form-check-label">Hembra</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                       type="radio"
                                       name="sex"
                                       value="MALE"
                                       {{ old('sex') === 'MALE' ? 'checked' : '' }}>
                                <label class="form-check-label">Macho</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Fecha de Nacimiento *</label>
                        <input type="date"
                               name="birth_date"
                               value="{{ old('birth_date') }}"
                               class="form-control"
                               required>
                        @error('birth_date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Fecha de Entrada</label>
                        <input type="date"
                               name="entry_date"
                               value="{{ old('entry_date', date('Y-m-d')) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Peso Actual (kg)</label>
                        <input type="number"
                               step="0.1"
                               name="weight_kg"
                               value="{{ old('weight_kg') }}"
                               class="form-control">
                    </div>

                </div>
            </div>
        </div>

        {{-- PRODUCCIÓN --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light font-weight-bold">
                <i class="fas fa-chart-line"></i> Producción e Inventario
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Etapa de Producción *</label>
                        <select name="production_stage" class="form-control" required>
                            <option value="">Seleccionar etapa</option>
                            <option value="CALF">Ternero</option>
                            <option value="GROWING">Crecimiento</option>
                            <option value="DRY">Seca</option>
                            <option value="MILKING">En ordeño</option>
                            <option value="CULL">Descarte</option>
                        </select>
                        @error('production_stage')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Grupo de Edad</label>
                        <input type="text" name="age_group"
                               value="{{ old('age_group') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Valor de Inventario</label>
                        <input type="number"
                               step="0.01"
                               name="inventory_value"
                               value="{{ old('inventory_value') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Lote / Corral</label>
                        <input type="text"
                               name="lot"
                               value="{{ old('lot') }}"
                               class="form-control">
                    </div>

                </div>
            </div>
        </div>

        {{-- OBSERVACIONES --}}
        <div class="card mb-5 shadow-sm">
            <div class="card-header bg-light font-weight-bold">
                <i class="fas fa-clipboard"></i> Observaciones
            </div>

            <div class="card-body">
                <textarea name="observations"
                          rows="4"
                          class="form-control">{{ old('observations') }}</textarea>
            </div>
        </div>

        {{-- BOTONES --}}
        <div class="text-right mb-5">
            <a href="{{ route('sg.admin.sg.animales.index') }}"
               class="btn btn-secondary mr-2">
                Cancelar
            </a>

            <button type="submit"
                    class="btn btn-success px-4">
                <i class="fas fa-save"></i> Registrar Bovino
            </button>
        </div>

    </form>
</div>

<script>
    document.getElementById('photo').addEventListener('change', function(e) {
        const preview = document.getElementById('preview');
        if (e.target.files[0]) {
            preview.src = URL.createObjectURL(e.target.files[0]);
        }
    });
</script>
@endsection

@extends('sg::layouts.masterliderDeUnidad')

@section('content')
<br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 animate-fade">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-cow text-success"></i> Registrar Nuevo Bovino
            </h3>
            <small class="text-muted">
                Complete la información para registrar un nuevo animal
            </small>
        </div>

        <a href="{{ route('sg.liderDeUnidad.sg.animals.index') }}"
           class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    {{-- CARD --}}
    <div class="card shadow-lg border-0 animate-slide">
        <div class="card-body p-5">

            <form action="{{ route('sg.liderDeUnidad.sg.animals.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- FOTO --}}
                <div class="text-center mb-5">
                    <div class="photo-box mx-auto mb-3">
                        <img id="preview"
                             src="{{ asset('images/default-cow.jpg') }}"
                             alt="Foto Bovino">
                    </div>

                    <div class="custom-file w-50 mx-auto">
                        <input type="file"
                               class="custom-file-input"
                               id="photo"
                               name="photo"
                               accept="image/*">
                        <label class="custom-file-label" for="photo">
                            Seleccionar fotografía
                        </label>
                    </div>

                    <small class="text-muted d-block mt-2">
                        JPG o PNG · Máx. 2MB
                    </small>
                </div>

                {{-- INFORMACIÓN GENERAL --}}
                <h5 class="mb-3 font-weight-bold text-secondary">
                    <i class="fas fa-info-circle"></i> Información General
                </h5>

                <div class="row">

                <div class="col-md-6 form-group">
                    <label>Placa *</label>
                    <input type="text"
                           name="plate"
                           value="{{ old('plate') }}"
                           class="form-control"
                           placeholder="Ej: 001, A-001"
                           required>
                    @error('plate')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                    <div class="col-md-6 form-group">
                        <label>Nombre (opcional)</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="form-control"
                               placeholder="Ej: Luna, Estrella">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Raza *</label>
                        <select name="breed_id"
                                class="form-control"
                                required>
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

                    <div class="col-md-6 form-group">
                        <label>Sexo *</label>
                        <div class="d-flex mt-2">
                            <div class="custom-control custom-radio mr-4">
                                <input type="radio"
                                       id="female"
                                       name="sex"
                                       value="FEMALE"
                                       class="custom-control-input"
                                       {{ old('sex','FEMALE') === 'FEMALE' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="female">
                                    Hembra
                                </label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio"
                                       id="male"
                                       name="sex"
                                       value="MALE"
                                       class="custom-control-input"
                                       {{ old('sex') === 'MALE' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="male">
                                    Macho
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Fecha de Nacimiento *</label>
                        <input type="date"
                               name="birth_date"
                               value="{{ old('birth_date') }}"
                               class="form-control"
                               required>
                        @error('birth_date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Fecha de Ingreso</label>
                        <input type="date"
                               name="entry_date"
                               value="{{ old('entry_date', date('Y-m-d')) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Peso Actual (kg)</label>
                        <input type="number"
                               step="0.1"
                               name="weight_kg"
                               value="{{ old('weight_kg') }}"
                               class="form-control">
                    </div>

                </div>

                {{-- PRODUCCIÓN --}}
                <h5 class="mt-4 mb-3 font-weight-bold text-secondary">
                    <i class="fas fa-chart-line"></i> Producción e Inventario
                </h5>

                <div class="row">

                    <div class="col-md-6 form-group">
                        <label>Etapa de Producción *</label>
                        <select name="production_stage"
                                class="form-control"
                                required>
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

                    <div class="col-md-6 form-group">
                        <label>Grupo de Edad</label>
                        <input type="text"
                               name="age_group"
                               value="{{ old('age_group') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Valor de Inventario</label>
                        <input type="number"
                               step="0.01"
                               name="inventory_value"
                               value="{{ old('inventory_value') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Lote / Corral</label>
                        <input type="text"
                               name="lot"
                               value="{{ old('lot') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Observaciones</label>
                        <textarea name="observations"
                                  rows="3"
                                  class="form-control">{{ old('observations') }}</textarea>
                    </div>

                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('sg.liderDeUnidad.sg.animals.index') }}"
                       class="btn btn-secondary mr-3">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn btn-success btn-lg animate-btn">
                        <i class="fas fa-save"></i> Registrar Bovino
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- ESTILOS --}}
<style>
.photo-box {
    width:180px;
    height:180px;
    border:3px dashed #dee2e6;
    border-radius:14px;
    overflow:hidden;
    transition: all .3s ease;
}
.photo-box:hover {
    border-color:#28a745;
}
.photo-box img {
    width:100%;
    height:100%;
    object-fit:cover;
}

.animate-fade {
    animation: fadeIn .6s ease;
}
.animate-slide {
    animation: slideUp .6s ease;
}
.animate-btn {
    transition: transform .2s ease;
}
.animate-btn:hover {
    transform: scale(1.05);
}

@keyframes fadeIn {
    from { opacity:0; }
    to { opacity:1; }
}
@keyframes slideUp {
    from { opacity:0; transform:translateY(20px); }
    to { opacity:1; transform:translateY(0); }
}
</style>

{{-- JS --}}
<script>
document.getElementById('photo').addEventListener('change', function(e) {
    if (e.target.files[0]) {
        document.getElementById('preview').src = URL.createObjectURL(e.target.files[0]);
    }
});
</script>
@endsection

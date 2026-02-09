@extends('sg::layouts.masterAprendiz')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 animate-fade">
        <div>
            <h3 class="font-weight-bold mb-0">
                <i class="fas fa-edit text-warning"></i> Editar Bovino
            </h3>
            <small class="text-muted">
                Código: <strong>{{ $animal->id }}</strong>
                {{ $animal->name ? " · {$animal->name}" : '' }}
            </small>
        </div>

        <a href="{{ route('sg.aprendiz.sg.ANIMALES.index') }}"
           class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    {{-- CARD --}}
    <div class="card shadow-lg border-0 animate-slide">
        <div class="card-body p-5">

            <form action="{{ route('sg.aprendiz.sg.ANIMALES.update', $animal) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- FOTO --}}
                <div class="text-center mb-5">
                    <div class="photo-box mx-auto mb-3">
                        <img id="preview"
                             src="{{ $animal->photo_url }}"
                             alt="Foto Bovino">
                    </div>

                    <div class="custom-file w-50 mx-auto">
                        <input type="file"
                               class="custom-file-input"
                               id="photo"
                               name="photo"
                               accept="image/*">
                        <label class="custom-file-label" for="photo">
                            Cambiar fotografía
                        </label>
                    </div>

                    <small class="text-muted d-block mt-2">
                        Dejar vacío para conservar la imagen actual
                    </small>
                </div>

                {{-- DATOS --}}
                <h5 class="mb-3 font-weight-bold text-secondary">
                    <i class="fas fa-info-circle"></i> Información General
                </h5>

                <div class="row">

                    <div class="col-md-6 form-group">
                        <label>Código</label>
                        <input type="text" class="form-control" value="{{ $animal->id }}" disabled>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Placa *</label>
                        <input type="text"
                               name="plate"
                               value="{{ old('plate', $animal->plate) }}"
                               class="form-control"
                               placeholder="Ej: 001, A-001"
                               required>
                        @error('plate')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Nombre</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $animal->name) }}"
                               class="form-control"
                               placeholder="Ej: Luna, Estrella">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Raza *</label>
                        <select name="breed_id" class="form-control" required>
                            @foreach($breeds as $id => $name)
                                <option value="{{ $id }}" {{ $animal->breed_id == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
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
                                       {{ $animal->sex === 'FEMALE' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="female">Hembra</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio"
                                       id="male"
                                       name="sex"
                                       value="MALE"
                                       class="custom-control-input"
                                       {{ $animal->sex === 'MALE' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="male">Macho</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Fecha de Nacimiento *</label>
                        <input type="date"
                               name="birth_date"
                               value="{{ $animal->birth_date?->format('Y-m-d') }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Fecha de Ingreso</label>
                        <input type="date"
                               name="entry_date"
                               value="{{ $animal->entry_date?->format('Y-m-d') }}"
                               class="form-control">
                    </div>

                </div>

                {{-- PRODUCCIÓN --}}
                <h5 class="mt-4 mb-3 font-weight-bold text-secondary">
                    <i class="fas fa-chart-line"></i> Producción y Control
                </h5>

                <div class="row">

                    <div class="col-md-4 form-group">
                        <label>Peso Actual (kg)</label>
                        <input type="number"
                               step="0.1"
                               name="weight_kg"
                               value="{{ $animal->weight_kg }}"
                               class="form-control">
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Etapa *</label>
                        <select name="production_stage" class="form-control" required>
                            <option value="CALF" {{ $animal->production_stage=='CALF'?'selected':'' }}>Ternero</option>
                            <option value="GROWING" {{ $animal->production_stage=='GROWING'?'selected':'' }}>Crecimiento</option>
                            <option value="DRY" {{ $animal->production_stage=='DRY'?'selected':'' }}>Seca</option>
                            <option value="MILKING" {{ $animal->production_stage=='MILKING'?'selected':'' }}>Ordeño</option>
                            <option value="CULL" {{ $animal->production_stage=='CULL'?'selected':'' }}>Descarte</option>
                        </select>
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Grupo de Edad</label>
                        <input type="text"
                               name="age_group"
                               value="{{ $animal->age_group }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Valor de Inventario</label>
                        <input type="number"
                               step="0.01"
                               name="inventory_value"
                               value="{{ $animal->inventory_value }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Lote / Corral</label>
                        <input type="text"
                               name="lot"
                               value="{{ $animal->lot }}"
                               class="form-control">
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Observaciones</label>
                        <textarea name="observations"
                                  rows="3"
                                  class="form-control">{{ $animal->observations }}</textarea>
                    </div>

                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('sg.aprendiz.sg.ANIMALES.index') }}"
                       class="btn btn-secondary mr-3">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn btn-warning btn-lg animate-btn">
                        <i class="fas fa-save"></i> Actualizar Bovino
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

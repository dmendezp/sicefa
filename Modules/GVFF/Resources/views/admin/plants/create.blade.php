@extends('gvff::layouts.master')

@section('content')
    <div class="container">
        <h1>Crear Planta</h1>
        <form action="{{ route('gvff.admin.plants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nurseries_id">Vivero</label>
                <select name="nurseries_id" id="nurseries_id" class="form-control @error('nurseries_id') is-invalid @enderror" required>
                    <option value="">Seleccione un vivero</option>
                    @foreach ($nurseries as $nursery)
                        <option value="{{ $nursery->id }}">{{ $nursery->name }}</option>
                    @endforeach
                </select>
                @error('nurseries_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="common_name">Nombre Común</label>
                <input type="text" name="common_name" id="common_name" class="form-control @error('common_name') is-invalid @enderror" value="{{ old('common_name') }}" required>
                @error('common_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="scientific_name">Nombre Científico</label>
                <input type="text" name="scientific_name" id="scientific_name" class="form-control @error('scientific_name') is-invalid @enderror" value="{{ old('scientific_name') }}" required>
                @error('scientific_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="plant_type">Tipo de Planta</label>
                <select name="plant_type" id="plant_type" class="form-control @error('plant_type') is-invalid @enderror" required>
                    <option value="">Seleccione un tipo</option>
                    <option value="ornamental" {{ old('plant_type') == 'ornamental' ? 'selected' : '' }}>Ornamental</option>
                    <option value="forestal" {{ old('plant_type') == 'forestal' ? 'selected' : '' }}>Forestal</option>
                    <option value="medicinal" {{ old('plant_type') == 'medicinal' ? 'selected' : '' }}>Medicinal</option>
                </select>
                @error('plant_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div id="plant-type-message" class="mt-2 text-info font-weight-bold"></div>
            </div>
            <div class="form-group">
                <label for="structure_type">Tipo de Estructura</label>
                <select name="structure_type" id="structure_type" class="form-control @error('structure_type') is-invalid @enderror">
                    <option value="">Seleccione un tipo</option>
                    <option value="tree" {{ old('structure_type') == 'tree' ? 'selected' : '' }}>Árbol</option>
                    <option value="shrub" {{ old('structure_type') == 'shrub' ? 'selected' : '' }}>Arbusto</option>
                    <option value="herb" {{ old('structure_type') == 'herb' ? 'selected' : '' }}>Hierba</option>
                </select>
                @error('structure_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="family">Familia</label>
                <input type="text" name="family" id="family" class="form-control @error('family') is-invalid @enderror" value="{{ old('family') }}">
                @error('family')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="characteristics">Características</label>
                <textarea name="characteristics" id="characteristics" class="form-control @error('characteristics') is-invalid @enderror">{{ old('characteristics') }}</textarea>
                @error('characteristics')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="benefits">Beneficios</label>
                <textarea name="benefits" id="benefits" class="form-control @error('benefits') is-invalid @enderror">{{ old('benefits') }}</textarea>
                @error('benefits')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="properties">Propiedades</label>
                <textarea name="properties" id="properties" class="form-control @error('properties') is-invalid @enderror">{{ old('properties') }}</textarea>
                @error('properties')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="traditional_uses">Usos Tradicionales</label>
                <textarea name="traditional_uses" id="traditional_uses" class="form-control @error('traditional_uses') is-invalid @enderror">{{ old('traditional_uses') }}</textarea>
                @error('traditional_uses')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Estado</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="">Seleccione un estado</option>
                    <option value="healthy" {{ old('status') == 'healthy' ? 'selected' : '' }}>Saludable</option>
                    <option value="endangered" {{ old('status') == 'endangered' ? 'selected' : '' }}>En peligro</option>
                    <option value="critical" {{ old('status') == 'critical' ? 'selected' : '' }}>Crítico</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inventory">Inventario</label>
                <input type="number" name="inventory" id="inventory" class="form-control @error('inventory') is-invalid @enderror" value="{{ old('inventory', 0) }}" required>
                @error('inventory')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="location">Ubicación</label>
                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Imagen</label>
                <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="available">Disponible</label>
                <input type="checkbox" name="available" id="available" value="1" {{ old('available', 1) ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="observations">Observaciones</label>
                <textarea name="observations" id="observations" class="form-control @error('observations') is-invalid @enderror">{{ old('observations') }}</textarea>
                @error('observations')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Crear Planta</button>
            <a href="{{ route('gvff.admin.plants.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    @push('scripts')
        <script>
            console.log('Script de planta cargado'); // Depuración: confirmar que el script se ejecuta

            document.addEventListener('DOMContentLoaded', function () {
                // Obtener elementos del DOM
                const plantTypeSelect = document.getElementById('plant_type');
                const priceField = document.getElementById('price-field');
                const priceInput = document.getElementById('price');
                const plantTypeMessage = document.getElementById('plant-type-message');

                // Verificar que los elementos existen
                if (!plantTypeSelect || !priceField || !priceInput || !plantTypeMessage) {
                    console.error('Error: Uno o más elementos del DOM no se encontraron');
                    return;
                }

                function actualizarEstadoFormulario() {
                    const tipoSeleccionado = plantTypeSelect.value;
                    console.log('Tipo de planta seleccionado:', tipoSeleccionado); // Depuración

                    // Mostrar u ocultar el campo de precio
                    if (tipoSeleccionado === 'venta') {
                        priceField.style.display = 'block';
                        priceInput.setAttribute('required', 'required');
                    } else {
                        priceField.style.display = 'none';
                        priceInput.removeAttribute('required');
                        priceInput.value = ''; // Limpiar el campo precio
                    }

                    // Mostrar mensaje con el tipo seleccionado
                    const etiquetasTipos = {
                        'ornamental': 'Ornamental',
                        'forestal': 'Forestal',
                        'medicinal': 'Medicinal',
                        'venta': 'Venta'
                    };
                    plantTypeMessage.textContent = tipoSeleccionado 
                        ? `Tipo seleccionado: ${etiquetasTipos[tipoSeleccionado] || 'Desconocido'}`
                        : '';
                }

                // Ejecutar al cargar la página
                actualizarEstadoFormulario();

                // Escuchar cambios en el selector de tipo de planta
                plantTypeSelect.addEventListener('change', function () {
                    console.log('Evento change disparado'); // Depuración
                    actualizarEstadoFormulario();
                });
            });
        </script>
    @endpush
@endsection
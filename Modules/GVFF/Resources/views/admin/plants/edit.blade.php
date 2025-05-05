@extends('gvff::layouts.master')

@section('content')
    <div class="container">
        <h1>Editar Planta</h1>
        <form action="{{ route('gvff.admin.plants.update', $plants) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nurseries_id">Vivero</label>
                <select name="nurseries_id" id="nurseries_id" class="form-control @error('nurseries_id') is-invalid @enderror" required>
                    <option value="">Seleccione un vivero</option>
                    @foreach ($nurseries as $nursery)
                        <option value="{{ $nursery->id }}" {{ old('nurseries_id', $plants->nurseries_id) == $nursery->id ? 'selected' : '' }}>{{ $nursery->name }}</option>
                    @endforeach
                </select>
                @error('nurseries_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="common_name">Nombre Común</label>
                <input type="text" name="common_name" id="common_name" class="form-control @error('common_name') is-invalid @enderror" value="{{ old('common_name', $plants->common_name) }}" required>
                @error('common_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="scientific_name">Nombre Científico</label>
                <input type="text" name="scientific_name" id="scientific_name" class="form-control @error('scientific_name') is-invalid @enderror" value="{{ old('scientific_name', $plants->scientific_name) }}" required>
                @error('scientific_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="plant_type">Tipo de Planta</label>
                <select name="plant_type" id="plant_type" class="form-control @error('plant_type') is-invalid @enderror" required>
                    <option value="">Seleccione un tipo</option>
                    <option value="ornamental" {{ old('plant_type', $plants->plant_type) == 'ornamental' ? 'selected' : '' }}>Ornamental</option>
                    <option value="forestal" {{ old('plant_type', $plants->plant_type) == 'forestal' ? 'selected' : '' }}>Forestal</option>
                    <option value="medicinal" {{ old('plant_type', $plants->plant_type) == 'medicinal' ? 'selected' : '' }}>Medicinal</option>
                </select>
                @error('plant_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="structure_type">Tipo de Estructura</label>
                <select name="structure_type" id="structure_type" class="form-control @error('structure_type') is-invalid @enderror">
                    <option value="">Seleccione un tipo</option>
                    <option value="tree" {{ old('structure_type', $plants->structure_type) == 'tree' ? 'selected' : '' }}>Árbol</option>
                    <option value="shrub" {{ old('structure_type', $plants->structure_type) == 'shrub' ? 'selected' : '' }}>Arbusto</option>
                    <option value="herb" {{ old('structure_type', $plants->structure_type) == 'herb' ? 'selected' : '' }}>Hierba</option>
                </select>
                @error('structure_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="family">Familia</label>
                <input type="text" name="family" id="family" class="form-control @error('family') is-invalid @enderror" value="{{ old('family', $plants->family) }}">
                @error('family')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="characteristics">Características</label>
                <textarea name="characteristics" id="characteristics" class="form-control @error('characteristics') is-invalid @enderror">{{ old('characteristics', $plants->characteristics) }}</textarea>
                @error('characteristics')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="benefits">Beneficios</label>
                <textarea name="benefits" id="benefits" class="form-control @error('benefits') is-invalid @enderror">{{ old('benefits', $plants->benefits) }}</textarea>
                @error('benefits')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="properties">Propiedades</label>
                <textarea name="properties" id="properties" class="form-control @error('properties') is-invalid @enderror">{{ old('properties', $plants->properties) }}</textarea>
                @error('properties')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="traditional_uses">Usos Tradicionales</label>
                <textarea name="traditional_uses" id="traditional_uses" class="form-control @error('traditional_uses') is-invalid @enderror">{{ old('traditional_uses', $plants->traditional_uses) }}</textarea>
                @error('traditional_uses')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Estado</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="">Seleccione un estado</option>
                    <option value="healthy" {{ old('status', $plants->status) == 'healthy' ? 'selected' : '' }}>Saludable</option>
                    <option value="endangered" {{ old('status', $plants->status) == 'endangered' ? 'selected' : '' }}>En peligro</option>
                    <option value="critical" {{ old('status', $plants->status) == 'critical' ? 'selected' : '' }}>Crítico</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inventory">Inventario</label>
                <input type="number" name="inventory" id="inventory" class="form-control @error('inventory') is-invalid @enderror" value="{{ old('inventory', $plants->inventory) }}" required>
                @error('inventory')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Precio</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $plants->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="location">Ubicación</label>
                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $plants->location) }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Imagen</label>
                <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                @if ($plants->image)
                    <img src="{{ asset($plants->image) }}" alt="{{ $plants->common_name }}" width="100" class="mt-2">
                @endif
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="available">Disponible</label>
                <input type="checkbox" name="available" id="available" value="1" {{ old('available', $plants->available) ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="observations">Observaciones</label>
                <textarea name="observations" id="observations" class="form-control @error('observations') is-invalid @enderror">{{ old('observations', $plants->observations) }}</textarea>
                @error('observations')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Planta</button>
            <a href="{{ route('gvff.admin.plants.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
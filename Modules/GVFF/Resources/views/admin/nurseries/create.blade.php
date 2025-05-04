<!-- Modules/GVFF/Resources/views/admin/viveros/create.blade.php -->
@extends('gvff::layouts.master')

@section('content')
    <div class="container">
        <h1>Crear Vivero</h1>
        <form action="{{ route('gvff.admin.nurseries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Ubicación</label>
                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="max_capacity" class="form-label">Capacidad Máxima</label>
                <input type="number" name="max_capacity" id="max_capacity" class="form-control @error('max_capacity') is-invalid @enderror" value="{{ old('max_capacity') }}" min="1">
                @error('max_capacity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="classification" class="form-label">Clasificación</label>
                <select name="classification" id="classification" class="form-control @error('classification') is-invalid @enderror">
                    <option value="public" {{ old('classification') == 'public' ? 'selected' : '' }}>Público</option>
                    <option value="private" {{ old('classification') == 'private' ? 'selected' : '' }}>Privado</option>
                </select>
                @error('classification')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('gvff.admin.nurseries.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
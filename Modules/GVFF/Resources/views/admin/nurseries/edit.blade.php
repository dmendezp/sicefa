@extends('gvff::layouts.master')

@section('title', 'Edit Nursery')

@push('styles')
    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 600;
            color: #2f855a; /* Match the green theme */
        }
        .form-control {
            transition: border-color 0.2s ease;
        }
        .form-control:focus {
            border-color: #38a169;
            box-shadow: 0 0 0 0.2rem rgba(56, 161, 105, 0.25);
        }
        .btn-primary {
            background-color: #38a169;
            border-color: #38a169;
        }
        .btn-primary:hover {
            background-color: #2f855a;
            border-color: #2f855a;
        }
        .btn-secondary {
            background-color: #6b7280;
            border-color: #6b7280;
        }
        .btn-secondary:hover {
            background-color: #4b5563;
            border-color: #4b5563;
        }
    </style>
@endpush

@section('content')

<div class="container mt-4">

    <h1 class="mb-4">Edit Nursery</h1>

    <!-- Confirmación de que esta vista se está renderizando -->
    <p class="text-success">ESTA ES LA VISTA CORRECTA PARA EDITAR</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('gvff.admin.nurseries.update', $nurseries) }}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $nurseries->name) }}" required>
        </div>

        <div class="col-md-6">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $nurseries->location) }}" required>
        </div>

        <div class="col-md-6">
            <label for="max_capacity" class="form-label">Max Capacity</label>
            <input type="number" name="max_capacity" id="max_capacity" class="form-control" value="{{ old('max_capacity', $nurseries->max_capacity) }}" required>
        </div>

        <div class="col-md-6">
            <label for="classification" class="form-label">Classification</label>
            <select name="classification" id="classification" class="form-select" required>
                <option value="public" {{ old('classification', $nurseries->classification) == 'public' ? 'selected' : '' }}>Public</option>
                <option value="private" {{ old('classification', $nurseries->classification) == 'private' ? 'selected' : '' }}>Private</option>
            </select>
        </div>

        <div class="col-12">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $nurseries->description) }}</textarea>
        </div>

        <div class="col-md-6">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        @if ($nurseries->image)
            <div class="col-md-6 d-flex align-items-end">
                <img src="{{ asset('storage/' . $nurseries->image) }}" alt="Nursery Image" class="img-thumbnail" width="150">
            </div>
        @endif

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update Nursery</button>
            <a href="{{ route('gvff.admin.nurseries.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>

    </form>

</div>

@endsection

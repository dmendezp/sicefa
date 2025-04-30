@extends('gvff::layouts.master')

@section('content')
    <h1>Edit Nursery</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('gvff.admin.nurseries.update', $nurseries) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $nurseries->name) }}" required>
        </div>

        <div>
            <label for="location">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', $nurseries->location) }}" required>
        </div>

        <div>
            <label for="max_capacity">Max Capacity</label>
            <input type="number" name="max_capacity" id="max_capacity" value="{{ old('max_capacity', $nurseries->max_capacity) }}" required>
        </div>

        <div>
            <label for="classification">Classification</label>
            <select name="classification" id="classification" required>
                <option value="public" {{ old('classification', $nurseries->classification) == 'public' ? 'selected' : '' }}>Public</option>
                <option value="private" {{ old('classification', $nurseries->classification) == 'private' ? 'selected' : '' }}>Private</option>
            </select>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ old('description', $nurseries->description) }}</textarea>
        </div>

        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
            @if ($nurseries->image)
                <img src="{{ asset('storage/' . $nurseries->image) }}" alt="Nursery Image" width="100">
            @endif
        </div>

        <button type="submit">Update Nursery</button>
        <a href="{{ route('gvff.admin.nurseries.index') }}">cancelar</a>
    </form>
@endsection
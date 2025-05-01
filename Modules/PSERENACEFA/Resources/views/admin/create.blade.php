@extends('pserenacefa::layouts.master')


@section('content')

<form action="{{ route('pserenacefa.admin.admin.store') }}" method="POST">
    @csrf

    <div>
        <label for="name">Environment Name</label>
        <input type="text" id="name" name="name" required maxlength="100">
    </div>

    <div>
        <label for="capacity">Capacity</label>
        <input type="number" id="capacity" name="capacity" required min="1">
    </div>

    <div>
        <label for="location">Location</label>
        <input type="text" id="location" name="location" required maxlength="100">
    </div>

    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" maxlength="255"></textarea>
    </div>

    <div>
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="Disponible" selected>Disponible</option>
            <option value="No Disponible">No Disponible</option>
        </select>
    </div>

    <div>
        <button type="submit">Create Environment</button>
    </div>
</form>

@endsection
@extends('gvff::layouts.master')

@section('content')
    <div class="container">
        <h1>Asignar Precio de Venta: {{ $plants->common_name }}</h1>

        <form action="{{ route('gvff.admin.plants.processSell', $plants) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="price">Precio (COP):</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $plants->price) }}" required step="0.01" min="0">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Guardar Precio</button>
        </form>
    </div>
@endsection

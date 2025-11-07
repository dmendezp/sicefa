@extends('sigac::layouts.master')

@section('content')
<h2>Editar Punto</h2>

<form method="POST" action="{{ route('sigac::points.points.edit', ['id' => $point->id]) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="date">Fecha:</label>
        <input type="date" id="date" name="date" value="{{ $point->date }}">
    </div>
    <div class="form-group">
        <label for="quantity">Cantidad:</label>
        <input type="number" id="quantity" name="quantity" value="{{ $point->quantity }}">
    </div>
    <div class="form-group">
        <label for="theme">Tema:</label>
        <input type="text" id="theme" name="theme" value="{{ $point->theme }}">
    </div>
    <div class="form-group">
        <label for="state">Estado:</label>
        <input type="text" id="state" name="state" value="{{ $point->state }}">
    </div>
    <!-- Agregar más campos según sea necesario -->
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form>
@endsection

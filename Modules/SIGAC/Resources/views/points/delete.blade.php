@extends('sigac::layouts.master')

@section('content')
<h2>Confirmar eliminación</h2>
<p>¿Estás seguro de que deseas eliminar este punto?</p>
<form method="POST" action="{{ route('borrar_punto', ['id' => $point->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Confirmar Eliminación</button>
</form>
@endsection

@extends('agrocefa::layouts.master')

@section('content')

<link rel="stylesheet" href="{{asset ('agrocefa/css/specie.css')}}">

<div class="container_edit">
    <div class="form-container">
        <td>
            <a href="{{ route('agrocefa.species.index') }}" class="back">
                <i class="fa-solid fa-circle-left"></i>
            </a>
        </td>
<h2 class="edit_title">Agregar nueva especie de cultivo</h2>

<form action="{{ route('agrocefa.species.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="lifecycle">Ciclo de vida:</label>
        <select name="lifecycle" id="lifecycle" class="form-control" required>
            <option value="Transitorio">Transitorio</option>
            <option value="Permanente">Permanente</option>
            <!-- Agrega más opciones según tus valores enum -->
        </select>
    </div>
    <button type="submit" class="act">Guardar</button>
</form>
</div>
</div>

@endsection
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

        <h2 class="edit_title">Editar Registro de Especies</h2>

        <form method="POST" action="{{ route('agrocefa.species.update', ['id' => $specie->id]) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $specie->name }}">
            </div>

            <div class="form-group">
                <label for="lifecycle">Ciclo de Vida:</label>
                <select name="lifecycle" id="lifecycle" class="form-control">
                    <option value="Transitorio" {{ $specie->lifecycle === 'Transitorio' ? 'selected' : '' }}>Transitorio</option>
                    <option value="Permanente" {{ $specie->lifecycle === 'Permanente' ? 'selected' : '' }}>Permanente</option>
                </select>
            </div>

            <button type="submit" class="act">Actualizar</button>
        </form>
    </div>
</div>


@endsection
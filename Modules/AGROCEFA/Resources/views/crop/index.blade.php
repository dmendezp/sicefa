@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Cultivos</title>
    <link rel="stylesheet" type="text/css" href="{{asset('agrocefa/css/crop.css')}}">
    
</head>
<body>
    <h1>Lista de Cultivos</h1>
    <br>
    <br>
    <br>

<div class="table-container">
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Área Sembrada</th>
            <th>Fecha de Siembra</th>
            <th>Densidad</th>
            <th>Acciones</th>
        </tr>
        @foreach($crop as $crop)
        <tr>
            <td>{{ $crop->id }}</td>
            <td>{{ $crop->name }}</td>
            <td>{{ $crop->sown_area }}</td>
            <td>{{ $crop->seed_time }}</td>
            <td>{{ $crop->density }}</td>
            <td>
                <a href="{{ route('agrocefa.crop.create', $crop->id) }}">Ver</a>
                <a href="{{ route('agrocefa.crop.edit', $crop->id) }}">Editar</a>
                <a href="{{ route('agrocefa.crop.delete', $crop->id) }}">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </table>
    <br>
    <a href="{{ route('agrocefa.crop.create') }}" class="add-button"><i class="fas fa-plus"></i></a>
</div>
</body>
@endsection

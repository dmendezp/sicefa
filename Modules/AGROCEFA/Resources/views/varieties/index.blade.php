@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Lista de variedad</title>
    <style>
        /* Estilo para la tabla */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Estilo para los botones */
        .add-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }

        .add-button:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <h1>Lista de variedades</h1>
    <br>
    <br>
    <br>

    <div class="table-container">
        <table>
            <tr> <!-- Abre la fila de encabezados -->
                <th>ID</th>
                <th>Nombre</th>
                <th>Ciclo de Vida</th>
                <th>Acciones</th>
            </tr> <!-- Cierra la fila de encabezados -->
            @foreach($varieties as $variety)
            <tr>
                <td>{{ $variety->id }}</td>
                <td>{{ $variety->name }}</td>
                <td>{{ $variety->lifecycle }}</td>
                <td>
                    <a href="{{ route('agrocefa.varieties.create', $variety->id) }}">Ver</a>
                    <a href="{{ route('agrocefa.varieties.edit', $variety->id) }}">Editar</a>
                    <a href="{{ route('agrocefa.varieties.elim', $variety->id) }}">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </table>
        <br>
        <a href="{{ route('agrocefa.varieties.create') }}" class="add-button"><i class="fas fa-plus"></i></a>
    </div>
</body>

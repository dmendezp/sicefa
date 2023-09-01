@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Crear Variedad de especie</title>
    <link rel="stylesheet" type="text/css" href="{{asset('agrocefa/css/varieties.css')}}">

</head>
<body>
    <h2>Crear Variedad de especie</h2>
    <form method="post" class="formulario">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea>
        <br>
        <input type="submit" value="Guardar">
        <h2>Lista de Variedades de Especies</h2>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
        <tr>
            <td>Arroz </td>
            <td>Cualquier tipo de arroz que sea cultivado en el sena</td>

            <td>
                <div class="button-container">

                    <a href="{{route ('agrocefa.varieties.editar')}}" id="editar-button" class="icon-button">
                        <i class="fa fa-pencil"></i> Editar
                    </a>
                    <a href="{{route('agrocefa.varieties.editar')}}" id="eliminar-button" class="icon-button">                    
                       <i class="fa fa-trash"></i> Eliminar
                    </a>
                    <a href="{{route('agrocefa.varieties.editar')}}" id="eliminar-button" class="icon-button">                    
                        <i class="fa fa-trash"></i> Agregar
                     </a>
                    <a href="{{ route('agrocefa.varieties.crear') }}" id="crear-button" class="icon-button">                    
                        <i class="fa fa-plus"></i> Crear
                    </a>
                </div>
            </td> 
        </tr>
    </form>
    </table>
@endsection
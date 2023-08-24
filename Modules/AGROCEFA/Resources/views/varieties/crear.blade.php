@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Crear Variedad de especie</title>
</head>
<body>
    <style>

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            margin: 0 auto;
            display: block;
            width: 950px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        h2 {
            text-align: center;
            font-size: 24px;
        }
        /*estilo de la tabla de eliminar y editar modificar un poco pregunrle a mario*/
        h2 {
            font-size: 24px;
        }

        form {
            margin-bottom: 20px;
            padding: 4%;
            text-align: let;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th{
            text-align: center;
        }
        th, td {
            padding: 8px;
            text-align: let;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .action-buttons button {
            padding: 5px 10px;
            margin-right: 5px;
            cursor: pointer;
        }

        .icon-button {
            background-color: #17a92d;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button-container {
            text-align: center;
        }

        #editar-button {
            background-color: green;
            color: white; 
        }

        #eliminar-button {
            background-color: red;
            color: white; 
        }

        .icon-button i {
            margin-right: 5px;
        }

        .icon-button:hover {
            background-color: #45a049;
        }


        .action-buttons button:hover {
            opacity: 0.8;
        }
    </style>
    <h2>Crear Variedad de especie</h2>
    <form method="post">
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
            <td>arroz </td>
            <td>cualquier tipo dearroz que sea cultivado en el sena</td>

            <td>
                <div class="button-container">

                    <a href="{{route ('agrocefa.varieties.editar')}}" id="editar-button" class="icon-button">
                        <i class="fa fa-pencil"></i> Editar
                    </a>
                    <a href="{{route('agrocefa.varieties.eliminar')}}" id="eliminar-button" class="icon-button">
                        <i class="fa fa-trash"></i> Eliminar
                    </a>
                </div>
            </td>
        </tr>
    </form>
    </table>

    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
        <tr>
            <td>arroz </td>
            <td>cualquier tipo dearroz que sea cultivado en el sena</td>

            <td>
                <div class="button-container">
                    <button id="editar-button" class="icon-button">
                        <i class="fa fa-pencil"></i> Editar
                    </button>
                    <button id="eliminar-button" class="icon-button">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </div>
            </td>
        </tr>
    </form>
    </table>

</body>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Acciones</th>
    </tr>
    <tr>
        <td>arroz </td>
        <td>cualquier tipo dearroz que sea cultivado en el sena</td>

        <td>
            <div class="button-container">
                <button id="editar-button" class="icon-button">
                    <i class="fa fa-pencil"></i> Editar
                </button>
                <button id="eliminar-button" class="icon-button">
                    <i class="fa fa-trash"></i> Eliminar
                </button>
            </div>
        </td>
    </tr>
</form>
</table>
@endsection
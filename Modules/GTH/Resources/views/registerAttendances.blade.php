@extends('gth::layouts.master')

@section('content')
    <h1>Vista Registro de Asistencia</h1>
    <!-- resources/views/asistencia/registro.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
</head>
<body>
    <h2>Registro de Asistencia con Huella Digital</h2>

    <form action="/registrar-asistencia" method="post">
        @csrf
        <label for="huella">Huella Digital:</label>
        <input type="text" name="huella" required>
        
        <!-- Puedes agregar más campos según sea necesario -->
        <!-- Por ejemplo, nombre, fecha, etc. -->

        <button type="submit">Registrar Asistencia</button>
    </form>
</body>
</html>

@endsection

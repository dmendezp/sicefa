@extends('bienestar::layouts.adminlte')

@section('content')
<h1>lista de conductores</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <!DOCTYPE html>
<html>
<head>
    <title>Formulario con Botón de Guardar</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <div class="formulario">
        <input type="text" id="placa" placeholder="Placa">
        <input type="text" id="conductor" placeholder="Conductor">
        <input type="text" id="cupos" placeholder="Cupos">
        <button id="btnGuardar">Guardar</button>
    </div>

    <div id="resultado"></div>
    
</body>
</html>
            </div>

        </div>

    </div>
</div>
    @endsection
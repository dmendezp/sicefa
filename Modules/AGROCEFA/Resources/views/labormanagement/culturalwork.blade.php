@extends('agrocefa::layouts.master')

@section('content')

<center>
    <h2 id="title">Registro de Aplicación Labores Culturales Unidad Productiva</h2>
</center>

<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="form-container">
                    <h3>Registrar Labor Cultural</h3>
                    <form action="#" method="post">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="hectareas">Hectáreas</label>
                                <input type="number" id="hectareas" name="hectareas" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="fecha">Fecha</label>
                                <input type="date" id="fecha" name="fecha" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="labor_ejecutada">Labor Ejecutada</label>
                                <select id="labor_ejecutada" name="labor_ejecutada" class="form-control">
                                    <option value="">Selecciona una labor</option>
                                    @foreach($activityNames as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="herramienta">Herramienta o Maquinaria utilizada</label>
                                <select id="herramienta" name="herramienta" class="form-control">
                                    <option value="">Selecciona una herramienta</option>
                                    @foreach($elementNames as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="costo_por_hectarea">Costo por Hectárea de Maquinaria</label>
                                <input type="number" id="costo_por_hectarea" name="costo_por_hectarea" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="jornales">Jornales</label>
                                <input type="number" id="jornales" name="jornales" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="personas">Personas</label>
                                <input type="number" id="personas" name="personas" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="valor_unitario">Valor Unitario Jornal</label>
                                <input type="number" id="valor_unitario" name="valor_unitario" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="valor_total">Valor Total</label>
                                <input type="number" id="valor_total" name="valor_total" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="costo_maquinaria">Costo Total Maquinaria</label>
                                <input type="number" id="costo_maquinaria" name="costo_maquinaria" class="form-control" disabled>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="firma_aplicador">Firma Aplicador</label>
                                <img src="{{ asset('agrocefa/images/labores/firma.png') }}" class="logo">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="firma_aplicador">Firma Quien Recomienda</label>
                                <img src="{{ asset('agrocefa/images/labores/firma.png') }}" class="logo">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="observacion">Observación</label>
                                <input type="text" id="observacion" name="observacion" class="form-control">
                            </div>
                            <div class="form-group col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    // Función para calcular el valor total basado en jornales y valor unitario
    function calcularValorTotal() {
        // Obtener el valor de jornales
        var jornales = parseFloat(document.getElementById('jornales').value) || 0;

        // Obtener el valor unitario
        var valorUnitario = parseFloat(document.getElementById('valor_unitario').value) || 0;

        // Calcular el valor total
        var valorTotal = jornales * valorUnitario;

        // Mostrar el valor total en el campo correspondiente
        document.getElementById('valor_total').value = valorTotal;
    }

    // Asignar la función calcularValorTotal al evento "input" en el campo de jornales
    document.getElementById('jornales').addEventListener('input', calcularValorTotal);

    // Asignar la función calcularValorTotal al evento "input" en el campo de valor unitario
    document.getElementById('valor_unitario').addEventListener('input', calcularValorTotal);
</script>


<script>
    // Función para calcular el costo total basado en maquinaria por hectárea
    function calcularCostoMaquinaria() {
        // Obtener la cantidad de hectáreas
        var hectareas = parseFloat(document.getElementById('hectareas').value) || 0;

        // Obtener el costo por hectárea de la maquinaria
        var costoPorHectarea = parseFloat(document.getElementById('costo_por_hectarea').value) || 0;

        // Calcular el costo total
        var costoTotalMaquinaria = hectareas * costoPorHectarea;

        // Mostrar el costo total en el campo correspondiente
        document.getElementById('costo_maquinaria').value = costoTotalMaquinaria;
    }

    // Asignar la función calcularCostoMaquinaria al evento "input" en los campos involucrados
    document.getElementById('hectareas').addEventListener('input', calcularCostoMaquinaria);
    document.getElementById('costo_por_hectarea').addEventListener('input', calcularCostoMaquinaria);
</script>
<style>
    /* ... Tus estilos actuales ... */

    .form-container {
        padding: 20px;
    }

    .form-container h3 {
        margin-bottom: 20px;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group input:focus {
        border-color: #695CFE;
    }

    .btn-primary {
        background-color: #695CFE;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #5436D6;
    }

    .logo {
        width: 100%;
        max-height: 100px;
    }
</style>


@endsection

@extends('bienestar::layouts.adminlte')

@section('content_header')
    <h1>Configuración de Rutas</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 style="font-family: Calibri, sans-serif; font-size: 40px; font-weight: 400; color: #000000;">Insertar de Rutas</h2>
            <form action="{{ route('bienestar.transportroutes.add') }}" method="POST">
                @csrf <!-- Agregar el token CSRF -->

                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Numero de Ruta" name="numberRoute" style="height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="nameRoute" name="nameRoute" class="form-control" placeholder="Nombre de Ruta" style="height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                        </div>
                        <div class="input-group mb-3">
                            <select id="bus" name="bus" class="form-control" style="width: 100%; height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                                <option value="">Bus</option>
                                @foreach ($buses as $bus)
                                    <option value="{{ $bus->id }}" data-driver-name="{{ $bus->bus_driver->name }}">{{ $bus->plate }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="stopBus" name="stopBus" class="form-control" placeholder="Parada del Bus" style="height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                        </div>
                    </div>
                    <span class="col-md-2"> <!-- Espacio entre los botones -->
                    </span>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <input id="nameDriver" name="nameDriver" type="text" class="form-control" placeholder="Nombre del Conductor" readonly="readonly" style="height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Hora Llegada</span>
                            </div>
                            <input type="time" id="timeArrival" name="timeArrival" class="form-control" style="height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Hora  Salida </span>
                            </div>
                            <input type="time" id="hourExit" name="hourExit" class="form-control" style="height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn" style="background-color: #FF001A; color: #FFFFFF;" id="showModalBtn">Cancelar</button>                    
                            <span class="ml-4"></span> <!-- Espacio entre los botones -->
                            <button type="submit" class="btn btn-success" style="background-color: #00FF22;">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Obtén una referencia al elemento select y al input
    var selectBus = document.getElementById('bus');
    var conductorInput = document.getElementById('nameDriver');

    // Agrega un evento de cambio al select
    selectBus.addEventListener('change', function() {
        // Obtén el valor seleccionado
        var selectedBusId = selectBus.value;

        // Busca la opción seleccionada y obtén el nombre del conductor desde el atributo de datos
        var selectedOption = selectBus.options[selectBus.selectedIndex];
        var conductorName = selectedOption.getAttribute('data-driver-name');

        // Actualiza el valor del input con el nombre del conductor
        conductorInput.value = conductorName;
    });
</script>

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

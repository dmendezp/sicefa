@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid" style="max-width:1200px">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-12">
            <div class="card-header">
                <h3 class="card-title">{{ trans('bienestar::menu.Insert Routes')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('cefa.bienestar.transportroutes.store') }}" method="POST" role="form">
                    @csrf
                    <div class="row p-4">
                        <div class="col-md-3">
                            <label for="route_number">{{ trans('bienestar::menu.Routing Number')}}</label>
                            <select name="route_number" id="route_number" class="form-control" required>
                                <option value="">{{ trans('bienestar::menu.Select a route number')}}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="name_route">{{ trans('bienestar::menu.Route Name')}}</label>
                            <input type="text" name="name_route" id="name_route" class="form-control" placeholder="{{ trans('bienestar::menu.Route Name')}}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="bus">{{ trans('bienestar::menu.Bus')}}</label>
                            <select name="bus" id="bus" class="form-control" required>
                                <option value="">{{ trans('bienestar::menu.Select a bus')}}</option>
                                @foreach ( $buses as $bus )
                                <option value="{{ $bus->id }}" data-bus-driver="{{ $bus->bus_driver->name }}">{{ $bus->plate }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="bus">{{ trans('bienestar::menu.Drivers Name')}}</label>
                            <input id="bus_driver" name="driver_name" type="text" class="form-control" placeholder="Nombre del Conductor" readonly="readonly">
                        </div>
                        <div class="col-md-3">
                            <label for="bus">{{ trans('bienestar::menu.Bus stop')}}</label>
                            <input id="stop_bus" name="stop_bus" type="text" class="form-control" placeholder="Ej: Juncal">
                        </div>
                        <div class="col-md-3">
                            <label for="arrival_time">{{ trans('bienestar::menu.Arrival Time')}}</label>
                            <input type="time" name="arrival_time" id="arrival_time" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label for="departure_time">{{ trans('bienestar::menu.Departure Time')}}</label>
                            <input type="time" name="departure_time" id="departure_time" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <div class="btns mt-0">
                                <button type="submit" class="btn btn-success" style="background-color: #179722; color: white;">{{ trans('bienestar::menu.Save')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="mtop16">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('bienestar::menu.Routing Number')}}</th>
                                <th>{{ trans('bienestar::menu.Route Name')}}</th>
                                <th>{{ trans('bienestar::menu.Bus stop')}}</th>
                                <th>{{ trans('bienestar::menu.Arrival Time')}}</th>
                                <th>{{ trans('bienestar::menu.Departure Time')}}</th>
                                <th>{{ trans('bienestar::menu.Plate')}}</th>
                                <th>{{ trans('bienestar::menu.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $routestransportations as $transport)
                            <tr>
                                <td>{{ $transport->id}}</td>
                                <td>{{ $transport->route_number}}</td>
                                <td>{{ $transport->name_route}}</td>
                                <td>{{ $transport->stop_bus}}</td>
                                <td>{{ $transport->arrival_time}}</td>
                                <td>{{ $transport->departure_time}}</td>
                                <td>{{ $transport->bus->plate}}</td>
                                <td><div class="d-flex">
                                    <button class="btn btn-primary editButton mr-2" data-id="{{ $transport->id }}" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button>
                                    <form action="{{ route('cefa.bienestar.transportroutes.destroy', ['id' => $transport->id]) }}" method="POST" class="formEliminar">
                                        @csrf
                                        @method("DELETE")
                                        <!-- Botón para abrir el modal de eliminación -->
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.card-body -->
    </div>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Transporte</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('cefa.bienestar/transportroutes/update/id') }}" method="POST" role="form">
                    @method('PUT')
                    @csrf
                    <div class="row p-4">
                        <div class="col-md-12">
                            <label for="route_number">Numero Ruta</label>
                            <div class="form-group">
                                <select name="route_number" id="route_number_select" class="form-control" required></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="name_route">Nombre Ruta</label>
                            <div class="form-group">
                                <input type="text" name="name_route" class="form-control" placeholder="Ingrese Nombre Ruta" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="bus">Bus</label>
                            <div class="form-group">
                                <select name="bus" id="bus_select" class="form-control" required></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stop_bus">Parada Bus</label>
                                <input type="text" name="stop_bus" class="form-control" placeholder="Parada Bus" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="bus_driver">Conductor</label>
                            <div class="form-group">
                                <input type="text" name="bus_driver" id="bus_driver_select" class="form-control" placeholder="Nombre del conductor">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="arrival_time">Hora LLegada</label>
                                <input type="time" name="arrival_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="departure_time">Hora Salida</label>
                                <input type="time" name="departure_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btns">
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Obtén una referencia al elemento select y al input
    var selectBus = document.getElementById('bus');
    var conductorInput = document.getElementById('bus_driver');

    // Agrega un evento de cambio al select
    selectBus.addEventListener('change', function() {
        // Obtén el valor seleccionado
        var selectedBusId = selectBus.value;

        // Busca la opción seleccionada y obtén el nombre del conductor desde el atributo de datos
        var selectedOption = selectBus.options[selectBus.selectedIndex];
        var conductorName = selectedOption.getAttribute('data-bus-driver');

        // Actualiza el valor del input con el nombre del conductor
        conductorInput.value = conductorName;
    });
</script>

@endsection
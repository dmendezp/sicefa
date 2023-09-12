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

<!-- Modales de edición -->
@foreach ( $routestransportations as $transport)
<div class="modal fade" id="editModal{{ $transport->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $transport->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $transport->id }}">Editar Transporte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición con validación -->
                <form id="editForm{{ $transport->id }}" action="{{ route('cefa.bienestar.transportroutes.update', ['id' => $transport->id]) }}" method="post" onsubmit="return validateForm{{ $transport->id }}()">
                @csrf
                    <div class="form-group">
                        <label for="route_number{{ $transport->id }}">Número De Ruta:</label>
                        <select name="route_number" id="route_number{{ $transport->id }}" class="form-control" required>
                            <option value="">Selecciona un número de ruta</option>
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
                    <div class="form-group">
                        <label for="name_route{{ $transport->id }}">Nombre De La Ruta:</label>
                        <input type="text" name="name_route" id="name_route{{ $transport->id }}" class="form-control" placeholder="Nombre Ruta" required>
                    </div>
                    <div class="form-group">
                        <label for="bus{{ $transport->id }}">Bus:</label>
                        <select name="bus" id="bus{{ $transport->id }}" class="form-control" required onchange="updateDriverName{{ $transport->id }}()">
                            <option value="">Selecciona un bus</option>
                            <!-- Aquí puedes agregar opciones dinámicamente con tu backend -->
                            <option value="1" data-bus-driver="Conductor 1">Bus 1</option>
                            <option value="2" data-bus-driver="Conductor 2">Bus 2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bus_driver{{ $transport->id }}">Nombre del Conductor:</label>
                        <input id="bus_driver{{ $transport->id }}" name="driver_name" type="text" class="form-control" placeholder="Nombre del Conductor" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="stop_bus{{ $transport->id }}">Parada:</label>
                        <input id="stop_bus{{ $transport->id }}" name="stop_bus" type="text" class="form-control" placeholder="Ej: Juncal">
                    </div>
                    <div class="form-group">
                        <label for="arrival_time{{ $transport->id }}">Hora Llegada:</label>
                        <input type="time" name="arrival_time" id="arrival_time{{ $transport->id }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="departure_time{{ $transport->id }}">Hora Salida:</label>
                        <input type="time" name="departure_time" id="departure_time{{ $transport->id }}" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
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

    // Función para abrir el modal de eliminación
    $(document).on('click', '.deleteButton', function () {
        var transportId = $(this).data('id');
        var modal = $('#deleteModal' + transportId);

        // Abre el modal
        modal.modal('show');
    });
</script>
<script>
    $(document).ready(function () {
        // Agrega un evento cuando el modal se muestra
        $('.editButton').on('click', function () {
            var id = $(this).data('id');
            var routeNumber = $(this).data('route-number');
            var nameRoute = $(this).data('name-route');
            var stopBus = $(this).data('stop-bus');
            var arrivalTime = $(this).data('arrival-time');
            var departureTime = $(this).data('departure-time');
            var busId = $(this).data('bus-id');
            var busDriver = $(this).data('bus-driver');

            // Llena el formulario con los valores obtenidos
            $('#route_number' + id).val(routeNumber);
            $('#name_route' + id).val(nameRoute);
            $('#stop_bus' + id).val(stopBus);
            $('#arrival_time' + id).val(arrivalTime);
            $('#departure_time' + id).val(departureTime);
            $('#bus' + id).val(busId);
            $('#bus_driver' + id).val(busDriver);
        });
    });
</script>
@endsection
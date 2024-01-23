@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid" style="max-width:1200px">
    <h1>{{ trans('bienestar::menu.Insert Routes')}} <i class="fas fa-bus"></i></h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-12">

            <!-- /.card-header -->
            <div class="card-body">
                @if (Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.save.transportroutes'))
                <form action="{{ route('bienestar.' . getRoleRouteName (Route::currentRouteName()) . '.save.transportroutes')}}" method="POST" role="form" class="formGuardar">
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
                                <option value="{{ $bus->id }}" data-bus-driver="{{ $bus->bus_driver->name }}" data-bus-quotas="{{ $bus->quota }}">{{ $bus->plate }}</option>
                                @endforeach

                            </select>
                        </div>
                        <input type="hidden" id="bus_quota" name="bus_quota" class="form-control" placeholder="Nombre del Conductor" readonly="readonly">
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
                @endif
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
                                <td>
                                    @if (Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.buttons.transportroutes'))
                                    <div class="d-flex">
                                        <button class="btn btn-primary editButton mr-2" data-id="{{ $transport->id }}" data-toggle="modal" data-target="#editModal{{$transport->id}}"><i class="fas fa-edit"></i></button>
                                        @if (Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.transportroutes'))
                                        <form action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.transportroutes', ['id' => $transport->id]) }}" method="POST" class="formEliminar">
                                        @csrf
                                            @method("DELETE")<!-- Botón para abrir el modal de eliminación -->
                                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                        @endif
                                    </div>
                                    @endif
                                </td>
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
<!-- Modal para la edición -->
@foreach ( $routestransportations as $transport)
<div class="modal fade" id="editModal{{ $transport->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Contenido del modal de edición aquí -->
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{ trans('bienestar::menu.Edit Benefit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición con validación -->
                @if (Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.edit.transportroutes'))
                <form id="editForm-{{ $transport->id }}" action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.edit.transportroutes', ['id' => $transport->id]) }}" class="formEditar" method="post" role="formedit" onsubmit="return validateForm{{ $transport->id }}()">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="hidden" name="id_transport" value="{{$transport->id}}">
                        <label for="route_number{{ $transport->id }}">Número De Ruta:</label>
                        <select name="new_route_number" id="route_number{{ $transport->id }}" class="form-control" required>
                            <option value="">Selecciona un número de ruta</option>
                            @for ($i = 1; $i <= 8; $i++) <option value="{{ $i }}" @if ($i==$transport->route_number) selected @endif>{{ $i }}</option>
                                @endfor
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label for="name_route{{ $transport->id }}">Nombre De La Ruta:</label>
                        <input type="text" name="new_name_route" id="name_route{{ $transport->id }}" class="form-control" placeholder="Nombre Ruta" required value="{{ $transport->name_route }}">
                    </div>
                    <div class="form-group">
                        <label for="bus{{ $transport->id }}">Bus:</label>
                        <select name="new_bus" id="bus{{ $transport->id }}" class="form-control" required onchange="updateDriverName{{ $transport->id }}()">
                            <option value="">Selecciona un bus</option>
                            @foreach ( $buses as $b )
                                <option value="{{ $b->id }}" data-bus-driver="{{ $b->bus_driver->name }}">{{ $b->plate }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bus_driver{{ $transport->id }}">Nombre del Conductor:</label>
                        <input id="bus_driver{{ $transport->id }}" name="new_driver_name" type="text" class="form-control" placeholder="Nombre del Conductor" readonly="readonly" value="{{ $transport->bus->bus_driver->name }}">
                    </div>
                    <input type="hidden" id="bus_quota{{ $transport->id }}" name="new_bus_quota" class="form-control" value="{{ $transport->bus->quota}}" readonly="readonly">
                    <div class="form-group">
                        <label for="stop_bus{{ $transport->id }}">Parada:</label>
                        <input id="stop_bus{{ $transport->id }}" name="new_stop_bus" type="text" class="form-control" placeholder="Ej: Juncal" value="{{ $transport->stop_bus }}">
                    </div>
                    <div class="form-group">
                        <label for="arrival_time{{ $transport->id }}">Hora Llegada:</label>
                        <input type="time" name="new_arrival_time" id="arrival_time{{ $transport->id }}" class="form-control" required value="{{ $transport->arrival_time }}">
                    </div>
                    <div class="form-group">
                        <label for="departure_time{{ $transport->id }}">Hora Salida:</label>
                        <input type="time" name="new_departure_time" id="departure_time{{ $transport->id }}" class="form-control" required value="{{ $transport->departure_time }}">
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    // Escuchar el evento de cambio en el campo de selección "Bus"
    $('#bus').change(function() {
        // Obtener el valor seleccionado en el campo de selección "Bus"
        var selectedBusId = $(this).val();

        // Encontrar la opción seleccionada y obtener el atributo "data-bus-driver"
        var selectedBusDriver = $('option:selected', this).data('bus-driver');
        var selectedBusQuota = $('option:selected', this).data('bus-quotas');

        // Actualizar el campo de entrada "Nombre del Conductor" con el nombre del conductor
        $('#bus_driver').val(selectedBusDriver);
        $('#bus_quota').val(selectedBusQuota);
    });
</script>
@endsection
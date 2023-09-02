@extends('bienestar::layouts.adminlte')

@section('content')

<!-- Contenido de la página -->
<div class="container">
    <div class="row">
        
            <h2 style="margin-bottom: 45px;">Listado De Rutas</h2>
        </div>
        <div class="card">
        <div class="card-body">
        <div class="col-md-6 text-right">
            <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div> 
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addRouteModal">Agregar Ruta</button>
            </div>
        </div>
    </div> 
        <!-- Modal for Add Route -->
            <div class="modal fade" id="addRouteModal" tabindex="-1" role="dialog" aria-labelledby="addRouteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="settingsModalLabel">Configuración</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Contenido de la configuración -->
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                        </div>
                                    </div>
            </div>
            <!-- Tabla para mostrar los datos -->
            <div class="table-responsive">
                <table id="example1" class="table table-bordered" style="white-space: nowrap; overflow-x: auto;">
                    <thead>
                        <tr>
                            <th># Ruta</th>
                            <th>Nombre Ruta</th>
                            <th>Parada</th>
                            <th>Hora Recogida</th>
                            <th>Hora Salida</th>
                            <th>Placa</th>
                            <th>Conductor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($routestransportation as $routestransport)
                        @foreach ($buses as $bus)
                        @foreach ($busDrivers as $busDriver)
                        <tr>
                            <td>{{ $routestransport->route_number }}</td>
                            <td>{{ $routestransport->name_route }}</td>
                            <td>{{ $routestransport->stop_bus }}</td>
                            <td>{{ $routestransport->arrival_time }}</td>
                            <td>{{ $routestransport->departure_time }}</td>
                            @if ($routestransport->bus_id == $bus->id)
                            <td>{{ $bus->plate }}</td>
                                @if ($bus->bus_driver_id == $busDriver->id)
                            <td>{{ $busDriver->name }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm custom-icon-btn" data-toggle="modal" data-target="#settingsModal">
                                <i class="fas fa-edit" style="color: #000000;"></i>
                                </a>
                                &nbsp;
                                <a href="#" class="btn btn-danger btn-sm custom-icon-btn" data-toggle="modal" data-target="#deleteModal">
                                    <i class="fas fa-trash" style="color: #000000;"></i>
                                </a>
                                <!-- Modal for edit -->
                                <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="settingsModalLabel">Configuración</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Contenido de la configuración -->
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                 <!-- Modal for Delete -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Eliminar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro de que deseas eliminar este elemento?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger">Eliminar</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </td>
                        </tr>
                            @endif
                            @endif
                        @endforeach
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Incluye los scripts de AdminLTE, jQuery y Popper.js -->
<script src="ruta_al_archivo_jquery.js"></script>
<script src="ruta_al_archivo_popper.js"></script>
<script src="ruta_al_archivo_adminlte.js"></script>

@endsection

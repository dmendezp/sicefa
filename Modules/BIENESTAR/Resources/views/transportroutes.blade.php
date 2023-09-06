@extends('bienestar::layouts.adminlte')

@section('content')
<!-- Main content -->
<div class="container-fluid" style="max-width:1200px">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-12">
            <div class="card-header">
                <h3 class="card-title">{{ __('Insertar De Rutas') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
    <form action="{{ route('bienestar.buses.store') }}" method="POST" role="form">
        @csrf
        <div class="row p-4">
            <div class="col-md-3">
                <label for="plate">Numero De Ruta:</label>
                <select name="plate" class="form-control" required>
                    <option value="">Selecciona un número de ruta</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="bus_driver">Nombre De Ruta:</label>
                <input type="text" name="route_name" class="form-control" placeholder="Nombre Ruta" required>           
            </div>
            <div class="col-md-3">
                <label for="bus">Bus:</label>
                <select name="bus" class="form-control" required>
                    <option value="">Seleccione...</option>
                    <!-- Aquí puedes insertar dinámicamente las opciones desde tu controlador -->
                </select>
            </div>
            <div class="col-md-3">
                <label for="bus_stop">Parada Bus:</label>
                <input type="text" name="bus_stop" class="form-control" placeholder="Parada De Bus" required>
            </div>
            <div class="col-md-3">
                <label for="driver">Conductor:</label>
                <input type="text" name="driver" class="form-control" placeholder="Nombre Conductor" required>
            </div>
            <div class="col-md-3">
                <label for="arrival_time">Hora Llegada:</label>
                <input type="time" name="arrival_time" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="departure_time">Hora Salida:</label>
                <input type="time" name="departure_time" class="form-control" required>
            </div>
            <div class="col-md-3" style="position:relative; top:30px">
                <button type="submit" class="btn btn-success" style="background-color: #00FF22; color: black;">Guardar</button>
            </div>
        </div>
    </form>
</div>

<div class="mtop16">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Numero De Ruta</th>
                                <th>Nombre De Ruta</th>
                                <th>Parada Del Bus</th>
                                <th>Nombre Conductor</th>
                                <th>Hora De Lllegada</th>
                                <th>Hora De Salida</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($routestransportation as $b)
                    <tr>
                        <td>{{ $b->route_number }}</td>
                        <td>{{ $b->name_route }}</td>
                        <td>{{ $b->stop_bus }}</td>
                        <td>{{ $b->bus_id }}</td>
                        <td>{{ $b->arrival_time }}</td>
                        <td>{{ $b->departure_time }}</td>
                                <td></td>
                                <td>
                                <div class="opts">
    <div class="btn-group" role="group">
        <button class="btn btn-sm btn-info mr-2" data-toggle="modal"
            data-target="#modal-default" data-plate="{{ $b->plate }}"
            data-bus-driver="{{ $b->bus_driver }}" data-bus-id="{{ $b->id }}"
            data-quota="{{ $b->quota }}">Editar
        </button>

        {!! Form::open(['route' => ['bienestar.buses.destroy', $b->id],
        'method' => 'DELETE', 'style' => 'display: inline;']) !!}
        <button class="btn btn-sm btn-danger"
            onclick="if(confirm('¿Estás seguro de que deseas eliminar este elemento?')) { $(this).closest('form').submit(); return false; }">Eliminar</button>
        {!! Form::close() !!}
    </div>
</div>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
 </div>
    </div>
     </div>
      </div>
       </div>
        </div>
@endsection
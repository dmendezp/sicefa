@extends('bienestar::layouts.adminlte')

@section('content')
<!-- Main content -->
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-8">
            <div class="card-header">
                <h3 class="card-title">{{ __('Buses') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {!! Form::open(['route' => 'bienestar.buses.store', 'method' => 'POST', 'role' => 'form'])
                !!}
                <div class="row p-4">
                    <div class="col-md-3">
                        {!! Form::label('plate', 'Placa:') !!}
                        {!! Form::text('plate', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la placa',
                        'required']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('bus_driver', 'Conductor:') !!}
                        {!! Form::select('bus_driver', $busDrivers, null, ['class' => 'form-control','placeholder' =>
                        'Seleccione...','required']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('quota', 'Cupos:') !!}
                        {!! Form::text('quota', null, ['class' => 'form-control', 'placeholder' => 'Ingrese los cupos',
                        'required']) !!}
                    </div>
                    <div class="col-md-2 align-self-end">
                        <div class="btns mt-3">
                            {!! Form::submit('Guardar',['class'=>'btn btn-success', 'style'=>'background-color: #00FF22;
                            color: black;']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="mtop16">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Conductor</th>
                                <th>Placa</th>
                                <th>Cupos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buses as $b)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b->bus_driver->name }}</td>
                                <td>{{ $b->plate }}</td>
                                <td>{{ $b->quota }}</td>
                                <td>
                                    <div class="opts">
                                        <button class="btn btn-sm btn-info" data-toggle="modal"
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


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar bus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'bienestar/buses/update/id', 'method' => 'PUT', 'role' =>
                'form']) !!}
                <div class="row p-4">
                    <div class="col-md-3">
                        {!! Form::text('plate', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la placa',
                        'required']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::select('bus_driver', $busDrivers, null, ['class' => 'form-control','required', 'id' =>
                        'bus_driver_select']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::text('quota', null, ['class' => 'form-control', 'placeholder' => 'Ingrese los cupos',
                        'required']) !!}
                    </div>
                    <div class="col-md-2">
                        <div class="btns">
                            {!! Form::submit('Actualizar',['class'=>'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal-default').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var plate = button.data('plate');
            var busDriver = button.data('bus-driver');
            var quota = button.data('quota');
            var busId = button.data('bus-id');

            var modal = $(this);
            modal.find('[name="plate"]').val(plate);
            modal.find('[name="quota"]').val(quota);

            // Establece la opción seleccionada en el select
            modal.find('#bus_driver_select').val(busDriver.id);

            // Pone el id del bus en la url del formulario
            var form = modal.find('form');
            var updateUrl = form.attr('action').replace(/id/g, busId);
            form.attr('action', updateUrl);
        });
    });
</script>
@endsection
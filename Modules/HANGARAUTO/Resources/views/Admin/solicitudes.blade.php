@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::general.Request_Vehicle') }}</li>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col pt-4">
                <div class="card-header bg-warning">
                    Solicitudes De Prestamos De Vehiculos
                </div><br>
                <table id="users" class="table table-bordered table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Vuelta</th>
                        <th>Departamento</th>
                        <th>Ciudad</th>
                        <th>Telefono</th>
                        <th>Motivo</th>
                        <th># Pasajeros</th>
                        <th>Enviada El Día</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        @foreach($requests as $v)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$ve->people[0]->first_name}}</td>
                                <td>{{$ve->people[0]->misena_email}}</td>
                                <td>{{$ve->start_date}}</td>
                                <td>{{$ve->end_date}}</td>
                                <td>{{$ve->municipality->department->name}}</td>
                                <td>{{$ve->municipality->name}}</td>
                                <td>{{$ve->people[0]->telephone1}}</td>
                                <td>{{$ve->reason}}</td>
                                <td>{{$ve->num_students}}</td>
                                <td>{{$ve->created_at}}</td>
                                <td>
                                    <a href="{{ route('admin.solicitudes.aceptar',$v->id) }}" type="button"><i class="fas fa-check"></i></a>
                                    <a href="{{ route('admin.solicitudes.rechazar',$v) }}" type="button"><i class="far fa-times-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/datatables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users').DataTable();
        });
    </script>
@stop
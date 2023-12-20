@extends('hangarauto::layout.adminhome')
@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href=""></a>{{ trans('hangarauto::') }}</li>
@endpush

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <!-- Main Content --->
    <div class="container-fluid">
        <div class="row">
            <div class="col pt-4">
                <div class="card-header bg-warning">
                    Registro De Conductores Del CEFA
                </div><br>
                <a href="{{ route('parking.admin.create') }}">
                    <button type="button" class="btn btn-primary">Agregar Conductor</button>
                </a>
                <div class="card">
                    <div class="card-body">
                        <table id="travels" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <th>Nombre</th>
                                <th>Primer Apellido</th>
                                <th>Segundo Apellido</th>
                                <th>Email</th>
                                <th>Numero De Telefono</th>
                                <th>Numero De Cédula</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                @foreach($drivers as $d)
                                    <tr>
                                        <td>{{$d->person->first_name}}</td>
                                        <td>{{$d->person->first_last_name}}</td>
                                        <td>{{$d->person->second_last_name}}</td>
                                        <td>{{$d->person->misena_email}}</td>
                                        <td>{{$d->person->telephone1}}</td>
                                        <td>{{$td->person->document}}</td>
                                        <td>
                                            <a class="btn-delete" href="{{ route('parking.admin.drivers.delete',$d) }}" data-action="eliminar" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min-js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#travels').DataTable();
        });
    </script>
@endsection

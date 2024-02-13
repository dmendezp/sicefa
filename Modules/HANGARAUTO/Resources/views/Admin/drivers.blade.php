@extends('hangarauto::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href=""></a>{{ trans('hangarauto::drivers.Drivers') }}</li>
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
                <div class="card-header">
                    <h4>Conductores</h4>
                </div><br>
                <a href="{{ route('hangarauto.admin.drivers.create') }}">
                    <button type="button" class="btn btn-primary">Agregar Conductor</button>
                </a><br><br>
                <div class="card">
                    <div class="card-body">
                        <table id="travels" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Numero De Cédula</th>
                                <th>Numero De Telefono</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                @foreach($drivers as $d)
                                    <tr>
                                        <td>{{$d->person->fullname}}</td>
                                        <td>{{$d->person->personal_email}}</td>
                                        <td>{{$d->person->telephone1}}</td>
                                        <td>{{$d->person->document_number}}</td>
                                        <td>
                                            <a class="btn-delete" href="{{ route('hangarauto.admin.drivers.delete',$d) }}" data-action="eliminar" data-toggle="tooltip" data-placement="top" title="Eliminar">
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

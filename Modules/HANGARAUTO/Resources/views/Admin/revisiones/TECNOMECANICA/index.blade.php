@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::Tecno.Tecnomecanic') }}</li>
@endpush

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col pt-4">
                <div class="card-header bg-warning">
                    <h5>{{trans('hangarauto::Tecno.Title1') }}</h5>
                </div><br>
                @include('hangarauto::admin.revisiones.tecnomecanica.create')
                <div class="card">
                    <div class="card-body">
                        <table id="Travel" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <th>ID</th>
                                <th>Vehiculo</th>
                                <th>Persona Que Lo Llevó</th>
                                <th>Lo Llevó el:</th>
                                <th>Nueva Fecha De Vencimiento Tecnomecanica</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                @foreach($Tecnomecanic as $t)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$t->vehicle_name_id}}</td>
                                        <td>{{$t->who}}</td>
                                        <td>{{$t->arrived}}</td>
                                        <td>{{$t->newdate}}</td>
                                        <td>
                                            <a class="btn-delete" href="{{ route('parking.admin.tecnomecanica.delete',$t) }}" data-action="eliminar" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#travels').DataTable();
        });
    </script>
@endsection
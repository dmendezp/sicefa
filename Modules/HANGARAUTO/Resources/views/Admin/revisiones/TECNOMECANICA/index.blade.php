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
                <div class="card-header">
                    <h4>{{trans('hangarauto::Tecno.Tecnomechanic') }}</h4>
                </div><br>
                @include('hangarauto::admin.revisiones.tecnomecanica.create')
                <div class="card">
                    <div class="card-body">
                        <table id="Travel" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <th>#</th>
                                <th>Vehiculo</th>
                                <th>Responsable</th>
                                <th>Fecha Revision</th>
                                <th>Fecha Vencimiento</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                @foreach($Tecnomecanic as $t)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$t->vehicle->name }}</td>
                                        <td>{{$t->person->fullname }}</td>
                                        <td>{{$t->review_date}}</td>
                                        <td>{{$t->expiration_date}}</td>
                                        <td>
                                            <a class="btn-delete" href="{{ route('hangarauto.admin.tecnomecanica.delete',$t) }}" data-action="eliminar" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
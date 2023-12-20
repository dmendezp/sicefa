@extends('hangarauto::layout.adminhome')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::') }}</li>
@endpush

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https:://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col pt-4">
                <div class="card-header bg-warning">
                    Registros De Estado Y Fecha De Cambio Del SOAT
                </div><br>
                @include('hangarauto::admin.revisiones.SOAT.create')
                <div class="card">
                    <div class="card-body">
                        <table id="Travel" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <th>ID</th>
                                <th>vehiculo</th>
                                <th>Persona Que Lo Llevó</th>
                                <th>Lo Llevó El</th>
                                <th>Nueva Fecha De Vencimiento SOAT</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                @foreach($Soat as $s)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$s->vehicle_name_id}}</td>
                                        <td>{{$s->who}}</td>
                                        <td>{{$s->arrived}}</td>
                                        <td>{{$s->newdate}}</td>
                                        <td>
                                            <a class="btn-delete" href="{{ route('parking.admin.soat.delete', $s)}}" data-action="eliminar" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
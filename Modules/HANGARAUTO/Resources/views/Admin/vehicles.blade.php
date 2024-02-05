@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href=""></a>{{ trans('hangarauto::Vehiculos.Vehicles') }}</li>
@endpush

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col pt-4">
                <div class="card-header bg-warning">
                    <h5>{{ trans('hangarauto::Vehiculos.cefa_vehicles') }}</h5>
                </div><br>
                <a href="{{ route('cefa.parking.admin.vehicles.create')}}">
                    <button type="button" class="btn btn-primary">Agregar Vehiculo</button>
                </a><br><br>
                <div class="card">
                    <div class="card-body">
                        <table id="Travel" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <th>ID</th>
                                <th>Vehículos</th>
                                <th>Referencia</th>
                                <th>Estado</th>
                                <th>Placa</th>
                                <th>Nivel De Gasolina</th>
                                <th>Imagen</th>
                                <th>Editar Info</th>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $t)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$t->name}}</td>
                                        <td>{{$t->referece}}</td>
                                        <td>{{$t->status}}</td>
                                        <td>{{$t->license}}</td>
                                        <td>{{$t->fuel_level}}</td>
                                        <td>
                                            <img src="{{ asset('/public/modules/HANGARAUTO/img/rastrilladora.jpg'.$t->file_path.$t->image) }}" width="120">
                                        </td>
                                        <td>
                                            <a href="{{ route('cefa.parking.admin.vehicles.edit',$t) }}" type="button"><i class="fas fa-edit"></i></a>
                                            <a class="btn-delete" href="{{ route('cefa.parking.admin.vehicles.delete',$t) }}" data-action="eliminar" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Consumo</li>
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
                    <h4>{{trans('hangarauto::Vehiculos.Oil Consume') }}</h4>
                </div><br>
                <!-- Muestra errores de validación -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @include('hangarauto::admin.con_gaso.create')
                <div class="card">
                    <div class="card-body">
                        <table id="Travel" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <th>#</th>
                                <th>{{trans('hangarauto::Vehiculos.Vehicle') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Responsability') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Date') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Fuel Type') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Amount') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Price') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Mileage') }}</th>
                                <th>{{trans('hangarauto::Drivers.Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach($consumo as $c)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$c->vehicle->name }}</td>
                                        <td>{{$c->person->fullname }}</td>
                                        <td>{{$c->date }}</td>
                                        <td>{{$c->type }}</td>
                                        <td>{{$c->amount }}</td>
                                        <td>{{$c->price}}</td>
                                        <td>{{$c->mileage}}</td>
                                        <td>
                                            <a class="btn-delete" href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.consumo.delete',$c) }}" data-action="eliminar" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::Soat.Soat') }}</li>
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
                <div class="card-header">
                    <h4>{{trans('hangarauto::Soat.Soat')}}</h3>
                </div><br>
                @include('hangarauto::admin.revisiones.SOAT.create')
                <div class="card">
                    <div class="card-body">
                        <table id="Travel" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <th>#</th>
                                <th>{{trans('hangarauto::Vehiculos.Vehicle') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Responsability') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Review Date') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Expiration Date') }}</th>
                                <th>{{trans('hangarauto::Drivers.Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach($Soat as $s)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$s->vehicle->name}}</td>
                                        <td>{{$s->person->fullname}}</td>
                                        <td>{{$s->review_date}}</td>
                                        <td>{{$s->expiration_date}}</td>
                                        <td>
                                            <a class="btn-delete" href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.soat.delete', $s)}}" data-action="eliminar" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                <i class="fas fa-trash-alt text-danger"></i>
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
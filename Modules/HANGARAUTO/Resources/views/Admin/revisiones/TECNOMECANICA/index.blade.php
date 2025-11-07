@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::Tecno.Tecnomechanic') }}</li>
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
                                <th>{{trans('hangarauto::Vehiculos.Vehicle') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Responsability') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Review Date') }}</th>
                                <th>{{trans('hangarauto::Vehiculos.Expiration Date') }}</th>
                                <th>{{trans('hangarauto::Drivers.Actions') }}</th>
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
                                            <a class="btn btn-primary" href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.tecnomecanica.edit', $t->id) }}" type="button"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-delete" href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.tecnomecanica.delete',$t) }}" data-action="eliminar" data-toggle="tooltip" data-placement="top" title="Eliminar">
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

    

    
@endsection
@extends('bienestar::layouts.master')
@section('content')
<div class="container">
    <div class="container-fluid">
        <h1 class="mb-4">{{ trans('bienestar::menu.Failure Reporting')}} <i class="fas fa-bus-alt"></i></h1>
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-12">
                <div class="card-body">
                <a href="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.transportation.view.transportation_assistance_lists')}}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i></a>
                <hr>
                <a href="{{ route('bienestar.admin.failure_reporting.transportation_assistance_lists.store')}}" class="btn btn-primary">Registrar Fallas</a>                
                    <div class="table-responsive">
                        <table class="table mt-4 table-bordered rounded-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ trans('Documento') }}</th>
                                    <th>{{ trans('bienestar::failure_report.Apprentice') }}</th>
                                    <th>{{ trans('bienestar::failure_report.Code') }}</th>
                                    <th>{{ trans('Numero ruta') }}</th>
                                    <th>{{ trans('Ruta') }}</th>
                                    <th>{{ trans('bienestar::failure_report.Date') }}</th>
                                    <th>{{ trans('bienestar::failure_report.Assistance_Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas de la tabla -->
                                @foreach($resultados as $resultado)
                                    <tr>
                                        <td>{{ $resultado->apprentice->person->document_number }}</td>
                                        <td>{{ $resultado->apprentice->person->fullname }}</td>
                                        <td>{{ $resultado->apprentice->course->program->name}} - {{$resultado->apprentice->course->code }}</td>
                                        <td>{{ $resultado->assigntransportroute->routes_trasportantion->route_number }}</td>
                                        <td>{{ $resultado->assigntransportroute->routes_trasportantion->name_route }}</td>
                                        <td>{{ $resultado->date_time }}</td>
                                        <td>{{ $resultado->assistance_status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
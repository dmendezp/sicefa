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
                <a href="{{ route('cefa.register_failures') }}" class="btn btn-primary" method="get">Registrar Fallas</a>                
                    <div class="table-responsive">
                        <table class="table mt-4 table-bordered rounded-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ trans('bienestar::failure_report.Apprentice') }}</th>
                                    <th>{{ trans('bienestar::failure_report.Code') }}</th>
                                    <th>{{ trans('bienestar::failure_report.Route_number') }}</th>
                                    <th>{{ trans('bienestar::failure_report.Bus_driver_name') }}</th>
                                    <th>{{ trans('bienestar::failure_report.Date') }}</th>
                                    <th>{{ trans('bienestar::failure_report.Assistance_Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas de la tabla -->
                                @foreach($resultados as $resultado)
                                    <tr>
                                        <td>{{ $resultado->apprentice->person->document_number }}</td>
                                        <td>{{ $resultado->apprentice->person->first_name }}</td>
                                        <td>{{ $resultado->apprentice->person->first_last_name }}</td>
                                        <td>{{ $resultado->apprentice->person->second_last_name }}</td>
                                        <td>{{ $resultado->apprentice->course->code }}</td>
                                        <td>{{ $resultado->apprentice->course->program->name }}</td>
                                        <td>{{ $resultado->assingTransportRoute->routeTransportation->route_number }}</td>
                                        <td>{{ $resultado->assingTransportRoute->routeTransportation->name_route }}</td>
                                        <td>{{ $resultado->busDriver->name }}</td>
                                        <td>{{ $resultado->bus->plate }}</td>
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
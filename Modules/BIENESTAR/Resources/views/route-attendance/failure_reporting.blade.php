@extends('bienestar::layouts.master')
@section('content')
<div class="container">
    <div class="container-fluid">
        <h1 class="mb-4">{{ trans('bienestar::menu.Failure Reporting')}} <i class="fas fa-bus-alt"></i></h1>
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-12">
                <div class="card-body">
                <a href="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.transportation.view.transportation_assistance_lists')}}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i></a>                
                    <div class="table-responsive">
                        <table class="table mt-4 table-bordered rounded-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Apprentice</th>
                                    <th>Code</th>
                                    <th>Route Number</th>
                                    <th>Bus Driver Name</th>
                                    <th>Date</th>
                                    <th>Assistance Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas de la tabla -->
                                @foreach($resultados as $key => $resultado)
                                <tr>
                                    <td style="font-weight: bold;">{{ $resultado->first_name }} {{ $resultado->first_last_name }} {{ $resultado->second_last_name }}</td>
                                    <td>{{ $resultado->code }}</td>
                                    <td>{{ $resultado->route_number }} {{ $resultado->name_route }}</td>
                                    <td>{{ $resultado->name }} - {{ $resultado->plate }}</td>
                                    <td>{{ $resultado->date_time }}</td>
                                    <td style="
            background-color: {{ $resultado->assistance_status == 'Falla' ? 'red' : 'inherit' }};
            color: {{ $resultado->assistance_status == 'Falla' ? 'white' : 'inherit' }};
            font-weight: {{ $resultado->assistance_status == 'Falla' ? 'bold' : 'normal' }};
        ">
                                        {{ $resultado->assistance_status }}
                                    </td>
                                </tr>
                                @if ($key < count($resultados) - 1 && $resultado->first_name != $resultados[$key + 1]->first_name)
                                    <tr>
                                        <td colspan="9">
                                            <br>
                                        </td>
                                    </tr>
                                    @endif
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
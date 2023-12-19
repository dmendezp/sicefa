@php
$role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp
@extends('bienestar::layouts.master')

@section('content')
<!-- Main content -->
<div class="container">
    <div class="container-fluid">
        <h1 class="mb-4">{{ trans('bienestar::menu.Transportation Route Assistance')}} <i class="fas fa-bus-alt"></i></h1>
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-8">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="number" name="search" class="form-control" placeholder="{{ trans('bienestar::menu.Enter your document number')}}" id="assitance">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" id="searchButtonassitance"><i class="fas fa-barcode"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($resultados) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ trans('bienestar::menu.Document')}}</th>
                                    <th>{{ trans('bienestar::menu.Apprentice')}}</th>
                                    <th>{{ trans('bienestar::menu.Transportation Route')}}</th>
                                    <th>{{ trans('bienestar::menu.Driver')}}</th>
                                    <th>{{ trans('bienestar::menu.Date')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resultados as $rel)
                                <tr>
                                    <td>{{$rel->document_number}}</td>
                                    <td>{{$rel->first_name}} {{$rel->first_last_name}} {{$rel->second_last_name}}</td>
                                    <td>{{$rel->route_number}} - {{$rel->name_route}}</td>
                                    <td>{{$rel->name}}</td>
                                    <td>{{ date('Y-m-d', strtotime($rel->date_time)) }}</td>                        
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>No hay registros de asistencias el dia de hoy</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on("change", "#assitance", function() {
        performSearch();
    });

    $(document).on("click", "#searchButtonassitance", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        performSearch();
        location.reload();
    });

    function performSearch() {
        var miObjeto = new Object();
        miObjeto = $('#assitance').val();
        var data = JSON.stringify(miObjeto);
        console.log(miObjeto);
        ajaxReplace('divAssitance', '/bienestar/{{ $role_name }}/transportation_asistance/search', data);

    }
</script>
@endsection
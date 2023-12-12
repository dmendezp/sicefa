@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <h1>{{ trans('Registro de Asistencia de Transporte')}} <i class="fas fa-bus"></i></h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-8">
            <div class="card-body">
                <!-- Formulario de filtro -->
                <div class="form-group col-md-7">
                    <label for="Ruta">{{ trans('bienestar::menu.Transportation Route')}}</label>
                    <div class="col-md-7">
                        <select name="name_route" id="name_route" class="form-control" required>
                            <option value="">{{ trans('bienestar::menu.Show All')}}</option>
                            @foreach($rutas as $r)
                            <option value="{{$r->route_number}} {{ $r->name_route}}">{{ $r->name_route}}</option>
                            @endforeach
                            <!-- Agrega más opciones según sea necesario -->
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="fecha_inicio">{{ trans('bienestar::menu.Start Date')}}</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_fin">{{ trans('bienestar::menu.End Date')}}</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
                    </div>
                </div>
            </div>
            <!-- Cuadro con la tabla -->
            <div class="table-responsive">
                <table id="datatable" class="table mt-4" style="width:100%">
                    <thead>
                        <tr>
                            <th>{{ trans('bienestar::menu.Apprentice')}}</th>
                            <th>{{ trans('bienestar::menu.Number Document')}}</th>
                            <th>{{ trans('bienestar::menu.Program')}}</th>
                            <th>{{ trans('bienestar::menu.Code')}}</th>
                            <th>Ruta de transporte</th>
                            <th>{{ trans('bienestar::menu.Date Time')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $R)
                        <tr>
                            <td>{{ $R->first_name }} {{ $R->first_last_name }} {{ $R->second_last_name }}</td>
                            <td>{{ $R->document_number }}</td>
                            <td>{{ $R->program_name }}</td>
                            <td>{{ $R->code }}</td>
                            <td>{{ $R->route_number }} {{ $R->name_route }}</td>
                            <td>{{ $R->date_time }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

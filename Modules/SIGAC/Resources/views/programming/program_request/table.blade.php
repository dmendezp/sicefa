@extends('sigac::layouts.master')

@section('content')

<div class="card card-blue card-outline shadow">
    <div class="card-header">
        <h3 class="card-title">Solicitudes de programas</h3>
        @if(Auth::user()->havePermission('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.program_request.index'))
            <a class="btn btn-outline-success float-right ml-1" href="{{ route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.program_request.index') }}">Solicitar Programa</a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="program_applications" class="display table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Instructor</th>
                        <th class="text-center">Programa</th>
                        <th class="text-center">Horas del Programa</th>
                        <th class="text-center">Programa Especial</th>
                        <th class="text-center">Municipio</th>
                        <th class="text-center">Cupo</th>
                        <th class="text-center">Fecha inicio</th>
                        <th class="text-center">Fecha fin</th>
                        <th class="text-center">Informacion Solicitante</th>
                        <th class="text-center">Programación</th>
                        <th class="text-center">Documentos</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($program_requests as $prom)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $prom->person->full_name }} - 
                                @foreach($prom->person->professions as $p)
                                    {{ $p->name }}
                                @endforeach
                            </td>
                            <td class="text-center">{{ $prom->program->sofia_code }} - {{ $prom->program->version }} - {{ $prom->program->name }}</td>
                            <td class="text-center">{{ $prom->program->maximum_duration }}</td>
                            <td class="text-center">{{ $prom->special_program->name }}</td>
                            <td class="text-center">{{ $prom->municipality->name }} - {{ $prom->municipality->department->name }}</td>
                            <td class="text-center">{{ $prom->quotas }}</td>
                            <td class="text-center">{{ $prom->start_date }}</td>
                            <td class="text-center">{{ $prom->end_date }}</td>
                            <td class="text-center">
                                <a  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#informationproyecto{{$prom->id}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            @include('sigac::programming.program_request.information')
                            <td class="text-center">
                                <a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dates{{$prom->id}}">
                                    <i class="fas fa-calendar"></i>
                                </a>
                            </td>
                            @include('sigac::programming.program_request.dates')
                            <td class="text-center">
                                <a class="btn btn-warning" href="{{ route('sigac.'. getRoleRouteName(Route::currentRouteName()) .'.programming.program_request.program_request_download', ['id' => $prom->id]) }}" target="_blank" style="color: white;">
                                    <i class="fas fa-file-download"></i>
                                </a>  
                            </td>
                            <td class="text-center">
                                @if($prom->state == 'Cancelado')
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#documents{{$prom->id}}"><i class="fas fa-edit"></i></button>
                                <a  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancel{{$prom->id}}" style="margin: 5px;">
                                    <i class="fas fa-eye"></i> Cancelado
                                </a>
                                @include('sigac::programming.program_request.documents')
                                @include('sigac::programming.program_request.devolution')
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#program_applications').DataTable({
        });
    });
</script>
@extends('sigac::layouts.master')

@push('head')
    <style>
        .input-group .input-group-text {
            background: none;
            border-left: none;
        }

    </style>
@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12"> {{-- Inicio competencia --}}
                <div class="card card-blue card-outline shadow">
                    <div class="card-header">
                        <h3 class="card-title">Actividades externas</h3>
                        <a class="btn btn-outline-success float-right ml-1" href="{{ route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.external_activities.external_activities_create') }}">Solicitar actividad</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Encargado</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Desde - Hasta</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($external_activities as $activity_name => $group) <!-- Agrupado por nombre de actividad -->
                                        @php
                                            foreach ($group as $programming) {
                                                $ids = $programming->id;
                                            }
                                        @endphp
                                        <tr>                            
                                            <td class="text-center">{{ $group->first()->activity_description }}</td>
                                            <td class="text-center">
                                                @foreach($group->first()->instructor_program_people as $p)
                                                    {{ $p->person->full_name }} <!-- Ajustar según si hay varios nombres -->
                                                @endforeach
                                            </td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($group->first()->date)->format('d-m-Y') }}</td>  
                                            <td class="text-center">{{ $group->first()->start_time . ' - ' . $group->first()->end_time }}</td>                          
                                            <td class="text-center">
                                                <a  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#info{{$programming->id}}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if(checkRol('sigac.academic_coordinator'))
                                                    <a  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approve{{$programming->id}}">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                    <a  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancel{{$programming->id}}">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            @include('sigac::programming.external_activities.info') 
                                            @include('sigac::programming.external_activities.approve')
                                            @include('sigac::programming.external_activities.cancel')
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
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12"> {{-- Inicio Trimestralización --}}
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Solicitudes | Caracterización</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive">
                                    <table id="training_project" class="display table table-bordered table-striped table-sm">
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
                                            @foreach($program_request as $prom)
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
                                                    @if($prom->state == 'Pendiente')
                                                        <td width="19%">
                                                            <a  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#characterization{{$prom->id}}">
                                                                Caracterizar
                                                            </a>
                                                            <a  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#devolution{{$prom->id}}">
                                                                Devolver
                                                            </a>
                                                        </td>
                                                    @elseif($prom->state == 'Cancelado')
                                                        <td class="text-center">
                                                            <a  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancel{{$prom->id}}">
                                                                <i class="fas fa-eye"></i> Cancelado
                                                            </a>
                                                        </td>
                                                    @else
                                                        <td class="text-center">
                                                            <a  class="btn btn-secondary">
                                                                Caracterizado
                                                            </a>
                                                        </td>
                                                    @endif

                                                    @include('sigac::programming.program_request.confirmation')
                                                    @include('sigac::programming.program_request.devolution')
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- Fin Caracterización --}}
            </div>
        </div>
    </div>

    @endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#quarterlies').DataTable({
        });
        
    });

    function mayus(e) {
        /* Convert the content of a field to uppercase */
        e.value = e.value.toUpperCase();
    }
</script>
<script>
    $(document).ready(function() {
        $('#training_project').DataTable({
        });
            $('.delete-training_project').on('click', function(event) {
            var trainingproject_id = $(this).data('trainingproject-id');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-trainingproject-form-' + trainingproject_id).submit();
                }
            });
        });
    });
    
</script>


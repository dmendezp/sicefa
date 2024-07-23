@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12"> {{-- Inicio competencia --}}
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Competencias - {{ $nameprogram }}</h3>
                            <div class="btns">
                                <a href="{{ route('sigac.academic_coordination.programming.parameters.index') }}"class="btn btn-primary float-right ml-1">
                                    <i class="fa-solid fa-angles-left fa-beat-fade"></i>
                                    Programas
                                </a>
                                <a class="btn btn-outline-secondary float-right ml-1" href="{{ route('sigac.academic_coordination.programming.learning_outcome.load.create', ['program_id' => $program_id]) }}">Cargar Resultados</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="programs" class="display table  table-striped ">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Codigo</th>
                                            <th class="text-center">Tiempo ejecucion (Meses)</th>
                                            <th class="text-center">Tipo</th>
                                            <th class="text-center">Resultados</th>
                                            <th class="text-center ">
                                                <a data-toggle="modal" data-target="#addCompetence" onclick="">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($competencies as $c)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $c->name }}</td>
                                                <td class="text-center">{{ $c->code }}</td>
                                                <td class="text-center">{{ $c->hour }}</td>
                                                <td class="text-center">{{ $c->type }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary" href="{{ route('sigac.academic_coordination.programming.learning_outcome.index', ['competencie_id' => $c->id , 'program_id' => $program_id]) }}">
                                                        <i class="fa-solid fa-outdent"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center col-1">
                                                    <div class="opts">
                                                        <a  data-bs-toggle="modal" data-bs-target="#editCompetence{{$c->id}}">
                                                            <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Competencia">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                    
                                                        <a class="delete-competence" data-competence-id="{{ $c->id }}">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </b>
                                                        </a>
                                                    </div>
                                                </td>
                                                @include('sigac::programming.parameters.competences.edit')
                                                <form id="delete-competence-form-{{ $c->id }}"
                                                    action="{{ route('sigac.academic_coordination.programming.competence.destroy', ['id' => $c->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> {{-- Fin competencia --}}
            </div>
        </div>
    </div>
@include('sigac::programming.parameters.competences.create')
@endsection

<script>
    $(document).ready(function() {
        $('.delete-competence').on('click', function(event) {
            var competence_id = $(this).data('competence-id');
                console.log(competence_id); // Your value from
            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '¿Estas seguro?',
                text: 'Esta accion no se puede remover',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-competence-form-' + competence_id).submit();
                }
            });
        });
    });
</script>



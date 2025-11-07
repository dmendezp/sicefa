@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12"> {{-- Inicio competencia --}}
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Resultados de Aprendizaje - Competencia:  {{ $namecompetencie }}</h3>
                            <div class="btns">
                                <a href="{{ route('sigac.academic_coordination.programming.competence.index', ['program_id' => $program_id]) }}"class="btn btn-primary float-right ml-1">
                                    <i class="fa-solid fa-angles-left fa-beat-fade"></i>
                                    Competencias
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="learning_customes" class="display table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Horas</th>
                                            <th class="text-center">
                                                <a data-toggle="modal" data-target="#addLearning_outcome" onclick="">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($learning_outcomes as $l)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $l->name }}</td>
                                            <td class="text-center">{{ $l->hour }}</td>
                                            <td class="text-center col-1">
                                                <div class="opts">
                                                    <a data-bs-toggle="modal" data-bs-target="#editResult{{$l->id}}">
                                                        <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Resultado de Aprendizaje">
                                                            <i class="fas fa-edit"></i>
                                                        </b>
                                                    </a>
                                                    <a class="delete-learning" data-learning-id="{{ $l->id }}">
                                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Resultado de Aprendizaje">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </b>
                                                    </a>
                                                </div>
                                            </td>
                                            @include('sigac::programming.parameters.learning_outcomes.edit')
                                            <form id="delete-learning-form-{{ $l->id }}"
                                                action="{{ route('sigac.academic_coordination.programming.learning_outcome.destroy', ['id' => $l->id]) }}"
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
    @include('sigac::programming.parameters.learning_outcomes.create')
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        // Evento para eliminar un registro
        $('.delete-learning').on('click', function(event) {
            var learning_id = $(this).data('learning-id');
            console.log(learning_id); // Valor del ID
            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede revertir',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-learning-form-' + learning_id).submit();
                }
            });
        });
    });

</script>
@endpush
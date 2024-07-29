<div>
    <div class="table-responsive">
        <table id="training_project" class="display table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center">Titulada</th>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">{{ trans('sigac::general.T_Name')}}</th>
                    <th class="text-center">Tiempo de ejecucion (Meses)</th>
                    <th class="text-center">Total de resultados</th>
                    <th class="text-center">Objetivo</th>
                    <th class="text-center">Trimestralizacion</th>
                    <th class="text-center">Cargar Trimestralizacion</th>
                    <th class="text-center">
                        <a data-bs-toggle="modal" data-bs-target="#crearproyecto">
                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                <i class="fas fa-plus-circle"></i>
                            </b>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($coursesWithTrainingProjects as $course)
                    @foreach($course->training_projects as $t)
                        <tr>
                            <td class="text-center">{{ $course->program->name }} - {{ $course->code }}</td>
                            <td class="text-center">{{ $t->code }}</td>
                            <td class="text-center">{{ $t->name }}</td>
                            <td class="text-center">{{ $t->execution_time }}</td>
                            <td class="text-center">{{ $counts[$t->id] ?? 0 }} de {{ $course->program->competencies->flatMap(function ($competency) {
                                return $competency->learning_outcomes;
                            })->count() }}
                            </td>
                            <td class="text-center">
                                <a  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#informationproyecto{{$t->id}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-primary" href="{{ route('sigac.academic_coordination.curriculum_planning.training_project.quarterlie.index', ['training_project_id' => $t->id, 'course_id' => $course->id]) }}">
                                    <i class="fa-solid fa-outdent"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-outline-secondary" href="{{ route('sigac.academic_coordination.curriculum_planning.quarterlie.load.create', ['course_id' => $course->id ,'training_project_id' => $t->id]) }}">Cargar Trimestralización</a>
                            </td>
                            <td class="text-center col-1">
                                <div class="opts">
                                    <a  data-bs-toggle="modal" data-bs-target="#editproyecto{{$t->id}}">
                                        <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Proyecto Formativo">
                                            <i class="fas fa-edit"></i>
                                        </b>
                                    </a>
                                    @include('sigac::curriculum_planning.training_project.information')
                                    @include('sigac::curriculum_planning.training_project.edit')
                                    <a class="delete-training_project"  data-trainingproject-id="{{ $t->id }}">
                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Proyecto Formativo">
                                            <i class="fas fa-trash-alt"></i>
                                        </b>
                                    </a>
                                </div>
                            </td>
                            <form id="delete-trainingproject-form-{{ $t->id }}"
                                action="{{ route('sigac.academic_coordination.curriculum_planning.training_project.destroy', ['id' => $t->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tr>
                    @endforeach
                @endforeach
                @include('sigac::curriculum_planning.training_project.create')
            </tbody>
        </table>
    </div>
</div>

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
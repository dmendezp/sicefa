@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form action="{{ route('sigac.academic_coordination.curriculum_planning.course_trainig_project.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('training_project', trans('sigac::learning_out_come.TrainingProject')) !!}
                                        {!! Form::select('training_project', $training_project_select, old('training_project'), ['class' => 'form-control training_project_select', 'required']) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('course', trans('sigac::learning_out_come.Courses')) !!}
                                        {!! Form::select('course', $courses, old('course'), ['class' => 'form-control course', 'required' ]) !!}                                    
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">{{ trans('sigac::profession.Add')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div id="training_projects">
                                    @include('sigac::curriculum_planning.course_training_project.table')
                                </div>
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
        $('#training_projecttable').DataTable({
        });
    });
</script>

<script>
    function confirmDelete(event) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡No podrás revertir esto!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Evitar que el formulario se envíe automáticamente
                    event.preventDefault();
                    
                    // Enviar el formulario manualmente
                    event.target.closest('form').submit();
                }
            });
        }
    $(document).ready(function() {
        
        $('.course').select2();
        $('.training_project_select').select2();
        $('.delete-course_training_projects').on('click', function(event) {
            var profession_program_id = $(this).data('course_training_projects-id');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '{{trans('sigac::profession.You_Sure')}}',
                text: '{{trans('sigac::profession.This_Action_Can_Undone')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{trans('sigac::profession.Yes_Delete')}}'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-course_training_projects-form-' + profession_program_id).submit();
                }
            });
        });
        $('.training_project_select').on('change', function () {
            var training_project = $(this).val();

            
            $.ajax({
                type: 'POST',
                url: "{{ route('sigac.academic_coordination.curriculum_planning.course_trainig_project.table') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    training_project: training_project
                },
                success: function(data) {
                    // Actualizar el contenedor con los resultados filtrados
                    $('#training_projects').html(data);
                    $('#training_projecttable').DataTable({
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
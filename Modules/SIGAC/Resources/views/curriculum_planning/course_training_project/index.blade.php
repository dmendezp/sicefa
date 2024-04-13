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
                                <form action="{{ route('sigac.academic_coordination.course_trainig_project.course_trainig_project.course_training_project_store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('course', trans('sigac::learning_out_come.Courses')) !!}
                                        {!! Form::select('course', $courses, old('course'), ['class' => 'form-control course'],) !!}                                    
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('training_project', trans('sigac::learning_out_come.TrainingProject')) !!}
                                        {!! Form::select('training_project', $training_projects, old('training_project'), ['class' => 'form-control training_project'],) !!}                                         
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">{{ trans('sigac::profession.Add')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table id="personProfession" class="display table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{ trans('sigac::learning_out_come.Courses') }}</th>
                                                <th class="text-center">{{ trans('sigac::learning_out_come.TrainingProject') }}</th>
                                                <th class="text-center">{{ trans('sigac::profession.Actions')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($course_training_projects as $c)
                                            @php
                                                $courses = \Modules\SICA\Entities\Course::all();
                                                
                                                $course = $courses->where('id', $c->course_id)->first();
                                                $training_project = DB::table('training_projects')->where('id', $c->training_project_id)->first();
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $course->code_name }}</td>
                                                <td class="text-center">{{ $training_project->name }}</td>
                                                <td class="text-center">
                                                    <a class="delete-course_training_projects" data-course_training_projects-id="{{ $c->id }}">
                                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('sigac::profession.Eliminate')}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </b>
                                                    </a>
                                                </td>
                                                <form id="delete-course_training_projects-form-{{ $c->id }}"
                                                    action="{{ route('sigac.academic_coordination.course_trainig_project.course_trainig_project.course_training_project_destroy', ['id' => $c->id]) }}"
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#personProfession').DataTable({
            columnDefs: [
                { orderable: false, targets: 2 }
            ]
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.course').select2();
        $('.training_project').select2();
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
    });
</script>
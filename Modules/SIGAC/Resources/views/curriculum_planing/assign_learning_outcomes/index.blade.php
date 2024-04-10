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
                                @isset($assign)
                                    <form action="{{ route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.learning_out_people_update', $assign->first()->id) }}" method="post">
                                @else
                                    <form action="{{ route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.learning_out_people_store') }}" method="post">
                                @endisset
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('instructor', trans('sigac::learning_out_come.Instructor')) !!}
                                        {!! Form::select('instructor', $instructors, isset($assign) ? $assign->first()->person_id : old('instructor'), ['class' => 'form-control instructor'],) !!}                                    
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('learningOutCome', trans('sigac::learning_out_come.LearningOutComes')) !!}
                                        {!! Form::select('learningOutCome', $learningOutComes,  isset($assign) ? $assign->first()->learning_outcome_id : old('learningOutCome'), ['class' => 'form-control learningOutCome'],) !!}                                         
                                    </div>
                                    <div class="text-center">
                                        @isset ($assign)
                                            <a href="{{ route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.learning_out_people_index') }}" class="btn btn-secondary">{{ trans('sigac::learning_out_come.Cancel')}}</a>
                                            <button type="submit" class="btn btn-success">{{ trans('sigac::learning_out_come.Update')}}</button>
                                        @else
                                            <button type="reset" class="btn btn-secondary">{{ trans('sigac::learning_out_come.Cancel')}}</button>
                                            <button type="submit" class="btn btn-success">{{ trans('sigac::learning_out_come.Add')}}</button>
                                        @endisset
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table id="learningoutcomeperson" class="display table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{ trans('sigac::learning_out_come.Instructor')}}</th>
                                                <th class="text-center">{{ trans('sigac::learning_out_come.LearningOutComes')}}</th>
                                                <th class="text-center">{{ trans('sigac::learning_out_come.Actions')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($learningOutcomePeople as $l)
                                            @php
                                                $person = DB::table('people')->where('id', $l->person_id)->first();
                                                $learning_outcomes = DB::table('learning_outcomes')->where('id', $l->learning_outcome_id)->first();
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $person->first_name . ' ' . $person->first_last_name . ' ' . $person->second_last_name }}</td>
                                                <td class="text-center">{{ $learning_outcomes->name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.learning_out_people_edit', $l->id) }}" class="mr-1" data-toggle='tooltip' data-placement="top" title="{{ trans('sigac::learning_out_come.Edit')}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <a class="delete-learning_outcomes_person" data-learning_outcomes_person-id="{{ $l->id }}">
                                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('sigac::learning_out_come.Eliminate')}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </b>
                                                    </a>
                                                </td>
                                                <form id="delete-learning_outcomes_person-form-{{ $l->id }}"
                                                    action="{{ route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.learning_out_people_destroy', ['id' => $l->id]) }}"
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
        $('#learningoutcomeperson').DataTable({
            columnDefs: [
                { orderable: false, targets: 2 }
            ]
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.instructor').select2();
        $('.learningOutCome').select2();
        $('.delete-learning_outcomes_person').on('click', function(event) {
            var profession_program_id = $(this).data('learning_outcomes_person-id');

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
                    document.getElementById('delete-learning_outcomes_person-form-' + profession_program_id).submit();
                }
            });
        });
    });
</script>
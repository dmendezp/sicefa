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
                                <form action="{{ route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.learning_out_people_store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('program', trans('sigac::learning_out_come.Programs')) !!}
                                        {!! Form::select('program', $programs, old('program'), ['class' => 'form-control program'],) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('competencie', trans('sigac::learning_out_come.Competencies')) !!}
                                        {!! Form::select('competencie', [], old('competencie'), ['class' => 'form-control competencie', 'placeholder' => trans('sigac::learning_out_come.SelectCompetition')]) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('learningOutCome', trans('sigac::learning_out_come.LearningOutComes')) !!}
                                        {!! Form::select('learningOutCome', [], old('learningOutCome'), ['class' => 'form-control learningOutCome', 'placeholder' => trans('sigac::learning_out_come.SelectLearningOutcome')]) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('instructor', trans('sigac::learning_out_come.Instructor')) !!}
                                        {!! Form::select('instructor', [], old('instructor'), ['class' => 'form-control instructor', 'placeholder' => trans('sigac::learning_out_come.SelectInstructor')],) !!}                                    
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">{{ trans('sigac::learning_out_come.Add')}}</button>
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
                                                    <a class="delete-learning_outcomes_person" data-learning_outcomes_person-id="{{ $l->id }}">
                                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('sigac::learning_out_come.Eliminate')}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </b>
                                                    </a>
                                                </td>
                                                <form id="delete-learning_outcomes_person-form-{{ $l->id }}"
                                                    action="{{ route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.learning_out_people_destroy', ['id' => $l->id]) }}"
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
        $('.program').select2();
        $('.competencie').select2();
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
<script>
    // Buscar competencias segun el programa seleccionado
    $(document).ready(function() {
        $('.program').on('change', function () {
            var selectedProgram = $(this).val();
            var url = {!! json_encode(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.learning_out_people_search_competencie', ['id' => ':id'])) !!}.replace(':id', selectedProgram.toString());
            // Realizar una solicitud AJAX para obtener los aspectos ambientales
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectCompetition") }}' + '</option>';
                        $.each(response.competencies, function (index, competencies) {
                            options += '<option value="' + competencies.id + '">' + competencies.name + '</option>';
                        });
                        // Actualizar las opciones del campo de aspecto ambiental actual
                        $('.competencie').last().html(options);
                },
                error: function (error) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectCompetition") }}' + '</option>';
                    $('.competencie').last().html(options);
                    console.log(error);
                }
            });
        });
    });  

    // Buscar resultados de aprendizaje segun la competencia seleccionada
    $(document).ready(function() {
        $('.competencie').on('change', function () {
            var selectedCompetencie = $(this).val();
            var url = {!! json_encode(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.learning_out_people_search_learning_outcome', ['id' => ':id'])) !!}.replace(':id', selectedCompetencie.toString());
            // Realizar una solicitud AJAX para obtener los aspectos ambientales
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectLearningOutcome") }}' + '</option>';
                        $.each(response.learning_outcomes, function (index, learning_outcomes) {
                            options += '<option value="' + learning_outcomes.id + '">' + learning_outcomes.name + '</option>';
                        });
                        // Actualizar las opciones del campo de aspecto ambiental actual
                        $('.learningOutCome').last().html(options);
                },
                error: function (error) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectLearningOutcome") }}' + '</option>';
                    $('.learningOutCome').last().html(options);
                    console.log(error);
                }
            });
        });
    });  

    //Buscar instructor segun la profesion de la competencida del resultado de aprendizaje seleccionado
    $(document).ready(function() {
        $('.learningOutCome').on('change', function () {
            var selectedLearningOutCome = $(this).val();
            var url = {!! json_encode(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.learning_out_people_search_instructor', ['id' => ':id'])) !!}.replace(':id', selectedLearningOutCome.toString());

            // Realizar una solicitud AJAX para obtener los aspectos ambientales
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectInstructor") }}' + '</option>';
                        $.each(response.instructors, function (index, instructors) {
                            options += '<option value="' + instructors.id + '">' + instructors.name + '</option>';
                        });
                        // Actualizar las opciones del campo de aspecto ambiental actual
                        $('.instructor').last().html(options);
                },
                error: function (error) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectInstructor") }}' + '</option>';
                    $('.instructors').last().html(options);
                    console.log(error);
                }
            });
        });
    });  
</script>
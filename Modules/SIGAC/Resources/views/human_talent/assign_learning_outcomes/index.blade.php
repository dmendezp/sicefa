@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Asignación de Resultados de Aprendizaje</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form id="learningOutPeopleForm" action="{{ route('sigac.academic_coordination.human_talent.assign_learning_outcomes.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('program', trans('sigac::learning_out_come.Programs')) !!}
                                        {!! Form::select('program', $programs, old('program'), ['class' => 'form-control program', 'required']) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('competencie', trans('sigac::learning_out_come.Competencies')) !!}
                                        {!! Form::select('competencie', [], old('competencie'), ['class' => 'form-control competencie', 'required', 'placeholder' => trans('sigac::learning_out_come.SelectCompetition')]) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('learningOutCome', trans('sigac::learning_out_come.LearningOutComes')) !!}
                                        {!! Form::select('learningOutCome', [], old('learningOutCome'), ['class' => 'form-control learningOutCome', 'required', 'placeholder' => trans('sigac::learning_out_come.SelectLearningOutcome')]) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('instructor', trans('sigac::learning_out_come.Instructor')) !!}
                                        {!! Form::select('instructor', [], old('instructor'), ['class' => 'form-control instructor', 'required', 'placeholder' => trans('sigac::learning_out_come.SelectInstructor')]) !!}                                    
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('priority', trans('Prioridad')) !!}
                                        {!! Form::select('priority', ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'], old('priority'), ['class' => 'form-control', 'placeholder' => trans('Seleccione la prioridad'), 'required']) !!}
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">{{ trans('sigac::learning_out_come.Add') }}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div id="instructors">
                                    @include('sigac::human_talent.assign_learning_outcomes.table')
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
        $('#assign_learning').DataTable({
            columnDefs: [
                { orderable: false, targets: 2 }
            ]
        });

        $('.program').select2();
        $('.competencie').select2();
        $('.learningOutCome').select2();
        $('.instructor').select2();

        // Enviar el formulario por AJAX
        $('#learningOutPeopleForm').on('submit', function(e) {
            e.preventDefault(); // Evita el envío del formulario

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire(
                        '¡Hecho!',
                        'El registro se ha guardado correctamente.',
                        'success'
                    );
                    // Actualizar la tabla después del registro
                    updateInstructorsTable();
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error',
                        'Hubo un problema al guardar el registro.',
                        'error'
                    );
                }
            });
        });

        // Actualizar la tabla
        function updateInstructorsTable() {
            var selectedCompetencie = $('.competencie').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('sigac.academic_coordination.human_talent.assign_learning_outcomes.table') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    selectedCompetencie: selectedCompetencie
                },
                success: function(data) {
                    $('#instructors').html(data);
                    $('#assign_learning').DataTable({
                        columnDefs: [
                            { orderable: false, targets: 2 }
                        ]
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        $('.program').on('change', function() {
            var selectedProgram = $(this).val();
            var url = {!! json_encode(route('sigac.academic_coordination.human_talent.assign_learning_outcomes.search_competencie', ['id' => ':id'])) !!}.replace(':id', selectedProgram.toString());

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectCompetition") }}' + '</option>';
                    $.each(response.competencies, function(index, competencie) {
                        options += '<option value="' + competencie.id + '">' + competencie.name + '</option>';
                    });
                    $('.competencie').html(options);
                },
                error: function(error) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectCompetition") }}' + '</option>';
                    $('.competencie').html(options);
                    console.log(error);
                }
            });
        });

        $('.competencie').on('change', function() {
            var selectedCompetencie = $(this).val();
            var url = {!! json_encode(route('sigac.academic_coordination.human_talent.assign_learning_outcomes.search_learning_outcome', ['id' => ':id'])) !!}.replace(':id', selectedCompetencie.toString());

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectLearningOutcome") }}' + '</option>';
                    $.each(response.learning_outcomes, function(index, learning_outcome) {
                        options += '<option value="' + learning_outcome.id + '">' + learning_outcome.name + '</option>';
                    });
                    $('.learningOutCome').html(options);
                },
                error: function(error) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectLearningOutcome") }}' + '</option>';
                    $('.learningOutCome').html(options);
                    console.log(error);
                }
            });

            updateInstructorsTable();
        });

        $('.learningOutCome').on('change', function() {
            var selectedLearningOutCome = $(this).val();
            var url = {!! json_encode(route('sigac.academic_coordination.human_talent.assign_learning_outcomes.search_instructor', ['id' => ':id'])) !!}.replace(':id', selectedLearningOutCome.toString());

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectInstructor") }}' + '</option>';
                    $.each(response.instructors, function(index, instructor) {
                        options += '<option value="' + instructor.id + '">' + instructor.name + '</option>';
                    });
                    $('.instructor').html(options);
                },
                error: function(error) {
                    var options = '<option value="">' + '{{ trans("sigac::learning_out_come.SelectInstructor") }}' + '</option>';
                    $('.instructor').html(options);
                    console.log(error);
                }
            });
        });
    });
</script>

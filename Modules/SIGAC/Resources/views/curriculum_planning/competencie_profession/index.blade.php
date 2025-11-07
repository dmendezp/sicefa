@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Competencias x Profesión</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form id="competencieProfessionForm" action="{{ route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('program',  trans('sigac::profession.Programs')) !!}
                                        {!! Form::select('program', $programs,  old('program'), ['class' => 'form-control program', 'required' ,],) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('competencie', trans('sigac::profession.Competencies')) !!}
                                        {!! Form::select('competencie', [],  old('competencie'), ['class' => 'form-control competencie', 'required' ,'placeholder' =>  trans('sigac::profession.SelectCompetition')],) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('profession',  trans('sigac::profession.Professions')) !!}
                                        {!! Form::select('profession', $professions, old('profession'), ['class' => 'form-control profession', 'required' ,],) !!}                                    
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">{{ trans('sigac::profession.Add')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div id="professions">
                                    @include('sigac::curriculum_planning.competencie_profession.table')
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
        $('#professionxprogram').DataTable({
            columnDefs: [
                { orderable: false, targets: 2 }
            ]
        });
        $('.profession').select2();
        $('.program').select2();
        $('.competencie').select2();

        // Enviar el formulario por AJAX
        $('#competencieProfessionForm').on('submit', function(e) {
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
                    // Actualizar la tabla de profesiones después del registro
                    updateProfessionsTable();
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

        // Actualizar la tabla de profesiones
        function updateProfessionsTable() {
            var selectedProgram = $('.program').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession.table') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    selectedProgram: selectedProgram
                },
                success: function(data) {
                    $('#professions').html(data);
                    $('#professionxprogram').DataTable({
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

        $('.program').on('change', function () {
            var selectedProgram = $(this).val();
            var url = {!! json_encode(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_search', ['id' => ':id'])) !!}.replace(':id', selectedProgram.toString());

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    var options = '<option value="">' + '{{ trans("sigac::profession.SelectCompetition") }}' + '</option>';
                    $.each(response.competencie, function (index, competencie) {
                        options += '<option value="' + competencie.id + '">' + competencie.name + '</option>';
                    });
                    $('.competencie').html(options);
                },
                error: function (error) {
                    var options = '<option value="">' + '{{ trans("sigac::profession.SelectCompetition") }}' + '</option>';
                    $('.competencie').html(options);
                    console.log(error);
                }
            });

            updateProfessionsTable();
        });
    });
</script>

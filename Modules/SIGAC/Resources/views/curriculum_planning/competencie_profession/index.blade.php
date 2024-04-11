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
                                <form action="{{ route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('profession',  trans('sigac::profession.Professions')) !!}
                                        {!! Form::select('profession', $professions, old('profession'), ['class' => 'form-control profession'],) !!}                                    
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('program',  trans('sigac::profession.Programs')) !!}
                                        {!! Form::select('program', $programs,  old('program'), ['class' => 'form-control program'],) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('competencie', trans('sigac::profession.Competencies')) !!}
                                        {!! Form::select('competencie', [],  old('competencie'), ['class' => 'form-control competencie', 'placeholder' =>  trans('sigac::profession.SelectCompetition')],) !!}                                         
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">{{ trans('sigac::profession.Add')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table id="professionxprogram" class="display table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{ trans('sigac::profession.Competencies')}}</th>
                                                <th class="text-center">{{ trans('sigac::profession.Profession')}}</th>
                                                <th class="text-center">{{ trans('sigac::profession.Actions')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($competencieProfession as $c)
                                            @php
                                                $profession = DB::table('professions')->where('id', $c->profession_id)->first();
                                                $competencies = DB::table('competencies')->where('id', $c->competencie_id)->first();
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $competencies->name }}</td>
                                                <td class="text-center">{{ $profession->name }}</td>
                                                <td class="text-center">
                                                    <a class="delete-competencie_profession" data-professionprogram-id="{{ $c->id }}">
                                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('sigac::profession.Eliminate')}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </b>
                                                    </a>

                                                </td>
                                                <form id="delete-professionprogram-form-{{ $c->id }}"
                                                    action="{{ route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_destroy', ['id' => $c->id]) }}"
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
        $('#professionxprogram').DataTable({
            columnDefs: [
                { orderable: false, targets: 2 }
            ]
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.profession').select2();
        $('.program').select2();
        $('.competencie').select2();
        $('.delete-competencie_profession').on('click', function(event) {
            var competencie_profession_id = $(this).data('professionprogram-id');

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
                    document.getElementById('delete-professionprogram-form-' + competencie_profession_id).submit();
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.program').on('change', function () {
            var selectedProgram = $(this).val();
            var url = {!! json_encode(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_search', ['id' => ':id'])) !!}.replace(':id', selectedProgram.toString());

            // Realizar una solicitud AJAX para obtener los aspectos ambientales
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    var options = '<option value="">' + '{{ trans("sigac::profession.SelectCompetition") }}' + '</option>';
                        $.each(response.competencie, function (index, competencie) {
                            options += '<option value="' + competencie.id + '">' + competencie.name + '</option>';
                        });
                        // Actualizar las opciones del campo de aspecto ambiental actual
                        $('.competencie').last().html(options);
                },
                error: function (error) {
                    var options = '<option value="">' + '{{ trans("sigac::profession.SelectCompetition") }}' + '</option>';
                    $('.competencie').last().html(options);
                    console.log(error);
                }
            });
        });
    });  
</script>
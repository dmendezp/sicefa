@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12"> {{-- Inicio Trimestralización --}}
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Resultado de aprendizaje por clase de ambiente</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 pr-3 pb-3">
                                    <form
                                        action="{{ route('sigac.academic_coordination.curriculum_planning.learning_class_store') }}"
                                        method="post">
                                        @csrf
                                        <div class="form-group">
                                            {!! Form::label('learning_outcome_id', 'Resultado de aprendizaje') !!}
                                            {!! Form::select('learning_outcome_id', $learningOut, old('learning_outcome_id'), [
                                                'class' => 'form-control learning',
                                            ]) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('class_environment_id', 'Clase de ambiente') !!}
                                            {!! Form::select('class_environment_id', $ClassEnvi, old('class_environment_id'), [
                                                'class' => 'form-control class',
                                            ]) !!}
                                        </div>

                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-success">{{ trans('sigac::profession.Add') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table id="resultClass" class="display table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Resultado de aprendizaje</th>
                                                    <th class="text-center">Clase de ambiente</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($class_environment_learning_outcome as $cl)
                                                    @php
                                                        $result = DB::table('learning_outcomes')
                                                            ->where('id', $cl->learning_outcome_id)
                                                            ->first();
                                                        $class = DB::table('class_environments')
                                                            ->where('id', $cl->class_environment_id)
                                                            ->first();
                                                    @endphp
                                                    <tr>
                                                        <td class="text-center">{{ $result->name }}</td>
                                                        <td class="text-center">{{ $class->name }}</td>
                                                        <td class="text-center">
                                                            <a class="delete-result_class"
                                                                data-result_class-id="{{ $cl->id }}">
                                                                <b class="text-danger" data-toggle="tooltip"
                                                                    data-placement="top" title="Eliminar">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </b>
                                                            </a>
                                                        </td>
                                                        <form id="delete-result_class-form-{{ $cl->id }}"
                                                            action="{{route('sigac.academic_coordination.curriculum_planning.learning_class_destroy', ['id' => $cl->id]) }}"
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
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#resultClass').DataTable({
            columnDefs: [{
                orderable: false,
                targets: 2
            }]
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.learning').select2();
        $('.class').select2();
        $('.delete-result_class').on('click', function(event) {
            var result_class_id = $(this).data('result_class-id');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '{{ trans('sigac::profession.You_Sure') }}',
                text: '{{ trans('sigac::profession.This_Action_Can_Undone') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{ trans('sigac::profession.Yes_Delete') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-result_class-form-' + result_class_id)
                        .submit();
                }
            });
        });
    });
</script>

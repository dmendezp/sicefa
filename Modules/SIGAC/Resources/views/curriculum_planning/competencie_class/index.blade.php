@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12"> {{-- Inicio Trimestralización --}}
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Competencia por clase de ambiente</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 pr-3 pb-3">
                                    <form
                                        action="{{ route('sigac.academic_coordination.curriculum_planning.competencie_class.store') }}"
                                        method="post">
                                        @csrf
                                        <div class="form-group">
                                            {!! Form::label('competencie_id', 'Competencia') !!}
                                            {!! Form::select('competencie_id', $competencieselect, old('competencie_id'), [
                                                'class' => 'form-control competencie',
                                                'required'
                                            ]) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('class_environment_id', 'Clase de ambiente') !!}
                                            {!! Form::select('class_environment_id', $ClassEnvi, old('class_environment_id'), [
                                                'class' => 'form-control class',
                                                'required'
                                            ]) !!}
                                        </div>

                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-success">{{ trans('sigac::profession.Add') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <div>
                                        @include('sigac::curriculum_planning.competencie_class.table')
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
        $('#class_environment').DataTable({
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
        $('.competencie').select2();
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

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
                                <form action="{{ route('sigac.academic_coordination.human_talent.assign_learning_outcomes.learning_out_people_store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('program', trans('sigac::learning_out_come.Programs')) !!}
                                        {!! Form::select('program', $programs, old('program'), ['class' => 'form-control program', 'required' ,]) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('competencie', trans('sigac::learning_out_come.Competencies')) !!}
                                        {!! Form::select('competencie', [], old('competencie'), ['class' => 'form-control competencie', 'required' ,'placeholder' => trans('sigac::learning_out_come.SelectCompetition')]) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('learningOutCome', trans('sigac::learning_out_come.LearningOutComes')) !!}
                                        {!! Form::select('learningOutCome', [], old('learningOutCome'), ['class' => 'form-control learningOutCome','required' , 'placeholder' => trans('sigac::learning_out_come.SelectLearningOutcome')]) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('instructor', trans('sigac::learning_out_come.Instructor')) !!}
                                        {!! Form::select('instructor', [], old('instructor'), ['class' => 'form-control instructor','required' , 'placeholder' => trans('sigac::learning_out_come.SelectInstructor')],) !!}                                    
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('priority', trans('sigac::learning_out_come.Instructor')) !!}
                                        {!! Form::select('priority', ['1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5'], null, [
                                            'id' => 'priority',
                                            'class' => 'form-control',
                                            'placeholder' => trans('Seleccione la prioridad'),
                                            'required',
                                        ]) !!}
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">{{ trans('sigac::learning_out_come.Add')}}</button>
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
        $('.program').select2();
        $('.competencie').select2();
        $('.instructor').select2();
        $('.learningOutCome').select2();
    });
</script>

@extends('sigac::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.committee.answer.store', 'method' => 'POST']) !!}
                @csrf
                {!! Form::hidden('evaluation_committee_id', $evaluation_committee_id) !!}
                <div class="form-group">
                    {!! Form::label('type', trans('Tipo de Respuesta')) !!}
                    {!! Form::select('type', ['Plan de Mejoramiento' => 'Plan de Mejoramiento','Respuesta' => 'Respuesta' ], 'Seleccione un tipo', [
                        'class' => 'form-control',
                        'id' => 'type',
                        'placeholder' => 'Seleccione un tipo',
                        'required'
                    ]) !!}
                </div>
                <div class="answer">
                    <div class="form-group">
                        {!! Form::label('answer', trans('Respuesta')) !!}
                        {!! Form::textarea('answer', old('answer'), [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese la respuesta',
                            'style' => 'max-height: 100px;',
                        ]) !!}
                    </div>
                </div>
                <div class="plan">
                    <div class="form-group">
                        {!! Form::label('instructor', trans('Instructor')) !!}
                        {!! Form::select('instructor', $instructors, null, [
                            'class' => 'form-control instructor-select',
                            'placeholder' => 'Seleccione el instructor',
                            'required'
                        ]) !!}
                    </div>
                </div>
           
                {!! Form::submit(trans('Registrar Respuesta'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        // Inicializa Select2 para los instructores
        $('.instructor-select').select2();

        $('.plan').hide();
        $('.answer').hide();

        $('#type').on('change', function () {
            var type = $(this).val(); 

            if (type == 'Plan de Mejoramiento') {
                $('.plan').show();
                $('.answer').hide(); 
            } else {
                $('.answer').show();
                $('.plan').hide();
            }
        });
    });
</script>
@endpush

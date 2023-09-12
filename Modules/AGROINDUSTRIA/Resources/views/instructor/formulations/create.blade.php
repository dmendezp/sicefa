@extends('agroindustria::layouts.master')

@section('content')
<div class="container_create">
    <div class="row justify-content-center">
        <div class="col-md-9">
        <div class="form">
                <div class="form-header">Registro de Formulaciones</div>
                <div class="form-body">
                    {!! Form::open(['url' => route('cefa.agroindustria.instructor.enviarsolicitud'),'method' => 'post']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('date', 'Fecha de Solicitud') !!}
                            {!! Form::date('date', now(), ['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('element_id', 'Nombre del producto') !!}
                            {!! Form::text('area', null ,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('proccess', 'Proceso') !!}
                            {!! Form::textarea('proccess', null , ['class'=>'form-control', 'id'=>'textarea']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('amount', 'Cantidad') !!}
                            {!! Form::number('amount', '', ['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('productive_unit_id', 'Unidad Productiva') !!}
                            {!! Form::select('productive_unit_id', $productive_unit_id ,null ,  ['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('person_id', 'Propietario') !!}
                            {!! Form::text('person_id', 'Persona logueada' , ['class' => 'form-control', 'readonly' => 'readonly',]) !!}                        
                        </div>
                        
                        
                </div>
            </div>
        </div>
        <div class="button">
            {!! Form::submit('Enviar',['class' => 'enviar','name' => 'enviar']) !!}
        </div>
    {!! Form:: close() !!}

            
    </div>
</div>
@endsection

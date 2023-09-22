@extends('agroindustria::layouts.master')
@section('content')
<div class="container_create">
    <div class="row">
        <div class="col-md-9">
            <div class="form">
                <div class="form-header">Registro de Labores</div>
                <div class="form-body">
                    {!! Form::open(['url' => route('cefa.agroindustria.units.instructor.labor.register'),'method' => 'post']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('activities', 'Actividades') !!}
                            {!! Form::select('activities', $activity, old('activities'), ['class' => 'form-control']) !!}  
                            @error('activities')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                      
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('recipe', 'Recetas') !!}
                            {!! Form::select('recipe', $recipe, old('recipe'), ['class' => 'form-control']) !!}   
                            @error('recipe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                       
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('date_plannig', 'Fecha de Planeación') !!}
                            {!! Form::date('date_plannig', now(), ['id' => 'readonly-bg-gray', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                            @error('date_plannig')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('date_execution', 'Fecha de Ejecución') !!}
                            {!! Form::date('date_execution', null, ['class' => 'form-control']) !!}
                            @error('date_execution')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('description', 'Descripción') !!}
                            {!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'proccess']) !!}
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div> 
                        <div class="col-md-6">
                            {!! Form::label('destination', 'Destino') !!}
                            {!! Form::select('destination', $destination, null, ['class'=>'form-control', 'placeholder' => 'Seleccione un destino']) !!}
                            @error('destination')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>   
                        <div class="col-md-12">
                            {!! Form::label('observations', 'Observaciones') !!}
                            {!! Form::textarea('observations', null, ['class'=>'form-control']) !!}
                            @error('observations')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror 
                        </div>   
                        <div class="button_receipe">{!! Form::submit(trans('agroindustria::formulations.Save'),['class' => 'save_receipe', 'name' => 'enviar']) !!}</div>
                    </div>
                </div>
            </div>
            {!! Form:: close() !!}     
        </div>
    </div>
</div>

@section('script')
@endsection
@endsection
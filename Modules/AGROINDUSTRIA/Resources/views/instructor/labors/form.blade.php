@extends('agroindustria::layouts.master')
@section('content')
<div class="container_create">
    <div class="row">
        <div class="col-md-9">
            <div class="form">
                <div class="form-header">{{trans('agroindustria::labors.laborRegistration')}}</div>
                <div class="form-body">
                    {!! Form::open(['url' => route('cefa.agroindustria.units.instructor.labor.register'),'method' => 'post']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('activities', trans('agroindustria::labors.activity')) !!}
                            {!! Form::select('activities', $activity, old('activities'), ['class' => 'form-control', 'id' => 'activity-selected']) !!}  
                            @error('activities')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                      
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('recipe', trans('agroindustria::labors.recipes')) !!}
                            {!! Form::select('recipe', $recipe, old('recipe'), ['class' => 'form-control']) !!}   
                            @error('recipe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                       
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('date_plannig', trans('agroindustria::labors.planningDate')) !!}
                            {!! Form::date('date_plannig', now(), ['id' => 'readonly-bg-gray', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                            @error('date_plannig')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('date_execution', trans('agroindustria::labors.executionDate')) !!}
                            {!! Form::date('date_execution', null, ['class' => 'form-control']) !!}
                            @error('date_execution')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('description', trans('agroindustria::labors.description')) !!}
                            {!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'proccess']) !!}
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div> 
                        <div class="col-md-6">
                            {!! Form::label('observations', trans('agroindustria::labors.observations')) !!}
                            {!! Form::textarea('observations', null, ['class'=>'form-control', 'id' => 'observations']) !!}
                            @error('observations')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror 
                        </div> 
                        <div class="col-md-6">
                            {!! Form::label('destination', trans('agroindustria::labors.destination')) !!}
                            {!! Form::select('destination', $destination, null, ['class'=>'form-control', 'placeholder' => trans("agroindustria::labors.selectDestination")]) !!}
                            @error('destination')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>  
                        <div class="col-md-6">
                            {!! Form::label('person', trans('agroindustria::labors.responsible')) !!}
                            {!! Form::select('person', [], null, ['class'=>'form-control', 'id' => 'responsible', 'placeholder' => trans("agroindustria::labors.selectResponsiblePerson")]) !!}
                            @error('person')
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

<script>
$(document).ready(function() {
    // Detecta cambios en el primer campo de selección (Receiver)
    $('#activity-selected').on('change', function() {
        var selectedActivity = $(this).val();

        var url = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.responsibilities', ['activityId' => ':activityId'])) !!}.replace(':activityId', selectedActivity.toString());

        // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                var options = '<option value="">' + '{{ trans("agroindustria::labors.selectResponsiblePerson") }}' + '</option>';
                $.each(response.id, function(index, warehouse) {
                    options += '<option value="' + warehouse.id + '">' + warehouse.name + '</option>';
                });

                // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                $('#responsible').html(options);;
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});

</script>
@endsection
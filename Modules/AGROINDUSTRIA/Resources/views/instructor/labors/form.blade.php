@extends('agroindustria::layouts.master')
@section('content')
<div class="container_create">
    <div class="row">
        <div class="col-md-9">
            <div class="form">
                <div class="form-header">{{trans('agroindustria::labors.laborRegistration')}}</div>
                <div class="form-body">
                    @if (Route::is('*form*'))
                    {!! Form::open(['url' => route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.register'),'method' => 'post']) !!}
                    @else
                    {!! Form::open(['url' => route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.update'),'method' => 'post']) !!}
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            @if (isset($registros))
                            {!! Form::hidden('id', $registros->id) !!}
                            @endif
                            {!! Form::label('activities', trans('agroindustria::labors.activity')) !!}
                            {!! Form::select('activities', $activity, isset($registros) ? $registros->activity->id : old('activities'), ['class' => 'form-control', 'id' => 'activity-selected']) !!}  
                            @error('activities')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                      
                        </div>
                        @if (isset($registros))
                        @if($registros->activity->activity_type->id == 1 && $registros->destination == 'Producción')
                        <div class="col-md-6" id="recipe-field" style="display: none;">
                            {!! Form::label('recipe', trans('agroindustria::labors.recipes')) !!}
                            {!! Form::select('recipe', [], isset($registros) ? $registros->productions->first()->element->id : old('recipe'), ['class' => 'form-control', 'id' => 'recipe-select', 'style' => 'width: 480px']) !!}
                            @error('recipe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        @else
                        <div class="col-md-6" id="recipe-field" style="display: none;">
                            {!! Form::label('recipe', trans('agroindustria::labors.recipes')) !!}
                            {!! Form::select('recipe', [], isset($registros) ? $registros->productions->first()->element->id : old('recipe'), ['class' => 'form-control', 'id' => 'recipe-select', 'style' => 'width: 480px']) !!}
                            @error('recipe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        <div class="col-md-6">
                            {!! Form::label('date_plannig', trans('agroindustria::labors.planningDate')) !!}
                            {!! Form::input('datetime-local', 'date_plannig', isset($registros) ? $registros->planning_date : now(), ['id' => 'readonly-bg-gray', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                            @error('date_plannig')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('date_execution', trans('agroindustria::labors.executionDate')) !!}
                            {!! Form::input('datetime-local', 'date_execution', isset($registros) ? $registros->execution_date : null, ['class' => 'form-control']) !!}
                            @error('date_execution')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('description', trans('agroindustria::labors.description')) !!}
                            {!! Form::textarea('description', isset($registros) ? $registros->description : null, ['class'=>'form-control', 'id'=>'proccess']) !!}
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div> 
                        <div class="col-md-6">
                            {!! Form::label('observations', trans('agroindustria::labors.observations')) !!}
                            {!! Form::textarea('observations', isset($registros) ? $registros->observations : null, ['class'=>'form-control', 'id' => 'observations']) !!}
                            @error('observations')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror 
                        </div> 
                        <div class="col-md-6">
                            {!! Form::label('destination', trans('agroindustria::labors.destination')) !!}
                            {!! Form::select('destination', $destination, isset($registros) ? $registros->destination : null, ['class'=>'form-control', 'placeholder' => trans("agroindustria::labors.selectDestination")]) !!}
                            @error('destination')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>  
                        <div class="col-md-6">
                            {!! Form::label('personName', trans('agroindustria::labors.responsible')) !!}
                            {!! Form::text('personName', isset($registros) ? $registros->person->first_name . ' ' . $registros->person->first_last_name . ' ' . $registros->person->second_last_name: null, ['class'=>'form-control', 'id' => 'responsible', 'readonly' => 'readonly']) !!}
                            {!! Form::hidden('person', isset($registros) ? $registros->person_id : null, ['id' => 'responsibleId']) !!}
                            @error('person')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                        @if (isset($registros))
                        @if ($registros->activity->activity_type->id == 1 && $registros->destination == 'Producción')
                        <div class="col-md-4" id="date-expiration-field" style="display: none;">
                            {!! Form::label('date_experation', trans('agroindustria::labors.expirationDate')) !!}
                            {!! Form::date('date_experation', isset($registros) ? $registros->productions->first()->expiration_date : null, ['class' => 'form-control']) !!}
                            @error('date_experation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4" id="lot-field" style="display: none;">
                            {!! Form::label('lot', trans('agroindustria::labors.lot')) !!}
                            {!! Form::number('lot', isset($registros) ? $registros->productions->first()->lot_number : null, ['class' => 'form-control']) !!}
                            @error('lot')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4" id="amount-production-field" style="display: none;">
                            {!! Form::label('amount_production', trans('agroindustria::labors.quantity')) !!}
                            {!! Form::number('amount_production', isset($registros) ? $registros->productions->first()->amount : null, ['class' => 'form-control', 'id' => 'amount_production']) !!}
                            @error('amount_production')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        @else
                        <div class="col-md-4" id="date-expiration-field" style="display: none;">
                            {!! Form::label('date_experation', trans('agroindustria::labors.expirationDate')) !!}
                            {!! Form::date('date_experation', isset($registros) ? $registros->productions->first()->expiration_date : null, ['class' => 'form-control']) !!}
                            @error('date_experation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4" id="lot-field" style="display: none;">
                            {!! Form::label('lot', trans('agroindustria::labors.lot')) !!}
                            {!! Form::number('lot', isset($registros) ? $registros->productions->first()->lot_number : null, ['class' => 'form-control']) !!}
                            @error('lot')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4" id="amount-production-field" style="display: none;">
                            {!! Form::label('amount_production', trans('agroindustria::labors.quantity')) !!}
                            {!! Form::number('amount_production', isset($registros) ? $registros->productions->first()->amount : null, ['class' => 'form-control', 'id' => 'amount_production']) !!}
                            @error('amount_production')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        <div class="col-md-6" id="total-labor">
                            {!! Form::label('total_labor', 'Total') !!}
                            {!! Form::number('total_labor', isset($registros) ? $registros->price: null, ['class' => 'form-control', 'id' => 'total_labor', 'readonly' => 'readonly']) !!}
                        </div>
                        <br>
                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                  <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        {{ trans('agroindustria::labors.openConsumableForm') }}
                                    </button>
                                  </h2>
                                  <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="consumables" id="form-container-consumables">
                                            <div id="form-consumables">
                                                <h3>{{trans('agroindustria::labors.consumables')}}</h3>
                                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                                <button type="button" class="btn btn-primary" id="add-consumables"><i class="fa-solid fa-plus"></i></button>
                                                @if (isset($registros) && $registros)
                                                    @foreach ($registros->consumables as $c)
                                                        <div class="consumable">
                                                            <div class="form-group-consumables">
                                                                {!! Form::label('consumables', trans('agroindustria::labors.consumables')) !!}
                                                                {!! Form::select('consumables[]', $consumables, $c->inventory_id, ['class' => 'element-select']) !!}
                                                            </div>
                                                            <div class="form-group-consumables"> 
                                                                <span class="quantity"></span>
                                                                {!! Form::label('amount_consumables', trans('agroindustria::labors.quantity')) !!}
                                                                {!! Form::number('amount_consumables[]',  $c->amount / $c->inventory->element->measurement_unit->conversion_factor, ['class' => 'form-control', 'id' => 'amount_consumables', 'step' => '0.01']) !!}
                                                            </div>
                                                            <div class="form-group-consumables">
                                                                {!! Form::label('price_consumable', trans('agroindustria::labors.unitValue')) !!}
                                                                {!! Form::number('price_unit_consumable', $c->inventory->price, ['class'=>'form-control', 'id' => 'price_unit_consumable', 'readonly' => 'readonly']) !!}
                                                            </div>
                                                            <div class="form-group-consumables">
                                                                {!! Form::label('price_consumable_total', 'Total') !!}
                                                                {!! Form::number('price_unit_consumable_total', $c->price, ['class'=>'form-control', 'id' => 'price_unit_consumable_total', 'readonly' => 'readonly']) !!}
                                                            </div>
                                                            {!! Form::button(trans('agroindustria::labors.delete'), ['class'=>'remove-consumables']) !!}                                
                                                        </div> 
                                                    @endforeach   
                                                    @else
                                                    <div class="consumable">
                                                        <div class="form-group-consumables">
                                                            {!! Form::label('consumables', trans('agroindustria::labors.consumables')) !!}
                                                            {!! Form::select('consumables[]', $consumables, null, ['class' => 'element-select']) !!}
                                                        </div>
                                                        <div class="form-group-consumables"> 
                                                            <span class="quantity"></span>
                                                            {!! Form::label('amount_consumables', trans('agroindustria::labors.quantity')) !!}
                                                            {!! Form::number('amount_consumables[]', null, ['class' => 'form-control', 'id' => 'amount_consumables', 'step' => '0.01']) !!}
                                                        </div>
                                                        <div class="form-group-consumables">
                                                            {!! Form::label('price_consumable', trans('agroindustria::labors.unitValue')) !!}
                                                            {!! Form::number('price_unit_consumable', null, ['class'=>'form-control', 'id' => 'price_unit_consumable', 'readonly' => 'readonly']) !!}
                                                        </div>
                                                        <div class="form-group-consumables">
                                                            {!! Form::label('price_consumable_total', 'Total') !!}
                                                            {!! Form::number('price_unit_consumable_total', null, ['class'=>'form-control', 'id' => 'price_unit_consumable_total', 'readonly' => 'readonly']) !!}
                                                        </div>
                                                        {!! Form::button(trans('agroindustria::labors.delete'), ['class'=>'remove-consumables']) !!}                                
                                                    </div> 
                                                @endif                       
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                  <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                        {{trans('agroindustria::labors.registerTools')}}
                                    </button>
                                  </h2>
                                  <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="tools" id="form-container-tools">
                                            <div id="form-tools">
                                                <h3 id="title_tools">{{trans('agroindustria::labors.tools')}}</h3>
                                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                                <button type="button" class="btn btn-primary" id="add-tools"><i class="fa-solid fa-plus"></i></button>
                                                @if (isset($registros) && $registros)
                                                    @foreach ($registros->tools as $t)
                                                        <div class="tools">
                                                            <div class="form-group-tools">
                                                                {!! Form::label('tools', trans('agroindustria::labors.tools')) !!}
                                                                {!! Form::select('tools[]', $tool, $t->inventory_id, ['class' => 'tool_select', 'style' => 'width: 200px']) !!}
                                                            </div>
                                                            <div class="form-group-tools">
                                                                <span class="quantity"></span>
                                                                {!! Form::label('amount', trans('agroindustria::labors.quantity')) !!}
                                                                {!! Form::number('amount_tools[]', $t->amount, ['class'=>'form-control', 'id' => 'amount_tools']) !!}
                                                            </div>   
                                                            <div class="form-group-tools">  
                                                                {!! Form::label('price', trans('agroindustria::labors.unitValue')) !!}
                                                                {!! Form::number('price_unit_tool', $t->inventory->price, ['class'=>'form-control', 'id' => 'price_unit_tool', 'readonly' => 'readonly']) !!}
                                                            </div> 
                                                            <div class="form-group-tools">  
                                                                {!! Form::label('price', 'Total') !!}
                                                                {!! Form::number('price_tools[]', $t->price, ['class'=>'form-control', 'id' => 'price_tool', 'readonly' => 'readonly']) !!}
                                                            </div>            
                                                            <button type="button" class="remove-tools">{{trans('agroindustria::labors.delete')}}</button>
                                                        </div>
                                                    @endforeach
                                                    @else
                                                    <div class="tools">
                                                        <div class="form-group-tools">
                                                            {!! Form::label('tools', trans('agroindustria::labors.tools')) !!}
                                                            {!! Form::select('tools[]', $tool, null, ['class' => 'tool_select', 'style' => 'width: 200px']) !!}
                                                        </div>
                                                        <div class="form-group-tools">
                                                            <span class="quantity"></span>
                                                            {!! Form::label('amount', trans('agroindustria::labors.quantity')) !!}
                                                            {!! Form::number('amount_tools[]', null, ['class'=>'form-control', 'id' => 'amount_tools']) !!}
                                                        </div>   
                                                        <div class="form-group-tools">  
                                                            {!! Form::label('price', trans('agroindustria::labors.unitValue')) !!}
                                                            {!! Form::number('price_unit_tool', null, ['class'=>'form-control', 'id' => 'price_unit_tool', 'readonly' => 'readonly']) !!}
                                                        </div> 
                                                        <div class="form-group-tools">  
                                                            {!! Form::label('price', 'Total') !!}
                                                            {!! Form::number('price_tools[]', null, ['class'=>'form-control', 'id' => 'price_tool', 'readonly' => 'readonly']) !!}
                                                        </div>            
                                                        <button type="button" class="remove-tools">{{trans('agroindustria::labors.delete')}}</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                  <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                        {{ trans('agroindustria::labors.openCollaboratorFormulatio') }}
                                    </button>
                                  </h2>
                                  <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="executors" id="form-container">
                                            <div id="form-executors">
                                                <h3 id="title_executor">{{ trans('agroindustria::labors.collaborators') }}</h3>
                                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                                <button type="button" class="btn btn-primary" id="add-executor"><i class="fa-solid fa-plus"></i></button>
                                                @if (isset($registros) && $registros)
                                                    @foreach ($registros->executors as $e)
                                                        <div class="collaborators">
                                                            <div class="form-group-collaborators">
                                                                {!! Form::label('personSearch', trans('agroindustria::labors.searchPerson')) !!}
                                                                {!! Form::text('search', null, ['class'=>'personSearch-select', 'style' => 'width: 185px']) !!}
                                                            </div>
                                                            <div class="form-group-collaborators">
                                                                {!! Form::label('collaborator', trans('agroindustria::labors.collaborators')) !!}
                                                                {!! Form::hidden('executors_id[]', $e->person_id, ['class' => 'executors_id']) !!}
                                                                {!! Form::text('executor', $e->person->first_name . ' ' . $e->person->first_last_name . ' ' . $e->person->second_last_name, ['class'=>'form-control collaborator_executors', 'readonly' => 'readonly']) !!}
                                                            </div>   
                                                            <div class="form-group-collaborators">
                                                                <span class="price-executor"></span>
                                                                {!! Form::label('employement_type', trans('agroindustria::labors.employeeType')) !!}
                                                                {!! Form::select('employement_type[]', $employee, $e->employee_type_id, ['class'=>'form-control employement_type', 'style' => 'width: 200px']) !!}
                                                                {!! Form::hidden('price[]', $e->price, ['id' => 'price']) !!}
                                                                @error('employement_type')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                            </div>
                                                            <div class="form-group-collaborators">  
                                                                <span class="total-executor"></span>
                                                                {!! Form::label('hours', trans('agroindustria::labors.hoursWorked')) !!}
                                                                {!! Form::number('hours[]', $e->amount, ['class'=>'form-control hours', 'id' => 'hours']) !!}
                                                                {!! Form::hidden('total-executor[]', $e->price, ['id' => 'total-executor']) !!}
                                                                @error('hours')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>            
                                                            <button type="button" class="remove-executor">{{trans('agroindustria::labors.delete')}}</button>
                                                        </div>
                                                    @endforeach
                                                    @else
                                                    <div class="collaborators">
                                                        <div class="form-group-collaborators">
                                                            {!! Form::label('personSearch', trans('agroindustria::labors.searchPerson')) !!}
                                                            {!! Form::text('search', null, ['class'=>'personSearch-select', 'style' => 'width: 185px']) !!}
                                                        </div>
                                                        <div class="form-group-collaborators">
                                                            {!! Form::label('collaborator', trans('agroindustria::labors.collaborators')) !!}
                                                            {!! Form::hidden('executors_id[]', null, ['class' => 'executors_id']) !!}
                                                            {!! Form::text('executor', null, ['class'=>'form-control collaborator_executors', 'readonly' => 'readonly']) !!}
                                                        </div>   
                                                        <div class="form-group-collaborators">
                                                            <span class="price-executor"></span>
                                                            {!! Form::label('employement_type', trans('agroindustria::labors.employeeType')) !!}
                                                            {!! Form::select('employement_type[]', $employee, null, ['class'=>'form-control employement_type', 'style' => 'width: 200px']) !!}
                                                            {!! Form::hidden('price[]', null, ['id' => 'price']) !!}
                                                            @error('employement_type')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="form-group-collaborators">  
                                                            <span class="total-executor"></span>
                                                            {!! Form::label('hours', trans('agroindustria::labors.hoursWorked')) !!}
                                                            {!! Form::number('hours[]', null, ['class'=>'form-control hours', 'id' => 'hours']) !!}
                                                            {!! Form::hidden('total-executor[]', null, ['id' => 'total-executor']) !!}
                                                            @error('hours')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>            
                                                        <button type="button" class="remove-executor">{{trans('agroindustria::labors.delete')}}</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                  <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                        {{trans('agroindustria::labors.registerEquipments')}}
                                    </button>
                                  </h2>
                                  <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="equipments" id="form-container-equipments">
                                            <div id="form-equipments">
                                                <h3 id="equipments">{{trans('agroindustria::labors.equipments')}}</h3>
                                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                                <button type="button" class="btn btn-primary" id="add-equipments"><i class="fa-solid fa-plus"></i></button>
                                                @if (isset($registros) && $registros)
                                                    @foreach ($registros->equipments as $eq)
                                                        <div class="equipment">
                                                            <div class="form-group-equipments">
                                                                {!! Form::label('inventories', trans('agroindustria::labors.equipments')) !!}
                                                                {!! Form::select('equipments[]', $equipment, $eq->inventory_id, ['class' => 'inventory_select', 'style' => 'width: 200px']) !!}
                                                            </div>
                                                            <div class="form-group-equipments">
                                                                <span class="quantity-equipment"></span>
                                                                {!! Form::label('amount', trans('agroindustria::labors.quantity')) !!}
                                                                {!! Form::number('amount_equipments[]', $eq->amount, ['class'=>'form-control', 'id' => 'amount_equipments']) !!}
                                                            </div>   
                                                            <div class="form-group-equipments">  
                                                                {!! Form::label('price', trans('agroindustria::labors.unitValue')) !!}
                                                                {!! Form::number('price_unit_equipment', $eq->inventory->price, ['class'=>'form-control', 'id' => 'price_unit_equipment', 'readonly' => 'readonly']) !!}
                                                            </div> 
                                                            <div class="form-group-equipments">  
                                                                {!! Form::label('price', 'Total') !!}
                                                                {!! Form::number('price_equipments[]', $eq->price, ['class'=>'form-control', 'id' => 'price_equipment', 'readonly' => 'readonly']) !!}
                                                            </div>           
                                                            <button type="button" class="remove-equipments">{{trans('agroindustria::labors.delete')}}</button>
                                                        </div>
                                                    @endforeach
                                                    @else
                                                    <div class="equipment">
                                                        <div class="form-group-equipments">
                                                            {!! Form::label('inventories', trans('agroindustria::labors.equipments')) !!}
                                                            {!! Form::select('equipments[]', $equipment, null, ['class' => 'inventory_select', 'style' => 'width: 200px']) !!}
                                                        </div>
                                                        <div class="form-group-equipments">
                                                            <span class="quantity-equipment"></span>
                                                            {!! Form::label('amount', trans('agroindustria::labors.quantity')) !!}
                                                            {!! Form::number('amount_equipments[]', null, ['class'=>'form-control', 'id' => 'amount_equipments']) !!}
                                                        </div>   
                                                        <div class="form-group-equipments">  
                                                            {!! Form::label('price', trans('agroindustria::labors.unitValue')) !!}
                                                            {!! Form::number('price_unit_equipment', null, ['class'=>'form-control', 'id' => 'price_unit_equipment', 'readonly' => 'readonly']) !!}
                                                        </div> 
                                                        <div class="form-group-equipments">  
                                                            {!! Form::label('price', 'Total') !!}
                                                            {!! Form::number('price_equipments[]', null, ['class'=>'form-control', 'id' => 'price_equipment', 'readonly' => 'readonly']) !!}
                                                        </div>           
                                                        <button type="button" class="remove-equipments">{{trans('agroindustria::labors.delete')}}</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                            {{trans('agroindustria::labors.registerEnvironmentalResources')}}
                                        </button>
                                    </h2>
                                  <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="resources" id="form-container-resources">
                                            <div id="form-resources">
                                                <h3 id="resources">{{trans('agroindustria::labors.environmentalResources')}}</h3>
                                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                                <button type="button" class="btn btn-primary" id="add-resources"><i class="fa-solid fa-plus"></i></button>
                                                @if (isset($registros) && $registros)
                                                    @foreach ($registros->environmental_aspect_labors as $en)
                                                        <div class="resource">
                                                            <div class="form-group">
                                                                {!! Form::label('environmental_aspect', trans('agroindustria::labors.environmentalAspect')) !!}
                                                                {!! Form::select('environmental_aspect[]', $environmental_aspect, isset($en) ? $en->environmental_aspect_id : old('environmental_aspect'),  ['class' => 'environmental_edit', 'style' => 'width: 200px']) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {!! Form::label('amount_environmental_aspect', trans('agroindustria::labors.quantity')) !!}
                                                                {!! Form::number('amount_environmental_aspect[]', $en->amount, ['class'=>'form-control', 'id' => 'amount_environmental_aspect']) !!}
                                                            </div>   
                                                            <div class="form-group">  
                                                                {!! Form::label('price_environmental_aspect', trans('agroindustria::labors.price')) !!}
                                                                {!! Form::number('price_environmental_aspect[]', $en->price, ['class'=>'form-control', 'id' => 'price_environmental_aspect']) !!}
                                                            </div>           
                                                            <button type="button" class="remove-resources">{{trans('agroindustria::labors.delete')}}</button>
                                                        </div>
                                                    @endforeach
                                                    @else
                                                    <div class="resource">
                                                        <div class="form-group">
                                                            {!! Form::label('environmental_aspect', trans('agroindustria::labors.environmentalAspect')) !!}
                                                            {!! Form::select('environmental_aspect[]', [], null, ['class' => 'environmental_aspect_select', 'id' => 'select_aspect', 'style' => 'width: 200px', 'placeholder' => trans("agroindustria::labors.selectEnvironmentalAspect")]) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            {!! Form::label('amount_environmental_aspect', trans('agroindustria::labors.quantity')) !!}
                                                            {!! Form::number('amount_environmental_aspect[]', null, ['class'=>'form-control', 'id' => 'amount_environmental_aspect']) !!}
                                                        </div>   
                                                        <div class="form-group">  
                                                            {!! Form::label('price_environmental_aspect', trans('agroindustria::labors.price')) !!}
                                                            {!! Form::number('price_environmental_aspect[]', null, ['class'=>'form-control', 'id' => 'price_environmental_aspect']) !!}
                                                        </div>           
                                                        <button type="button" class="remove-resources">{{trans('agroindustria::labors.delete')}}</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>                            
                        </div>               
                        <div class="button_receipe">{!! Form::submit(trans('agroindustria::formulations.Save'),['class' => 'save_receipe btn btn-success', 'name' => 'enviar']) !!}</div>
                    </div>
                    {!! Form:: close() !!}     
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
@endsection

<script>
    $(document).ready(function() {
     var baseUrl = '{{ route("agroindustria.".getRoleRouteName(Route::currentRouteName()).".units.labor.form.elements") }}';
          $('select[name="recipe"]').select2({
            placeholder: 'Seleccione un elemento',
            minimumInputLength: 3,
            ajax: {
                url: baseUrl,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        element_id: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    });

                    return {
                        results: results
                    };
                },
                cache: true
            }
        });
    });
</script>


<script>
    $(document).ready(function () {
        // Agregar un nuevo campo de consumibles
        $('.element-select').select2();

        $("#add-consumables").click(function () {
            var newConsumable = '<div class="consumable"><div class="form-group">{!! Form::label("consumables", trans("agroindustria::labors.consumables")) !!}{!! Form::select("consumables[]", $consumables, null, ["class" => "element-select"]) !!}</div><div class="form-group" style="margin-left: 5px; margin-right: 16px;"><span class="quantity"></span>{!! Form::label("amount_consumables", trans("agroindustria::labors.quantity")) !!}{!! Form::number("amount_consumables[]", null, ["class" => "form-control", "id" => "amount_consumables", "step" => "0.01"]) !!}</div><div class="form-group">{!! Form::label("price_consumable", trans("agroindustria::labors.unitValue")) !!}{!! Form::number("price_unit_consumable", null, ["class"=>"form-control", "id" => "price_unit_consumable", "readonly" => "readonly"]) !!}</div><div class="form-group" style="margin-left: 3px">{!! Form::label("price_consumable_total", "Total") !!}{!! Form::number("price_unit_consumable_total", null, ["class"=>"form-control", "id" => "price_unit_consumable_total", "readonly" => "readonly"]) !!}</div>{!! Form::button(trans("agroindustria::labors.delete"), ["class"=>"remove-consumables", "style" => "margin-left: 6px"]) !!}</div>';

            // Agregar el nuevo campo al DOM
            $("#form-consumables").append(newConsumable);

            $('.element-select:last').select2();
        });
        
        // Cuando cambie la selección de recetas
        $('#recipe-select').on('change', function () {
            updateConsumables();
        });

        // Cuando cambie la cantidad inicial
        $('#amount_production').on('input', function () {
            updateConsumables();
        });

        @if(Route::is('*form*'))
        function updateConsumables() {
            var amount = $('#amount_production').val(); // Obtener la cantidad actual
            var url = {!! json_encode(route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.consumables', ['id' => ':id'])) !!}.replace(':id', $('#recipe-select').val().toString());
            // Realiza una solicitud AJAX para obtener los ingredientes de la receta
            $.ajax({
                url: '{!! route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.consumables', ['id' => ':id']) !!}'.replace(':id', $('#recipe-select').val().toString()),
                type: 'GET',
                success: function (data) {
                    // Limpia el contenedor de consumibles
                    var $consumableContainer = $('.consumable:first');
                    $consumableContainer.empty();

                    var totalPriceConsumables = 0;

                    // Itera a través de los consumibles y agrega los campos de selección de consumibles
                    $.each(data.consumables, function (index, consumable) {
                        var counter = index + 1; // Incrementa el contador
                        var amountFormulation = data.amountFormulation[0].amountFormulation;
                        var amountIngredient = data.amountIngredient[index].amountIngredient;
                        var amountPerFormulation = amountIngredient / amountFormulation;

                        var totalAmount = amountPerFormulation * amount; // Calcular la cantidad total

                        var totalPrice = totalAmount * consumable.price;

                        totalPriceConsumables += totalPrice;                
                        
                        var newConsumableField = '<div class="consumable recipe-product">' +
                            '<div class="form-group">' +
                            '<label for="consumables">{{trans("agroindustria::labors.searchConsumables")}}</label>' +
                            '<input type="hidden" name="consumables[]" class="form-control" id="element-select-' + counter + '" value="' + consumable.id + '" style="width: 200px;" readonly>' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="consumables">{{trans("agroindustria::labors.consumables")}}</label>' +
                            '<input type="text" name="name_consumable" class="form-control" id="element_name-' + counter + '" value="' + consumable.name + '" readonly>' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<span class="quantity">{{trans("agroindustria::labors.quantityAvailable")}}: ' + consumable.amount + '</span>' +
                            '<label for="amount_consumables">{{trans("agroindustria::labors.quantity")}}</label>' +
                            '<input type="number" name="amount_consumables[]" id="amount_consumables_formulation" class="form-control" value="' + totalAmount + '" readonly>' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<span class="price_unit">{{trans("agroindustria::labors.unitValue")}}: ' + consumable.price + '</span>' +
                            '<label for="amount_consumables">Total</label>' +
                            '<input type="number" name="total_price_consumable" id="total_price_consumable" class="form-control" value="' + totalPrice + '" readonly>' +
                            '</div>' +
                            '<button type="button" class="remove-consumables">{{trans('agroindustria::labors.delete')}}</button>'
                            '</div>';

                            maxQuantity = consumable.amount;
                            

                            function updateSaveButtonState(totalAmount, maxQuantity) {
                                var saveButton = $('.save_receipe');

                                if (totalAmount > maxQuantity) {
                                    saveButton.prop('disabled', true);
                                    saveButton.addClass('disabled-button');
                                    isAnyProductExceeding = true;
                                    console.log('Deshabilitado');
                                } else {
                                    isAnyProductExceeding = false;
                                    console.log('Habilitado');
                                    if (!isAnyProductExceeding) {
                                        saveButton.prop('disabled', false);
                                        saveButton.removeClass('disabled-button');
                                    } else {
                                        saveButton.prop('disabled', true);
                                        saveButton.addClass('disabled-button');
                                    }
                                }
                            }

                        $consumableContainer.append(newConsumableField);
                            
                       
                        if (totalAmount > maxQuantity) {
                            // Actualizar el contenido del span después de agregarlo al DOM
                            $consumableContainer.find('.quantity').text('Cantidad no disponible').css('color', 'red');
                            updateSaveButtonState(totalAmount, maxQuantity);
                        } else {
                            updateSaveButtonState(totalAmount, maxQuantity);
                        }
                       
                        // Actualizar el campo "Total de la Labor"
                        $('input[name="total_labor"]').val(totalPriceConsumables);
                        

                        // Inicializa los campos de selección de consumibles con Select2 dentro del contexto de esta iteración
                        (function (currentCounter) {
                            $('#element-select-' + currentCounter).select2({
                                placeholder: '{{trans("agroindustria::labors.searchConsumables")}}',
                                minimumInputLength: 1,
                                ajax: {
                                    url: function (params) {
                                        var searchUrlElement = '{!! route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.elements', ["name" => ":name"]) !!}'.replace(':name', params.term);
                                        return searchUrlElement;
                                    },
                                    dataType: 'json',
                                    delay: 250,
                                    processResults: function (data) {
                                        return {
                                            results: data.elements.map(function (element) {
                                                return {
                                                    id: element.id,
                                                    text: element.name,
                                                };
                                            })
                                        };
                                    },
                                    cache: true
                                }
                            });

                            $('#element-select-' + currentCounter).on('select2:select', function (e) {
                                var selectedElement = e.params.data;
                                $(this).closest('.consumable').find('input#element-select-' + currentCounter).val(selectedElement.id);
                                $(this).closest('.consumable').find('input#element_name-' + currentCounter).val(selectedElement.text);
                            });
                        })(counter); // Pasa el valor de counter al contexto de la función autoinvocada
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        @endif
        // Llamar a updateConsumables al cargar la página
        updateConsumables();
        // Eliminar un campo de consumibles
        $("#form-consumables").on("click", ".remove-consumables", function () {
            $(this).closest('.consumable').remove();
        });
    });
</script>

{{-- Agrega campos dinamicamente para formulario de ejecutores --}}
<script>
    $(document).ready(function() {
        // Agregar un nuevo campo de colaborador
        $('.employement_type').select2();

        $("#add-executor").click(function() {
            var newCollaborator = '<div class="collaborators"><div class="form-group">{!! Form::label("personSearch", trans("agroindustria::labors.searchPerson")) !!}{!! Form::text("search", null, ["class"=>"personSearch-select"]) !!}</div> <div class="form-group"> {!! Form::label("collaborator", trans("agroindustria::labors.collaborators")) !!}{!! Form::hidden("executors_id[]", null, ["id" => "executors_id"]) !!}{!! Form::text("executor", null, ["class"=>"form-control", "id" => "collaborator_executors", "readonly" => "readonly"]) !!}</div> <div class="form-group"><span class="price-executor"></span>{!! Form::label("employement_type", trans("agroindustria::labors.employeeType")) !!}{!! Form::select("employement_type[]", $employee, null, ["class"=>"form-control employement_type", "style" => "width: 200px"]) !!}{!! Form::hidden("price[]", null, ["id" => "price"]) !!}</div> <div class="form-group"><span class="total-executor"></span>{!! Form::label("hours", trans("agroindustria::labors.hoursWorked")) !!}{!! Form::number("hours[]", null, ["class"=>"form-control hours", "id" => "hours"]) !!} {!! Form::hidden("total-executor[]", null, ["id" => "total-executor"]) !!}</div> <button type="button" class="remove-executor">{{trans("agroindustria::labors.delete")}}</button></div>';
    
            // Agregar el nuevo campo al DOM
            $("#form-executors").append(newCollaborator);
    
            $('.employement_type:last').select2();
       
            var baseUrl = '{{ route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.executors', ["document_number" => ":document_number"]) }}';
           

            $('.personSearch-select:last').select2({
                placeholder: '{{trans("agroindustria::labors.searchPerson")}}',
                minimumInputLength: 1, // Habilita la búsqueda en tiempo real
                ajax: {
                    url: function(params) {
                        // Reemplaza el marcador de posición con el término de búsqueda
                        var searchUrl = baseUrl.replace(':document_number', params.term);
    
                        return searchUrl; // Utiliza la URL actualizada con el término de búsqueda
                    },
                    dataType: 'json',
                    delay: 250, // Retardo antes de iniciar la búsqueda
                    processResults: function(data) {
                        return {
                            results: data.id.map(function(person) {
                                return {
                                    id: person.id,
                                    text: person.name,
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Manejar la selección de una persona en el campo de búsqueda
            $('.personSearch-select:last').on('select2:select', function(e) {
                var selectedPerson = e.params.data;
                // Actualizar el contenido de la etiqueta con el nombre de la persona seleccionada
                $(this).closest('.collaborators').find('input#executors_id').val(selectedPerson.id);
                $(this).closest('.collaborators').find('input#collaborator_executors').val(selectedPerson.text);
            });
            
        });

        $('.personSearch-select').select2({
                placeholder: '{{trans("agroindustria::labors.searchPerson")}}',
                minimumInputLength: 1, // Habilita la búsqueda en tiempo real
                ajax: {
                    url: function(params) {
                        // Reemplaza el marcador de posición con el término de búsqueda
                        var searchUrl = {!! json_encode(route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.executors', ["document_number" => ":document_number"])) !!}.replace(':document_number', params.term);
    
                        return searchUrl; // Utiliza la URL actualizada con el término de búsqueda
                    },
                    dataType: 'json',
                    delay: 250, // Retardo antes de iniciar la búsqueda
                    processResults: function(data) {
                        return {
                            results: data.id.map(function(person) {
                                return {
                                    id: person.id,
                                    text: person.name,
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            $('.personSearch-select').on('select2:select', function(e) {
                var selectedPerson = e.params.data;
                // Actualizar el contenido de la etiqueta con el nombre de la persona seleccionada
                $('.executors_id').val(selectedPerson.id);
                $('.collaborator_executors').val(selectedPerson.text);
            });
        
        // Detecta cambios en el primer campo de selección (Receiver)
        $('#form-executors').on('change', '.employement_type', function() {
            var selectedEmployement = $(this).val();
            var parentElement = $(this).closest('.collaborators');
            var priceEmployementField = parentElement.find('input#price');
            var priceEmployement = parentElement.find('.price-executor');
            var url = {!! json_encode(route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.price', ['id' => ':id'])) !!}.replace(':id', selectedEmployement.toString());
            console.log('role:' + url);
           
            if(selectedEmployement){
                // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                        var price = response.price;
                        priceEmployementField.val(price);
                        priceEmployement.text('Precio: ' + price);
                        updateTotalPrice();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }else{
                priceEmployementField.data('price', 0);
                updateTotalPrice(); // Actualizar el precio total cuando no se selecciona una herramienta
                updateTotalLaborPrice();
            }
        });
        $('#form-executors').on('input', 'input#hours', function() {
            updateTotalPrice(); // Actualizar el precio total cuando se modifica la cantidad
            updateTotalLaborPrice();
        });

        function updateTotalLaborPrice() {
            var totalPriceEquipments = 0;
            var totalPriceTools = 0;
            var totalPriceConsumables = 0;
            var totalPriceRecipes = 0;
            var totalExecutor = 0;
            var totalResource = 0;

            $('#form-equipments .equipment').each(function() {
                var totalField = $(this).find('input#price_equipment');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceEquipments += totalPrice;
            });

            $('#form-tools .tools').each(function() {
                var totalField = $(this).find('input#price_tool');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceTools += totalPrice;
            });

            $('#form-executors .collaborators').each(function() {
                var totalField = $(this).find('input#total-executor');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalExecutor += totalPrice;
            });

            // Calcular el total de productos de receta fuera del bucle
            $('.recipe-product').each(function() {
                var totalRecipeField = $(this).find('input#total_price_consumable');
                var totalRecipePrice = parseFloat(totalRecipeField.val()) || 0;
                totalPriceRecipes += totalRecipePrice;
            });

            $('#form-container-resources .resource').each(function() {
                var totalField = $(this).find('input#price_environmental_aspect');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalResource += totalPrice;
                console.log('Recurso: ' + totalResource);
            });


            $('.consumable').each(function() {
                var totalField = $(this).find('input#price_unit_consumable_total');
                var totalPrice = parseFloat(totalField.val()) || 0;

                totalPriceConsumables += totalPrice;
            });
            

            var total = totalPriceEquipments + totalPriceTools + totalPriceRecipes + totalPriceConsumables + totalExecutor + totalResource;

            $('input[name="total_labor"]').val(total);
        }

        function updateTotalPrice() {
            var totalPrice = 0;
            $('.collaborators').each(function() {
                var priceEmployement = $(this).find('.total-executor');
                var priceField = $(this).find('input#price');
                var price = parseInt(priceField.val()) || 0;
                var amountField = $(this).find('input#hours');
                var amount = parseInt(amountField.val()) || 0;
                var totalField = $(this).find('input#total-executor');
                var totalPrice = price * amount;
                priceEmployement.text('Total: ' + totalPrice);
                totalField.val(totalPrice);
                
            });
        }

        // Eliminar un campo de colaborador
        $("#form-executors").on("click", ".remove-executor", function() {
            $(this).closest('.collaborators').remove();
        });
    });
</script>

{{-- Agrega campos dinamicamente para formulario de herramientas --}}
<script>
    $(document).ready(function() {
       // Agregar un nuevo campo de colaborador
       $('.tool_select').select2();

       $("#add-tools").click(function() {
           var newTool = '<div class="tools"><div class="form-group">{!! Form::label("tools", trans("agroindustria::labors.tools")) !!}{!! Form::select("tools[]", $tool, null, ["class" => "tool_select", "style" => "width: 200px"]) !!}</div><div class="form-group" style="margin-left: 5px; margin-right: 16px;"><span class="quantity"></span>{!! Form::label("amount", trans("agroindustria::labors.quantity")) !!}{!! Form::number("amount_tools[]", null, ["class"=>"form-control", "id" => "amount_tools"]) !!}</div><div class="form-group">{!! Form::label("price", trans("agroindustria::labors.unitValue")) !!}{!! Form::number("price_unit_tool", null, ["class"=>"form-control", "id" => "price_unit_tool", "readonly" => "readonly"]) !!}</div><div class="form-group" style="margin-left: 3px">{!! Form::label("price", "Total") !!}{!! Form::number("price_tools[]", null, ["class"=>"form-control", "id" => "price_tool", "readonly" => "readonly"]) !!}</div><button type="button" class="remove-tools" style="margin-left: 6px">{{trans("agroindustria::labors.delete")}}</button></div>';

           // Agregar el nuevo campo al DOM
           $("#form-tools").append(newTool);

           $('.tool_select:last').select2();

       });

       var isAnyProductExceeding = false;
       $('#form-tools').on('change', 'select[name^="tools"]', function() {
            var selectedTool = $(this).val();
            var parentElement = $(this).closest('.tools');
            var priceField = parentElement.find('input#price_unit_tool');
            var quantityField = parentElement.find('.quantity');

            if (selectedTool) {
                // Realiza una solicitud AJAX para obtener el precio de la herramienta seleccionada
                var url = {!! json_encode(route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.tools.price', ['id' => ':id'])) !!}.replace(':id', selectedTool.toString());

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        if(response.data.length > 0){
                            var data = response.data[0];
                            console.log(data);
                            var price = parseFloat(data.price);
                            maxQuantity = parseFloat(data.amount);

                            priceField.val(price);
                            updateTotalPrice(); // Actualizar el precio total cuando se selecciona la herramienta
                            updateSaveButtonState(quantityField, 0, maxQuantity);
                            $('#form-tools').off('input', 'input#amount_tools').on('input', 'input#amount_tools', function() {
                                var amountInput = $(this);
                                var amount = amountInput.val();
                                updateSaveButtonState(quantityField, amount, maxQuantity)
                                updateTotalPrice(); // Actualizar el precio total cuando se modifica la cantidad
                                updateTotalLaborPrice();
                            });
                            
                        }else{
                            quantityField.text('');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else {
                priceField.data('price', 0);
                updateTotalPrice(); // Actualizar el precio total cuando no se selecciona una herramienta
                updateTotalLaborPrice();
            }
        });

        function updateSaveButtonState(quantityField, amount, maxQuantity) {
            var saveButton = $('.save_receipe');

            if (amount > maxQuantity) {
                quantityField.text('{{trans("agroindustria::labors.amountEnteredGreater")}}').css('color', 'red');
                saveButton.prop('disabled', true);
                saveButton.addClass('disabled-button');
                isAnyProductExceeding = true;
                console.log('Deshabilitado');
            } else {
                quantityField.text('Cantidad Disponible: ' + maxQuantity).css('color', '#666');
                isAnyProductExceeding = false;
                console.log(isAnyProductExceeding);
                if (!isAnyProductExceeding) {
                    saveButton.prop('disabled', false);
                    saveButton.removeClass('disabled-button');
                } else {
                    saveButton.prop('disabled', true);
                    saveButton.addClass('disabled-button');
                }
            }
        }

        function updateTotalLaborPrice() {
            var totalPriceEquipments = 0;
            var totalPriceTools = 0;
            var totalPriceConsumables = 0;
            var totalPriceRecipes = 0;
            var totalExecutor = 0;
            var totalResource = 0;

            $('#form-equipments .equipment').each(function() {
                var totalField = $(this).find('input#price_equipment');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceEquipments += totalPrice;
            });

            $('#form-tools .tools').each(function() {
                var totalField = $(this).find('input#price_tool');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceTools += totalPrice;
            });

            $('#form-executors .collaborators').each(function() {
                var totalField = $(this).find('input#total-executor');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalExecutor += totalPrice;
            });

            // Calcular el total de productos de receta fuera del bucle
            $('.recipe-product').each(function() {
                var totalRecipeField = $(this).find('input#total_price_consumable');
                var totalRecipePrice = parseFloat(totalRecipeField.val()) || 0;
                totalPriceRecipes += totalRecipePrice;
            });

            $('#form-container-resources .resource').each(function() {
                var totalField = $(this).find('input#price_environmental_aspect');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalResource += totalPrice;
                console.log('Recurso: ' + totalResource);
            });


            $('.consumable').each(function() {
                var totalField = $(this).find('input#price_unit_consumable_total');
                var totalPrice = parseFloat(totalField.val()) || 0;

                totalPriceConsumables += totalPrice;
            });

            var total = totalPriceEquipments + totalPriceTools + totalPriceRecipes + totalPriceConsumables + totalExecutor + totalResource;

            $('input[name="total_labor"]').val(total);
        }

        function updateTotalPrice() {
            var totalPrice = 0;
            $('.tools').each(function() {
                var priceField = $(this).find('input#price_unit_tool');
                var price = parseInt(priceField.val()) || 0;
                var amountField = $(this).find('input#amount_tools');
                var amount = parseInt(amountField.val()) || 0;
                var totalField = $(this).find('input#price_tool');
                var totalPrice = price * amount;
                totalField.val(totalPrice);
            });
        }


        // Eliminar un campo de colaborador
        $("#form-tools").on("click", ".remove-tools", function() {
           $(this).closest('.tools').remove();
       });
   });
</script>

<script>
    $(document).ready(function() {
        var isAnyProductExceeding = false;

        $("#form-consumables").on("change", "select[name^='consumables']", function() {
            var selectedElement = $(this).val();
            var parentProduct = $(this).closest('.consumable');
            var availablePriceUnit = parentProduct.find('input#price_unit_consumable');
            var availableQuantity = parentProduct.find('.quantity');
            if (selectedElement) {
                $.ajax({
                    url: {!! json_encode(route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.consumables.amount', ['consumables' => ':consumables'])) !!}.replace(':consumables', selectedElement.toString()),
                    method: 'GET',
                    success: function(response) {
                        if (response.elements.length > 0) {
                            var element = response.elements[0];
                            var price = parseFloat(element.price);
                            maxQuantity = parseFloat(element.amount);

                            availablePriceUnit.val(price);
                            updateTotalPrice();
                            updateSaveButtonState(availableQuantity, 0, maxQuantity);

                            $('#form-consumables').off('input', 'input#amount_consumables').on('input', 'input#amount_consumables', function() {
                                var amountInput = $(this);
                                var amount = amountInput.val();
                                updateSaveButtonState(availableQuantity, amount, maxQuantity);
                                updateTotalPrice();
                                updateTotalLaborPrice();
                            });

                        } else {
                            availableQuantity.text(''); // Limpia el texto si no se encuentra la cantidad disponible
                        }
                    },
                    error: function(error) {
                        console.error('Error al obtener la cantidad disponible:', error);
                        availableQuantity.text(''); // Limpia el texto en caso de error
                        availablePrice.val('');
                    }
                });
                
            } else {
                availableQuantity.text('');
                availablePriceField.data('price', 0);
                updateTotalPrice(); // Actualizar el precio total cuando no se selecciona un consumible
            }
        });

        function updateSaveButtonState(availableQuantity, amount, maxQuantity) {
            var saveButton = $('.save_receipe');
            console.log(maxQuantity);

            if (amount > maxQuantity) {
                availableQuantity.text('{{trans("agroindustria::labors.amountEnteredGreater")}}').css('color', 'red');
                saveButton.prop('disabled', true);
                saveButton.addClass('disabled-button');
                isAnyProductExceeding = true;
                console.log('Deshabilitado');
            } else {
                availableQuantity.text('{{trans("agroindustria::labors.quantityAvailable")}}: ' + maxQuantity).css('color', '#666');
                isAnyProductExceeding = false;
                console.log(isAnyProductExceeding);
                if (!isAnyProductExceeding) {
                    saveButton.prop('disabled', false);
                    saveButton.removeClass('disabled-button');
                } else {
                    saveButton.prop('disabled', true);
                    saveButton.addClass('disabled-button');
                }
            }
        }
        
        function updateTotalLaborPrice() {
            var totalPriceEquipments = 0;
            var totalPriceTools = 0;
            var totalPriceConsumables = 0;
            var totalPriceRecipes = 0;
            var totalExecutor = 0;
            var totalResource = 0;

            $('#form-equipments .equipment').each(function() {
                var totalField = $(this).find('input#price_equipment');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceEquipments += totalPrice;
            });

            $('#form-tools .tools').each(function() {
                var totalField = $(this).find('input#price_tool');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceTools += totalPrice;
            });

            $('#form-executors .collaborators').each(function() {
                var totalField = $(this).find('input#total-executor');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalExecutor += totalPrice;
            });

            // Calcular el total de productos de receta fuera del bucle
            $('.recipe-product').each(function() {
                var totalRecipeField = $(this).find('input#total_price_consumable');
                var totalRecipePrice = parseFloat(totalRecipeField.val()) || 0;
                totalPriceRecipes += totalRecipePrice;
            });

            $('#form-container-resources .resource').each(function() {
                var totalField = $(this).find('input#price_environmental_aspect');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalResource += totalPrice;
                console.log('Recurso: ' + totalResource);
            });


            $('.consumable').each(function() {
                var totalField = $(this).find('input#price_unit_consumable_total');
                var totalPrice = parseFloat(totalField.val()) || 0;

                totalPriceConsumables += totalPrice;
            });

            var total = totalPriceEquipments + totalPriceTools + totalPriceRecipes + totalPriceConsumables + totalExecutor + totalResource;

            $('input[name="total_labor"]').val(total);
        }


        function updateTotalPrice() {
            var totalPrice = 0;
            $('.consumable').each(function() {
                var availableTotal = $(this).find('input#price_unit_consumable_total');
                var availableAmount = $(this).find('input#amount_consumables');
                var priceField = $(this).find('input#price_unit_consumable');
                var amount = parseFloat(availableAmount.val()) || 0;
                var price = parseFloat(priceField.val()) || 0;
                var totalPrice = price * amount;
                availableTotal.val(totalPrice);
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.inventory_select').select2();
        $("#add-equipments").click(function() {
           var newEquipment = '<div class="equipment"><div class="form-group">{!! Form::label("inventories", trans("agroindustria::labors.equipments")) !!}{!! Form::select("equipments[]", $equipment, null, ["class" => "inventory_select", "style" => "width: 200px"]) !!}</div><div class="form-group" style="margin-left: 5px; margin-right: 16px;"><span class="quantity-equipment"></span>{!! Form::label("amount", trans("agroindustria::labors.quantity")) !!}{!! Form::number("amount_equipments[]", null, ["class"=>"form-control", "id" => "amount_equipments"]) !!}</div><div class="form-group">{!! Form::label("price", trans("agroindustria::labors.unitValue")) !!}{!! Form::number("price_unit_equipment", null, ["class"=>"form-control", "id" => "price_unit_equipment", "readonly" => "readonly"]) !!}</div><div class="form-group" style="margin-left: 3px">{!! Form::label("price", "Total") !!}{!! Form::number("price_equipments[]", null, ["class"=>"form-control", "id" => "price_equipment", "readonly" => "readonly"]) !!}</div><button type="button" class="remove-equipments" style="margin-left: 6px">{{trans("agroindustria::labors.delete")}}</button></div>';
           
           // Agregar el nuevo campo al DOM
           $("#form-equipments").append(newEquipment);

           $('.inventory_select:last').select2();
       });

       $('#form-equipments').on('change', '.inventory_select', function() {
            var selectedEquipment = $(this).val();
            var parentElement = $(this).closest('.equipment');
            var priceField = parentElement.find('input#price_unit_equipment');
            var quantityField = parentElement.find('.quantity-equipment');
            if (selectedEquipment) {
                // Realiza una solicitud AJAX para obtener el precio de la herramienta seleccionada
                var url = {!! json_encode(route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.equipments.amounteq', ['equipments' => ':equipments'])) !!}.replace(':equipments', selectedEquipment.toString());
                console.log('Ruta: ' + url);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        if(response.elements.length > 0){
                            var data = response.elements[0];
                            var price = parseFloat(data.price);
                            maxQuantity = parseFloat(data.amount);

                            priceField.val(price);
                            updateTotalPrice(); // Actualizar el precio total cuando se selecciona la herramienta
                            updateSaveButtonState(quantityField, 0, maxQuantity);

                            $('#form-equipments').off('input', 'input#amount_equipments').on('input', 'input#amount_equipments', function() {
                                var amountInput = $(this);
                                var amount = amountInput.val();
                                updateSaveButtonState(quantityField, amount, maxQuantity);
                                updateTotalPrice(); // Actualizar el precio total cuando se modifica la cantidad
                                updateTotalLaborPrice();
                            });
                        }else{
                            quantityField.text('');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        quantityField.text('');
                    }
                });
            } else {
                quantityField.text('');
                priceField.data('price', 0);
                updateTotalPrice(); // Actualizar el precio total cuando no se selecciona una herramienta
                updateTotalLaborPrice();
            }
        });

        function updateSaveButtonState(quantityField, amount, maxQuantity) {
            var saveButton = $('.save_receipe');
            console.log(maxQuantity);

            if (amount > maxQuantity) {
                quantityField.text('{{trans("agroindustria::labors.amountEnteredGreater")}}').css('color', 'red');
                saveButton.prop('disabled', true);
                saveButton.addClass('disabled-button');
                isAnyProductExceeding = true;
                console.log('Deshabilitado');
            } else {
                quantityField.text('{{trans("agroindustria::labors.quantityAvailable")}}: ' + maxQuantity).css('color', '#666');
                isAnyProductExceeding = false;
                console.log(isAnyProductExceeding);
                if (!isAnyProductExceeding) {
                    saveButton.prop('disabled', false);
                    saveButton.removeClass('disabled-button');
                } else {
                    saveButton.prop('disabled', true);
                    saveButton.addClass('disabled-button');
                }
            }
        }

        function updateTotalLaborPrice() {
            var totalPriceEquipments = 0;
            var totalPriceTools = 0;
            var totalPriceConsumables = 0;
            var totalPriceRecipes = 0;
            var totalExecutor = 0;
            var totalResource = 0;

            $('#form-equipments .equipment').each(function() {
                var totalField = $(this).find('input#price_equipment');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceEquipments += totalPrice;
            });

            $('#form-tools .tools').each(function() {
                var totalField = $(this).find('input#price_tool');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceTools += totalPrice;
            });

            $('#form-executors .collaborators').each(function() {
                var totalField = $(this).find('input#total-executor');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalExecutor += totalPrice;
            });

            // Calcular el total de productos de receta fuera del bucle
            $('.recipe-product').each(function() {
                var totalRecipeField = $(this).find('input#total_price_consumable');
                var totalRecipePrice = parseFloat(totalRecipeField.val()) || 0;
                totalPriceRecipes += totalRecipePrice;
            });

            $('#form-container-resources .resource').each(function() {
                var totalField = $(this).find('input#price_environmental_aspect');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalResource += totalPrice;
            });

            
            $('.consumable').each(function() {
                var totalField = $(this).find('input#price_unit_consumable_total');
                var totalPrice = parseFloat(totalField.val()) || 0;

                totalPriceConsumables += totalPrice;
            });

            var total = totalPriceEquipments + totalPriceTools + totalPriceRecipes + totalPriceConsumables + totalExecutor + totalResource;

            $('input[name="total_labor"]').val(total);
        }

        function updateTotalPrice() {
            var totalPrice = 0;
            $('.equipment').each(function() {
                var availableTotal = $(this).find('input#price_equipment');
                var availableAmount = $(this).find('input#amount_equipments');
                var priceField = $(this).find('input#price_unit_equipment');
                var amount = parseInt(availableAmount.val()) || 0;
                var price = parseFloat(priceField.val()) || 0;
                var totalPrice = price * amount;
                availableTotal.val(totalPrice);
            });
        }

       // Eliminar un campo de colaborador
       $("#form-equipments").on("click", ".remove-equipments", function() {
           $(this).closest('.equipment').remove();
       });
    });
</script>

<script>
    $(document).ready(function () {
        // Agregar un nuevo campo de colaborador
        $('.environmental_aspect_select').select2();
        $('.environmental_edit').select2();
        

        $("#add-resources").click(function () {
            var selectedActivity = $('#activity-selected').val();

            var newResource = '<div class="resource">' +
                '<div class="form-group">' +
                '{!! Form::label("environmental_aspect", trans("agroindustria::labors.environmentalAspect")) !!}' +
                '{!! Form::select("environmental_aspect[]", [], null, ["class" => "environmental_aspect_select", "style" => "width: 200px", "placeholder" => trans("agroindustria::labors.selectEnvironmentalAspect")]) !!}' +
                '</div>' +
                '<div class="form-group">' +
                '{!! Form::label("amount_environmental_aspect", trans("agroindustria::labors.quantity")) !!}' +
                '{!! Form::number("amount_environmental_aspect[]", null, ["class"=>"form-control"]) !!}' +
                '</div>' +
                '<div class="form-group">' +
                '{!! Form::label("price_environmental_aspect", trans("agroindustria::labors.price")) !!}' +
                '{!! Form::number("price_environmental_aspect[]", null, ["class"=>"form-control", "id" => "price_environmental_aspect"]) !!}' +
                '</div>' +
                '<button type="button" class="remove-resources">{{trans("agroindustria::labors.delete")}}</button>' +
                '</div>';

            // Agregar el nuevo campo al DOM
            $("#form-resources").append(newResource);

            // Inicializar Select2 para el nuevo campo
            $('.environmental_aspect_select').select2();            
            // Realizar una solicitud AJAX para obtener los aspectos ambientales
            environmental();
        });

        function environmental() {
            // Asignar evento change una vez
            $('#activity-selected').on('change', function () {
                var selectedActivity = $(this).val();
                var url = {!! json_encode(route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.responsibilities', ['activityId' => ':activityId'])) !!}.replace(':activityId', selectedActivity.toString());
                $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    var personId = response.id[0].id;
                    var personName = response.id[0].name;

                    // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                    $('#responsible').val(personName);
                    $('#responsibleId').val(personId);
                    
                    // Añade aquí el código para consultar el tipo de actividad
                    var activityType = {!! json_encode(route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.type', ['type' => ':type'])) !!}.replace(':type', selectedActivity.toString());
                    $.ajax({
                        url: activityType,
                        type: 'GET',
                        success: function(typeResponse) {
                            if (typeResponse.type.length > 0) {
                               
                                $('#total-labor').removeClass('col-md-6').addClass('col-md-12');
                                $('#recipe-field').show();
                                $('#date-expiration-field').show();
                                $('#lot-field').show();
                                $('#amount-production-field').show();
                            } else {
                                $('#total-labor').removeClass('col-md-12').addClass('col-md-6');
                                $('#recipe-field').hide();
                                $('#date-expiration-field').hide();
                                $('#lot-field').hide();
                                $('#amount-production-field').hide();
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
                // Actualizar todas las opciones para cada elemento .environmental_aspect_select
                $('.environmental_aspect_select').each(function () {
                    var url = {!! json_encode(route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.labor.resource', ['activity_id' => ':activity_id'])) !!}.replace(':activity_id', selectedActivity.toString());
                    console.log(url);
                    // Realizar una solicitud AJAX para obtener los aspectos ambientales
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (response) {
                            var options = '<option value="">' + '{{trans("agroindustria::labors.selectEnvironmentalAspect")}}' + '</option>';
                            $.each(response.aspect, function (index, aspect) {
                                options += '<option value="' + aspect.id + '">' + aspect.name + '</option>';
                            });
                            // Actualizar las opciones del campo de aspecto ambiental actual
                            $('.environmental_aspect_select').html(options);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
            });

            // Ejecutar la función al cargar el documento
            $('#activity-selected').trigger('change');
        } 

        $('#form-container-resources').on('input', 'input#price_environmental_aspect', function() {
            updateTotalLaborPrice();
        });
        
        function updateTotalLaborPrice() {
            var totalPriceEquipments = 0;
            var totalPriceTools = 0;
            var totalPriceConsumables = 0;
            var totalPriceRecipes = 0;
            var totalExecutor = 0;
            var totalResource = 0;

            $('#form-equipments .equipment').each(function() {
                var totalField = $(this).find('input#price_equipment');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceEquipments += totalPrice;
            });

            $('#form-tools .tools').each(function() {
                var totalField = $(this).find('input#price_tool');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceTools += totalPrice;
            });

            $('#form-executors .collaborators').each(function() {
                var totalField = $(this).find('input#total-executor');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalExecutor += totalPrice;
            });

            // Calcular el total de productos de receta fuera del bucle
            $('.recipe-product').each(function() {
                var totalRecipeField = $(this).find('input#total_price_consumable');
                var totalRecipePrice = parseFloat(totalRecipeField.val()) || 0;
                totalPriceRecipes += totalRecipePrice;
            });

            $('#form-container-resources .resource').each(function() {
                var totalField = $(this).find('input#price_environmental_aspect');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalResource += totalPrice;
                console.log('Recurso: ' + totalResource);
            });

            $('.consumable').each(function() {
                var totalField = $(this).find('input#price_unit_consumable_total');
                var totalPrice = parseFloat(totalField.val()) || 0;

                totalPriceConsumables += totalPrice;
            });

            var total = totalPriceEquipments + totalPriceTools + totalPriceRecipes + totalPriceConsumables + totalExecutor + totalResource;

            $('input[name="total_labor"]').val(total);
        }


        // Llamar a environmental al cargar el documento
        environmental();
        
        // Eliminar un campo de colaborador
        $("#form-resources").on("click", ".remove-resources", function () {
            $(this).closest('.resource').remove();
        });
    });
</script>
@endsection
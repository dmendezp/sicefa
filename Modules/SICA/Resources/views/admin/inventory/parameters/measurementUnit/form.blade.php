@if (isset($measurementUnit))
    {!! Form::hidden('id', $measurementUnit->id) !!}
@endif
{!! Form::label('name', 'Nombre:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($measurementUnit) ? $measurementUnit->name : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('measurement_unit', 'Tipo de Propiedad:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::select('measurement_unit', getEnumValues('measurementUnit','measurement_unit'), isset($measurementUnit) ? $measurementUnit->measurement_unit : 'medida unitaria minima', 'factor de converción',
        ['class' => 'form-control', 'required']) !!}
</div>
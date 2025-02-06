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

{!! Form::label('abbreviation', 'Abreviación:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('abbreviation', isset($measurementUnit) ? $measurementUnit->abbreviation : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('minimum_unit_measure', 'Medida unitaria minima:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('minimum_unit_measure', isset($measurementUnit) ? $measurementUnit->minimum_unit_measure : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('conversion_factor', 'Factor de converción:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('conversion_factor', isset($measurementUnit) ? $measurementUnit->conversion_factor : null, ['class' => 'form-control', 'required']) !!}
</div>

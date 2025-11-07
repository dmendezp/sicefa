@if (isset($kindOfPurchase))
    {!! Form::hidden('id', $kindOfPurchase->id) !!}
@endif
{!! Form::label('name', 'Nombre:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($kindOfPurchase) ? $kindOfPurchase->name : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('description', 'Descripción:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('description', isset($kindOfPurchase) ? $kindOfPurchase->description : null, ['class' => 'form-control', 'required']) !!}
</div>

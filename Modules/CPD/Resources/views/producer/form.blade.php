@if (isset($producer))
    {!! Form::hidden('producer_id', $producer->id) !!}
@endif
{!! Form::label('name', trans('cpd::producer.F_Text_Name'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($producer) ? $producer->name : null, [
        'class' => 'form-control',
        'required',
        'onkeyup' => 'mayus(this)',
        'id' => 'name'
    ]) !!}
</div>
@if (isset($course))
    {!! Form::hidden('id', $course->id) !!}
@endif


{!! Form::label('code', trans('sica::menu.Fiche'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('code', isset($course) ? $course->code : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('program_id', trans('sica::menu.Formation Program'), ['class' => 'mt-3']) !!}
<div class="form-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-list"></i>
        </span>
        {!! Form::select('program_id', $program, isset($course) ? $course->program_id : null, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione un programa de formación']) !!}
    </div>
</div>

{!! Form::label('person_id', trans('sica::menu.Leading Instructor'), ['class' => 'mt-3']) !!}
<div class="form-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-list"></i>
        </span>
        {!! Form::select('person_id', $instructors, isset($course) ? $course->person_id : null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>

{!! Form::label('star_date', trans('sica::menu.Start Date'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="fa-solid fa-calendar-days"></i>
        </span>
    </div>
    {!! Form::date('star_date', isset($course) ? $course->star_date : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('school_end_date', trans('sica::menu.End Of School Year'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="fa-solid fa-calendar-days"></i>
        </span>
    </div>
    {!! Form::date('school_end_date', isset($course) ? $course->school_end_date : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('star_production_date', trans('sica::menu.Start Productive'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="fa-solid fa-calendar-days"></i>
        </span>
    </div>
    {!! Form::date('star_production_date', isset($course) ? $course->star_production_date : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('end_date', trans('sica::menu.End Date'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::date('end_date', isset($course) ? $course->end_date : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('status', trans('sica::menu.Status'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::select('status', getEnumValues('courses','status'), isset($course) ? $course->status : null, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione un estado']) !!}
</div>

{!! Form::label('deschooling', trans('sica::menu.Modality'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::select('deschooling', getEnumValues('courses','deschooling'), isset($course) ? $course->deschooling : null, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione una modalidad']) !!}
</div>

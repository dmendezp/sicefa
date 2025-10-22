@extends('sigac::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>{{ trans('sigac::visits.title.create_request') }}</h2>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {!! Form::open(['route' => 'sigac.academic_coordination.visitrequest.store', 'method' => 'POST', 'files' => true]) !!}
        @csrf

        {{-- Empresa --}}
        <div class="mb-3">
            {!! Form::label('company_name', trans('sigac::visits.company.label')) !!}
            {!! Form::text('company_name', old('company_name'), [
                'class' => 'form-control',
                'list' => 'companies-list',
                'placeholder' => 'Escriba o seleccione...',
                'required',
            ]) !!}
            <datalist id="companies-list">
                @foreach ($companies as $company)
                    <option value="{{ $company->name }}"></option>
                @endforeach
            </datalist>
        </div>

        {{-- Datos de contacto directo --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                {!! Form::label('contact_name', trans('sigac::visits.company.label')) !!}
                {!! Form::text('contact_name', old('contact_name'), ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="col-md-4 mb-3">
                {!! Form::label('contact_phone', trans('sigac::visits.contact.phone')) !!}
                {!! Form::text('contact_phone', old('contact_phone'), ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="col-md-4 mb-3">
                {!! Form::label('contact_email', trans('sigac::visits.contact.email')) !!}
                {!! Form::email('contact_email', old('contact_email'), ['class'=>'form-control', 'required']) !!}
            </div>
        </div>

        {{-- Tipo de solicitud --}}
        <div class="mb-3">
            <label class="form-label d-block">{{ trans('sigac::visits.request.type.label') }}</label>
            <div class="btn-group">
                <input type="radio" name="type" value="visita" id="type_visita" class="btn-check"
                       {{ old('type','visita') === 'visita' ? 'checked' : '' }}>
                <label class="btn btn-outline-primary" for="type_visita">{{ trans('sigac::visits.request.type.visit') }}</label>

                <input type="radio" name="type" value="practica" id="type_practica" class="btn-check"
                       {{ old('type') === 'practica' ? 'checked' : '' }}>
                <label class="btn btn-outline-primary" for="type_practica">{{ trans('sigac::visits.request.type.practice') }}</label>
            </div>
        </div>

        {{-- Requerimientos (solo si es práctica) --}}
        <div id="req_wrapper" class="mb-3" style="display: none;">
            {!! Form::label('practice_requirements', '¿Qué van a necesitar?') !!}
            {!! Form::textarea('practice_requirements', old('practice_requirements'), [
                'class'=>'form-control',
                'rows'=>3,
                'maxlength'=>2000
            ]) !!}
            <small class="text-muted">Ej.: materiales, laboratorios, equipos, etc.</small>
        </div>

        {{-- Datos adicionales --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                {!! Form::label('number_of_people', trans('sigac::visits.people.count')) !!}
                {!! Form::number('number_of_people', old('number_of_people'), ['class'=>'form-control', 'min'=>1]) !!}
            </div>
            <div class="col-md-6 mb-3">
                {!! Form::label('people_list', trans('sigac::visits.people.list')) !!}
                {!! Form::file('people_list', ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                {!! Form::label('date_received', 'Fecha de recepción') !!}
                {!! Form::date('date_received', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-6 mb-3">
                {!! Form::label('response_date', 'Fecha de respuesta') !!}
                {!! Form::date('response_date', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="mb-3">
            {!! Form::label('response_method', 'Método de respuesta') !!}
            {!! Form::select('response_method', ['Llamada'=>'Llamada','Correo'=>'Correo'], null, [
                'class'=>'form-control',
                'placeholder'=>'Seleccione...',
            ]) !!}
        </div>

        <div class="mb-3">
            {!! Form::label('observations', 'Observaciones') !!}
            {!! Form::textarea('observations', null, ['class'=>'form-control', 'rows'=>3]) !!}
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">{{ trans('sigac::visits.actions.submit') }}</button>
        </div>

        {!! Form::close() !!}
    </div>
</div>

{{-- Script condicional para mostrar requerimientos --}}
<script>
document.addEventListener('DOMContentLoaded', function(){
    const wrapper = document.getElementById('req_wrapper');
    const showIfPractica = () => {
        wrapper.style.display = document.getElementById('type_practica').checked ? '' : 'none';
    };
    document.getElementById('type_visita').addEventListener('change', showIfPractica);
    document.getElementById('type_practica').addEventListener('change', showIfPractica);
    showIfPractica();
});
</script>

{{-- Modal de confirmación --}}
@if(session('created_visit_request'))
@php($vr = session('created_visit_request'))
<div class="modal fade" id="modalSolicitudCreada" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Solicitud registrada</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <dl class="row">
            <dt class="col-sm-4">Empresa</dt>
            <dd class="col-sm-8">{{ $vr['company'] }}</dd>

            <dt class="col-sm-4">Contacto</dt>
            <dd class="col-sm-8">{{ $vr['contact_name'] }} ({{ $vr['contact_email'] }})</dd>

            <dt class="col-sm-4">Teléfono</dt>
            <dd class="col-sm-8">{{ $vr['contact_phone'] }}</dd>

            <dt class="col-sm-4">Tipo</dt>
            <dd class="col-sm-8 text-capitalize">{{ $vr['type'] }}</dd>

            @if($vr['type'] === 'practica')
                <dt class="col-sm-4">Requerimientos</dt>
                <dd class="col-sm-8">{{ $vr['requirements'] }}</dd>
            @endif

            <dt class="col-sm-4">Estado</dt>
            <dd class="col-sm-8"><span class="badge bg-info">{{ $vr['state'] }}</span></dd>

            <dt class="col-sm-4">Fecha de creación</dt>
            <dd class="col-sm-8">{{ $vr['created_at'] }}</dd>
        </dl>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const modal = new bootstrap.Modal(document.getElementById('modalSolicitudCreada'));
    modal.show();
});
</script>
@endif
@endsection

@extends('sigac::layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ trans('sigac::visits.title.create_request') }}</h2>
        </div>

        <div class="card-body">
            {{-- ✅ Errores de validación --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p><strong>Por favor corrige los siguientes errores:</strong></p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {!! Form::open([
                'route' => 'sigac.academic_coordination.visitrequest.store',
                'method' => 'POST',
                'files' => true,
            ]) !!}
            @csrf

            {{-- Empresa --}}
            <div class="mb-3">
                {!! Form::label('company_name', trans('sigac::visits.company.label')) !!}
                {!! Form::text('company_name', old('company_name'), [
                    'class' => 'form-control ' . ($errors->has('company_name') ? 'is-invalid' : ''),
                    'list' => 'companies-list',
                    'placeholder' => 'Escriba o seleccione...',
                    'required',
                ]) !!}
                <datalist id="companies-list">
                    @foreach ($companies as $company)
                        <option value="{{ $company->name }}"></option>
                    @endforeach
                </datalist>
                @error('company_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Datos de contacto directo --}}
            <div class="row">
                <div class="col-md-4 mb-3">
                    {!! Form::label('contact_name', trans('sigac::visits.contact.name')) !!}
                    {!! Form::text('contact_name', old('contact_name'), [
                        'class' => 'form-control ' . ($errors->has('contact_name') ? 'is-invalid' : ''),
                        'required',
                    ]) !!}
                    @error('contact_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    {!! Form::label('contact_phone', trans('sigac::visits.contact.phone')) !!}
                    {!! Form::text('contact_phone', old('contact_phone'), [
                        'class' => 'form-control ' . ($errors->has('contact_phone') ? 'is-invalid' : ''),
                        'required',
                    ]) !!}
                    @error('contact_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    {!! Form::label('contact_email', trans('sigac::visits.contact.email')) !!}
                    {!! Form::email('contact_email', old('contact_email'), [
                        'class' => 'form-control ' . ($errors->has('contact_email') ? 'is-invalid' : ''),
                        'required',
                    ]) !!}
                    @error('contact_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Tipo de solicitud --}}
            <div class="mb-3">
                <label class="form-label d-block">{{ trans('sigac::visits.request.type.label') }}</label>
                <div class="btn-group" role="group">
                    {{-- VISITA --}}
                    <input
                        type="radio"
                        name="type"
                        value="visita"
                        id="type_visita"
                        class="btn-check"
                        {{ old('type', 'visita') === 'visita' ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary" for="type_visita">
                        {{ trans('sigac::visits.request.type.visit') }}
                    </label>

                    {{-- PRÁCTICA --}}
                    <input
                        type="radio"
                        name="type"
                        value="practica"
                        id="type_practica"
                        class="btn-check"
                        {{ old('type') === 'practica' ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary" for="type_practica">
                        {{ trans('sigac::visits.request.type.practice') }}
                    </label>
                </div>
                @error('type')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Requerimientos (solo si es práctica) --}}
            <div id="req_wrapper" class="mb-3" style="display: none;">
                {!! Form::label('practice_requirements', trans('sigac::visits.practice.requirements.label')) !!}
                {!! Form::textarea('practice_requirements', old('practice_requirements'), [
                    'class' => 'form-control ' . ($errors->has('practice_requirements') ? 'is-invalid' : ''),
                    'rows' => 3,
                    'maxlength' => 2000,
                ]) !!}
                <small class="text-muted">
                    {{ trans('sigac::visits.practice.requirements.help') }}
                </small>
                @error('practice_requirements')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Datos adicionales --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    {!! Form::label('number_of_people', trans('sigac::visits.people.count')) !!}
                    {!! Form::number('number_of_people', old('number_of_people'), [
                        'class' => 'form-control ' . ($errors->has('number_of_people') ? 'is-invalid' : ''),
                        'min' => 1,
                    ]) !!}
                    @error('number_of_people')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    {!! Form::label('people_list', trans('sigac::visits.people.list')) !!}
                    {!! Form::file('people_list', [
                        'class' => 'form-control ' . ($errors->has('people_list') ? 'is-invalid' : ''),
                    ]) !!}
                    @error('people_list')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    {!! Form::label('date_received', trans('sigac::visits.dates.received')) !!}
                    {!! Form::date('date_received', old('date_received', \Carbon\Carbon::now()->toDateString()), [
                        'class' => 'form-control ' . ($errors->has('date_received') ? 'is-invalid' : ''),
                    ]) !!}
                    @error('date_received')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    {!! Form::label('response_date', trans('sigac::visits.dates.response')) !!}
                    {!! Form::date('response_date', old('response_date'), [
                        'class' => 'form-control ' . ($errors->has('response_date') ? 'is-invalid' : ''),
                    ]) !!}
                    @error('response_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                {!! Form::label('response_method', trans('sigac::visits.response.method')) !!}
                {!! Form::select(
                    'response_method',
                    [
                        'call' => trans('sigac::visits.response.method.call'),
                        'email' => trans('sigac::visits.response.method.email'),
                    ],
                    old('response_method'),
                    [
                        'class' => 'form-select ' . ($errors->has('response_method') ? 'is-invalid' : ''),
                        'placeholder' => trans('sigac::visits.select.placeholder'),
                    ],
                ) !!}
                @error('response_method')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                {!! Form::label('observations', trans('sigac::visits.observations')) !!}
                {!! Form::textarea('observations', old('observations'), [
                    'class' => 'form-control ' . ($errors->has('observations') ? 'is-invalid' : ''),
                    'rows' => 3,
                ]) !!}
                @error('observations')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    {{ trans('sigac::visits.actions.submit') }}
                </button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    {{-- Script condicional para mostrar requerimientos --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('req_wrapper');
            const txtRequirements = document.getElementById('practice_requirements') || document.querySelector('[name="practice_requirements"]');
            const radioVisita = document.getElementById('type_visita');
            const radioPractica = document.getElementById('type_practica');

            const updateRequirements = () => {
                const isPractica = radioPractica.checked;
                wrapper.style.display = isPractica ? '' : 'none';

                // Opcional: marcar requerido a nivel HTML solo cuando sea práctica
                if (txtRequirements) {
                    if (isPractica) {
                        txtRequirements.setAttribute('required', 'required');
                    } else {
                        txtRequirements.removeAttribute('required');
                    }
                }
            };

            radioVisita.addEventListener('change', updateRequirements);
            radioPractica.addEventListener('change', updateRequirements);

            // Estado inicial (por si viene con old('type'))
            updateRequirements();
        });
    </script>

    {{-- Modal de confirmación (lo tuyo tal cual) --}}
    @if (session('created_visit_request'))
        {{-- ... aquí dejas tu modal tal como lo tenías ... --}}
    @endif
@endsection

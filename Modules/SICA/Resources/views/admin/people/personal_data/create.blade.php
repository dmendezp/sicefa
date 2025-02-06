@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp

@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Datos Personales</h3>
                    </div>
                    <div class="card-body box-profile">
                        {!! Form::open(['url' => route('sica.'.$role_name.'.people.personal_data.store')]) !!}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="text-left">
                                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('modules/sica/images/blanco.png') }}" alt="User profile picture">
                                            <br />
                                            {!! Form::file('avatar', ['class' => 'form-control-file', 'aria-label' => 'fileexample']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Nombre</label>
                                        {!! Form::text('first_name', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese su primer nombre',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Primer Apellido</label>
                                        {!! Form::text('first_last_name', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese su primer apellido',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Segundo Apellido</label>
                                        {!! Form::text('second_last_name', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese su segundo apellido',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Tipo documento</label>
                                        {!! Form::select('document_type', getEnumValues('people', 'document_type'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Número de documento</label>
                                        {!! Form::number('document_number', $doc, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Documento',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Fecha de expedición</label>
                                        {!! Form::date('date_of_issue', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Fecha de nacimiento</label>
                                        {!! Form::date('date_of_birth', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Tipo de sangre</label>
                                        {!! Form::select('blood_type', getEnumValues('people', 'blood_type'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Género</label>
                                        {!! Form::select('gender', getEnumValues('people', 'gender'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Eps</label>
                                        {!! Form::select('eps_id', $eps, null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Estado civil</label>
                                        {!! Form::select('marital_status', getEnumValues('people', 'marital_status'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Tarjeta militar</label>
                                        {!! Form::text('military_card', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Número'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Nivel de sisbén</label>
                                        {!! Form::select('sisben_level', getEnumValues('people', 'sisben_level'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Estrato social</label>
                                        {!! Form::select('socioeconomical_status', getEnumValues('people', 'socioeconomical_status'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        {!! Form::text('address', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Dirección'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Celular #1</label>
                                        {!! Form::number('telephone1', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Número',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Celular #2</label>
                                        {!! Form::number('telephone2', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Número',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Celular #3</label>
                                        {!! Form::number('telephone3', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Número',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Correo personal</label>
                                        {!! Form::email('personal_email', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Correo electrónico'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Correo misena</label>
                                        {!! Form::email('misena_email', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Correo electrónico .misena'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Correo sena</label>
                                        {!! Form::email('sena_email', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Correo electrónico .sena'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Grupo poblacional</label>
                                        {!! Form::select('population_group_id', $population_groups, null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Entidad de pensiones</label>
                                        {!! Form::select('pension_entity_id', $pension_entities, null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                @if (Auth::user()->havePermission('sica.'.$role_name.'.people.personal_data.store'))
                                    {!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
                                @endif
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

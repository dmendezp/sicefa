@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp

@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class=" d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Actualizar Datos Personales</h3>
                    </div>
                    <div class="card-body box-profile">
                        {!! Form::open(['url' => route('sica.'.$role_name.'.people.personal_data.update', $person)]) !!}
                            @method('put')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="text-left">
                                            @if ($person->avatar == '')
                                                <div id="holder" style="max-height:100px;">
                                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('modules/sica/images/blanco.png') }}">
                                                </div>
                                            @else
                                                <div id="holder" style="max-height:100px;">
                                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/' . $person->avatar) }}">
                                                </div>
                                            @endif
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-info">
                                                        <i class="fas fa-image"></i>
                                                    </a>
                                                </span>
                                                {!! Form::hidden('avatar', $person->avatar, ['class' => 'form-control', 'id' => 'thumbnail']) !!}
                                            </div>
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
                                        {!! Form::text('first_name', $person->first_name, [
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
                                        {!! Form::text('first_last_name', $person->first_last_name, [
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
                                        {!! Form::text('second_last_name', $person->second_last_name, [
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
                                        {!! Form::select('document_type', getEnumValues('people', 'document_type'), $person->document_type, [
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
                                        {!! Form::number('document_number', $person->document_number, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Documento',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Fecha de expedición</label>
                                        {!! Form::date('date_of_issue', $person->date_of_issue, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Fecha de nacimiento</label>
                                        {!! Form::date('date_of_birth', $person->date_of_birth, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Tipo de sangre</label>
                                        {!! Form::select('blood_type', getEnumValues('people', 'blood_type'), $person->blood_type, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Género</label>
                                        {!! Form::select('gender', getEnumValues('people', 'gender'), $person->gender, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Eps</label>
                                        {!! Form::select('eps_id', $eps, $person->eps_id, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Estado civil</label>
                                        {!! Form::select('marital_status', getEnumValues('people', 'marital_status'), $person->marital_status, [
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
                                        {!! Form::text('military_card', $person->military_card, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Número'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Nivel de sisbén</label>
                                        {!! Form::select('sisben_level', getEnumValues('people', 'sisben_level'), $person->sisben_level, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Estrato social</label>
                                        {!! Form::select('socioeconomical_status', getEnumValues('people', 'socioeconomical_status'), $person->socioeconomical_status, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        {!! Form::text('address', $person->address, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Dirección'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Celular #1</label>
                                        {!! Form::number('telephone1', $person->telephone1, [
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
                                        {!! Form::number('telephone2', $person->telephone2, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Número',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Celular #3</label>
                                        {!! Form::number('telephone3', $person->telephone3, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Número',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Correo personal</label>
                                        {!! Form::email('personal_email', $person->personal_email, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Correo electrónico'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Correo misena</label>
                                        {!! Form::email('misena_email', $person->misena_email, [
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
                                        {!! Form::email('sena_email', $person->sena_email, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Correo electrónico .sena'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Grupo poblacional</label>
                                        {!! Form::select('population_group_id', $population_groups, $person->population_group_id, [
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
                                        {!! Form::select('pension_entity_id', $pension_entities, $person->pension_entity_id, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                @if (Auth::user()->havePermission('sica.'.$role_name.'.people.personal_data.update'))
                                    {!! Form::submit('Actualizar', ['class' => 'btn btn-success']) !!}
                                @endif
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            //Date picker
            $('#reservationdate').datepicker({
                viewMode: 'years'
            });
        });
    </script>

    <script>
        var route_prefix = "/filemanager";
    </script>

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        //var route_prefix = base+"/filemanager";
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });
    </script>
@endsection

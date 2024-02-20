@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::drivers_update') }}</li>
@endpush

@section('content')
<br>
<div class="content">
    <div class="row justify-content-center">
        <div class="card card-primary card-outline shadow col-md-4">
            <div class="card-header">
                <h3>Modificar Datos Del Conductor</h3>
            </div>
            {{ csrf_field() }}
            {!! Form::open(['url' => route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.drivers.update', $driver->id)]) !!}
            <label for="name">{{ trans('hangarauto::drivers.Name')}}:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="far fa-keyboard"></i>
                    </span>
                </div>
                {!! Form::text('name',(( $diver->last_name)),['class' => 'form-control']) !!}
            </div>
            <label for="name">Email:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="far fa-keyboard"></i>
                    </span>
                </div>
                {!! Form::email('email', (($driver->email)), ['class' => 'form-control']) !!}
            </div>
            <label for="name">{{ trans('hangarauto::drivers.Telephone')}}:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="far fa-keyboard"></i>
                    </span>
                </div>
                {!! Form::text('phone',(( $driver->phone)), ['class' => 'form-control']) !!}
            </div>
            <div class="mt-4 text-center mb-4">
                {!! Form::submit('{{ trans('hangarauto::drivers.Search')}}', ['class' => 'btn btn-success']) !!}
            </div>
        </div>
    </div>
</div>
@stop
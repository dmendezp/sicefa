@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::') }}</li>
@endpush

@section('content')
<br>
<div class="content">
    <div class="row justify-content-center">
        <div class="card card-primary card-outline shadow col-md-4">
            <div class="card-header">
                <h3>Agregar Nuevo Conductor</h3>
            </div>

            <div class="form_search" id="form_search">
                <br>
                {!! Form::open(['url' => 'hangarauto/administrator/conductores/search']) !!}
                <div class="row">
                    <div class="col-md-8">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Numero De Cedula', 'required']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::submit('Buscar', ['class' => 'btn btn-success']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <br>
            </div>
            @if(isset($people))
                @if(is_null($people))
                    <h1>"Documento No Encontrado"</h1>
                @else
                    {!! Form::open(['url' => route('hangarauto.admin.drivers.create'), 'method'=> 'POST']) !!}
                    @csrf
                    <label class="mtop16" for="name">Nombre:</label>
                    <div>
                        {{ $people->first_name." ".$people->first_last_name." ".$people->second_last_name." ".$people->telephone1." ".$people->document." ".$people->misena_email }}

                        {!! Form::hidden('person_id', $people->id, ['class' => 'form-control', 'placeholder' => 'ingrese Su Busqueda', 'required']) !!}
                    </div>
                    {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::vehiculos.Reports') }}</li>
@endpush

@section('content')
<br>
<div class="content">
    <div class="row justify-content-center">
        <div class="card card-primary card-outline shadow col-md-4">
            <div class="card-header">
                <h3>{{ trans('hangarauto::drivers.Add New Driver')}}</h3>
            </div>

            <div class="form_search" id="form_search">
                <br>
                {!! Form::open(['url' => route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.drivers.search')]) !!}
                <div class="row">
                    <div class="col-md-8">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Numero De Cedula', 'required']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::submit(trans('hangarauto::drivers.Search'), ['class' => 'btn btn-success']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <br>
            </div>
            @if(isset($people))
                @if(is_null($people))
                    <h1>{{ trans('hangarauto::drivers.Document Not Found')}}</h1>
                @else
                    {!! Form::open(['url' => route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.drivers.create'), 'method'=> 'POST']) !!}
                    @csrf
                    <label class="mtop16" for="name">{{ trans('hangarauto::drivers.Name')}}:</label>
                    <div>
                        {{ $people->first_name." ".$people->first_last_name." ".$people->second_last_name." ".$people->document_number }}

                        {!! Form::hidden('person_id', $people->id, ['class' => 'form-control', 'placeholder' => 'ingrese Su Busqueda', 'required']) !!}
                    </div>
                    <br>
                    {!! Form::submit( trans('hangarauto::drivers.Save'), ['class' => 'btn btn-success mtop16', 'style' => 'margin-bottom:20px']) !!}
                    {!! Form::close() !!}
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
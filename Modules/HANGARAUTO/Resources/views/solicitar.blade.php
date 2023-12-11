@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::solicitar.Request_Vehicle') }}</li>
@endpush
@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="card card-primary card-outline shadow col-md-4">
                <div class="card-header">
                    <h3>Solicitar Vehiculo</h3>
                </div>
                <br>
                <div class="form_search" id="form_search">
                    {!! Form::open([]) !!}
                    <div class="row">
                        <div class="col-md-8">
                            {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese N° De Documento', 'required']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::submit('Buscar', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
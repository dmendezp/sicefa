@extends('hangarauto::layout.adminhome')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::') }}</li>
@endpush

@section('content')
<br>
<div class="content">
    <div class="row justify-content-center">
        <div class="card card-primary card-outline shadow col-md-4">
            <div class="card-header">
                <h3>Formato De Rechazo De Solicitud</h3>
            </div>
            <form action="{{ route('admin.solicitudes.rechazado') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Correo Del Solicitante:</label><br>
                    {!! Form::email('email', $request->email, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="name">Motivo Del Rechazo:</label>
                    {!! Form::text('why', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <button type="submit" id="btn-contact" class="btn">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
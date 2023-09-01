@extends('bienestar::layouts.adminlte')

@section('content')
<!-- Main Content -->
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-8">
            <div class="card-header">
                <h3 class="card-title">{{ __('Convocations') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {!! Form::open(['route' => 'bienestar.Convocations.store', 'method' => 'POST', 'role' => 'form']) 
                !!}
                <div class="row p-3">
                    <div class="col-md-4">
                        {!! Form::label('title_convocation', 'Titulo Convocatoria:') !!}
                        {!! Form::text('title_convocation', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Convocatoria',
                            'required']) !!}
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('description_convocation', 'Descripcion:') !!}
                        {!! Form::text('description_convocation', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion',
                            'required']) !!}
                    </div>
                
                    <div class="col-md-4">
                        {!! Form::label('food_quotas', 'Cupos alimentacion:') !!}
                        {!! Form::number('food_quotas', null, ['class' => 'form-number', 'placeholder' => 'Digite Cantidad',
                            'required']) !!}
                    </div>
                    <div class="row p-3">
                    <div class="col-md-4">
                        {!! Form::label('transport_quotas','Cupos Transporte:') !!}
                        {!! Form::number('transport_quotas', null, ['class' => 'form-number', 'placeholder' => 'Digite Cantidad',
                            'required']) !!}
                    </div>
                    <hr>
                    <div class="col-md-4">
                        {!! Form::label('start_date', 'Fecha Inicio') !!}
                        {!! Form::date('start_date', null, ['class' => 'form-control',  'required']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('end_date', 'Fecha Final') !!}
                        {!! Form::date('end_date', null, ['class' => 'form-control',  'required']) !!}
                    </div>
                    <div class="col-md-2 align-self-end">
                            <div class="btns mt-3">
                                {!! Form::submit('Guardar',['class'=>'btn btn-success', 'style'=>'background-color: #00FF22;
                                color: black;']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="mtop16">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titulo</th>
                                    <th>Descripcion</th>
                                    <th>Cupos Alimentacion</th>
                                    <th>Cupos Transporte</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Final</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Convocations as $convocation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $convocation->title }}</td>
                                    <td>{{ $convocation->description }}</td>
                                    <td>{{ $convocation->start_date }}</td>
                                    <td>{{ $convocation->end_date }}</td>
                                    <td>{{ $convocation->start_date }}</td>
                                    <td>{{ $convocation->transport_quotas }}</td>
                                    <td>{{ $convocation->food_quotas }}</td>
                                    <td>
                                        <div class="opts">
                                            <button class="btn btn-sm btn-info" data-toggle="modal"
                                            data-target="#mdal-default" data-title="{{ $c->title }}"
                                            data-description="{{ $c->description }}" data-start-date="{{ $c->start_date }}"
                                            data-end-date="{{ $c->start_date }}" data-transport-quotas="{{ $c->transport_quotas }}"
                                            data-food-quotas="{{ $c->food_quotas }}">Editar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /-card -->
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Convocatoria</h4>
                    <button type="button" class="close" data-dismiss="modal" arial-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'bienestar/Convocations/update/id', 'method' => 'PUT']) !!}
                    <div class="row p-4">
                        <div class="col-md-3">
                            {!! Form::text('title', null, ['class'=> 'form-control', 'placeholder' => 'Ingrese Titulo',
                                'required']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion',
                                'required']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::date('start_date', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::date('end_date', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::number('transport_quotas', null, ['class' => 'form-number', 'placeholder' => 'Digite Cantidad',
                                'required']) !!}
                        </div>
                        <div class="col-md-3">
                        {!! Form::number('food_quotas', null, ['class' => 'form-number', 'placeholder' => 'Digite Cantidad',
                                'required']) !!}
                        </div>
                        <div class="col-md-2">
                            <div class="btns">
                                {!! Form::submit('Actualizar',['class' =>'btn btn-success']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal-default').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var description = button.data('description');
            var startDate = button.data('star-date');
            var endDate = button.data('end-date');
            var transportQuotas = button.data('transport-quotas');
            var foodQuotas = button.data('food-quotas');
            var ConvocationsId = button.data('Convocations-id');
            
            var modal = $(this);
            modal.find('[name="title"]').val(title);
            modal.find('[name="description"]').val(description);
            modal.find('[name="start_date"]').val(startDate);
            modal.find('[name="end_date"]').val(endDate);
            modal.find('[name="transport_quotas"]').val(transportQuotas);
            modal.find('[name="food_quotas"]').val(foodQuotas);


            //Pone El Id De La Convocatoria En La Url Del Formulario
            var form = modal.find('form');
            var updateUrl = form.attr('action').replace(/id/g, ConvocationsId);
            form.attr('action', updateUrl);
        });
    });
    
</script>
@endsection
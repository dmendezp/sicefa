@extends('bienestar::layouts.master')

@section('content')
<!-- Main Content -->
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-8">
            <div class="card-header">
                <h3 class="card-title">{{ trans('bienestar::menu.Convocations')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {!! Form::open(['url' => route('cefa.bienestar.Convocations.store'), 'method' => 'POST']) !!}
                @csrf
                <div class="row p-3">
                    <div class="col-md-4">
                        {!! Form::label('title_convocation', 'Titulo Convocatoria:') !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Convocatoria']) !!}
                            @error('title')
                            <span class="text-danger" >{{ $message }}</span>
                            @enderror
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('description', 'Descripcion:') !!}
                        {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion',
                            'required']) !!}
                    </div>
                
                    <div class="col-md-4">
                    <label for="food_quotas">Cupos alimentacion:</label>
                                <input type="number" name="food_quotas" id="food_quotas" class="form-control" placeholder="Digite Cantidad" required maxlength="2" min="1" max="99">
                                <span id="food_quotas-error" class="text-danger"></span>
                    </div>
                    <div class="col-md-4">
                    <label for="transport_quotas">Cupos transporte:</label>
                                <input type="number" name="transport_quotas" id="transport_quotas" class="form-control" placeholder="Digite Cantidad" required maxlength="2" min="1" max="99">
                                <span id="transport_quotas-error" class="text-danger"></span>

                    <div class="col-md-4">
                        {!! Form::label('time_interval', 'Fecha interval') !!}
                        {!! Form::date('time_interval', null, ['class' => 'form-control',  'required']) !!}
                    </div>
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
                                {!! Form::submit('Guardar',['class'=>'btn btn-success', 'style'=>'background-color: #179722;;
                                color: with;']) !!}
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
                                    <th>Intervalo tiempo</th> 
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Convocations as $convocation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $convocation->title }}</td>
                                    <td>{{ $convocation->description }}</td>
                                    <td>{{ $convocation->food_quotas }}</td>
                                    <td>{{ $convocation->transport_quotas }}</td>
                                    <td>{{ $convocation->start_date }}</td>
                                    <td>{{ $convocation->end_date }}</td>
                                    <td>{{ $convocation->time_interval }}</</td>
                                    <td>
                                    <button class="btn btn-sm btn-info edit-button" data-toggle="modal"
                                        data-target="#modal-default" data-id="{{ $convocation->id }}"
                                        data-title="{{ $convocation->title }}"
                                        data-description="{{ $convocation->description }}"
                                        data-food_quotas="{{ $convocation->food_quotas }}"
                                        data-transport_quotas="{{ $convocation->transport_quotas}}"
                                        data-start-date="{{ $convocation->start_date }}"
                                        data-end-date="{{ $convocation->end_date }}"
                                        data-food-quotas="{{ $convocation->time_interval }}">Editar
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
                    {!! Form::open(['url' => 'cefa.bienestar/Convocations/update/id', 'method' => 'PUT']) !!}
                    <div class="row p-4">
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="quota">titulo:</label>
                            {!! Form::text('title', null, ['class'=> 'form-control', 'placeholder' => 'Ingrese Titulo',
                                'required']) !!}
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="quota">descripcion:</label>
                            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion',
                                'required']) !!}
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="food_quotas">Cupos alimentacion:</label>
                                <input type="number" name="food_quotas" id="food_quotas" class="form-control" placeholder="Digite Cantidad" required maxlength="2"min="1" max="99">
                                <span id="food_quotas-error" class="text-danger"></span>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="transport_quotas">Cupos Transporte:</label>
                                <input type="number" name="transport_quotas" id="transport_quotas" class="form-control" placeholder="Digite Cantidad" required maxlength="2" min="1" max="99">
                                <span id="transport_quotas-error" class="text-danger"></span>
                            </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="quota">fecha inicio:</label>
                            {!! Form::date('start_date', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="quota">fecha final:</label>
                            {!! Form::date('end_date', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="quota">intervalo tiempo:</label>
                        {!! Form::date('time_interval', null, ['class' => 'form-control',  'required']) !!}
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
        $('.edit-button').click(function() {
            var button = $(this);
            var title = button.data('title');
            var description = button.data('description');
            var foodQuotas = button.data('food-quotas');
            var transportQuotas = button.data('transport-quotas');
            var startDate = button.data('start-date');
            var endDate = button.data('end-date');
            var timeinterval=button.data('time_interval');
            var convocationId = button.data('id');
            
            var modal = $('#modal-default');
            modal.find('[name="title"]').val(title);
            modal.find('[name="description"]').val(description);
            modal.find('[name="food_quotas"]').val(foodQuotas);
            modal.find('[name="transport_quotas"]').val(transportQuotas);
            modal.find('[name="start_date"]').val(startDate);
            modal.find('[name="end_date"]').val(endDate);
            modal.find('[name="time_interval"]').val(timeinterval);
            
            

            // Actualiza la acción del formulario en el modal
            var form = modal.find('form');
            var updateUrl = form.attr('action').replace('id', convocationId);
            form.attr('action', updateUrl);
        });
    });
</script>


<script>
    //cupos de alimentacion
  document.getElementById('food_quotas').addEventListener('input', function() {
    const food_quotasInput = this.value;
    const food_quotasError = document.getElementById('food_quotas-error');

    // Removemos cualquier caracter no numérico y limitamos la longitud a 2
    const cleanedInput = food_quotasInput.replace(/\D/g, '').substring(0, 2);

    // Verificamos si la entrada contiene exactamente dos números
    if (/^\d{2}$/.test(cleanedInput)) {
        food_quotasError.textContent = ''; // Campo válido, borra el mensaje de error
      this.value = cleanedInput; // Actualizamos el valor del campo
    } else {
      // Muestra El Mensaje De Error
      
    }
  });
  </script>
  <script>
    //cupos de transporte
  document.getElementById('transport_quotas').addEventListener('input', function() {
    const transport_quotasInput = this.value;
    const transport_quotasError = document.getElementById('transport_quotas-error');

    // Removemos cualquier caracter no numérico y limitamos la longitud a 2
    const cleanedInput = transport_quotasInput.replace(/\D/g, '').substring(0, 2);

    // Verificamos si la entrada contiene exactamente dos números
    if (/^\d{2}$/.test(cleanedInput)) {
        transport_quotasError.textContent = ''; // Campo válido, borra el mensaje de error
      this.value = cleanedInput; // Actualizamos el valor del campo
    } else {
      // Muestra El Mensaje De Error
      
    }
  });
  </script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
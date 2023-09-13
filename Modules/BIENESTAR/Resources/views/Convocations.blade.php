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
                        {!! Form::label('title convocation',__('bienestar::menu.title convocation')) !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Convocatoria','id'=>'title_convocation']) !!}
                        <span  id="title_error" class="text-danger" ></span>
                        
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('description',__('bienestar::menu.description')) !!}
                        {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion','id' => 'description']) !!}
                        <span id="description_error" class="text-danger"></span>
                    </div>
                
                    <div class="col-md-4">
                    <label for="food_quotas">{{ trans('bienestar::menu.food quotas')}}</label>
                                <input type="number" name="food_quotas" id="food_quotas" class="form-control" placeholder="Digite Cantidad" required maxlength="2" min="1" max="99">
                                <span id="food_quotas-error" class="text-danger"></span>
                    </div>
                    <div class="col-md-4">
                    <label for="transport_quotas">{{ trans('bienestar::menu.transport quotas')}}</label>
                                <input type="number" name="transport_quotas" id="transport_quotas" class="form-control" placeholder="Digite Cantidad" required maxlength="2" min="1" max="99">
                                <span id="transport_quotas-error" class="text-danger"></span>

                    <div class="col-md-12">
                        {!! Form::label('time interval',__('bienestar::menu.time interval')) !!}
                        {!! Form::date('time interval', null, ['class' => 'form-control',  'required']) !!}
                    </div>
                    </div>
                    <hr>
                    <div class="col-md-4">
                        {!! Form::label('start date', __('bienestar::menu.start date')) !!}
                        {!! Form::date('start date', null, ['class' => 'form-control',  'required']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('end date', __('bienestar::menu.end date')) !!}
                        {!! Form::date('end date', null, ['class' => 'form-control',  'required']) !!}
                    </div>
                    <div class="col-md-2 align-self-end">
                            <div class="btns mt-3">
                                {!! Form::submit(__('bienestar::menu.Save'),['class'=>'btn btn-success', 'style'=>'background-color: #179722;
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
                                    <th>{{ trans('bienestar::menu.title convocation')}}</th>
                                    <th>{{ trans('bienestar::menu.description')}}</th>
                                    <th>{{ trans('bienestar::menu.food quotas')}}</th>
                                    <th>{{ trans('bienestar::menu.transport quotas')}}</th>
                                    <th>{{ trans('bienestar::menu.start date')}}</th>
                                    <th>{{ trans('bienestar::menu.end date')}}</th>
                                    <th>{{ trans('bienestar::menu.time interval')}}</th> 
                                    <th>{{ trans('bienestar::menu.Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Convocations as $convocation)
                                <tr>
                                    <td>{{ $convocation->id }}</td>
                                    <td>{{ $convocation->title }}</td>
                                    <td>{{ $convocation->description }}</td>
                                    <td>{{ $convocation->food_quotas }}</td>
                                    <td>{{ $convocation->transport_quotas }}</td>
                                    <td>{{ $convocation->start_date }}</td>
                                    <td>{{ $convocation->end_date }}</td>
                                    <td>{{ $convocation->time_interval }}</</td>
                                    <td>

                                    <div class="btn-group">
                                     <button class="btn btn-sm btn-info edit-button mr-1" data-toggle="modal"
                                        data-target="#modal-default" data-id="{{ $convocation->id }}"
                                        data-title="{{ $convocation->title }}"
                                        data-description="{{ $convocation->description }}"
                                        data-food_quotas="{{ $convocation->food_quotas }}"
                                        data-transport_quotas="{{ $convocation->transport_quotas}}"
                                        data-start-date="{{ $convocation->start_date }}"
                                        data-end-date="{{ $convocation->end_date }}"
                                        data-food-quotas="{{ $convocation->time_interval }}"><i class="fa fa-edit"></i>
                                     </button>
                                    
                                         <!-- Botón para eliminar -->
                                         {!! Form::open(['route' => ['cefa.bienestar.Convocations.destroy', $convocation->id],
                                        'method' => 'DELETE', 'class' => 'formEliminar', 'style'=> 'display: inline;']) !!}
                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash-alt"></i></button>
                                        {!! Form::close() !!}
                                    </div>
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
                    <h4 class="modal-title">{{ trans('bienestar::menu.Edit convocations')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" arial-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'cefa.bienestar/Convocations/update/id', 'method' => 'PUT','role' => 'form']) !!}
                    <div class="row ">
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="title">{{ trans('bienestar::menu.title convocation')}}</label>
                            {!! Form::text('title', null, ['class'=> 'form-control', 'placeholder' => 'Ingrese Titulo',
                                'required']) !!}
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="quota">{{ trans('bienestar::menu.description')}}</label>
                            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion',
                                'required']) !!}
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="food_quotas">{{ trans('bienestar::menu.food quotas')}}</label>
                                <input type="number" name="food_quotas" id="food_quotas" class="form-control" placeholder="Digite Cantidad" required maxlength="2"min="1" max="99">
                                <span id="food_quotas-error" class="text-danger"></span>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="transport_quotas">{{ trans('bienestar::menu.transport quotas')}}</label>
                                <input type="number" name="transport_quotas" id="transport_quotas" class="form-control" placeholder="Digite Cantidad" required maxlength="2" min="1" max="99">
                                <span id="transport_quotas-error" class="text-danger"></span>
                            </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="quota">{{trans('bienestar::menu.start date')}}</label>
                            {!! Form::date('start_date', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="quota">{{ trans('bienestar::menu.end date')}}</label>
                            {!! Form::date('end_date', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="quota">{{ trans('bienestar::menu.time interval')}}</label>
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
<script>
    // Validación de Titulo Convocatoria
 document.getElementById('title_convocation').addEventListener('input', function() {
    const titleInput = this.value;
    const titleError = document.getElementById('title_error');
    const guardarBtn = document.getElementById('guardarBtn');

    // Verifica si la entrada contiene solo letras
    if (/^[a-zA-Z]+$/.test(titleInput)) {
        titleError.textContent = ''; // Campo válido, borra el mensaje de error
    } else {
        titleError.textContent = 'El título debe contener solo letras'; // Muestra el mensaje de error
    }

    // Verifica si el campo de título está vacío para deshabilitar el botón
    if (titleInput.trim() === '') {
        titleError.textContent = 'Complete el campo'; // Muestra el mensaje de error
        guardarBtn.setAttribute('disabled', 'true'); // Deshabilita el botón
    } else {
        // Verifica si el campo de descripción también está lleno para habilitar el botón
        if (document.getElementById('title_convocation').value.trim() !== '') {
            guardarBtn.removeAttribute('disabled'); // Habilita el botón
        }
    }
  });
</script>
<script>
  // Validación de Descripcion
 document.getElementById('description').addEventListener('input', function() {
    const descriptionInput = this.value;
    const descriptionError = document.getElementById('description_error');
    const guardarBtn = document.getElementById('guardarBtn');

    // No se realiza ninguna validación en este campo, se permite cualquier entrada
    descriptionError.textContent = ''; // Borra el mensaje de error

    // Verifica si el campo de descripción está vacío para deshabilitar el botón
    if (descriptionInput.trim() === '') {
        descriptionError.textContent = 'Complete el campo'; // Muestra el mensaje de error
        guardarBtn.setAttribute('disabled', 'true'); // Deshabilita el botón
    } else {
        // Verifica si el campo de título también está lleno para habilitar el botón
        if (document.getElementById('description').value.trim() !== '') {
            guardarBtn.removeAttribute('disabled'); // Habilita el botón
        }
    }
 });

</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
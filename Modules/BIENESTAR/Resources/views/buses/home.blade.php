@extends('bienestar::layouts.master')

@section('content')
<!-- Main content -->
<div class="container-fluid">
<h1>{{ trans('bienestar::menu.Buses')}} <i class="fas fa-bus"></i></h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-8">
            <!-- /.card-header -->
            <div class="card-body">
            @if(Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.save.buses'))
            {!! Form::open(['route' => 'bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.save.buses', 'method' => 'POST', 'role' => 'form', 'class' => 'formGuardar'])
                !!}
                <div class="row p-4">
                   <div class="col-md-3">
                   
                      <label for="plate">{{ trans('bienestar::menu.Plate')}}</label>
                        <input type="text" name="plate" id="plate" class="form-control" placeholder="{{ trans('bienestar::menu.Enter the plate')}}" required maxlength="6" oninput="this.value = this.value.toUpperCase()">
                        <span id="plate-error" class="text-danger"></span>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('bus_driver',__('bienestar::menu.Driver')) !!}
                        {!! Form::select('bus_driver', $busDrivers, null, ['class' => 'form-control','placeholder' =>
                        'Seleccione...','required']) !!}
                    </div>
                    <div class="col-md-3">
                        <label for="quota">{{ trans('bienestar::menu.Quotas')}}:</label>
                        <input type="number" name="quota" id="quota" class="form-control" placeholder="Ingrese los cupos" required maxlength="2" oninput="validateQuota(this)" min="1" max="99">
                        <span id="quota-error" class="text-danger"></span>
                    </div>
                    <div class="col-md-2 align-self-end">
                        <div class="btns mt-3">
                            {!! Form::submit(__('bienestar::menu.Save'),['class'=>'btn btn-success', 'style'=>'background-color: #179722;
                            color: with;' ]) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                @endif
                <div class="mtop16">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('bienestar::menu.Driver')}}</th>
                                <th>{{ trans('bienestar::menu.Plate')}}</th>
                                <th>{{ trans('bienestar::menu.Quotas')}}</th>
                                <th>{{ trans('bienestar::menu.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buses as $b)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ isset($b->bus_driver) ? $b->bus_driver->name : ''}}</td>
                                <td>{{ $b->plate }}</td>
                                <td>{{ $b->quota }}</td>
                                <td>
                                    <div class="opts">
                                        <button class="btn btn-primary editButton mr-2"  data-toggle="modal"
                                            data-target="#modal-default-{{$b->id}}" data-plate="{{ $b->plate }}"
                                            data-bus-driver="{{ $b->bus_driver }}" data-bus-id="{{ $b->id }}"
                                            data-quota="{{ $b->quota }}"><i class="fa fa-edit"></i>
                                        </button>
                                        <input type="hidden" id="bus_id" name="bus_id" value="{{$b->id}}">

                                        @if (Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.buses'))
                                        {!! Form::open(['route' => ['bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.buses', $b->id],
                                        'method' => 'DELETE','class' => 'formEliminar', 'style' => 'display: inline;']) !!}
                                        <button class="btn btn-danger"type="submit"><i class="fa fa-trash-alt"></i></button>
                                        {!! Form::close() !!}
                                        @endif                                       
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
        <!-- /.card -->
    </div>
</div>

<!-- /.modal -->
@foreach ($buses as $bus)
<div class="modal fade" id="modal-default-{{ $bus->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('bienestar::menu.Edit Bus')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.edit.buses'))
                {!! Form::open( ['route' => ['bienestar.'.getRoleRouteName(Route::currentRouteName()).'.edit.buses', $bus->id], 'method' => 'PUT', 'role' => 'form','class' => 'formEditar']) !!}
                <div class="row p-4">
                <div class="col-md-12">
            <div class="form-group">
                <label for="plate">{{ trans('bienestar::menu.Plate')}}:</label>
                <input type="text" name="plate" id="plate" class="form-control" placeholder="Ingrese La Placa" required maxlength="6" oninput="this.value = this.value.toUpperCase(); validatePlate(this);"value="{{ $bus->plate }}">
                <span id="plate-error" class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
            {!! Form::label('bus_driver',__('bienestar::menu.Driver')) !!}
                {!! Form::select('bus_driver', $busDrivers, null, ['class' => 'form-control', 'required', 'id' => 'bus_driver_select']) !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="quota">{{ trans('bienestar::menu.Quotas')}}:</label>
                {!! Form::number('quota', $bus->quota, ['class' => 'form-control', 'placeholder' => 'Ingrese los cupos', 'required', 'oninput' => 'this.value = this.value.replace(/^0+/g, \'\')', 'onblur' => 'validateQuota(this)']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="btns">
            {!! Form::submit(__('bienestar::menu.Save'),['class'=>'btn btn-success']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    @endif
            </div>
        </div>
    </div>
</div>
@endforeach  
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#modal-default').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var plate = button.data('plate');
            var busDriver = button.data('bus-driver');
            var quota = button.data('quota');
            var busId = button.data('bus-id');
            console.log(busId);

            var modalId = '#modal-default-' + busId;
            var modal = $(modalId);
            modal.modal('show');

            modal.find('[name="plate"]').val(plate);
            modal.find('[name="quota"]').val(quota);
            modal.find('#bus_driver_select').val(busDriver.id);

            var form = modal.find('form');
            var updateUrl = form.attr('action').replace(/id/g, busId);
            form.attr('action', updateUrl);
        });
    });
</script>

<script>
    //placa
    document.getElementById('plate').addEventListener('input', function() {
        var plateInput = this.value;
        var plateError = document.getElementById('plate-error');

        // Verifica si el valor coincide con el patrón de 3 letras seguidas de 3 números
        if (/^[A-Za-z]{3}[0-9]{3}$/.test(plateInput)) {
            plateError.textContent = ''; // Oculta la alerta si es válido
            this.setCustomValidity(''); // Marca el campo como válido
        } else {
            plateError.textContent = 'La placa debe tener 3 letras seguidas de 3 números.';
            this.setCustomValidity('Invalid'); // Marca el campo como inválido
        }
    });
</script>




<script>
    //cupos
    document.getElementById('quota').addEventListener('input', function() {
        const quotaInput = this.value;
        const quotaError = document.getElementById('quota-error');

        // Removemos cualquier caracter no numérico y limitamos la longitud a 2
        const cleanedInput = quotaInput.replace(/\D/g, '').substring(0, 2);

        // Verificamos si la entrada contiene exactamente dos números
        if (/^\d{2}$/.test(cleanedInput)) {
            quotaError.textContent = ''; // Campo válido, borra el mensaje de error
            this.value = cleanedInput; // Actualizamos el valor del campo
        } else {
            // Muestra El Mensaje De Error
        }
    });
</script>

<script>
    //modal de placas
    $(document).ready(function() {
        $('#modal-default').on('show.bs.modal', function(event) {
            // ... (código existente)

            var modal = $(this);

            // Limita el campo de Placa a 6 caracteres
            modal.find('[name="plate"]').on('input', function() {
                var plateInput = this.value;
                var plateError = modal.find('#plate-error');

                if (plateInput.length > 6) {
                    this.value = plateInput.slice(0, 6);
                }
                // Verifica si hay más de 3 letras o 3 números
                var letters = plateInput.match(/[A-Za-z]/g) || [];
                var numbers = plateInput.match(/[0-9]/g) || [];

                if (letters.length > 3 || numbers.length > 3) {
                    plateError.text('Debe ingresar exactamente 3 letras y 3 números').show();
                } else {
                    plateError.hide();
                }
            }); 
        });
    });
</script>
<script>
    //modal del cupos
    $(document).ready(function() {
        $('#modal-default').on('show.bs.modal', function(event) {
            // ... (código existente)

            var modal = $(this);

            // Limita el campo de Cupos a 2 dígitos
            modal.find('[name="quota"]').on('input', function() {
                var quotaInput = this.value;
                var quotaError = modal.find('#quota-error');

                // Removemos cualquier caracter no numérico y limitamos la longitud a 2
                var cleanedInput = quotaInput.replace(/\D/g, '').substring(0, 2);

                // Verificamos si la entrada contiene exactamente dos números y no es igual a "00"
                if (/^\d{2}$/.test(cleanedInput)) {
                    quotaError.text(''); // Campo válido, borra el mensaje de error
                    this.value = cleanedInput; // Actualizamos el valor del campo
                } else {
                    // Muestra El Mensaje De Error
                    quotaError.text('Ingrese 2 dígitos válidos.');
                }
            });
        });
    });
</script>
<script>
    //cupos  de cero
    function validateQuota(input) {
        var quotaValue = input.value;
        var errorElement = document.getElementById('quota-error');

        if (quotaValue === '0') {
            errorElement.textContent = 'Los cupos no pueden ser "0".';
            input.value = ''; // Vaciar el campo
            input.focus(); // Devolver el foco al campo
        } else {
            errorElement.textContent = ''; // Borrar el mensaje de error si no es "0"
        }
    }
</script>
<script>
    //placa en el modal de edición
    document.getElementById('plate_edit').addEventListener('input', function() {
        var plateInput = this.value;
        var plateError = document.getElementById('plate-edit-error');

        // Verifica si el valor coincide con el patrón de 3 letras seguidas de 3 números
        if (/^[A-Za-z]{3}[0-9]{3}$/.test(plateInput)) {
            plateError.textContent = ''; // Oculta la alerta si es válido
            this.setCustomValidity(''); // Marca el campo como válido
        } else {
            plateError.textContent = 'La placa debe tener 3 letras seguidas de 3 números.';
            this.setCustomValidity('Invalid'); // Marca el campo como inválido
        }
    });
</script>
<script>
    //cupos
    document.getElementById('quota_edit').addEventListener('input', function() {
        const quotaInput = this.value;
        const quotaError = document.getElementById('quota-edit-error');

        // Removemos cualquier caracter no numérico y limitamos la longitud a 2
        const cleanedInput = quotaInput.replace(/\D/g, '').substring(0, 2);

        // Verificamos si la entrada contiene exactamente dos números
        if (/^\d{2}$/.test(cleanedInput)) {
            quotaError.textContent = ''; // Campo válido, borra el mensaje de error
            this.value = cleanedInput; // Actualizamos el valor del campo
        } else {
            // Muestra El Mensaje De Error
        }
    });
</script>





@endsection
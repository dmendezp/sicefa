@extends('bienestar::layouts.master')

@section('content')
<!-- Main Content -->
<div class="container-fluid">
    <h1>{{ trans('bienestar::menu.Convocations')}} <i class="fas fa-clipboard-list"></i> </h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-10">
            <!-- /.card-header -->
            <div class="card-body">
                @if(Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.save.convocations'))
                {!! Form::open(['url' => route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.save.convocations'), 'method' => 'POST']) !!}
                @csrf
                <div class="row p-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('name',__('bienestar::menu.Title Convocation')) !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Convocatoria','id'=>'title_convocation']) !!}
                            <span id="name_error" class="text-danger"></span>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('description',__('bienestar::menu.Description')) !!}
                            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion','id' => 'description']) !!}
                            <span id="description_error" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="food_quotas">{{ trans('bienestar::menu.Food Quotas')}}</label>
                        <input type="number" name="food_quotas" id="food_quotas" class="form-control" placeholder="Digite Cantidad" required maxlength="2" min="1" max="999">
                        <span id="food_quotas-error" class="text-danger"></span>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transport_quotas">{{ trans('bienestar::menu.Transport Quotas')}}</label>
                            <input type="number" name="transport_quotas" id="transport_quotas" class="form-control" placeholder="Digite Cantidad" required maxlength="2" min="1" max="999">
                            <span id="transport_quotas-error" class="text-danger"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-3">
                        {!! Form::label('start date', __('bienestar::menu.Start Date')) !!}
                        {!! Form::date('start date', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('end date', __('bienestar::menu.End Date')) !!}
                        {!! Form::date('end date', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="quarter_id">{{ trans('bienestar::menu.Quarter')}}</label>
                            <select class="form-control" name="quarter_id" required>
                                <option value="0">Seleccione...</option>
                                @foreach ($quarters as $quarter)
                                <option value="{{ $quarter->id }}">{{ $quarter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 align-self-end">
                        <div class="d-flex align-items-end">
                            <div class="btns mt-3">
                                {!! Form::submit(__('bienestar::menu.Save'),['class'=>'btn btn-success', 'style'=>'background-color: #179722;
                                color: with;']) !!}
                            </div>
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
                                <th>{{ trans('bienestar::menu.Title Convocation')}}</th>
                                <th>{{ trans('bienestar::menu.Description')}}</th>
                                <th>{{ trans('bienestar::menu.Food Quotas')}}</th>
                                <th>{{ trans('bienestar::menu.Transport Quotas')}}</th>
                                <th>{{ trans('bienestar::menu.Start Date')}}</th>
                                <th>{{ trans('bienestar::menu.End Date')}}</th>
                                <th>{{ trans('bienestar::menu.Quarter')}}</th>
                                <th>{{ trans('bienestar::menu.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($convocations as $convocation)
                            <tr>
                                <td>{{ $convocation->id }}</td>
                                <td>{{ $convocation->name}}</td>
                                <td>{{ $convocation->description }}</td>
                                <td>{{ $convocation->food_quotas }}</td>
                                <td>{{ $convocation->transport_quotas }}</td>
                                <td>{{ $convocation->start_date }}</td>
                                <td>{{ $convocation->end_date}}</td>
                                @foreach ($quarters as $quarter)                                
                                    @if ($quarter->id === $convocation->quarter_id)
                                        <td>{{ $quarter->name }}</td>
                                        @break
                                    @endif
                                @endforeach<td>
                                    <!-- Botón para editar -->
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-info edit-button mr-1" data-toggle="modal" data-target="#editarModal_{{ $convocation->id }}" data-id="{{ $convocation->id }}" data-name="{{ $convocation->name }}" data-description="{{ $convocation->description }}" data-food_quotas="{{ $convocation->food_quotas }}" data-transport_quotas="{{ $convocation->transport_quotas}}" data-start-date="{{ $convocation->start_date }}" data-end-date="{{ $convocation->end_date }}" data-quarter_id="{{ $convocation->quarter_id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <!-- Botón para eliminar -->
                                        @if (Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.convocations'))
                                        {!! Form::open(['route' => ['bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.convocations', $convocation->id],
                                        'method' => 'DELETE', 'class' => 'formEliminar', 'style'=> 'display: inline;']) !!}
                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash-alt"></i></button>
                                        {!! Form::close() !!}
                                        @endif
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

<!-- /-modal -->
@foreach($convocations as $convocation)
<div class="modal fade" id="editarModal_{{ $convocation->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('bienestar::menu.Edit Convocations')}}</h4>
                <button type="button" class="close" data-dismiss="modal" arial-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.edit.convocations'))
                {!! Form::model('', ['route' => ['bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.edit.convocations', $convocation->id], 'method' => 'PUT', 'role' => 'form']) !!}
                <div class="row p-3">
                    <input type="hidden" name="convocation_id" id="convocation_id">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">{{trans('bienestar::menu.Title Convocation')}}</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $convocation->name) }}" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">{{trans('bienestar::menu.Description')}}</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $convocation->description) }}" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="food_quotas">{{trans('bienestar::menu.Food Quotas')}}</label>
                            <input type="text" name="food_quotas" id="food_quotas" class="form-control" value="{{ old('food_quotas', $convocation->food_quotas) }}" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="transport_quotas">{{trans('bienestar::menu.Transport Quotas')}}</label>
                            <input type="text" name="transport_quotas" id="transport_quotas" class="form-control" value="{{ old('transport_quotas', $convocation->transport_quotas) }}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="start_date">{{trans('bienestar::menu.Start Date')}}</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $convocation->start_date) }}" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="end_date">{{ trans('bienestar::menu.end date')}}</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $convocation->end_date) }}" required>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="quarter_id">{{ trans('bienestar::menu.Quarter')}}</label>
                            <select class="form-control" name="quarter_id" required>
                                @foreach ($quarters as $quarter)
                                <option value="{{ $quarter->id }}" {{ $quarter->id == $convocation->quarter_id ?'selected' : '' }}>
                                    {{ $quarter->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="btns">
                        {!! Form::submit(__('bienestar::menu.Save'),['class'=>'btn btn-success', 'style'=>'background-color: #179722;color: with;']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endforeach
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        // Add a click event handler to the edit button
        $(".edit-button").click(function() {
            // Get the data attributes from the button
            var id = $(this).data("id");
            var name = $(this).data("name"); // Obtener el nombre del botón
            var description = $(this).data("description");
            var food_quotas = $(this).data("food_quotas");
            var transport_quotas = $(this).data("transport_quotas");
            var start_date = $(this).data("start-date");
            var end_date = $(this).data("end-date");
            var quarter_id = $(this).data("quarter_id");

            // Populate the form fields with the data
            $("#modal-default #convocation_id").val(id); // Establecer el id en el campo oculto
            $("#modal-default #name").val(name); // Actualizar el campo de nombre con el nombre obtenido
            $("#modal-default #description").val(description);
            $("#modal-default #food_quotas").val(food_quotas);
            $("#modal-default #transport_quotas").val(transport_quotas);
            $("#modal-default #start_date").val(start_date);
            $("#modal-default #end_date").val(end_date);
            $("#modal-default select[name='quarter_id']").val(quarter_id);

            // Set the form action URL to include the record ID for editing
            $("#modal-default form").attr("action", "{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.convocations', '') }}/" + id);

            // Show the modal
            $("#modal-default").modal("show");
        });
    });
</script>


<script>
    //cupos de alimentacion
    document.getElementById('food_quotas').addEventListener('input', function() {
        const food_quotasInput = this.value;
        const food_quotasError = document.getElementById('food_quotas-error');

        // Removemos cualquier caracter no numérico y limitamos la longitud a 2
        const cleanedInput = food_quotasInput.replace(/\D/g, '').substring(0, 3);

        // Verificamos si la entrada contiene exactamente dos números
        if (/^\d{3}$/.test(cleanedInput)) {
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
        const cleanedInput = transport_quotasInput.replace(/\D/g, '').substring(0, 3);

        // Verificamos si la entrada contiene exactamente dos números
        if (/^\d{3}$/.test(cleanedInput)) {
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


@endsection
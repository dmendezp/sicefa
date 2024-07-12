@extends('sigac::layouts.master')
@section('content')
<h2>{{ trans('agrocefa::movements.Entry_Form') }}</h2>  

<div class="container" style="margin-left: 5px">
    <div class="card" style="width: 110%">
        <div class="card-body">
            {!! Form::open(['route' => 'sigac.instructor.environmentcontrol.environment_inventory_movement.entrance.store', 'method' => 'POST']) !!}
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('date', trans('agrocefa::movements.Date')) !!}
                        {!! Form::text('date', $datenow, ['class' => 'form-control', 'required', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('user_id', trans('agrocefa::movements.Responsibility')) !!}
                        {!! Form::select('user_id', $person, null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>
                    
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card" id="card">
                        <div class="card-header" id="card_header">
                            {{ trans('agrocefa::movements.Delivery') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('deliverywarehouse', trans('agrocefa::movements.Warehouse_That_Delivers')) !!}
                                {!! Form::select('deliverywarehouse', $warehouses, null, ['class' => 'form-control', 'required' , 'readonly' => 'readonly'] ) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" id="card">
                        <div class="card-header" id="card_header">
                            {{ trans('agrocefa::movements.Receive') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('receivewarehouse', trans('Ambiente Recibe')) !!}
                                {!! Form::select('receivewarehouse', $environments, null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    {!! Form::label('observation', trans('agrocefa::movements.Observation')) !!}
                    {!! Form::textarea('observation', null,  ['class' => 'form-control', 'style' => 'max-height: 100px;']) !!}
                </div>
            </div>
            <!-- Agregar la tabla dinámica -->
            <div class="form-group">
                <h3>{{ trans('agrocefa::movements.Elements')}}</h3>
                <div class="table-responsive">
                    <table id="productTable" class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>{{ trans('agrocefa::movements.1T_Name_Of_The_Element') }}</th>
                                <th>{{ trans('agrocefa::movements.1T_Amount') }}</th>
                                <th>{{ trans('agrocefa::movements.1T_Price') }}</th>
                                <th>{{ trans('agrocefa::movements.1T_Lot') }}</th>
                                <th>{{ trans('agrocefa::movements.1T_Stock') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas de la tabla se agregarán dinámicamente aquí -->
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" id="addProduct">{{ trans('agrocefa::movements.Btn_Add_Element') }}</button>
            </div>
            <br>
            {!! Form::submit( trans('agrocefa::movements.Btn_Register_Entrance'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <!-- Div para mostrar notificaciones -->
    <div id="notification" class="alert alert-danger" style="display: none;"></div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        var productTable = $('#productTable tbody');
        var elements = {!! json_encode($elements) !!};
        var productsData = [];

        // Función para agregar una nueva fila de producto
        function addProductRow() {
            var newRow = $('<tr class="product-row">');
            newRow.html('<td><input type="hidden" id="product-name" class="product-name" name="product-name[]"></td>' +
                '<td class="col-2"><select id="product-id" class="form-control product-id" name="product-id[]" required></select><div class="product-measurement-unit"></div></td>' +
                '<td class="col-3"><input type="number" id="product-quantity" class="form-control product-quantity campo" name="product-quantity[]" placeholder="Cantidad"><span class="quantity-message"></span></td>' +
                '<td class="col-2"><input type="text" id="product-price" class="form-control product-price campo" name="product-price[]" placeholder="$"></td>' +
                '<td class="col-2"><input type="text" id="product-lot" class="form-control product-lot campo" name="product-lot[]" placeholder="Lote #"></td>' +
                '<td class="col-2"><input type="text" id="product-stock" class="form-control product-stock campo" name="product-stock[]" placeholder="Stock"></td>'
                
            );
            // Llenar el select de nombre de producto en la nueva fila
            var productNameSelect = newRow.find('.product-id');
            productNameSelect.append('<option value="">{{trans('agrocefa::movements.Placeholder_Element')}}</option>');

            // Iterar sobre los elementos y agregar las opciones al menú desplegable
            $.each(elements, function(index, element) {
                productNameSelect.append('<option value="' + element.id + '">' + element.name + '</option>');
            });

            // Inicializar Select2 en el campo de selección de herramientas
            newRow.find('#product-id').select2({
                placeholder: "Buscar producto...",
                allowClear: true // Esto permite borrar la selección actual
            });

            // Agregar la fila a la tabla
            productTable.append(newRow);

        
             // Agregar los campos adicionales debajo de la fila
             newRow.after(
                '<tr class="product-row2">' +
                '<th></th>' +
                '<th>{{ trans('agrocefa::movements.1T_Category') }}</th>' +
                '<th>{{ trans('Codigo Inventario') }}</th>' +
                '<th>{{ trans('agrocefa::movements.1T_Destination') }}</th>' +
                '<th>{{ trans('agrocefa::movements.1T_Entry') }}</th>' +
                '<th>{{ trans('agrocefa::movements.1T_Expiration') }}</th>' +
                '<th></th>' +
                '</tr>' +
                '<tr class="product-row3">' +
                '<td ></td>' +
                '<td class="col-2"><input type="text" id="product-category" class="form-control product-category campo" name="product-category[]" readonly></td>' +
                '<td class="col-2"><input type="number" id="product-code" class="form-control product-code campo" name="product-code[]" placeholder="Codigo" ></td>' +
                '<td class="col-2"><select id="product-destination" class="form-control product-destination campo" name="product-destination[]" required>' +
                '<option>Seleccione el destino</option>' +
                '<option value="Producción">Producción</option>' +
                '<option value="Formación">Formación</option>' +
                '</select></td>' +
                '<td class="col-1"><input type="date" id="product-entry" class="form-control product-entry" name="product-entry[]"></td>' +
                '<td class="col-1"><input type="date" id="product-expiration" class="form-control product-expiration" name="product-expiration[]"></td>' +
                '<td class="col-2"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button></td>' +
                '</tr>'
            );
        }

        // Llamar a addProductRow al cargar la página para generar la primera fila
        addProductRow();

        // Manejador de eventos para el botón Agregar Producto
        $('#addProduct').click(function () {
            var lastRow = productTable.find('tr.product-row:last');
            var lastRow3 = productTable.find('tr.product-row3:last');

            if (lastRow.find('#product-name').val() && lastRow.find('#product-quantity').val() && lastRow.find('#product-price').val() && lastRow3.find('#product-category').val() && lastRow3.find('#product-destination').val()) {
                addProductRow();
            } else {
                showNotification("Por favor, complete todos los campos de la fila actual antes de agregar otra.", true);
            }
        });

        // Manejador de eventos para cambiar la unidad de medida, la categoría, la cantidad y el precio al seleccionar un elemento
        productTable.on('change', '.product-id', function () {
            var currentRow = productTable.find('tr.product-row:last');
            var currentRow3 = productTable.find('tr.product-row3:last');
            var selectedElementId = $(this).find('option:selected').val();

            // Realizar una solicitud AJAX para obtener los datos del elemento
            $.ajax({
                url: '{{ route('agrocefa.passant.movements.getinformationelement') }}',
                method: 'GET',
                data: { element: selectedElementId },
                success: function (response) {
                    console.log(response);
                    var measurementUnitField = $('.product-measurement-unit');
                    var categoryField = currentRow3.find('#product-category');
                    var nameField = currentRow.find('#product-name');

                    measurementUnitField.text('Unidad de medida : ' + response.unidad_medida ||
                        'Unidad de medida no encontrada');
                    categoryField.val(response.categoria || 'Categoría no encontrada');
                    nameField.val(response.name || 'Nombre no encontrada');
                },
                error: function() {
                    var measurementUnitField = $('.product-measurement-unit');
                    var categoryField = currentRow3.find('#product-category');
                    var nameField = currentRow.find('#product-name');

                    measurementUnitField.text('Error al obtener la unidad de medida');
                    categoryField.val('Error al obtener la categoría');
                    nameField.val('Error al obtener el nombre');
                }
            });
        });

        // Manejador de eventos para eliminar productos con SweetAlert
        productTable.on('click', '.removeProduct', function () {
            var currentRow = productTable.find('tr.product-row:last');
            var currentRow2 = productTable.find('tr.product-row2:last');
            var currentRow3 = productTable.find('tr.product-row3:last');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar'
            }).then(function (result) {
                if (result.isConfirmed) {
                    // Si el usuario confirma, eliminar la fila y actualizar los datos
                    currentRow.remove();
                    currentRow2.remove();
                    currentRow3.remove();
                    $('.product-id').select2({
                    });
                }
            });
        });

        // Funcion para mostrar las alertas
        function showNotification(message, isError = false) {
            const notificationElement = document.getElementById("notification");
            notificationElement.textContent = message;

            if (isError) {
                notificationElement.classList.add("alert-danger");
            } else {
                notificationElement.classList.remove("alert-danger");
            }

            notificationElement.style.display = "block";

            // Desaparecer después de 3 segundos (puedes ajustar este tiempo)
            setTimeout(function() {
                notificationElement.style.display = "none";
            }, 3000);
        }
    });
</script>
@endpush
<style>
    #productTable th:nth-child(1),
    #productTable td:nth-child(1) {
        display: none;
    }
</style>
@endsection

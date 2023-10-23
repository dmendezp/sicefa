@extends('agrocefa::layouts.master')

@section('content')

@if (session('success'))
    <script>
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Registro Exitoso',
        showConfirmButton: false,
        timer: 1500,
        customClass: {
            popup: 'my-custom-popup-class', 
        },
        onOpen: () => {

            const popup = document.querySelector('.my-custom-popup-class');
            if (popup) {
            popup.style.display = 'flex';
            popup.style.alignItems = 'center';
            popup.style.justifyContent = 'center';
            }
        },
        });
    </script>
@endif
@if (session('error'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 15000,
                customClass: {
                    popup: 'my-custom-popup-class', 
                },
                onOpen: () => {
                    
                    const popup = document.querySelector('.my-custom-popup-class');
                    if (popup) {
                        popup.style.display = 'flex';
                        popup.style.alignItems = 'center';
                        popup.style.justifyContent = 'center';
                    }
                },
            });
        </script>
    @endif
<h2>{{trans('agrocefa::movements.Entry_Form')}}</h2>

<div class="container" style="margin-left: 5px">
    <!-- Div para mostrar notificaciones -->
    <div id="notification" class="alert alert-danger" style="display: none;"></div>
    <div class="card" style="width: 105%">
        <div class="card-body">
            {!! Form::open(['route' => 'agrocefa.registerentrance', 'method' => 'POST']) !!}
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('date', trans('agrocefa::movements.Date')) !!}
                        {!! Form::text('date', $date, ['class' => 'form-control', 'required', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('user_id', trans('agrocefa::movements.Responsibility')) !!}
                        {!! Form::select('user_id', $people, null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
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
                                {!! Form::select('deliverywarehouse', $werhousentrance->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
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
                                {!! Form::label('receivewarehouse', trans('agrocefa::movements.Warehouse_That_Receives')) !!}
                                {!! Form::select('receivewarehouse', $warehouseData->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
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
                <table id="productTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('agrocefa::movements.1T_Name_Of_The_Element') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Measurement_Unit') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Amount') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Price') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Lot') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Stock') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Category') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Destination') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Actions') }}</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Filas de la tabla se agregarán dinámicamente aquí -->
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" id="addProduct">{{ trans('agrocefa::movements.Btn_Add_Element') }}</button>
            </div>
            <br>
            {!! Form::submit( trans('agrocefa::movements.Btn_Register_Entrance'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    console.log("Contenido de  elements:", {!! json_encode($elements) !!});
</script>
<style>
    #productTable th:nth-child(1),
    #productTable td:nth-child(1) {
        display: none;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var productTable = $('#productTable tbody');
        var elements = {!! json_encode($elements) !!};
        var productsData = [];

        // Función para agregar una nueva fila de producto
        function addProductRow() {
            var newRow = $('<tr class="product-row">');
                newRow.html('<td><input type="hidden" id="product-name" class="product-name" name="product-name[]"></td>' +
                    '<td class="col-2"><select id="product-id" class="form-control product-id" name="product-id[]" required></select></td>' +
                    '<td><input type="text" id="product-measurement-unit" class="form-control product-measurement-unit" name="product-measurement-unit[]" readonly></td>' +
                    '<td class="col-1.5"><input type="number" id="product-quantity" class="form-control product-quantity" name="product-quantity[]" placeholder="Cantidad"><span class="quantity-message"></span></td>' +
                    '<td><input type="text" id="product-price" class="form-control product-price" name="product-price[]"></td>' +
                    '<td><input type="text" id="product-lot" class="form-control product-lot" name="product-lot[]" placeholder="Lote #"></td>' +
                    '<td><input type="text" id="product-stock" class="form-control product-stock" name="product-stock[]" placeholder="Stock"></td>' +
                    '<td><input type="text" id="product-category" class="form-control product-category" name="product-category[]" readonly></td>' +
                    '<td class="col-1.5"><select id="product-destination" class="form-control product-destination" name="product-destination[]" required>' +
                    '<option value="Producción">Producción</option>' +
                    '<option value="Formación">Formación</option>' +
                    '</select></td>' +
                    '<td><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>'
                );

            // Llenar el select de nombre de producto en la nueva fila
            var productNameSelect = newRow.find('.product-id');
            productNameSelect.append('<option value="">{{trans('agrocefa::movements.Placeholder_Element')}}</option>');

            // Iterar sobre los elementos y agregar las opciones al menú desplegable
            $.each(elements, function(index, element) {
                productNameSelect.append('<option value="' + element.id + '">' + element.name + '</option>');
            });

            // Agregar la fila a la tabla
            productTable.append(newRow);

        }

        // Llamar a addProductRow al cargar la página para generar la primera fila
        addProductRow();

        // Manejador de eventos para el botón Agregar Producto
        $('#addProduct').click(function () {
            var lastRow = productTable.find('tr.product-row:last');

            if (lastRow.find('#product-name').val() && lastRow.find('#product-measurement-unit').val() && lastRow.find('#product-quantity').val() && lastRow.find('#product-price').val() && lastRow.find('#product-category').val() && lastRow.find('#product-destination').val()) {
                addProductRow();
            } else {
                showNotification("Por favor, complete todos los campos de la fila actual antes de agregar otra.", true);
            }
        });

        // Manejador de eventos para eliminar productos
        productTable.on('click', '.removeProduct', function () {
            $(this).closest('tr').remove();
            updateProductsData();
        });

        // Manejador de eventos para cambiar la unidad de medida, la categoría, la cantidad y el precio al seleccionar un elemento
        productTable.on('change', '.product-id', function () {
            var currentRow = $(this).closest('tr');
            var selectedElementId = $(this).find('option:selected').val();

            // Realizar una solicitud AJAX para obtener los datos del elemento
            $.ajax({
                url: '{{ route('agrocefa.obtenerdatos') }}',
                method: 'GET',
                data: { element: selectedElementId },
                success: function (response) {
                    console.log(response);
                    var measurementUnitField = currentRow.find('#product-measurement-unit');
                    var categoryField = currentRow.find('#product-category');
                    var nameField = currentRow.find('#product-name');
                    var destinationField = currentRow.find('#product-destination');


                    measurementUnitField.val(response.unidad_medida ||
                        'Unidad de medida no encontrada');
                    categoryField.val(response.categoria || 'Categoría no encontrada');
                    nameField.val(response.name || 'Nombre no encontrada');
                    destinationField.val(response.destination || 'Destino no encontrada');


                },
                error: function() {
                    var measurementUnitField = currentRow.find('#product-measurement-unit');
                    var categoryField = currentRow.find('#product-category');
                    var nameField = currentRow.find('#product-name');
                    var destinationField = currentRow.find('#product-name');

                    measurementUnitField.val('Error al obtener la unidad de medida');
                    categoryField.val('Error al obtener la categoría');
                    nameField.val('Error al obtener el nombre');
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



@endsection

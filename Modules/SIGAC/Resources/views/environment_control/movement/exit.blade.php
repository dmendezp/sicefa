@extends('sigac::layouts.master')
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
    <h2>{{ trans('agrocefa::movements.Exit_Form') }}</h2>

    <div class="container" id="containermovements">
        <!-- Div para mostrar notificaciones -->
        <div id="notification" class="alert alert-danger" style="display: none;"></div>
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'sigac.instructor.environmentcontrol.environment_inventory_movement.exit.store', 'method' => 'POST']) !!}
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('date', trans('agrocefa::movements.Date')) !!}
                            {!! Form::text('date', old('date', $datenow), ['class' => 'form-control', 'required', 'readonly' => 'readonly']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('user_id', trans('agrocefa::movements.Responsible_Recipient')) !!}
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
                                    {!! Form::label('deliverywarehouse', trans('Ambiente Entrega')) !!}
                                    {!! Form::select(
                                        'deliverywarehouse',
                                        $environments,
                                        old('deliverywarehouse'),
                                        ['class' => 'form-control', 'required'],
                                    ) !!}
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
                                    {!! Form::select('receivewarehouse', $environments, old('receivewarehouse'), [
                                        'class' => 'form-control',
                                        'required',
                                        'id' => 'receivewarehouse',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('observation', trans('agrocefa::movements.Observation')) !!}
                            {!! Form::textarea('observation', old('observation'), [
                                'class' => 'form-control',
                                'style' => 'max-height: 100px;',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <br>
                <!-- Agregar la tabla dinámica -->
                <div class="form-group">
                    <h3 id="title">{{ trans('agrocefa::movements.Elements') }}</h3>
                    <div class="table-responsive">
                        <table id="productTable" class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ trans('agrocefa::movements.1T_Name_Of_The_Element') }}</th>
                                    <th>{{ trans('agrocefa::movements.1T_Measurement_Unit') }}</th>
                                    <th>{{ trans('agrocefa::movements.1T_Amount') }}</th>
                                    <th>{{ trans('agrocefa::movements.1T_Price') }}</th>
                                    <th>{{ trans('agrocefa::movements.1T_Category') }}</th>
                                    <th>{{ trans('agrocefa::movements.1T_Destination') }}</th>
                                    <!-- Agregar la columna de Destino -->
                                    <th>{{ trans('agrocefa::movements.1T_Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas de la tabla se agregarán dinámicamente aquí -->
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-primary"
                        id="addProduct">{{ trans('agrocefa::movements.Btn_Add_Element') }}</button>
                </div>

                <br>
                {!! Form::submit(trans('agrocefa::movements.Btn_Register_Exit'), [
                    'class' => 'btn btn-primary',
                    'id' => 'registerButton',
                ]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>
        console.log("Contenido de  elements:", {!! json_encode($elements) !!});
    </script>
    <style>
        /* Agrega esta regla CSS para ocultar la columna */
        #productTable th:nth-child(1),
        #productTable td:nth-child(1) {
            display: none;
        }
    </style>

    <script>
        $(document).ready(function() {
            var productTable = $('#productTable tbody');
            var elements = {};
            var warehouses = {}; // Objeto para almacenar las bodegas
            var selectedElements = {}; // Objeto para mantener un registro de elementos seleccionados en cada fila
            var newRow;

            // Llamar a addProductRow al cargar la página para generar la primera fila
            addProductRow();

            // Función para agregar una nueva fila de producto
            function addProductRow() {
                newRow = $('<tr class="product-row">');
                newRow.html(
                    '<td><input type="hidden" id="product-name" class="product-name" name="product-name[]"><input type="hidden" id="product-lot" class="product-lot" name="product-lot[]"></td>' +
                    '<td class="col-2"><select id="product-id" class="form-control product-id" name="product-id[]" required></select><input type="hidden" id="product-element" class="product-element" name="product-element[]"></td>' +
                    '<td><input type="text" id="product-measurement-unit" class="form-control product-measurement-unit" name="product-measurement-unit[]" readonly><input type="hidden" id="product-stock" class="product-stock" name="product-stock[]"></td>' +
                    '<td class="col-2"><input type="number" id="product-quantity" class="form-control product-quantity" name="product-quantity[]" placeholder="Cantidad"><span class="quantity-message"></span></td>' +
                    '<td><input type="text" id="product-price" class="form-control product-price" name="product-price[]" readonly></td>' +
                    '<td><input type="text" id="product-category" class="form-control product-category" name="product-category[]" readonly></td>' +
                    '<td class="col-2"><input type="text" id="product-destination" class="form-control product-destination" name="product-destination[]" readonly></td>' +
                    '<td class="col-1"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>'
                );

                // Inicializar Select2 en el campo de selección de herramientas
                    newRow.find('#product-id').select2({
                        placeholder: "Buscar producto...",
                        allowClear: true // Esto permite borrar la selección actual
                    });

                // Agregar la fila a la tabla
                productTable.append(newRow);


            }

            // Manejador de eventos para eliminar productos con SweetAlert
            productTable.on('click', '.removeProduct', function () {
                var currentRow = $(this).closest('tr');

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
                        updateProductsData();
                    }
                });
            });

            // Manejador de eventos para el cambio en la bodega
            $('#deliverywarehouse').on('change', function() {
                var selectedenvironmentId = $(this).val(); // Obtener el ID de la bodega seleccionada

                // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
                $.ajax({
                    url: '{{ route('sigac.instructor.environmentcontrol.environment_inventory_movement.exit.searchelement') }}', // Reemplaza 'agrocefa.obtenerelementos' con la ruta adecuada
                    method: 'GET', // Puedes usar GET u otro método según tu configuración
                    data: {
                        environment: selectedenvironmentId
                    }, // Enviar el ID seleccionado como parámetro
                    success: function(response) {
                        // Manejar la respuesta de la solicitud AJAX aquí
                        console.log('Respuesta de la solicitud elementos:', response);

                        // Almacenar la lista de elementos en la variable "elements"
                        elements = response;

                        // Obtener el campo de selección de productos de la última fila
                        var productNameSelect = $('.product-id:last');
                        var productName = $('.product-name');

                        productNameSelect.empty(); // Vaciar las opciones actuales

                        // Agregar la opción predeterminada "Seleccione el elemento"
                        productNameSelect.append(new Option('Seleccione el elemento', ''));

                        // Iterar sobre la respuesta JSON y agregar las opciones al campo de selección
                        $.each(response, function(index, element) {
                            // Agregar una nueva opción con el atributo "value" como el ID del elemento y "name" como texto
                            console.log(element.name);
                            productNameSelect.append(new Option(element.name, element
                                .id));
                            productName.val(element.name || '');

                            // Actualizar los atributos "name" de otros campos según sea necesario
                            var currentRow = productNameSelect.closest(
                                'tr.product-row');

                            $('#product-element').val(element.element_id);

                            currentRow.find('.product-measurement-unit').attr('name',
                                'product-measurement-unit[]');
                            currentRow.find('.product-price').attr('name',
                                'product-price[]');
                            currentRow.find('.product-category').attr('name',
                                'product-category[]');
                            currentRow.find('.product-destination').attr('name',
                                'product-destination[]');
                        });
                    },
                    error: function() {
                        // Manejar errores si la solicitud AJAX falla
                        console.error('Error en la solicitud AJAX');
                    }
                });
            });

            // Manejador de eventos para el botón Agregar Producto
            $('#addProduct').click(function() {
                var lastRow = productTable.find('tr.product-row:last');

                if (lastRow.find('#product-id').val() && lastRow.find('#product-measurement-unit').val() &&
                    lastRow.find('#product-quantity').val() && lastRow.find('#product-price').val() &&
                    lastRow.find('#product-category').val() && lastRow.find('#product-destination').val()) {
                    addProductRow();

                    // Obtener el elemento seleccionado en la fila anterior
                    var selectedElementId = selectedElements[lastRow.index()];

                    // Llenar el campo de selección de productos de esta fila con los elementos previamente obtenidos
                    var productNameSelect = newRow.find(
                        '.product-id'); // Acceder a newRow en lugar de lastRow
                    productNameSelect.append(new Option('Seleccione el elemento', ''));
                    $.each(elements, function(index, element) {
                        productNameSelect.append(new Option(element.name, element.id));
                    });

                    // Asignar el elemento seleccionado al registro correspondiente
                    selectedElements[newRow.index()] = selectedElementId;
                } else {
                    showNotification(
                        "Por favor, complete todos los campos de la fila actual antes de agregar otra.",
                        true);

                }
            });


            // Manejador de eventos para cambiar la unidad de medida, la categoría, la cantidad y el precio al seleccionar un elemento
            productTable.on('change', 'select[name="product-id[]"]:last', function() {
                var currentRow = $(this).closest('tr');
                var selectedElementId = $(this).val(); // Usar .val() para obtener el valor seleccionado

                // Realizar una solicitud AJAX para obtener los datos del elemento
                $.ajax({
                    url: '{{ route('agrocefa.passant.movements.getinformationelement') }}',
                    method: 'GET',
                    data: {
                        element: selectedElementId
                    },
                    success: function(response) {
                        console.log(response);

                        var measurementUnitField = currentRow.find('#product-measurement-unit');
                        var categoryField = currentRow.find('#product-category');
                        var nameField = currentRow.find('#product-name');


                        measurementUnitField.val(response.unidad_medida ||
                            'Unidad de medida no encontrada');
                        categoryField.val(response.categoria || 'Categoría no encontrada');
                        nameField.val(response.name || 'Nombre no encontrada');


                    },
                    error: function() {
                        var measurementUnitField = currentRow.find('#product-measurement-unit');
                        var categoryField = currentRow.find('#product-category');
                        var nameField = currentRow.find('#product-name');

                        measurementUnitField.val('Error al obtener la unidad de medida');
                        categoryField.val('Error al obtener la categoría');
                        nameField.val('Error al obtener el nombre');
                    }
                });
            });




            // Manejador de eventos para cambiar el precio y mostrar cantidad al seleccionar un elemento
            productTable.on('change', 'select[name="product-id[]"]', function() {
                var currentRow = $(this).closest('tr');
                var selectedElementId = $(this).val(); // Obtener el valor seleccionado

                // Realizar una solicitud AJAX para obtener los datos del elemento
                $.ajax({
                    url: '{{ route('agrocefa.passant.movements.getprice') }}',
                    method: 'GET',
                    data: {
                        element: selectedElementId
                    },
                    success: function(response) {
                        console.log(response);
                        // Actualizar los campos de precio, cantidad y destino
                        currentRow.find('#product-price').val(response.price || '');
                        currentRow.find('#product-quantity').val(response.amount || '');
                        currentRow.find('#product-destination').val(response.destination || '');
                        currentRow.find('#product-lot').val(response.lote || '');
                        currentRow.find('#product-stock').val(response.stock || '');

                        var quantityMessage = currentRow.find('.quantity-message');

                        var amount = response.amount;
                        if (amount !== null) {
                            quantityMessage.text('Cantidad Disponible: ' + amount).removeClass(
                                'error-message');
                        } else {
                            quantityMessage.text('Cantidad no disponible').addClass(
                                'error-message');
                        }

                    },
                    error: function() {
                        var priceField = currentRow.find('#product-price');
                        var quantityField = currentRow.find('#product-quantity');
                        var destinationField = currentRow.find('#product-destination');
                        var lotField = currentRow.find('#product-lot');
                        var stockField = currentRow.find('#product-stock');
                        var quantityMessage = currentRow.find('.quantity-message');

                        priceField.val('Error al obtener el precio');
                        quantityField.val('');
                        destinationField.val('');

                        // Actualiza el contenido del span con un mensaje de error y aplica la clase CSS
                        quantityMessage.text(
                            'Cantidad Disponible: Error al obtener la cantidad').addClass(
                            'error-message');
                    }
                });
            });

            // Manejador de eventos para cambiar la cantidad y habilitar/deshabilitar el botón de registro
            productTable.on('input', 'input[name="product-quantity[]"]', function() {
                var currentRow = $(this).closest('tr');
                var selectedElementId = currentRow.find('select[name="product-id[]"]')
                    .val(); // Obtener el valor seleccionado
                var enteredQuantity = parseInt($(this)
                    .val()); // Obtener la cantidad ingresada como número entero

                if (!isNaN(enteredQuantity)) {
                    $.ajax({
                        url: '{{ route('agrocefa.passant.movements.getprice') }}',
                        method: 'GET',
                        data: {
                            element: selectedElementId
                        },
                        success: function(response) {
                            console.log(response);

                            var availableQuantity = response.amount;
                            console.log(availableQuantity);

                            var quantityMessage = currentRow.find('.quantity-message');

                            if (enteredQuantity <= availableQuantity) {
                                quantityMessage.text('Cantidad Disponible: ' +
                                    availableQuantity).removeClass('error-message');
                                $('#registerButton').prop('disabled',
                                    false); // Habilitar el botón
                            } else {
                                quantityMessage.text(
                                    'La cantidad que desea enviar es mayor a la disponible : ' +
                                    availableQuantity).addClass('error-message');
                                $('#registerButton').prop('disabled',
                                    true); // Deshabilitar el botón
                            }
                        },
                        error: function() {
                            var quantityMessage = currentRow.find('.quantity-message');
                            quantityMessage.text('Error al obtener la cantidad disponible')
                                .addClass('error-message');
                            $('#registerButton').prop('disabled', true);
                        }
                    });
                }
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
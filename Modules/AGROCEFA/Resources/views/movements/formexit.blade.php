@extends('agrocefa::layouts.master')
<link rel="stylesheet" href="{{ asset('agrocefa/css/movements.css') }}">
@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'my-custom-popup-class', // Clase CSS personalizada para el cuadro de diálogo
                },
                onOpen: () => {
                    // Cuando se abre el cuadro de diálogo, centrarlo verticalmente
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
                    popup: 'my-custom-popup-class', // Clase CSS personalizada para el cuadro de diálogo
                },
                onOpen: () => {
                    // Cuando se abre el cuadro de diálogo, centrarlo verticalmente
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
    <h2>Formulario Salida</h2>

    <div class="container" id="containermovements">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'agrocefa.registerexit', 'method' => 'POST']) !!}
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('date', 'Fecha') !!}
                            {!! Form::text( 'date', old('date', $date), ['class' => 'form-control', 'required', 'readonly' => 'readonly']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('user_id', 'Responsable') !!}
                            {!! Form::select('user_id', $people->pluck('first_name', 'id'), old('user_id'), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                        </div>
                    </div>    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" id="card">
                            <div class="card-header" id="card_header">
                                Entrega
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('productive_unit', 'Unidad Productiva') !!}
                                    {!! Form::text('productive_unit',  Session::get('selectedUnitName'), ['class' => 'form-control', 'readonly' => 'readonly']) !!}

                                </div>
                                <div class="form-group">
                                    {!! Form::label('deliverywarehouse', 'Bodega Entrega') !!}
                                    {!! Form::select(
                                        'deliverywarehouse',
                                        ['' => 'Seleccione la unidad'] + $warehouseData->pluck('name', 'id')->toArray(),
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
                                Recibe
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('product_unit', 'Unidad Productiva') !!}
                                    {!! Form::select(
                                        'product_unit',
                                        ['' => 'Seleccione la unidad'] + $productunits->pluck('name', 'id')->toArray(),
                                        old('product_unit'),
                                        ['class' => 'form-control', 'required', 'id' => 'productUnitSelect'],
                                    ) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('receivewarehouse', 'Bodega Recibe') !!}
                                    {!! Form::select('receivewarehouse', [], old('receivewarehouse'), [
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
                            {!! Form::label('observation', 'Observacion') !!}
                            {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'style' => 'max-height: 100px;', 'required']) !!}
                        </div>
                    </div>
                </div>
                <br>
                <!-- Agregar la tabla dinámica -->
                <div class="form-group">
                    <h3 id="title">Elementos</h3>
                    <table id="productTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre del Producto</th>
                                <th>Unidad de Medida</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Categoria</th>
                                <th>Destino</th> <!-- Agregar la columna de Destino -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas de la tabla se agregarán dinámicamente aquí -->
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary" id="addProduct">Agregar Producto</button>
                </div>
                <!-- Otros campos del formulario según tus necesidades -->
                <input type="hidden" name="products" id="productsInput" value="">
                <input type="hidden" class="product-selected-id" name="product_selected_id">
                <br>
                {!! Form::submit('Registrar Entrada', ['class' => 'btn btn-primary']) !!}
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var productTable = $('#productTable tbody');
            var elements = {!! json_encode($elements) !!};
            var productsData = [];

            // Función para actualizar los datos de los productos
            function updateProductsData() {
                productsData = [];

                // Recorrer todas las filas de la tabla de productos
                productTable.find('tr.product-row').each(function() {
                    var currentRow = $(this);
                    var productNameSelect = currentRow.find('.product-name');
                    var productName = productNameSelect.val();
                    var selectedElementId = productNameSelect.find('option:selected').val();
                    var measurementUnit = currentRow.find('.product-measurement-unit').val();
                    var quantity = currentRow.find('.product-quantity').val();
                    var price = currentRow.find('.product-price').val();
                    var category = currentRow.find('.product-category').val();
                    var destination = currentRow.find('.product-destination').val();

                    // Verificar que todos los campos tengan valores
                    if (productName && measurementUnit && quantity && price && category && destination) {
                        // Agregar el producto a la lista de productos
                        productsData.push({
                            'product-name': selectedElementId,
                            'product-measurement-unit': measurementUnit,
                            'product-quantity': quantity,
                            'product-price': price,
                            'product-category': category,
                            'product-destination': destination,
                            'id': selectedElementId,
                            'name': productName
                        });
                    }
                });

                // Actualizar el campo oculto con los datos de los productos
                $('#productsInput').val(JSON.stringify(productsData));
            }


            // Función para agregar una nueva fila de producto
            function addProductRow() {
                var newRow = $('<tr class="product-row">');
                    newRow.html('<td><input type="hidden" class="product-element-id"></td>' +
                    '<td class="col-2"><select class="form-control product-name" required></select></td>' +
                    '<td><input type="text" class="form-control product-measurement-unit" readonly></td>' +
                    '<td class="col-2"><input type="number" class="form-control product-quantity" placeholder="Cantidad"><span class="quantity-message"></span></td>' +
                    '<td><input type="text" class="form-control product-price" readonly ></td>' +
                    '<td><input type="text" class="form-control product-category" readonly></td>' +
                    '<td class="col-2"><input type="text" class="form-control product-destination" readonly></td>' +
                    '<td class="col-1"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>' +
                    '<button type="button" class="btn btn-success saveProduct"><i class="fa fa-check"></i></button></td>');



                // Agregar la fila a la tabla
                productTable.append(newRow);

                // Manejador de eventos para el botón Guardar
                newRow.find('.saveProduct').click(function() {
                    var currentRow = $(this).closest('tr');

                    // Verificar si todos los campos en la fila actual están completos
                    if (currentRow.find('.product-name').val() && currentRow.find(
                            '.product-measurement-unit').val() && currentRow.find('.product-quantity')
                    .val() && currentRow.find('.product-price').val() && currentRow.find(
                            '.product-category').val() && currentRow.find('.product-destination').val()) {
                        updateProductsData();

                        var productNameSelect = currentRow.find('.product-name');
                        var productName = productNameSelect.val();
                        var selectedElementId = productNameSelect.find('option:selected').val();
                        var measurementUnit = currentRow.find('.product-measurement-unit').val();
                        var quantity = currentRow.find('.product-quantity').val();
                        var price = currentRow.find('.product-price').val();
                        var category = currentRow.find('.product-category').val();
                        var destination = currentRow.find('.product-destination').val();

                        // Actualizar el producto en productsData
                        var updatedProduct = {
                            'product-name': selectedElementId,
                            'product-measurement-unit': measurementUnit,
                            'product-quantity': quantity,
                            'product-price': price,
                            'product-category': category,
                            'product-destination': destination,
                            'id': selectedElementId,
                            'name': productName
                        };

                        // Buscar y reemplazar el producto en productsData
                        for (var i = 0; i < productsData.length; i++) {
                            if (productsData[i]['id'] === selectedElementId) {
                                productsData[i] = updatedProduct;
                                break;
                            }
                        }

                        $('#productsInput').val(JSON.stringify(productsData));

                        // Reemplazar el botón "Guardar" por el icono de chulito
                        var saveButton = currentRow.find('.saveProduct');
                        var checkIcon = saveButton.find('i.fa-check');
                        saveButton.text('').append(checkIcon);
                        saveButton.attr('disabled', true); // Deshabilitar el botón

                        alert('Elemento Agregado');
                    } else {
                        alert('Por favor, complete todos los campos de la fila actual antes de guardar.');
                    }
                });

                // Llamar a updateProductsData después de agregar un producto
                updateProductsData();
            }



            // Llamar a addProductRow al cargar la página para generar la primera fila
            addProductRow();

            // Manejador de eventos para el botón Agregar Producto
            $('#addProduct').click(function() {
                var lastRow = productTable.find('tr.product-row:last');

                if (lastRow.find('.product-name').val() && lastRow.find('.product-measurement-unit')
                .val() && lastRow.find('.product-quantity').val() && lastRow.find('.product-price').val() &&
                    lastRow.find('.product-category').val() && lastRow.find('.product-destination').val()) {
                    addProductRow();
                } else {
                    alert('Por favor, complete todos los campos de la fila actual antes de agregar otra.');
                }
            });

            // Manejador de eventos para eliminar productos
            productTable.on('click', '.removeProduct', function() {
                $(this).closest('tr').remove();
                updateProductsData();
            });

            // Manejador de eventos para obtener los elementos
            $('#deliverywarehouse').on('change', function() {
                var selectedWarehouseId = $(this).val(); // Obtener el ID de la bodega seleccionada

                // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
                $.ajax({
                    url: '{{ route('agrocefa.obtenerelement') }}', // Reemplaza 'agrocefa.obtenerelementos' con la ruta adecuada
                    method: 'GET', // Puedes usar GET u otro método según tu configuración
                    data: {
                        warehouse: selectedWarehouseId
                    }, // Enviar el ID seleccionado como parámetro
                    success: function(response) {
                        // Manejar la respuesta de la solicitud AJAX aquí
                        console.log('Respuesta de la solicitud elementos:', response);

                        // Obtener el campo de selección de productos
                        var productNameSelect = $('.product-name');
                        productNameSelect.empty(); // Vaciar las opciones actuales

                        // Agregar la opción predeterminada "Seleccione el elemento"
                        productNameSelect.append(new Option('Seleccione el elemento', ''));

                        // Iterar sobre la respuesta JSON y agregar las opciones al campo de selección
                        $.each(response, function(index, element) {
                            // Aquí, element se refiere a un objeto en la respuesta JSON
                            // Agregar una nueva opción con el atributo "element_id" como valor y "destination" como texto
                            productNameSelect.append(new Option(element.name, element
                                .id));
                        });
                    },
                    error: function() {
                        // Manejar errores si la solicitud AJAX falla
                        console.error('Error en la solicitud AJAX');
                    }
                });
            });

            // Manejador de eventos para cambiar la unidad de medida, la categoría, la cantidad y el precio al seleccionar un elemento
            productTable.on('change', '.product-name', function() {
                var currentRow = $(this).closest('tr');
                var selectedElementId = $(this).find('option:selected').val();

                // Realizar una solicitud AJAX para obtener los datos del elemento
                $.ajax({
                    url: '{{ route('agrocefa.obtenerdatos') }}',
                    method: 'GET',
                    data: {
                        element: selectedElementId
                    },
                    success: function(response) {
                        console.log(response);
                        var measurementUnitField = currentRow.find('.product-measurement-unit');
                        var categoryField = currentRow.find('.product-category');


                        measurementUnitField.val(response.unidad_medida ||
                            'Unidad de medida no encontrada');
                        categoryField.val(response.categoria || 'Categoría no encontrada');


                        // Llamar a updateProductsData después de cambiar la selección
                        updateProductsData();
                    },
                    error: function() {
                        var measurementUnitField = currentRow.find('.product-measurement-unit');
                        var categoryField = currentRow.find('.product-category');

                        measurementUnitField.val('Error al obtener la unidad de medida');
                        categoryField.val('Error al obtener la categoría');


                        // Llamar a updateProductsData después de cambiar la selección
                        updateProductsData();
                    }
                });
            });

            // Manejador de eventos para cambiar el precio y mostrar cantidad al seleccionar un elemento
            productTable.on('change', '.product-name', function() {
                var currentRow = $(this).closest('tr');
                var selectedElementId = $(this).find('option:selected').val();

                // Realizar una solicitud AJAX para obtener los datos del elemento
                $.ajax({
                    url: '{{ route('agrocefa.getprice') }}',
                    method: 'GET',
                    data: {
                        element: selectedElementId
                    },
                    success: function(response) {
                        console.log(response);
                        var priceField = currentRow.find('.product-price');
                        var quantityField = currentRow.find('.product-quantity');
                        var destinationField = currentRow.find('.product-destination');
                        var quantityMessage = currentRow.find('.quantity-message');
                        
                        priceField.val(response.price || 'Precio no encontrado');
                        quantityField.val(response.amount || 'Cantidad no encontrada');
                        destinationField.val(response.destination || 'Destino no encontrada');
                        
                        // Actualiza el contenido del span con la cantidad y aplica la clase CSS
                        quantityMessage.text('Cantidad Disponible: ' + (response.amount || 'Cantidad no encontrada')).addClass('small-font');

                        // Llamar a updateProductsData después de cambiar la selección
                        updateProductsData();
                    },
                    error: function() {
                        var priceField = currentRow.find('.product-price');
                        var quantityField = currentRow.find('.product-quantity');
                        var quantityMessage = currentRow.find('.quantity-message');
                        var destinationField = currentRow.find('.product-destination');

                        priceField.val('Error al obtener el precio');
                        quantityField.val('');
                        
                        // Actualiza el contenido del span con un mensaje de error y aplica la clase CSS
                        quantityMessage.text('Cantidad Disponible: Error al obtener la cantidad').addClass('small-font');

                        // Llamar a updateProductsData después de cambiar la selección
                        updateProductsData();
                    }
                });
            });


            // Manejador de eventos para el cambio en el campo "Unidad Productiva"
            $('#productUnitSelect').on('change', function() {
                var selectedProductId = $(this).val(); // Obtener el ID de la unidad productiva seleccionada

                // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
                $.ajax({
                    url: '{{ route('agrocefa.warehouse') }}', // Reemplaza 'obtenerbodegas' con la ruta adecuada
                    method: 'GET', // Puedes usar GET u otro método según tu configuración
                    data: {
                        unit: selectedProductId
                    }, // Enviar el ID seleccionado como parámetro
                    success: function(response) {
                        // Manejar la respuesta de la solicitud AJAX aquí
                        console.log('Respuesta de la solicitud AJAX:', response);

                        // Convertir el objeto JSON en un array de objetos
                        var warehousesArray = [];
                        for (var id in response) {
                            if (response.hasOwnProperty(id)) {
                                warehousesArray.push({
                                    id: id,
                                    name: response[id]
                                });
                            }
                        }
                        console.log('Respuesta de la solicitud:', warehousesArray);


                        // Actualizar el campo "Bodega Recibe" con las opciones recibidas
                        var receivewarehouseSelect = $('#receivewarehouse');
                        console.log('Campo "Bodega Recibe" seleccionado:',
                            receivewarehouseSelect);
                        receivewarehouseSelect.empty(); // Vaciar las opciones actuales

                        // Agregar la opción predeterminada "Seleccione el elemento"
                        receivewarehouseSelect.append(new Option('Seleccione el la bodega',
                        ''));

                        // Agregar las nuevas opciones desde el array de objetos
                        $.each(warehousesArray, function(index, warehouse) {
                            receivewarehouseSelect.append(new Option(warehouse.name,
                                warehouse.id));
                        });


                    },
                    error: function() {
                        // Manejar errores si la solicitud AJAX falla
                        console.error('Error en la solicitud AJAX');
                    }
                });
            });


        });
    </script>
@endsection

    <!-- Agregar un div para contener la información adicional -->
    <div id="formsupplies" style="display: none;">
        <div class="container" id="form">
        <!-- Agregar la tabla dinámica -->
        <div class="form-group">
            <h3 id="title">Insumos</h3>
            <table id="agrochemicalTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Categoria</th>
                        <th>Insumos</th>
                        <th>{{ trans('agrocefa::movements.1T_Measurement_Unit') }}</th>
                        <th>{{ trans('agrocefa::movements.1T_Amount') }}</th>
                        <th>{{ trans('agrocefa::movements.1T_Price') }}</th>
                        <th>Lote</th>
                        <th>Precio Total</th>
                        <!-- Agregar la columna de Destino -->
                        <th>{{ trans('agrocefa::movements.1T_Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Filas de la tabla se agregarán dinámicamente aquí -->
                </tbody>    
            </table>
            <button type="button" class="btn btn-primary"
                        id="addProduct">{{ trans('agrocefa::movements.Btn_Add_Element') }}</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var agrochemicalTable = $('#agrochemicalTable tbody');
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
                '<td><input type="hidden" id="product-name" class="product-name" name="product-name[]"></td>' +
                '<td class="col-2"><select id="category-id" class="form-control" name="category-id[]" required><option value="">Seleccione la Categoria</option>@foreach ($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach</select></td>' +
                '<td class="col-2"><select id="product-id" class="form-control product-id" name="product-id[]" required></select></td>' +
                '<td><input type="text" id="product-measurement-unit" class="form-control product-measurement-unit" name="product-measurement-unit[]" readonly><input type="hidden" id="product-stock" class="product-stock" name="product-stock[]"></td>' +
                '<td class="col-2"><input type="number" id="product-quantity" class="form-control product-quantity" name="product-quantity[]" placeholder="Cantidad"><span class="quantity-message"></span></td>' +
                '<td><input type="text" id="product-price" class="form-control product-price" name="product-price[]" readonly></td>' +
                '<td><input type="text" id="product-lot" class="form-control product-lot" name="product-lot[]" readonly></td>' +
                '<td><input type="text" id="price-total" class="form-control price-total" name="price-total[]" readonly></td>' +
                '<td class="col-1"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>'
            );

            // Agregar la fila a la tabla
            agrochemicalTable.append(newRow);

        }

        // Manejador de eventos para el cambio en la bodega
        $('#category-id').on('change', function() {
                var selectcategory = $(this).val(); // Obtener el ID de la bodega seleccionada
    
                // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
                $.ajax({
                    url: '{{ route('agrocefa.labormanagement.getsupplies') }}', // Reemplaza 'agrocefa.obtenerelementos' con la ruta adecuada
                    method: 'GET', // Puedes usar GET u otro método según tu configuración
                    data: {
                        category: selectcategory
                    }, // Enviar el ID seleccionado como parámetro
                    success: function(response) {
                        // Manejar la respuesta de la solicitud AJAX aquí
                        console.log('Respuesta de la solicitud elementos:', response);

                        // Almacenar la lista de elementos en la variable "elements"
                        elements = response;

                        // Obtener el campo de selección de productos de la última fila
                        var productNameSelect = newRow.find('.product-id');
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
            var lastRow = agrochemicalTable.find('tr.product-row:last');

            if (lastRow.find('#product-id').val() && lastRow.find('#product-measurement-unit').val() &&
                lastRow.find('#product-quantity').val() && lastRow.find('#product-price').val() &&
                lastRow.find('#price-total').val()) {
                addProductRow();

                // Obtener el elemento seleccionado en la fila anterior
                var selectedElementId = selectedElements[lastRow.index()];

                // Llenar el campo de selección de productos de esta fila con los elementos previamente obtenidos
                var productNameSelect = newRow.find(
                    '.product-id'); // Acceder a newRow en lugar de lastRow
                
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



        // Manejador de eventos para cambiar la unidad de medida, la cantidad y el precio al seleccionar un elemento
        agrochemicalTable.on('change', 'select[name="product-id[]"]:last', function() {
            var currentRow = $(this).closest('tr');
            var selectedElementId = $(this).val(); // Usar .val() para obtener el valor seleccionado

            // Realizar una solicitud AJAX para obtener los datos del elemento
            $.ajax({
                url: '{{ route('agrocefa.obtenerdatos') }}',
                method: 'GET',
                data: {
                    element: selectedElementId
                },
                success: function(response) {
                    console.log(response);

                    var measurementUnitField = currentRow.find('#product-measurement-unit');
                    var nameField = currentRow.find('#product-name');


                    measurementUnitField.val(response.unidad_medida ||
                        'Unidad de medida no encontrada');
                    nameField.val(response.name || 'Nombre no encontrada');


                },
                error: function() {
                    var measurementUnitField = currentRow.find('#product-measurement-unit');
                    var nameField = currentRow.find('#product-name');

                    measurementUnitField.val('Error al obtener la unidad de medida');
                    nameField.val('Error al obtener el nombre');
                }
            });
        });




        // Manejador de eventos para cambiar el precio y mostrar cantidad al seleccionar un elemento
        agrochemicalTable.on('change', 'select[name="product-id[]"]', function() {
            var currentRow = $(this).closest('tr');
            var selectedElementId = $(this).val(); // Obtener el valor seleccionado

            // Realizar una solicitud AJAX para obtener los datos del elemento
            $.ajax({
                url: '{{ route('agrocefa.getprice') }}',
                method: 'GET',
                data: {
                    element: selectedElementId
                },
                success: function(response) {
                    console.log(response);
                    // Actualizar los campos de precio, cantidad y destino
                    currentRow.find('#product-price').val(response.price || '');
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
                    var lotField = currentRow.find('#product-lot');
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
        agrochemicalTable.on('input', 'input[name="product-quantity[]"]', function() {
            var currentRow = $(this).closest('tr');
            var selectedElementId = currentRow.find('select[name="product-id[]"]')
                .val(); // Obtener el valor seleccionado
            var enteredQuantity = parseInt($(this)
                .val()); // Obtener la cantidad ingresada como número entero

            if (!isNaN(enteredQuantity)) {
                $.ajax({
                    url: '{{ route('agrocefa.getprice') }}',
                    method: 'GET',
                    data: {
                        element: selectedElementId
                    },
                    success: function(response) {
                        console.log(response);

                        var availableQuantity = response.amount;

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

        // Cambiar el evento 'change' a 'input' para el campo de cantidad
        agrochemicalTable.on('input', 'input[name="product-quantity[]"]', function() {
            var currentRow = $(this).closest('tr');
            var priceField = currentRow.find('#product-price');
            var quantityField = currentRow.find('#product-quantity');
            var priceTotalField = currentRow.find('#price-total');

            var price = parseFloat(priceField.val()) || 0;
            var quantity = parseInt(quantityField.val()) || 0;

            var total = price * quantity;

            priceTotalField.val(total.toFixed(2));
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


    <!-- Agregar un div para contener la información adicional -->
    <div id="formsupplies" style="display: none;">
        <div class="container" id="form">
            <!-- Agregar la tabla dinámica -->
            <div class="form-group">
                <h3 id="title">Insumos</h3>
                <table id="suppliesTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Insumos</th>
                            <th>Dosis*HA: Lt-Kg</th>
                            <th>Precio U.Elemento</th>
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
                    id="addProduct1">{{ trans('agrocefa::movements.Btn_Add_Element') }}</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var suppliesTable = $('#suppliesTable tbody');
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
                    '<td class="col-2"><select id="category-id" class="form-control" name="category-id[]"><option value="">Seleccione la Categoria</option>@foreach ($categories as $category)<option value="{{ $category->name }}">{{ $category->name }}</option>@endforeach</select></td>' +
                    '<td class="col-2"><select id="supplies-id" class="form-control supplies-id" name="supplies-id[]" ></select></td>' +
                    '<td class="col-2"><input type="number" id="supplies_quantity" class="form-control supplies_quantity" name="supplies_quantity[]" placeholder="Cantidad"><span class="quantity-message"></span></td>' +
                    '<td><input type="text" id="supplies_price" class="form-control supplies_price" name="supplies_price[]" readonly></td>' +
                    '<td><input type="text" id="supplies_price-total" class="form-control supplies_price-total" name="supplies_price-total[]" readonly></td>' +
                    '<td class="col-1"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>'
                );

                // Agregar la fila a la tabla
                suppliesTable.append(newRow);

                // Agregar los campos adicionales debajo de la fila
                newRow.after(
                    '<tr class="additional-fields" style="display: none;">' +
                    '<td>Método de Aplicación: <input type="text" class="form-control supplies_application-method" name="application-method[]" /></td>' +
                    '<td>Objetivo: <input type="text" class="form-control supplies_objective" name="objective[]" /></td>' +
                    '</tr>'
                );
            }

            // Manejador de eventos para el cambio en la categoría
            $('#suppliesTable').on('change', 'select[name="category-id[]"]', function() {
                var selectedCategory = $(this).val();
                var additionalFieldsRow = $(this).closest('tr').next('.additional-fields');

                if (selectedCategory === 'Agroquimico' || selectedCategory === 'Fertilizante') {
                    additionalFieldsRow.show();
                } else {
                    additionalFieldsRow.hide();
                }
                console.log('Categoría seleccionada:', selectedCategory);
                console.log('Elemento de campos adicionales:', additionalFieldsRow);


                // Aquí puedes agregar más lógica para mostrar u ocultar campos adicionales según sea necesario.
            });

            // Escuchar el evento "input" en los campos "Método de Aplicación" y "Objetivo"
            suppliesTable.on('input', 'input[name="application-method[]"], input[name="objective[]"]', function() {
                var currentRow = $(this).closest('tr');
                var fieldName = $(this).attr('name'); // Nombre del campo

                // Obtener el valor introducido por el usuario
                var enteredValue = $(this).val();

                // Guardar el valor en el localStorage
                localStorage.setItem(fieldName, enteredValue);
            });

            // Mostrar sugerencias basadas en el localStorage cuando el usuario comience a escribir
            suppliesTable.on('input', 'input[name="application-method[]"], input[name="objective[]"]', function() {
                var fieldName = $(this).attr('name'); // Nombre del campo

                // Obtener el valor introducido por el usuario
                var enteredValue = $(this).val();

                // Obtener el valor almacenado en el localStorage
                var savedValue = localStorage.getItem(fieldName);

                if (savedValue !== null) {
                    // Comprobar si el valor introducido coincide con el valor almacenado
                    if (enteredValue === savedValue.substring(0, enteredValue.length)) {
                        // Establecer el valor completo como sugerencia
                        $(this).val(savedValue);
                    }
                }
            });


            // Manejador de eventos para el cambio en la categoria
            $('#suppliesTable').on('change', 'select[name="category-id[]"]', function() {
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
                        var productNameSelect = newRow.find('.supplies-id');
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
                            currentRow.find('.supplies_price').attr('name',
                                'supplies_price[]');
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
            $('#addProduct1').click(function() {
                var lastRow = suppliesTable.find('tr.product-row:last');

                if (lastRow.find('#supplies-id').val() &&
                    lastRow.find('#supplies_quantity').val() && lastRow.find('#supplies_price').val() &&
                    lastRow.find('#supplies_price-total').val()) {
                    addProductRow();
                    console.log('paso');
                    // Obtener el elemento seleccionado en la fila anterior
                    var selectedElementId = selectedElements[lastRow.index()];

                    // Asignar el elemento seleccionado al registro correspondiente
                    selectedElements[newRow.index()] = selectedElementId;
                } else {
                    console.log('pasos');
                    showNotification(
                        "Por favor, complete todos los campos de la fila actual antes de agregar otra.",
                        true);

                }
            });

            // Manejador de eventos para eliminar productos
            suppliesTable.on('click', '.removeProduct', function() {
                // Elimina la fila y la siguiente fila de campos adicionales
                var currentRow = $(this).closest('tr');
                currentRow.next('.additional-fields').remove(); // Elimina los campos adicionales
                currentRow.remove(); // Elimina la fila del producto


            });


            // Manejador de eventos para cambiar la unidad de medida, la cantidad y el precio al seleccionar un elemento
            suppliesTable.on('change', 'select[name="supplies-id[]"]:last', function() {
                var currentRow = $(this).closest('tr');
                var selectedElementId = $(this).val(); // Usar .val() para obtener el valor seleccionado

                // Realizar una solicitud AJAX para obtener los datos del elemento
                $.ajax({
                    url: '{{ route('agrocefa.labormanagement.obtenerdatos') }}',
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
            suppliesTable.on('change', 'select[name="supplies-id[]"]', function() {
                var currentRow = $(this).closest('tr');
                var selectedElementId = $(this).val(); // Obtener el valor seleccionado

                // Realizar una solicitud AJAX para obtener los datos del elemento
                $.ajax({
                    url: '{{ route('agrocefa.labormanagement.getprice') }}',
                    method: 'GET',
                    data: {
                        element: selectedElementId
                    },
                    success: function(response) {
                        console.log(response);
                        // Actualizar los campos de precio, cantidad y destino
                        currentRow.find('#supplies_price').val(response.price || '');
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
                        var priceField = currentRow.find('#supplies_price');
                        var quantityField = currentRow.find('#supplies_quantity');
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
            suppliesTable.on('input', 'input[name="supplies_quantity[]"]', function() {
                var currentRow = $(this).closest('tr');
                var selectedElementId = currentRow.find('select[name="supplies-id[]"]')
                    .val(); // Obtener el valor seleccionado
                var enteredQuantity = parseInt($(this)
                    .val()); // Obtener la cantidad ingresada como número entero

                if (!isNaN(enteredQuantity)) {
                    $.ajax({
                        url: '{{ route('agrocefa.labormanagement.getprice') }}',
                        method: 'GET',
                        data: {
                            element: selectedElementId
                        },
                        success: function(response) {
                            console.log(response.amount);

                            // Verifica si response.amount es válido y es un número
                            if (response.amount !== null) {
                                var availableQuantity = parseInt(response.amount);
                                var quantityMessage = currentRow.find('.quantity-message');

                                if (enteredQuantity <= availableQuantity) {
                                    quantityMessage.text('Cantidad Disponible: ' +
                                        availableQuantity).removeClass('error-message');
                                    $('#registerButton').prop('disabled', false);
                                } else {
                                    // Si la cantidad ingresada es mayor que la disponible
                                    quantityMessage.text('La cantidad ingresada (' +
                                        enteredQuantity + ') es mayor a la disponible (' +
                                        availableQuantity + ')').addClass('error-message');
                                    $('#registerButton').prop('disabled', true);
                                }
                            } else {
                                var quantityMessage = currentRow.find('.quantity-message');
                                quantityMessage.text('Error: Cantidad disponible no válida')
                                    .addClass('error-message');
                                $('#registerButton').prop('disabled', true);
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

            // Función para recalcular el precio total
            function calculateTotal() {
                var sownArea = parseFloat($('#sownArea').val()) || 0; // Obtener el valor del área sembrada
                console.log(sownArea);
                suppliesTable.find('tr.product-row').each(function() {
                    var currentRow = $(this);
                    var priceField = currentRow.find('.supplies_price');
                    var quantityField = currentRow.find('.supplies_quantity');
                    var priceTotalField = currentRow.find('.supplies_price-total');

                    var price = parseFloat(priceField.val()) || 0;
                    var quantity = parseInt(quantityField.val()) || 0;
                    if (price > 0 && quantity > 0) {
                        var total = price * quantity * sownArea; // Multiplica por el área sembrada


                        priceTotalField.val(total.toFixed(0));
                    } else {
                        priceTotalField.val(''); // Deja el campo en blanco si falta información
                    }
                });
            }

            // Manejador de eventos para el cambio en el campo de cantidad y precio
            suppliesTable.on('input', 'input[name="supplies_quantity[]"]', function() {
                calculateTotal();
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

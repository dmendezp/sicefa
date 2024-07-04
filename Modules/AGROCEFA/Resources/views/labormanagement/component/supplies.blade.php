    <!-- Agregar un div para contener la información adicional -->
    
    <div id="formsupplies" style="display: none;">
        <br>
        <div class="container" id="form">
            <!-- Agregar la tabla dinámica -->
            <div class="form-group">
                <div class="table-responsive">
                    <h3 id="title">{{ trans('agrocefa::labor.Suplies')}}</h3>
                    <table id="suppliesTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('agrocefa::labor.1T_Category') }}</th>
                                <th>{{ trans('agrocefa::labor.1T_Suplies') }}</th>
                                <th>{{ trans('agrocefa::labor.1T_Dose') }}</th>
                                <th>{{ trans('agrocefa::labor.1T_Item_Unit_Price') }}</th>
                                <th>{{ trans('agrocefa::labor.1T_Total') }}</th>
                                <!-- Agregar la columna de Destino -->
                                <th>{{ trans('agrocefa::movements.1T_Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas de la tabla se agregarán dinámicamente aquí -->
                        </tbody>
                    </table>

                    <br>   
                    <button type="button" class="btn standcolor" id="addProduct1">{{ trans('agrocefa::movements.Btn_Add_Element') }}</button>    
                </div>
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

            // Manejador de eventos para eliminar productos con SweetAlert
            suppliesTable.on('click', '.removeProduct', function () {
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
                         // Elimina la fila y la siguiente fila de campos adicionales
                        currentRow.next('.additional-fields').remove(); // Elimina los campos adicionales
                        currentRow.remove(); // Elimina la fila del producto
                    }
                });
            });

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
                var selectcategory = $(this).val(); // Obtener el ID de la categoría seleccionada

                // Realizar una solicitud AJAX para obtener los suministros relacionados con la categoría seleccionada
                $.ajax({
                    url: '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.labormanagement.getsupplies') }}',
                    method: 'GET',
                    data: {
                        category: selectcategory
                    },
                    success: function(response) {
                        // Manejar la respuesta de la solicitud AJAX aquí
                        console.log('Respuesta de la solicitud elementos:', response);

                        // Almacenar la lista de elementos en la variable "elements"
                        elements = response;

                        // Obtener el campo de selección de productos de la última fila
                        var productNameSelect = newRow.find('.supplies-id');

                        // Vaciar las opciones actuales
                        productNameSelect.empty();

                        // Agregar la opción predeterminada "Seleccione el elemento"
                        productNameSelect.append(new Option('Seleccione el elemento', ''));

                        // Iterar sobre la respuesta JSON y agregar las opciones al campo de selección
                        $.each(response, function(index, element) {

                            // Crear un grupo de opciones para el elemento actual
                            var optgroup = $("<optgroup>");
                            if (element.production_date === null) { 
                                optgroup.attr("label", "No tiene fecha");
                            } else {
                                optgroup.attr("label", element.production_date);
                            }


                            // Agregar la fecha como una opción dentro del grupo
                            optgroup.append(new Option(element.name,element.inventory_id));

                            // Agregar el grupo al select
                            productNameSelect.append(optgroup);
                        });

                        // Inicializar Select2 en el campo de selección de productos
                        productNameSelect.select2({
                            placeholder: "Buscar suministro...",
                            allowClear: true // Esto permite borrar la selección actual
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




            // Manejador de eventos para cambiar el precio y mostrar cantidad al seleccionar un elemento
            suppliesTable.on('change', 'select[name="supplies-id[]"]', function() {
                var currentRow = $(this).closest('tr');
                var selectedElementId = $(this).val(); // Obtener el valor seleccionado

                // Realizar una solicitud AJAX para obtener los datos del elemento
                $.ajax({
                    url: '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.labormanagement.getprice') }}',
                    method: 'GET',
                    data: {
                        element: selectedElementId
                    },
                    success: function(response) {
                        console.log(response);
                        // Actualizar los campos de precio, cantidad y destino

                        var formattedPrice = response.price.toLocaleString();
                        currentRow.find('#supplies_price').val(formattedPrice || '');
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
                        url: '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.labormanagement.getprice') }}',
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

                    // Obtener el precio como un número flotante
                    var price = parseFloat(priceField.val().replace(',', '.')) || 0;
                    var quantity = parseInt(quantityField.val()) || 0;

                    console.log(price, quantity);
                    if (price > 0 && quantity > 0) {
                        var total = price * quantity; // Multiplica por la cantidad

                        // Formatear el precio total manualmente
                        var formattedTotal = formatNumber(total, 3);

                        priceTotalField.val(formattedTotal);
                    } else {
                        priceTotalField.val(''); // Dejar el campo en blanco si falta información
                    }
                });
            }

            // Función para formatear un número con separador de miles y decimales
            function formatNumber(number, decimals) {
                var decimalSeparator = '.';
                var thousandsSeparator = ',';

                var numParts = number.toFixed(decimals).split('.');
                var integerPart = numParts[0];
                var decimalPart = numParts.length > 1 ? decimalSeparator + numParts[1] : '';

                integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator);

                return integerPart + decimalPart;
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

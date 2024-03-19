    <!-- Agregar un div para contener la información adicional -->
    <div id="formmachinery" style="display: none;">
        <br>
        <div class="container" id="form">
            <!-- Agregar la tabla dinámica -->
            <div class="form-group">
                <div class="table-responsive">
                    <h3 id="title">{{ trans('agrocefa::labor.Machinery') }}</h3>
                    <table id="machineryTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('agrocefa::labor.3T_Machinery') }}</th>
                                <th>{{ trans('agrocefa::labor.3T_Value') }}</th>
                                <th>{{ trans('agrocefa::labor.3T_Hours') }}</th>
                                <th>{{ trans('agrocefa::labor.2T_Total') }}</th>
                                <!-- Agregar la columna de Destino -->
                                <th>{{ trans('agrocefa::movements.1T_Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas de la tabla se agregarán dinámicamente aquí -->
                        </tbody>
                    </table>
                    <button type="button" class="btn standcolor"
                        id="addProduct">{{ trans('agrocefa::movements.Btn_Add_Element') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var machineryTable = $('#machineryTable tbody');
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
    
                    '<td class="col-2"><select id="machinery-id" class="form-control machinery-id" name="machinery-id[]" ><option value="">Seleccione la Herramienta</option>@foreach ($machineryOptions as $machineryId => $machineryName)<option value="{{ $machineryId }}">{{ $machineryName }}</option>@endforeach</select></td>' +
                    '<td><input type="number" id="machinery_price" class="form-control machinery_price" name="machinery_price[]" placeholder="Precio"></td>' +
                    '<td class="col-2"><input type="number" id="machinery_wage" class="form-control machinery_wage" name="machinery_wage[]" placeholder="Cantidad"><span class="quantity-message"></span></td>' +
                    '<td><input type="text" id="machinery_price-total" class="form-control machinery_price-total" name="machinery_price-total[]" readonly></td>' +
                    '<td class="col-1"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>'
                );

                // Inicializar Select2 en el campo de selección de herramientas
                newRow.find('.machinery-id').select2({
                    placeholder: "Buscar maquinaria...",
                    allowClear: true // Esto permite borrar la selección actual
                });

                // Agregar la fila a la tabla
                machineryTable.append(newRow);

            }


            // Manejador de eventos para el botón Agregar Producto
            $('#addProduct').click(function() {
                var lastRow = machineryTable.find('tr.product-row:last');

                if (lastRow.find('#machinery-id').val() &&
                    lastRow.find('#machinery_wage').val() && lastRow.find('#machinery_price').val() &&
                    lastRow.find('#machinery_price-total').val()) {
                    addProductRow();

                    // Obtener el elemento seleccionado en la fila anterior
                    var selectedElementId = selectedElements[lastRow.index()];

                    // Llenar el campo de selección de productos de esta fila con los elementos previamente obtenidos
                    var productNameSelect = newRow.find(
                        '.machinery-id'); // Acceder a newRow en lugar de lastRow

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

            // Manejador de eventos para eliminar productos con SweetAlert
            machineryTable.on('click', '.removeProduct', function () {
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
                            currentRow.remove(); // Elimina la fila del producto
                        }
                    });
                });

            // Función para recalcular el precio total
            function calculateTotal() {
                var sownArea = parseFloat($('#sownArea').val()) || 0; // Obtener el valor del área sembrada
                console.log(sownArea);
                machineryTable.find('tr.product-row').each(function() {
                    var currentRow = $(this);
                    var priceField = currentRow.find('.machinery_price');
                    var quantityField = currentRow.find('.machinery_wage');
                    var priceTotalField = currentRow.find('.machinery_price-total');

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
            machineryTable.on('input', 'input[name="machinery_wage[]"], input[name="machinery_price[]"]', function() {
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

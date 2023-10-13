    <!-- Agregar un div para contener la información adicional -->
    <div id="formmachinery" style="display: none;">
        <div class="container" id="form">
            <!-- Agregar la tabla dinámica -->
            <div class="form-group">
                <h3 id="title">Maquinaria</h3>
                <table id="machineryTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Maquinaria</th>
                            <th>Jornales</th>
                            <th>Valor (HA)</th>
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
                    '<td><input type="hidden" id="product-name" class="product-name" name="product-name[]"></td>' +
                    '<td class="col-2"><select id="machinery-id" class="form-control machinery-id" name="machinery-id[]" required><option value="">Seleccione la Herramienta</option>@foreach ($machineryOptions as $machineryId => $machineryName)<option value="{{ $machineryId }}">{{ $machineryName }}</option>@endforeach</select></td>' +
                    '<td class="col-2"><input type="number" id="wage-quantity" class="form-control wage-quantity" name="wage-quantity[]" placeholder="Cantidad"><span class="quantity-message"></span></td>' +
                    '<td><input type="text" id="price" class="form-control price" name="price[]" placeholder="Precio"></td>' +
                    '<td><input type="text" id="price-total" class="form-control price-total" name="price-total[]" readonly></td>' +
                    '<td class="col-1"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>'
                );

                // Agregar la fila a la tabla
                machineryTable.append(newRow);

            }


            // Manejador de eventos para el botón Agregar Producto
            $('#addProduct').click(function() {
                var lastRow = machineryTable.find('tr.product-row:last');

                if (lastRow.find('#machinery-id').val() &&
                    lastRow.find('#wage-quantity').val() && lastRow.find('#price').val() &&
                    lastRow.find('#price-total').val()) {
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

            // Función para recalcular el precio total
            function calculateTotal() {
                var sownArea = parseFloat($('#sownArea').val()) || 0; // Obtener el valor del área sembrada
                console.log(sownArea);
                machineryTable.find('tr.product-row').each(function() {
                    var currentRow = $(this);
                    var priceField = currentRow.find('.price');
                    var quantityField = currentRow.find('.wage-quantity');
                    var priceTotalField = currentRow.find('.price-total');

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
            machineryTable.on('input', 'input[name="wage-quantity[]"], input[name="price[]"]', function() {
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

<!-- Agregar un div para contener la información adicional -->
<div id="formtool" style="display: none;">
    <br>
    <div class="container" id="form">
        <!-- Agregar la tabla dinámica -->
        <div class="form-group">
            <div class="table-responsive">
                <h3 id="title">{{ trans('agrocefa::labor.ToolUsed') }}</h3>
                <table id="toolTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('agrocefa::labor.2T_Tool') }}</th>
                            <th>{{ trans('agrocefa::labor.2T_Hours') }}</th>
                            <th>{{ trans('agrocefa::labor.2T_Price') }}</th>
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
                    id="addtool">{{ trans('agrocefa::movements.Btn_Add_Element') }}</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var toolTable = $('#toolTable tbody');
        var elements = {};
        var warehouses = {}; // Objeto para almacenar las bodegas
        var selectedElements = {}; // Objeto para mantener un registro de elementos seleccionados en cada fila

        var newRow;

        // Llamar a addtoolRow al cargar la página para generar la primera fila
        addtoolRow();

        // Función para agregar una nueva fila de producto
        function addtoolRow() {
            newRow = $('<tr class="product-row">');
            newRow.html(
                '<td class="col-2"><select id="tool-id" class="form-control tool-id" name="tool-id[]"><option value="">Seleccione la Herramienta</option>@foreach ($toolOptions as $toolId => $toolName)<option value="{{ $toolId }}">{{ $toolName }}</option>@endforeach</select></td>' +
                '<td class="col-2"><input type="number" id="tool_quantity" class="form-control tool_quantity" name="tool_quantity[]" placeholder="Cantidad"><span class="quantity-message"></span></td>' +
                '<td><input type="text" id="tool_price" class="form-control tool_price" name="tool_price[]" placeholder="Costo de uso"></td>' +
                '<td><input type="text" id="tool_price-total" class="form-control tool_price-total" name="tool_price-total[]" readonly></td>' +
                '<td class="col-1"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>'
            );

            // Inicializar Select2 en el campo de selección de herramientas
            newRow.find('.tool-id').select2({
                placeholder: "Buscar herramienta...",
                allowClear: true // Esto permite borrar la selección actual
            });

            // Agregar la fila a la tabla
            toolTable.append(newRow);
        }

        // Manejador de eventos para el botón Agregar Producto
        $('#addtool').click(function() {
            var lastRow = toolTable.find('tr.product-row:last');

            if (lastRow.find('#tool-id').val() && lastRow.find('#tool_quantity').val() && lastRow.find('#tool_price').val() && lastRow.find('#tool_price-total').val()) {
                addtoolRow();

                // Obtener el elemento seleccionado en la fila anterior
                var selectedElementId = selectedElements[lastRow.index()];

                // Llenar el campo de selección de productos de esta fila con los elementos previamente obtenidos
                var productNameSelect = newRow.find('.tool-id'); // Acceder a newRow en lugar de lastRow

                $.each(elements, function(index, element) {
                    productNameSelect.append(new Option(element.name, element.id));
                });

                // Asignar el elemento seleccionado al registro correspondiente
                selectedElements[newRow.index()] = selectedElementId;
            } else {
                showNotification("Por favor, complete todos los campos de la fila actual antes de agregar otra.", true);
            }
        });

        // Manejador de eventos para eliminar productos con SweetAlert
        toolTable.on('click', '.removeProduct', function () {
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

        // Cambiar el evento 'input' a 'keyup' para el campo de precio
        toolTable.on('keyup', 'input[name="tool_price[]"]', function() {
            var currentRow = $(this).closest('tr');
            var priceField = currentRow.find('#tool_price');
            var quantityField = currentRow.find('#tool_quantity');
            var priceTotalField = currentRow.find('#tool_price-total');

            var price = parseFloat(priceField.val().replace(',', '.')) || 0;
            var quantity = parseInt(quantityField.val()) || 0;

            var total = price * quantity;

            priceTotalField.val(total.toLocaleString('es-ES'));
        });

        // Cambiar el evento 'input' a 'keyup' para el campo de precio
        toolTable.on('keyup', 'input[name="tool_quantity[]"]', function() {
            var currentRow = $(this).closest('tr');
            var priceField = currentRow.find('#tool_price');
            var quantityField = currentRow.find('#tool_quantity');
            var priceTotalField = currentRow.find('#tool_price-total');

            var price = parseFloat(priceField.val().replace(',', '.')) || 0;
            var quantity = parseInt(quantityField.val()) || 0;

            var total = price * quantity;

            priceTotalField.val(total.toLocaleString('es-ES'));
        });

        // Agregar controlador de eventos para formatear el precio cuando se pierda el foco del campo
        toolTable.on('blur', 'input[name="tool_price[]"]', function() {
            var priceField = $(this);
            var price = parseFloat(priceField.val().replace(',', '.')) || 0;
            priceField.val(price.toLocaleString('es-ES'));
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

        <!-- Agregar un div para contener la información adicional -->
        <div id="formexecutor" style="display: none;">
            <div class="container" id="form">
                <!-- Agregar la tabla dinámica -->
                <div class="form-group">
                    <h3 id="title">Personal contratado</h3>
                    <table id="executorTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Persona</th>
                                <th>Tipo de Empleado</th>
                                <th>Horas trabajadas</th>
                                <th>Precio Hora</th>
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
                        id="addEmploye">{{ trans('agrocefa::movements.Btn_Add_Element') }}</button>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var executorTable = $('#executorTable tbody');
                var elements = {};
                var warehouses = {}; // Objeto para almacenar las bodegas
                var selectedElements = {}; // Objeto para mantener un registro de elementos seleccionados en cada fila

                var newRow;

                // Llamar a addProductRow al cargar la página para generar la primera fila
                addProductRow();


                // Función para agregar una nueva fila de productoS
                function addProductRow() {
                    newRow = $('<tr class="person-row">');
                    newRow.html(
                        '<td><input type="hidden" id="product-name" class="product-name" name="product-name[]"></td>' +
                        '<td class="col-2"><select class="form-control person-id" id="select2" name="person-id[]" required><option value=""></option></select></td>' +
                        '<td class="col-2"><select id="employement-id" class="form-control" name="employement-id[]" required><option value="">Seleccione Tipo de Empleado</option>@foreach ($employes as $employe)<option value="{{ $employe->id }}">{{ $employe->name }}</option>@endforeach</select></td>' +
                        '<td class="col-2"><input type="number" id="quantityhours" class="form-control quantityhours" name="quantityhours[]" placeholder="Cantidad"><span class="quantity-message"></span></td>' +
                        '<td><input type="text" id="priceemploye" class="form-control priceemploye" name="priceemploye[]" readonly></td>' +
                        '<td><input type="text" id="price-total" class="form-control price-total" name="price-total[]" readonly></td>' +
                        '<td class="col-1"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>'
                    );

                    // Agregar la fila a la tabla
                    executorTable.append(newRow);

                    // Inicializar Select2 en campos de selección de personas
                $('select[name="person-id[]"]:last').select2({
                    placeholder: 'Seleccione una persona',
                    minimumInputLength: 3,
                    ajax: {
                        url: '{{ route('agrocefa.labormanagement.searchperson') }}',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term,
                            };
                        },
                        processResults: function(data) {
                            var results = data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.text
                                };
                            });

                            return {
                                results: results
                            };
                        },
                        cache: true
                    }
                });

                }

                



                // Manejador de eventos para el botón Agregar Producto
                $('#addEmploye').click(function() {
                    var lastRow = executorTable.find('tr.person-row:last');

                    if (!lastRow.find('.person-id').val()) {
                        showNotification("El campo 'person-id' está vacío.", true);
                    } else if (!lastRow.find('#employement-id').val()) {
                        showNotification("El campo 'employement-id' está vacío.", true);
                    } else if (!lastRow.find('#quantityhours').val()) {
                        showNotification("El campo 'quantityhours' está vacío.", true);
                    } else if (!lastRow.find('#priceemploye').val()) {
                        showNotification("El campo 'priceemploye' está vacío.", true);
                    } else if (!lastRow.find('#price-total').val()) {
                        showNotification("El campo 'price-total' está vacío.", true);
                    } else {
                        addProductRow();

                        // Obtener el elemento seleccionado en la fila anterior 
                        var selectedElementId = selectedElements[lastRow.index()];

                        // Llenar el campo de selección de productos de esta fila con los elementos previamente obtenidos
                        var productNameSelect = newRow.find(
                        '.person-id'); // Acceder a newRow en lugar de lastRow

                        $.each(elements, function(index, element) {
                            productNameSelect.append(new Option(element.name, element.id));
                        });

                        // Asignar el elemento seleccionado al registro correspondiente
                        selectedElements[newRow.index()] = selectedElementId;
                    }
                });





                // Manejador de eventos para cambiar la unidad de medida, la cantidad y el precio al seleccionar un elemento
                executorTable.on('change', 'select[name="employement-id[]"]:last', function() {
                    var currentRow = $(this).closest('tr');
                    var selectedEmploye = $(this).val(); // Usar .val() para obtener el valor seleccionado

                    // Realizar una solicitud AJAX para obtener los datos del elemento
                    $.ajax({
                        url: '{{ route('agrocefa.labormanagement.getpriceemploye') }}',
                        method: 'GET',
                        data: {
                            employee: selectedEmploye
                        },
                        success: function(response) {
                            console.log(response);

                            var priceemployeField = currentRow.find('#priceemploye');

                            priceemployeField.val(response.price ||
                                'Precio no encontrada');
                        },
                        error: function() {
                            var priceemployeField = currentRow.find('#priceemploye');

                            priceemployeField.val('Error al obtener la unidad de medida');

                        }
                    });
                });




                // Cambiar el evento 'change' a 'input' para el campo de cantidad
                executorTable.on('input', 'input[name="quantityhours[]"]', function() {
                    var currentRow = $(this).closest('tr');
                    var priceField = currentRow.find('#priceemploye');
                    var quantityField = currentRow.find('#quantityhours');
                    var priceTotalField = currentRow.find('#price-total');

                    var price = parseFloat(priceField.val()) || 0;
                    var quantity = parseInt(quantityField.val()) || 0;

                    var total = price * quantity;

                    priceTotalField.val(total.toFixed(0));
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

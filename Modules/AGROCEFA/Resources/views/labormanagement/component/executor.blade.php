        <!-- Agregar un div para contener la información adicional -->
        <div id="formexecutor" style="display: none;">
            <br>
            <div class="container" id="form">
                <!-- Agregar la tabla dinámica -->
                <div class="form-group">
                    <div class="table-responsive">
                        <h3 id="title">{{ trans('agrocefa::labor.HiredsStaff') }}</h3>
                        <table id="executorTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ trans('agrocefa::labor.4T_Person') }}</th>
                                    <th>{{ trans('agrocefa::labor.4T_EmpoyeeType') }}</th>
                                    <th>{{ trans('agrocefa::labor.4T_Hours') }}</th>
                                    <th>{{ trans('agrocefa::labor.4T_Price') }}</th>
                                    <th>{{ trans('agrocefa::labor.4T_Total') }}</th>
                                    <!-- Agregar la columna de Destino -->
                                    <th>{{ trans('agrocefa::movements.1T_Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas de la tabla se agregarán dinámicamente aquí -->
                            </tbody>
                        </table>
                        <button type="button" class="btn standcolor"
                            id="addEmploye">{{ trans('agrocefa::movements.Btn_Add_Element') }}</button>
                    </div>
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
                        '<td class="col-2"><select class="form-control executor-id" id="select2" name="executor-id[]" ><option value=""></option></select></td>' +
                        '<td class="col-2"><select id="executor_employement-id" class="form-control" name="executor_employement-id[]" ><option value="">Seleccione Tipo de Empleado</option>@foreach ($employes as $employe)<option value="{{ $employe->id }}">{{ $employe->name }}</option>@endforeach</select></td>' +
                        '<td class="col-2"><input type="number" id="executor_quantityhours" class="form-control executor_quantityhours" name="executor_quantityhours[]" placeholder="Cantidad"><span class="quantity-message"></span></td>' +
                        '<td><input type="text" id="executor_priceemploye" class="form-control executor_priceemploye" name="executor_priceemploye[]" readonly></td>' +
                        '<td><input type="text" id="executor_price-total" class="form-control executor_price-total" name="executor_price-total[]" readonly></td>' +
                        '<td class="col-1"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>'
                    );

                    // Agregar la fila a la tabla
                    executorTable.append(newRow);

                    // Inicializar Select2 en campos de selección de personas
                    $('select[name="executor-id[]"]:last').select2({
                        placeholder: 'Seleccione una persona',
                        minimumInputLength: 3,
                        ajax: {
                            url: '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.labormanagement.searchperson') }}',
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

                    if (!lastRow.find('.executor-id').val()) {
                        showNotification("El campo 'executor-id' está vacío.", true);
                    } else if (!lastRow.find('#executor_employement-id').val()) {
                        showNotification("El campo 'executor_employement-id' está vacío.", true);
                    } else if (!lastRow.find('#executor_quantityhours').val()) {
                        showNotification("El campo 'executor_quantityhours' está vacío.", true);
                    } else if (!lastRow.find('#executor_priceemploye').val()) {
                        showNotification("El campo 'executor_priceemploye' está vacío.", true);
                    } else if (!lastRow.find('#executor_price-total').val()) {
                        showNotification("El campo 'executor_price-total' está vacío.", true);
                    } else {
                        addProductRow();

                        // Obtener el elemento seleccionado en la fila anterior 
                        var selectedElementId = selectedElements[lastRow.index()];

                        // Llenar el campo de selección de productos de esta fila con los elementos previamente obtenidos
                        var productNameSelect = newRow.find(
                            '.executor-id'); // Acceder a newRow en lugar de lastRow

                        $.each(elements, function(index, element) {
                            productNameSelect.append(new Option(element.name, element.id));
                        });

                        // Asignar el elemento seleccionado al registro correspondiente
                        selectedElements[newRow.index()] = selectedElementId;
                    }
                });

                // Manejador de eventos para eliminar productos con SweetAlert
                executorTable.on('click', '.removeProduct', function () {
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

                // Manejador de eventos para cambiar la unidad de medida, la cantidad y el precio al seleccionar un elemento
                executorTable.on('change', 'select[name="executor_employement-id[]"]:last', function() {
                    var currentRow = $(this).closest('tr');
                    var selectedEmploye = $(this).val(); // Usar .val() para obtener el valor seleccionado

                    // Realizar una solicitud AJAX para obtener los datos del elemento
                    $.ajax({
                        url: '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.labormanagement.getpriceemploye') }}',
                        method: 'GET',
                        data: {
                            employee: selectedEmploye
                        },
                        success: function(response) {
                            console.log(response);

                            var priceemployeField = currentRow.find('#executor_priceemploye');

                            priceemployeField.val(response.price);
                        },
                        error: function() {
                            var priceemployeField = currentRow.find('#executor_priceemploye');

                            priceemployeField.val('Error al obtener el precio');

                        }
                    });
                });




                // Cambiar el evento 'change' a 'input' para el campo de cantidad
                executorTable.on('input', 'input[name="executor_quantityhours[]"]', function() {
                    var currentRow = $(this).closest('tr');
                    var priceField = currentRow.find('#executor_priceemploye');
                    var quantityField = currentRow.find('#executor_quantityhours');
                    var priceTotalField = currentRow.find('#executor_price-total');

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

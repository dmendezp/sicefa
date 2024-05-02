
    <!-- Agrega campos y elementos según tus necesidades -->
    <h2 class="text-center">{{ trans('agrocefa::labor.production_movement') }}</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card-header" id="card_header" style="margin-bottom: 10px;">
                {{ trans('agrocefa::movements.Delivery') }}
            </div>
            <div class="form-group">
                {!! Form::label('productive_unit', trans('agrocefa::movements.Productive_Unit')) !!}
                {!! Form::text('productive_unit', Session::get('selectedUnitName'), [
                    'class' => 'form-control',
                    'readonly' => 'readonly',
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('deliverywarehouse', trans('agrocefa::labor.warehouse')) !!}
                {!! Form::select(
                    'deliverywarehouse',
                    ['' => trans('agrocefa::labor.Select_the_warehouse')] + $warehouseData->pluck('name', 'id')->toArray(),
                    old('deliverywarehouse'),
                    ['class' => 'form-control'],
                ) !!}
            </div>

        </div>
        <div class="col-md-6">
            <div class="card-header" id="card_header" style="margin-bottom: 10px;">
                {{ trans('agrocefa::movements.Receive') }}
            </div>
            <div class="form-group">
                {!! Form::label('unit', trans('agrocefa::movements.Productive_Unit')) !!}
                {!! Form::select(
                    'unit',
                    ['' => trans('agrocefa::labor.Select_the_unit')] + $productunits->pluck('name', 'id')->toArray(),
                    null,
                    ['class' => 'form-control', 'id' => 'unitSelect']
                ) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('warehouse', trans('agrocefa::labor.warehouse')) !!}
                {!! Form::select('warehouse', [], null, ['class' => 'form-control', 'id' => 'warehouseSelect']) !!}
            </div>
        </div>
        </div>
        <br>

        <div class="container" id="form">
            <!-- Agregar la tabla dinámica -->
            <div class="form-group">
                <h3 id="title">{{ trans('agrocefa::labor.Production')}}</h3>
                <table id="productionTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('agrocefa::labor.5T_Element')}}</th>
                            <th>{{ trans('agrocefa::labor.5T_Amount')}}</th>
                            <th>{{ trans('agrocefa::labor.5T_Expiration')}}</th>
                            <th>{{ trans('agrocefa::labor.5T_Lot')}}</th>
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

    <script>
        $(document).ready(function() {
            var productionTable = $('#productionTable tbody');
            var elements = {};
            var selectedElements = {}; // Objeto para mantener un registro de elementos seleccionados en cada fila

            var newRow;

            // Llamar a addProductRow al cargar la página para generar la primera fila
            addProductRow();


            // Función para agregar una nueva fila de producto
            function addProductRow() {
                newRow = $('<tr class="product-row">');
                newRow.html(
                    '<td class="col-2"><select id="production-id" class="form-control production-id" name="production-id[]" ><option value="">Seleccione el elemento</option>@foreach ($productionsOptions as $elementId => $elementName)<option value="{{ $elementId }}">{{ $elementName }}</option>@endforeach</select></td>' +
                    '<td><input type="number" id="production_amount" class="form-control production_amount" name="production_amount[]" placeholder="Cantidad"></td>' +
                    '<td><input type="date" id="production-expiration" class="form-control production_expiration" name="production_expiration[]" placeholder="Expiracion #"></td>' +
                    '<td><input type="number" id="production-lot" class="form-control production-lot" name="production_lot[]" placeholder="Lote #"></td>' +
                    '<td class="col-1"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>'
                );

                // Inicializar Select2 en el campo de selección de herramientas
                newRow.find('.production-id').select2({
                    placeholder: "Buscar producto...",
                    allowClear: true // Esto permite borrar la selección actual
                });

                // Agregar la fila a la tabla
                productionTable.append(newRow);

            }


            // Manejador de eventos para el botón Agregar Producto
            $('#addProduct').click(function() {
                var lastRow = productionTable.find('tr.product-row:last');

                if (lastRow.find('#production-id').val() &&
                    lastRow.find('#production_amount').val()) {
                    addProductRow();

                    // Obtener el elemento seleccionado en la fila anterior
                    var selectedElementId = selectedElements[lastRow.index()];

                    // Llenar el campo de selección de productos de esta fila con los elementos previamente obtenidos
                    var productNameSelect = newRow.find(
                        '.production-id'); // Acceder a newRow en lugar de lastRow

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
            productionTable.on('click', '.removeProduct', function () {
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

        <script>
            $(document).ready(function () {
                // Manejador de eventos para el cambio en el campo "Unidad Productiva"
                $('#unitSelect').on('change', function () {
                    var selectedUnitId = $(this).val();
        
                    if (selectedUnitId) {
                        $.ajax({
                            url: "{{ route('agrocefa.labormanagement.warehouseUnits') }}",
                            method: 'GET',
                            data: {
                                unit: selectedUnitId
                            },
                            success: function (response) {
                                console.log(response);
                                if (response.filteredWarehouses) {
                                    var warehousesSelect = $('#warehouseSelect');
                                    warehousesSelect.empty();
                                    warehousesSelect.append(new Option('{{ trans('agrocefa::labor.Select_the_warehouse') }}', ''));
        
                                    // Recorre los resultados y crea opciones
                                    $.each(response.filteredWarehouses, function (index, warehouse) {
                                        warehousesSelect.append(new Option(warehouse.name, warehouse.id));
                                    });
                                }
                            },
                            error: function () {
                                console.error('Error en la solicitud AJAX');
                            }
                        });
                    }
                });
            });
        </script>

@extends('agrocefa::layouts.master')

@section('content')

@if (session('success'))
    <script>
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Registro Exitoso',
        showConfirmButton: false,
        timer: 1500,
        customClass: {
            popup: 'my-custom-popup-class', 
        },
        onOpen: () => {

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
<h2>{{trans('agrocefa::movements.Entry_Form')}}</h2>

<div class="container">
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'agrocefa.registerentrance', 'method' => 'POST']) !!}
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('date', trans('agrocefa::movements.Date')) !!}
                        {!! Form::text('date', $date, ['class' => 'form-control', 'required', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('user_id', trans('agrocefa::movements.Responsibility')) !!}
                        {!! Form::select('user_id', $people, null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>
                    
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card" id="card">
                        <div class="card-header" id="card_header">
                            {{ trans('agrocefa::movements.Delivery') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('deliverywarehouse', trans('agrocefa::movements.Warehouse_That_Delivers')) !!}
                                {!! Form::select('deliverywarehouse', $werhousentrance->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" id="card">
                        <div class="card-header" id="card_header">
                            {{ trans('agrocefa::movements.Receive') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('receivewarehouse', trans('agrocefa::movements.Warehouse_That_Receives')) !!}
                                {!! Form::select('receivewarehouse', $warehouseData->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    {!! Form::label('observation', trans('agrocefa::movements.Observation')) !!}
                    {!! Form::textarea('observation', null,  ['class' => 'form-control', 'style' => 'max-height: 100px;']) !!}
                </div>
            </div>
            <!-- Agregar la tabla dinámica -->
            <div class="form-group">
                <h3>{{ trans('agrocefa::movements.Elements')}}</h3>
                <table id="productTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('agrocefa::movements.1T_Name_Of_The_Element') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Measurement_Unit') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Amount') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Price') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Category') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Destination') }}</th>
                            <th>{{ trans('agrocefa::movements.1T_Actions') }}</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Filas de la tabla se agregarán dinámicamente aquí -->
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" id="addProduct">{{ trans('agrocefa::movements.Btn_Add_Element') }}</button>
            </div>
            <!-- Otros campos del formulario según tus necesidades -->
            <input type="hidden" name="products" id="productsInput" value="">
            <input type="hidden" class="product-selected-id" name="product_selected_id">
            <br>
            {!! Form::submit( trans('agrocefa::movements.Btn_Register_Entrance'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    console.log("Contenido de  elements:", {!! json_encode($elements) !!});
</script>
<style>
    #productTable th:nth-child(1),
    #productTable td:nth-child(1) {
        display: none;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var productTable = $('#productTable tbody');
        var elements = {!! json_encode($elements) !!};
        var productsData = [];

        // Función para actualizar los datos de los productos
        function updateProductsData() {
            productsData = [];

            // Recorrer todas las filas de la tabla de productos
            productTable.find('tr.product-row').each(function () {
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
                '<td><select class="form-control product-name" required></select></td>' +
                '<td><input type="text" name="product-measurement-unit[]" class="form-control product-measurement-unit" readonly></td>' +
                '<td><input type="number" class="form-control product-quantity" placeholder="{{trans('agrocefa::movements.Placeholder_Amount')}}"></td>' +
                '<td><input type="number" class="form-control product-price" placeholder="{{trans('agrocefa::movements.Placeholder_Price')}}" ></td>' +
                '<td><input type="text" class="form-control product-category" readonly></td>' +
                '<td><select class="form-control product-destination" required>' +
                '<option value="Producción">Producción</option>' +
                '<option value="Formación">Formación</option>' +
                '</select></td>' +
                '<td class="col-1"><button type="button" id="button" class="btn btn-danger removeProduct"><i class="fa fa-trash"></i></button>' +
                '<button type="button" class="btn btn-success saveProduct"><i class="fa fa-check"></i></button></td>');

            // Llenar el select de nombre de producto en la nueva fila
            var productNameSelect = newRow.find('.product-name');
            productNameSelect.append('<option value="">{{trans('agrocefa::movements.Placeholder_Element')}}</option>');

            // Iterar sobre los elementos y agregar las opciones al menú desplegable
            $.each(elements, function(index, element) {
                productNameSelect.append('<option value="' + element.id + '">' + element.name + '</option>');
            });

            // Agregar la fila a la tabla
            productTable.append(newRow);

            // Manejador de eventos para el botón Guardar
            newRow.find('.saveProduct').click(function () {
                var currentRow = $(this).closest('tr');

                // Verificar si todos los campos en la fila actual están completos
                if (currentRow.find('.product-name').val() && currentRow.find('.product-measurement-unit').val() && currentRow.find('.product-quantity').val() && currentRow.find('.product-price').val() && currentRow.find('.product-category').val() && currentRow.find('.product-destination').val()) {
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
        $('#addProduct').click(function () {
            var lastRow = productTable.find('tr.product-row:last');

            if (lastRow.find('.product-name').val() && lastRow.find('.product-measurement-unit').val() && lastRow.find('.product-quantity').val() && lastRow.find('.product-price').val() && lastRow.find('.product-category').val() && lastRow.find('.product-destination').val()) {
                addProductRow();
            } else {
                alert('Por favor, complete todos los campos de la fila actual antes de agregar otra.');
            }
        });

        // Manejador de eventos para eliminar productos
        productTable.on('click', '.removeProduct', function () {
            $(this).closest('tr').remove();
            updateProductsData();
        });

        // Manejador de eventos para cambiar la unidad de medida, la categoría, la cantidad y el precio al seleccionar un elemento
        productTable.on('change', '.product-name', function () {
            var currentRow = $(this).closest('tr');
            var selectedElementId = $(this).find('option:selected').val();

            // Realizar una solicitud AJAX para obtener los datos del elemento
            $.ajax({
                url: '{{ route('agrocefa.obtenerdatos') }}',
                method: 'GET',
                data: { element: selectedElementId },
                success: function (response) {
                    console.log(response);
                    var measurementUnitField = currentRow.find('.product-measurement-unit');
                    var categoryField = currentRow.find('.product-category');


                    measurementUnitField.val(response.unidad_medida || 'Unidad de medida no encontrada');
                    categoryField.val(response.categoria || 'Categoría no encontrada');


                    // Llamar a updateProductsData después de cambiar la selección
                    updateProductsData();
                },
                error    : function () {
                    var measurementUnitField = currentRow.find('.product-measurement-unit');
                    var categoryField = currentRow.find('.product-category');

                    measurementUnitField.val('Error al obtener la unidad de medida');
                    categoryField.val('Error al obtener la categoría');
  

                    // Llamar a updateProductsData después de cambiar la selección
                    updateProductsData();
                }
            });
        });
    });
</script>



@endsection

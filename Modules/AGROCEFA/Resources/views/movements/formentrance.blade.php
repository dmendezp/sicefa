@extends('agrocefa::layouts.master')

@section('content')
    <h2>Formulario Entrada</h2>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3></h3>
            </div>
            <div class="card-body">
                
                {!! Form::open(['route' => 'agrocefa.registerentrance', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('date', 'Fecha') !!}
                    {!! Form::text('date', $date, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('user_id', 'Responsable') !!}
                    {!! Form::select('user_id', $people->pluck('first_name', 'id'), null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('deliverywarehouse', 'Bodega Entrega') !!}
                    {!! Form::select('deliverywarehouse', $werhousentrance->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('receivewarehouse', 'Bodega Recibe') !!}
                    {!! Form::select('receivewarehouse', $warehouseData->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
                </div>
                <!-- Agregar la tabla dinámica -->
                <div class="form-group">
                    <h3>Productos</h3>
                    <table id="productTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre del Producto</th>
                                <th>Unidad de Medida</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Categoria</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas de la tabla se agregarán dinámicamente aquí -->
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary" id="addProduct">Agregar Producto</button>
                </div>
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit('Registrar Entrada', ['class' => 'btn btn-primary',]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

<!-- Agrega esto en la sección de scripts en tu vista -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Variables para la tabla y el botón de agregar producto
        var productTable = $('#productTable tbody');
        var addProductButton = $('#addProduct');
        var elements = {!! json_encode($elements) !!};

        // Activa manualmente el manejador de eventos 'change' en el elemento select de la primera fila
        var firstRowProductNameSelect = productTable.find('.product-name').first();
        firstRowProductNameSelect.change(); // Simula el evento 'change'

        // Manejador de eventos para el botón Agregar Producto
        addProductButton.click(function() {
            // Crear una nueva fila para agregar un producto
            var newRow = $('<tr>');
            newRow.html('<td><select class="form-control product-name" required></select></td>' +
                        '<td><input type="text" class="form-control product-measurement-unit" readonly></td>' +
                        '<td><input type="number" class="form-control product-quantity" placeholder="Cantidad"></td>' +
                        '<td><input type="number" class="form-control product-price" placeholder="Precio"></td>' +
                        '<td><input type="text" class="form-control product-category" readonly></td>' +
                        '<td><button type="button" class="btn btn-danger removeProduct">Eliminar</button></td>');

            // Agregar la fila a la tabla
            productTable.append(newRow);

            // Llenar el select de nombre de producto en la nueva fila
            var productNameSelect = newRow.find('.product-name');
            productNameSelect.append('<option value="">Seleccione un elemento</option>');

            $.each(elements, function(name, measurementUnit) {
                productNameSelect.append('<option value="' + name + '">' + name + '</option>');
            });
        });

        // Manejador de eventos para cambiar la unidad de medida y obtener la categoría al seleccionar un elemento
        productTable.on('change', '.product-name', function() {
            var selectedElement = $(this).val(); // Elemento seleccionado
            var measurementUnitField = $(this).closest('tr').find('.product-measurement-unit');
            var categoryField = $(this).closest('tr').find('.product-category');

            // Realizar una solicitud AJAX para obtener la unidad de medida y la categoría del elemento
            $.ajax({
                url: '{{ route('agrocefa.obtenerunidadmedida') }}',
                method: 'GET',
                data: { element: selectedElement },
                success: function(response) {
                    if (response.unidad_medida !== undefined && response.unidad_medida !== '') {
                        // Si la unidad de medida se encuentra en la respuesta, mostrarla
                        measurementUnitField.val(response.unidad_medida);
                    } else {
                        // Si la unidad de medida no se encuentra, mostrar un mensaje de error
                        measurementUnitField.val('Unidad de medida no encontrada');
                    }

                    // Realizar una solicitud AJAX adicional para obtener la categoría
                    $.ajax({
                        url: '{{ route('agrocefa.obtenercategoria') }}',
                        method: 'GET',
                        data: { element: selectedElement },
                        success: function(response) {
                            if (response.categoria !== undefined && response.categoria !== '') {
                                // Si la categoría se encuentra en la respuesta, mostrarla
                                categoryField.val(response.categoria);
                            } else {
                                // Si la categoría no se encuentra, mostrar un mensaje de error
                                categoryField.val('Categoría no encontrada');
                            }
                        },
                        error: function() {
                            // Manejo de errores si la solicitud falla
                            categoryField.val('Error al obtener la categoría');
                        }
                    });
                },
                error: function() {
                    // Manejo de errores si la solicitud para la unidad de medida falla
                    measurementUnitField.val('Error al obtener la unidad de medida');
                }
            });
        });


        // Manejador de eventos para eliminar productos
        productTable.on('click', '.removeProduct', function() {
            $(this).closest('tr').remove();
        });
    });

</script>


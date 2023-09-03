@extends('agrocefa::layouts.master')

@section('content')
    <h2>Formulario Salida</h2>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3></h3>
            </div>
            <div class="card-body">
                {!! Form::open(['method' => 'POST']) !!}
                @csrf
                @method('PUT')
                <div class="form-group">
                    {!! Form::label('date', 'Fecha') !!}
                    {!! Form::text('date', $date, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('user_id', 'Responsable') !!}
                    {!! Form::select('user_id', $people->pluck('first_name','first_last_name', 'id'), null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('deliverywarehouse', 'Bodega Entrega') !!}
                    {!! Form::select('deliverywarehouse', $werhousentrance->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('receivewarehouse', 'Bodega Recibe') !!}
                    {!! Form::select('receivewarehouse', $receivewarehouse->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
                </div>
                <!-- Agregar la tabla dinámica -->
                <div class="form-group">
                    <h3>Productos</h3>
                    <table id="productTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre del Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas de la tabla se agregarán dinámicamente aquí -->
                            <td><input type="text" name="product_name[]"></td>
                            <td><input type="number" name="product_quantity[]"></td>
                            <td><input type="number" name="product_price[]"></td>
                            <td><button type="button" class="btn btn-danger removeProduct">Eliminar</button></td>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary" id="addProduct">Agregar Producto</button>
                </div>
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit('Registrar Salida', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Variables para la tabla y el botón de agregar producto
        var productTable = $('#productTable tbody');
        var addProductButton = $('#addProduct');

        // Manejador de eventos para el botón Agregar Producto
        addProductButton.click(function() {
            // Crear una nueva fila para agregar un producto
            var newRow = $('<tr>');
            newRow.html('<td><input type="text" name="product_name[]"></td>' +
                        '<td><input type="number" name="product_quantity[]"></td>' +
                        '<td><input type="number" name="product_price[]"></td>' +
                        '<td><button type="button" class="btn btn-danger removeProduct">Eliminar</button></td>');

            // Agregar la fila a la tabla
            productTable.append(newRow);
        });

        // Manejador de eventos para eliminar productos
        productTable.on('click', '.removeProduct', function() {
            $(this).closest('tr').remove();
        });
    });
</script>


<div>
    <div class="row mx-3">
        <div class="col-4">
            <div class="form-group">
                <label>Producto:</label>
                <select id='product_id' class="form-select" wire:model="product_id">
                    <option value="">-- Seleccionar producto --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"> {{ $product->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>Existencias:</label>
                {!! Form::text('product_total_amount', $product_total_amount, ['class'=>'form-control text-center', 'disabled']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>Precio:</label>
                {!! Form::text('product_price', $product_price, ['class'=>'form-control text-center', 'disabled']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>Cantidad:</label>
                {!! Form::number('product_amount', null, ['class'=>'form-control text-center', 'id'=>'product_amount', 'disabled',
                    'wire:model.defer'=>'product_amount', 'wire:keydown.enter'=>'addProduct']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>Subtotal:</label>
                {!! Form::text('product_subtotal', null, ['class'=>'form-control text-center', 'id'=>'product_subtotal', 'disabled',
                    'wire:model'=>'product_subtotal']) !!}
            </div>
        </div>
    </div>

    <div class="row mx-3">
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 500px">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Producto</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Valor</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selected_products as $sp)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}</th>
                                        <td>{{ $sp['product_name'] }}</td>
                                        <td class="text-center">
                                            <strong>{{ $sp['product_amount'] }}</strong>
                                        </td>
                                        <td class="text-center">{{ $sp['product_price'] }}</td>
                                        <td class="text-center">
                                            <strong>{{ $sp['product_subtotal'] }}</strong>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-outline-warning btn-sm py-0" data-toggle="tooltip" data-placement="top" title="Actualizar producto"
                                                    wire:click="editProduct({{ $sp['product_element_id'] }})">
                                                <i class="fas fa-pen-alt"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-danger btn-sm py-0" data-toggle="tooltip" data-placement="top" title="Eliminar producto"
                                                    wire:click="deleteProduct({{ $sp['product_element_id'] }})">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-success">
                <div class="card-header text-center">
                    <strong>Venta</strong>
                </div>
                <div class="card-body tex-center py-1 pb-2">

                    <label class="form-label my-0">Nombre</label>
                    {!! Form::select('person_id', ['1'=>'Jesús David Guevara Munar', '2'=>'Punto de venta'], 2, ['class'=>'form-select form-select-sm', 'placeholder'=>'-- Seleccionar --']) !!}
                    <label class="form-label my-0 mt-1">Identificación</label>
                    {!! Form::text('identification', 'CC - ##########', ['class'=>'form-control form-control-sm', 'placeholder'=>'Selecciona persona', 'disabled']) !!}
                    <div class="form-check form-switch mt-1">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Generar factura</label>
                    </div>
                    <hr>

                    <ul class="list-group list-group-flush text-center px-5 rounded-3 fs-5">
                        <li class="list-group-item list-group-item-primary py-0 px-0">
                            {!! Form::number('total', $total ? $total : 0, [
                                'class'=>'form-control form-control-lg text-center mx-0',
                                'id'=>'total',
                                'style' => 'background-color: #d1e2ff',
                                'disabled'])
                            !!}
                        </li>
                        <li class="list-group-item py-1 px-0">
                            {!! Form::number('payment_value', $payment_value ? $payment_value : 0, [
                                'class'=>'form-control form-control-lg text-center mx-0',
                                'id'=>'payment_value',
                                $input_payment_value ? '' : 'disabled'])
                            !!}
                        </li>
                        <li class="list-group-item list-group-item-dark py-0 px-0">
                            {!! Form::number('total', $change_value ? $change_value : 0, [
                                'class'=>'form-control form-control-lg text-center mx-0 text-success fw-bold',
                                'id'=>'change_value',
                                'style' => 'background-color: #ced4da',
                                'disabled'])
                            !!}
                        </li>
                    </ul>

                    <div class="text-center mt-2">
                        <button class="btn btn-sm btn-success" id="sale_button" wire:click="registerSale" disabled>
                            <i class="far fa-plus-square"></i>
                            Registrar Venta
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@section('sripts-generate-sale')
    <script>
        $(document).ready(function() {
            $("#payment_value").click(function() {
                $(this).select(); // Seleccionar todo el contenido del input cuando se de un click dentro del campo de valor de pago
            });
        });

        // Calcular el valor de cambio de acuerdo al total de la comprar y el valor de pago de la compra
        function calculate(total) {
            var payment_value = parseInt($("#payment_value").val());
            $("#change_value").removeClass('text-success').addClass('text-danger').val(payment_value - total);
            $('#sale_button').prop('disabled', true); // Desactivar botón de realizar venta
            if (total!=0 && payment_value>=total) {
                $("#change_value").removeClass('text-danger').addClass('text-success').val(payment_value - total);
                $("#sale_button").prop('disabled', false); // Activar botón de realizar venta
            }
            if(total>0){ // Verificar que el total sea mayor a 0 para así activiar o desactivar el botón de realizar venta
                $("#payment_value").prop('disabled', false); // Activar el input del valor de pago
            }else{
                $("#payment_value").prop('disabled', true); // Desactivar el input del valor de pago
            }
            input_payment_value(total);
        }

        // Configuración para calcular el valor de cambio de una venta y activación/desactivación del botón guardar venta
        function input_payment_value(total){
            var $payment_value = $('#payment_value'); // Instanciar el elemento de valor de cambio
            var $change_value = $('#change_value'); // Instanciar el elemento de valor de cambio
            var $sale_button = $('#sale_button'); // Instanciar botón de realizar venta
            $payment_value.off('input').on('input', function(){
                var input_payment_value = $(this);
                var val_payment_value = parseInt(input_payment_value.val());
                if(isNaN(val_payment_value) || val_payment_value < 0){
                    input_payment_value.val(0);
                    $change_value.removeClass('text-success').addClass('text-danger').val(0);
                    $sale_button.prop('disabled', true); // Desactivar botón de realizar venta
                } else if (val_payment_value >= total) {
                    $change_value.removeClass('text-danger').addClass('text-success').val(val_payment_value - total);
                    $sale_button.prop('disabled', false); // Activar botón de realizar venta
                } else {
                    $change_value.removeClass('text-success').addClass('text-danger').val(val_payment_value - total);
                    $sale_button.prop('disabled', true); // Desactivar botón de realizar venta
                }
            });
            $('#total').val(total);
            $payment_value.trigger('input');
            if(total == 0){
                $sale_button.prop('disabled', true); // Desactivar botón de realizar venta
            }
        }

        // Limpiar valores de venta
        Livewire.on('clear-sale-values', function() {
            $("#total").val(0);
            $("#payment_value").val(0);
            $("#change_value").val(0);
        });

        // lanzar mensajes
        Livewire.on('message', function(type, action, message, change_value) {
            color = (type=='success') ? 'green' : ((type=='error') ? 'red' : 'default');
            Swal.fire({
                title: action,
                text: message,
                html: (type == 'success') ?
                    '<div class="bg-light py-2">' +
                        '<p class="text-secondary">Tiene un cambio de:</p>' +
                        '<h1>'+ $('#change_value') +'</h1>' +
                    '</div>'
                    : null,
                icon: type,
                iconColor: color,
                confirmButtonText: 'Aceptar',
                confirmButtonColor: 'green'
            });
        });
        
        // Calcular valor de cambio
        Livewire.on('change_value', function(){
            $('#payment_value').trigger('input');
        });

        // Llamado de función para calcular el valor de cambio de una venta y activación/desactivación del botón guardar venta
        Livewire.on('input-payment-value', function(total) {
            input_payment_value(total);
        });

        // Establecer configuraciones para el campo de ingreso de cantidad
        Livewire.on('input-product-amount', function(product_total_amount, product_price, product_subtotal, total) {
            var $product_amount = $('#product_amount'); // Instanciar el campo de cantidad de producto
            var $product_subtotal = $('#product_subtotal'); // Instancia el campo subtotal del producto
            var $total = $('#total'); // Instanciar el campo total de la venta

            $total.val(total + product_subtotal); // Establecer valor total en tiempo real (especialmente cuando se edita un producto).
            calculate($total.val());

            if (product_total_amount == 0) {
                $product_amount.prop('disabled', true); // Desactivar el campo Cantidad
            } else {
                $product_amount.prop('disabled', false).focus(); // Desactivar campo Cantidad
                $product_amount.off('input').on('input', function() { // Establecer propiedades para el campo de cantidad, subtotal de productos y total de la venta
                    var input = $(this);
                    var val = parseInt(input.val());
                    if (isNaN(val) || val < 0) {
                        input.val(0);
                        $product_subtotal.val(0);
                        $total.val(total);
                    } else if (val > product_total_amount) {
                        input.val(product_total_amount);
                        $product_subtotal.val(product_total_amount*product_price);
                        $total.val(product_total_amount * product_price + total);
                    } else {
                        input.val(val);
                        $product_subtotal.val(val*product_price);
                        $total.val(val * product_price + total);
                    }
                    calculate($total.val());
                });
            }
        });
    </script>
@endsection

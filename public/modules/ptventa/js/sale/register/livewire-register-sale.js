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
                '<h1>'+ change_value +'</h1>' +
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

    new bootstrap.Modal($('#registerCustomer')).show();

window.addEventListener('closeFormModal', event => {
    new bootstrap.Modal($('#registerCustomer')).hide();
})


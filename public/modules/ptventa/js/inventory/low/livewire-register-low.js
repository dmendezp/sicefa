// Establecer configuraciones para el campo de ingreso de cantidad
Livewire.on('input-product-amount', function(product_total_amount) {
    
    var $product_amount = $('#product_amount');

    if (product_total_amount == 0) {
        $product_amount.prop('disabled', true);
    } else {
        $product_amount.prop('disabled', false).focus();

        $product_amount.off('input').on('input', function() {
            var input = $(this);
            var val = parseInt(input.val());
            if (isNaN(val) || val < 0) {
                input.val(0);
            } else if (val > product_total_amount) {
                input.val(product_total_amount);
            } else {
                input.val();
            }            
        });
    }
});

// lanzar mensajes
Livewire.on('message', function(type, action, message) {
    const color = {
        success: 'green',
        error: 'red'
    };
    if(type=='alert-success'){
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 2000
        })
    }else if(type=='alert-warning'){
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: message,
            showConfirmButton: false,
            timer: 1500
        })
    }else{
        Swal.fire({
            title: action,
            text: message,
            icon: type,
            iconColor: color[type],
            confirmButtonText: 'Aceptar',
            confirmButtonColor: 'green'
        });
    }
});

Livewire.on('printTicket', async function(voucher_number, date, customer, dt_customer, seller, details, total) {
    print_sale(voucher_number, date, customer, dt_customer, seller, details, total);
});
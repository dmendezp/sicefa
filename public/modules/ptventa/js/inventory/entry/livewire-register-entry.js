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
            timer: 1500
        })
    }else if(type=='alert-warning'){
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: message,
            showConfirmButton: false,
            timer: 2000
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

// Establecer el precio del producto de acuerdo al elemento seleccionado
$('#product_element_id').change(function() {
    value = $(this).find(':selected').data('price');
    $('#product_price').val(value);
    if(value!=''){
        $('#product_amount').focus();
    }
});
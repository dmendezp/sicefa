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

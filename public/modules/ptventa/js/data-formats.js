// Formatear el número con separador de miles usando puntos y símbolo de moneda "$"
function priceFormat(numero) {
    return "$" + numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Eliminamos el símbolo de moneda "$" y los puntos separadores de miles
function revertPriceFormat(precioFormateado) {
    const numeroSinFormato = precioFormateado.replace(/\$|\.+/g, '');
    const numero = parseFloat(numeroSinFormato);
    return numero;
}

// Generar clase para aplicar formato de precio en un input de formulario
$('.price-format').toArray().forEach(function(field){
    new Cleave(field, { /* Format for price data $ #.###,## */
        prefix: '$',
        numeral: true,
        numeralDecimalMark: ',',
        delimiter: '.',
        numeralDecimalScale: 2
    });
});

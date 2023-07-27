function priceFormat(numero) {
    // Formatear el número con separador de miles usando puntos y símbolo de moneda "$"
    return "$" + numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

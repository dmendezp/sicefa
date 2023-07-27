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
            html: (type == 'success') ?
                '<div class="bg-light py-2">' +
                    '<p class="text-secondary">Tiene un cambio de:</p>' +
                    '<h1>'+ change_value +'</h1>' +
                '</div>'
                : null,
            icon: type,
            iconColor: color[type],
            confirmButtonText: 'Aceptar',
            confirmButtonColor: 'green'
        });
    }
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
        $product_amount.prop('disabled', false).focus(); // Activar campo Cantidad
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

// Definir constante para manipular los distintos eventos manejados por el modal de registro de cliente (persona)
const modalRegisterCustomer = new bootstrap.Modal($('#registerCustomer'));

// Abrir el formulario de registro de cliente (persona)
Livewire.on('open-modal-register-customer', function() {
    modalRegisterCustomer.show();
});

// Cerrar el formulario de registro de cliente (persona)
Livewire.on('close-modal-register-customer', function() {
    modalRegisterCustomer.hide();
});

Livewire.on('printTicket', async function(voucher_number, date, customer, dt_customer, seller, details, total) {

    // Componentes para tabular la tabla
    const separarCadenaEnArregloSiSuperaLongitud = (cadena, maximaLongitud) => {
        const resultado = [];
        let indice = 0;
        while (indice < cadena.length) {
            const pedazo = cadena.substring(indice, indice + maximaLongitud);
            indice += maximaLongitud;
            resultado.push(pedazo);
        }
        return resultado;
    }
    const dividirCadenasYEncontrarMayorConteoDeBloques = (contenidosConMaximaLongitud) => {
        let mayorConteoDeCadenasSeparadas = 0;
        const cadenasSeparadas = [];
        for (const contenido of contenidosConMaximaLongitud) {
            const separadas = separarCadenaEnArregloSiSuperaLongitud(contenido.contenido, contenido.maximaLongitud);
            cadenasSeparadas.push({ separadas, maximaLongitud: contenido.maximaLongitud });
            if (separadas.length > mayorConteoDeCadenasSeparadas) {
                mayorConteoDeCadenasSeparadas = separadas.length;
            }
        }
        return [cadenasSeparadas, mayorConteoDeCadenasSeparadas];
    }
    const tabularDatos = (cadenas, relleno, separadorColumnas) => {
        const [arreglosDeContenidosConMaximaLongitudSeparadas, mayorConteoDeBloques] = dividirCadenasYEncontrarMayorConteoDeBloques(cadenas)
        let indice = 0;
        const lineas = [];
        while (indice < mayorConteoDeBloques) {
            let linea = "";
            for (const contenidos of arreglosDeContenidosConMaximaLongitudSeparadas) {
                let cadena = "";
                if (indice < contenidos.separadas.length) {
                    cadena = contenidos.separadas[indice];
                }
                if (cadena.length < contenidos.maximaLongitud) {
                    cadena = cadena + relleno.repeat(contenidos.maximaLongitud - cadena.length);
                }
                linea += cadena + separadorColumnas;
            }
            lineas.push(linea);
            indice++;
        }
        return lineas;
    }

    // Estructura de la tabla
    const maximaLongitudItem = 2,
    maximaLongitudNombre = 22,
    maximaLongitudCantidad = 4,
    maximaLongitudPrecio = 7,
    maximaLongitudSubtotal = 8,
    relleno = " ",
    separadorColumnas = "|";
    const obtenerLineaSeparadora = () => {
        const lineasSeparador = tabularDatos(
            [
                { contenido: "-", maximaLongitud: maximaLongitudItem },
                { contenido: "-", maximaLongitud: maximaLongitudNombre },
                { contenido: "-", maximaLongitud: maximaLongitudCantidad },
                { contenido: "-", maximaLongitud: maximaLongitudPrecio },
                { contenido: "-", maximaLongitud: maximaLongitudSubtotal },
            ],
            "-",
            "+",
        );
        let separadorDeLineas = "";
        if (lineasSeparador.length > 0) {
            separadorDeLineas = lineasSeparador[0]
        }
        return separadorDeLineas;
    }
    let tabla = obtenerLineaSeparadora() + "\n";
    const lineasEncabezado = tabularDatos([
        { contenido: "#", maximaLongitud: maximaLongitudItem },
        { contenido: "Producto", maximaLongitud: maximaLongitudNombre },
        { contenido: "Cant", maximaLongitud: maximaLongitudCantidad },
        { contenido: "V.Unit", maximaLongitud: maximaLongitudPrecio },
        { contenido: "Subtotal", maximaLongitud: maximaLongitudSubtotal },
    ],
        relleno,
        separadorColumnas,
    );
    for (const linea of lineasEncabezado) {
        tabla += linea + "\n";
    }
    tabla += obtenerLineaSeparadora() + "\n";
    for (const [index, d] of details.entries()) {
        const autoincrementable = index + 1;
        const lineas = tabularDatos(
            [
            { contenido: autoincrementable.toString(), maximaLongitud: maximaLongitudItem },
                { contenido: d.product_name, maximaLongitud: maximaLongitudNombre },
                { contenido: " "+d.product_amount.toString(), maximaLongitud: maximaLongitudCantidad },
                { contenido: priceFormat(d.product_price), maximaLongitud: maximaLongitudPrecio },
                { contenido: priceFormat(d.product_subtotal), maximaLongitud: maximaLongitudSubtotal },
            ],
            relleno,
            separadorColumnas
        );
        for (const linea of lineas) {
            tabla += linea + "\n";8
        }
        tabla += obtenerLineaSeparadora() + "\n";
    }

    // Inicio de impresión
    const conector = new ConectorPluginV3();
    const respuesta = await conector
    .Iniciar()
    .EstablecerTamañoFuente(1, 1)
    .EstablecerEnfatizado(false)
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO)
    .Corte(1)
    .TextoSegunPaginaDeCodigos(2, "cp850", "CENTRO DE FORMACIÓN AGROINDUSTRIAL\n")
    .EscribirTexto("Nit 899.99934-1\n")
    .DeshabilitarElModoDeCaracteresChinos()
    .TextoSegunPaginaDeCodigos(2, "cp850", "Producción de Centro - SENA Empresa\n")
    .EscribirTexto("La Angostura\n")
    .EscribirTexto("Art 17 Decreto 1001 de 1997\n")
    .EscribirTexto("------------------------------------------------\n")
    .EstablecerEnfatizado(true)
    .TextoSegunPaginaDeCodigos(2, "cp850", "Factura de entrada N°: "+voucher_number+"\n")
    .EstablecerEnfatizado(false)
    .EscribirTexto("------------------------------------------------\n")
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
    .EstablecerEnfatizado(true)
    .EscribirTexto("Fecha y hora: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", date+"\n")
    .EstablecerEnfatizado(true)
    .EscribirTexto("Cliente: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", customer+"\n")
    .EstablecerEnfatizado(true)
    .TextoSegunPaginaDeCodigos(2, "cp850", "Identificación: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", dt_customer+"\n")
    .EstablecerEnfatizado(true)
    .EscribirTexto("Vendedor: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", seller+"\n")
    .EscribirTexto(tabla)
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
    .EstablecerEnfatizado(true)
    .EscribirTexto("TOTAL:  "+priceFormat(total)+" |\n")
    .EstablecerEnfatizado(false)
    .EscribirTexto("-----------------------------------------------+\n")
    .Feed(4)
    .Corte(1)
    .imprimirEn("POS-80C");
    if (respuesta === true) {
    } else {
        alert("Error al imprimir comprobante: " + respuesta);
    }
});






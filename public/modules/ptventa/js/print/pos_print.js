
function print_sale(voucher_number, date, customer, dt_customer, seller, details, total){
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
                { contenido: d.product_price, maximaLongitud: maximaLongitudPrecio },
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
    .TextoSegunPaginaDeCodigos(2, "cp850", "Factura de venta N°: "+voucher_number+"\n")
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
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO)
    .EscribirTexto("Muchas gracias por su compra\n")
    .TextoSegunPaginaDeCodigos(2, "cp850", "¡Vuelva pronto!")
    .Feed(4)
    .Corte(1)
    .imprimirEn("POS-80C");
    if (respuesta === true) {
    } else {
        alert("Error al imprimir comprobante: " + respuesta);
    }
};



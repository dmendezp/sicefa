/* Realizar impresión de baja de inventario */
async function print_low_inventory(movement) {
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
    for (const [index, d] of movement.movement_details.entries()) {

        const autoincrementable = index + 1;
        const lineas = tabularDatos(
            [
            { contenido: autoincrementable.toString(), maximaLongitud: maximaLongitudItem },
                { contenido: d.inventory.element.name + " (" + d.inventory.element.measurement_unit.name + ")", maximaLongitud: maximaLongitudNombre },
                { contenido: " "+d.amount.toString(), maximaLongitud: maximaLongitudCantidad },
                { contenido: priceFormat(d.price), maximaLongitud: maximaLongitudPrecio },
                { contenido: priceFormat(d.amount * d.price), maximaLongitud: maximaLongitudSubtotal },
            ],
            relleno,
            separadorColumnas
        );
        for (const linea of lineas) {
            tabla += linea + "\n";
        }
        tabla += obtenerLineaSeparadora() + "\n";
    }

    // Obtener responsable del registro de baja
    responsible = movement.movement_responsibilities.find(function(wm) {return wm.role === "ENTREGA";}).person;

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
    .TextoSegunPaginaDeCodigos(2, "cp850", "PTVENTA - Baja de inventario N°: "+movement.voucher_number+"\n")
    .EstablecerEnfatizado(false)
    .EscribirTexto("------------------------------------------------\n")
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
    .EstablecerEnfatizado(true)
    .EscribirTexto("Fecha y hora: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", movement.registration_date+"\n")
    .EstablecerEnfatizado(true)
    .EscribirTexto("Bodega:       ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", movement.warehouse_movements.find(function(wm) {return wm.role === "Entrega";}).productive_unit_warehouse.warehouse.name+"\n")
    .EstablecerEnfatizado(true)
    .EscribirTexto("Responsable:  ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", responsible.first_name+" "+responsible.first_last_name+" "+responsible.second_last_name +"\n")
    .TextoSegunPaginaDeCodigos(2, "cp850", tabla)
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
    .EstablecerEnfatizado(true)
    .EscribirTexto("TOTAL:  "+priceFormat(movement.price)+" |\n")
    .EstablecerEnfatizado(false)
    .EscribirTexto("-----------------------------------------------+\n")
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
    .EstablecerEnfatizado(true)
    .TextoSegunPaginaDeCodigos(2, "cp850", "Observación: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", movement.observation+"\n")
    .EscribirTexto("------------------------------------------------\n")
    .Feed(4)
    .Corte(1)
    .imprimirEn("POS-80C");
    if (respuesta === true) {
        return true;
    } else {
        /* Lanzar notificación toastr */
        toastr.options.timeOut = 0;
        toastr.options.closeButton = true;
        toastr.error(respuesta, 'Error de impresión');
        return false;
    }
};

/* Realizar impresión de entrada de inventario */
async function print_entry_inventory(movement) {
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
    for (const [index, d] of movement.movement_details.entries()) {
        const autoincrementable = index + 1;
        const lineas = tabularDatos(
            [
                { contenido: autoincrementable.toString(), maximaLongitud: maximaLongitudItem },
                { contenido: d.inventory.element.name + " (" + d.inventory.element.measurement_unit.name + ")", maximaLongitud: maximaLongitudNombre },
                { contenido: " "+d.amount.toString(), maximaLongitud: maximaLongitudCantidad },
                { contenido: priceFormat(d.price), maximaLongitud: maximaLongitudPrecio },
                { contenido: priceFormat(d.amount * d.price), maximaLongitud: maximaLongitudSubtotal },
            ],
            relleno,
            separadorColumnas
        );
        for (const linea of lineas) {
            tabla += linea + "\n";
        }
        tabla += obtenerLineaSeparadora() + "\n";
    }

    // Obtener el proveeder que entra los productos
    provider = movement.movement_responsibilities.find(function(wm) {return wm.role === "ENTREGA";}).person;
    // Obtener el responsable que recibe los productos
    receive = movement.movement_responsibilities.find(function(wm) {return wm.role === "RECIBE";}).person;

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
    .TextoSegunPaginaDeCodigos(2, "cp850", "PTVENTA - Entrada de inventario N°: "+movement.voucher_number+"\n")
    .EstablecerEnfatizado(false)
    .EscribirTexto("------------------------------------------------\n")
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
    .EstablecerEnfatizado(true)
    .EscribirTexto("Fecha y hora: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", movement.registration_date+"\n")
    .EstablecerEnfatizado(true)
    .EscribirTexto("Proveedor:    ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", provider.first_name+" "+provider.first_last_name+" "+provider.second_last_name +"\n")
    .EstablecerEnfatizado(true)
    .EscribirTexto("Recibe:       ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", receive.first_name+" "+receive.first_last_name+" "+receive.second_last_name +"\n")
    .TextoSegunPaginaDeCodigos(2, "cp850", tabla)
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
    .EstablecerEnfatizado(true)
    .EscribirTexto("TOTAL:  "+priceFormat(movement.price)+" |\n")
    .EstablecerEnfatizado(false)
    .EscribirTexto("-----------------------------------------------+\n")
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
    .EstablecerEnfatizado(true)
    .TextoSegunPaginaDeCodigos(2, "cp850", "Observación: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", movement.observation+"\n")
    .EscribirTexto("------------------------------------------------\n")
    .Feed(4)
    .Corte(1)
    .imprimirEn("POS-80C")
    if (respuesta === true) {
        return true;
    } else {
        /* Lanzar notificación toastr */
        toastr.options.timeOut = 0;
        toastr.options.closeButton = true;
        toastr.error(respuesta, 'Error de impresión');
        return false;
    }
};

/* Realizar impresión de venta realizada */
async function print_sale(movement) {
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

    const processed_elements = new Set(); // Almacenar los elementos procesados
    iteration_group = 0; // Iteración del grupo de elementos

    for (const [index, d] of movement.movement_details.entries()) {

        element_id = d.inventory.element_id; // Capturar elemento procesado
        // Comprobar si el elemento ya ha sido procesado
        if (!processed_elements.has(element_id)) {
            processed_elements.add(element_id); // Agregar elemento como procesado
            iteration_group ++; // Incrementar el número de iteración del grupo de elementos procesados
            total_amount = 0; // Cantidad total del grupo de elementos
            for(const [index_aux, aux_d] of movement.movement_details.entries()){ // Recorrer todos los elementos para obtener la cantidad total del elemento procesado
                if(aux_d.inventory.element_id == element_id){
                    total_amount += aux_d.amount;
                }
            }

            const lineas = tabularDatos(
                [
                    { contenido: iteration_group.toString(), maximaLongitud: maximaLongitudItem },
                    { contenido: d.inventory.element.name + " (" + d.inventory.element.measurement_unit.name + ")", maximaLongitud: maximaLongitudNombre },
                    { contenido: " "+total_amount.toString(), maximaLongitud: maximaLongitudCantidad },
                    { contenido: priceFormat(d.price), maximaLongitud: maximaLongitudPrecio },
                    { contenido: priceFormat(total_amount * d.price), maximaLongitud: maximaLongitudSubtotal },
                ],
                relleno,
                separadorColumnas
            );
            for (const linea of lineas) {
                tabla += linea + "\n";
            }
            tabla += obtenerLineaSeparadora() + "\n";
        }
    }

    // Obtener el proveeder que entra los productos
    customer = movement.movement_responsibilities.find(function(wm) {return wm.role === "CLIENTE";}).person;
    // Obtener el responsable que recibe los productos
    seller = movement.movement_responsibilities.find(function(wm) {return wm.role === "VENDEDOR";}).person;
    // Establecer abreviaciones del tipo de documento de indentificación
    const document_type_abbreviations = {
        'Cédula de ciudadanía': 'CC',
        'Tarjeta de identidad': 'TI',
        'Cédula de extranjería': 'CE',
        'Pasaporte': 'PP',
        'Documento nacional de identidad': 'DNI',
        'Registro civil': 'RC'
    };

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
    .TextoSegunPaginaDeCodigos(2, "cp850", "PTVENTA - Factura de venta N°: "+movement.voucher_number+"\n")
    .EstablecerEnfatizado(false)
    .EscribirTexto("------------------------------------------------\n")
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
    .EstablecerEnfatizado(true)
    .EscribirTexto("Fecha y hora: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", movement.registration_date+"\n")
    .EstablecerEnfatizado(true)
    .EscribirTexto("Cliente: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", customer.first_name+" "+customer.first_last_name+" "+customer.second_last_name +"\n")
    .EstablecerEnfatizado(true)
    .TextoSegunPaginaDeCodigos(2, "cp850", "Identificación: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", document_type_abbreviations[customer.document_type]+"-"+customer.document_number +"\n")
    .EstablecerEnfatizado(true)
    .EscribirTexto("Vendedor: ")
    .EstablecerEnfatizado(false)
    .TextoSegunPaginaDeCodigos(2, "cp850", seller.first_name+" "+seller.first_last_name+" "+seller.second_last_name +"\n")
    .TextoSegunPaginaDeCodigos(2, "cp850", tabla)
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
    .EstablecerEnfatizado(true)
    .EscribirTexto("TOTAL:  "+priceFormat(movement.price)+" |\n")
    .EstablecerEnfatizado(false)
    .EscribirTexto("-----------------------------------------------+\n")
    .EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO)
    .EscribirTexto("Muchas gracias por su compra\n")
    .TextoSegunPaginaDeCodigos(2, "cp850", "¡Vuelva pronto!")
    .Feed(4)
    .Corte(1)
    .imprimirEn("POS-80C")
    if (respuesta === true) {
        return true;
    } else {
        /* Lanzar notificación toastr */
        toastr.options.timeOut = 0;
        toastr.options.closeButton = true;
        toastr.error(respuesta, 'Error de impresión');
        return false;
    }
};







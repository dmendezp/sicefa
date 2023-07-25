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

function imprimirTicket(voucher_number, date, provider, receive, details, total) {
    return new Promise(async (resolve) => {
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
                    { contenido: " "+d.product_price.toString(), maximaLongitud: maximaLongitudPrecio },
                    { contenido: " "+(d.product_amount * d.product_price).toString(), maximaLongitud: maximaLongitudSubtotal },
                ],
                relleno,
                separadorColumnas
            );
            for (const linea of lineas) {
                tabla += linea + "\n";
            }
            tabla += obtenerLineaSeparadora() + "\n";
        }

        // Inicio de impresión
        const conector = new ConectorPluginV3();
        conector.Iniciar();
        conector.EstablecerTamañoFuente(1, 1);
        conector.EstablecerEnfatizado(false);
        conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
        conector.Corte(1);
        conector.TextoSegunPaginaDeCodigos(2, "cp850", "CENTRO DE FORMACIÓN AGROINDUSTRIAL\n")
        conector.EscribirTexto("Nit 899.99934-1\n");
        conector.DeshabilitarElModoDeCaracteresChinos();
        conector.TextoSegunPaginaDeCodigos(2, "cp850", "Producción de Centro - SENA Empresa\n");
        conector.EscribirTexto("La Angostura\n");
        conector.EscribirTexto("Art 17 Decreto 1001 de 1997\n");
        conector.EscribirTexto("------------------------------------------------\n");
        conector.EstablecerEnfatizado(true);
        conector.TextoSegunPaginaDeCodigos(2, "cp850", "Factura de entrada N°: "+voucher_number+"\n");
        conector.EstablecerEnfatizado(false);
        conector.EscribirTexto("------------------------------------------------\n");
        conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA);
        conector.EstablecerEnfatizado(true);
        conector.EscribirTexto("Fecha y hora: ");
        conector.EstablecerEnfatizado(false);
        conector.TextoSegunPaginaDeCodigos(2, "cp850", date+"\n");
        conector.EstablecerEnfatizado(true);
        conector.EscribirTexto("Proveedor:    ");
        conector.EstablecerEnfatizado(false);
        conector.TextoSegunPaginaDeCodigos(2, "cp850", provider+"\n");
        conector.EstablecerEnfatizado(true);f
        conector.EscribirTexto("Recibe:       ");
        conector.EstablecerEnfatizado(false);
        conector.TextoSegunPaginaDeCodigos(2, "cp850", receive+"\n");
        conector.EscribirTexto(tabla)
        conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA);
        conector.EstablecerEnfatizado(true);
        conector.EscribirTexto("TOTAL:  "+total+" |\n");
        conector.EstablecerEnfatizado(false);
        conector.EscribirTexto("-----------------------------------------------+\n");
        conector.Feed(4);
        conector.Corte(1);
        const respuesta = await conector.imprimirEn("POS-80C");
        resolve(respuesta);
    });
}

Livewire.on('printTicket', async function(voucher_number, date, provider, receive, details, total) {
    const respuesta = await imprimirTicket(voucher_number, date, provider, receive, details, total);
    if (respuesta === false) {
        alert("Error en impresión: " + respuesta);
    }
});


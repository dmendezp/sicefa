<?php
$nombreImpresora = 'POS-80C';
$fecha = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura Electrónica</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div>
        <h1>Factura Electrónica</h1>
        <p>Fecha: <?php echo $fecha; ?></p>
        <p>Número de factura: 001</p>
        <hr>
    </div>

    <button id="imprimirBtn">Imprimir</button>

    <script src="{{ asset('modules/ptventa/js/sale/conector_javascript_POS80C.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            
                const conector = new ConectorPluginV3();
                conector.Iniciar();
                conector.EstablecerTamañoFuente(1, 1);
                conector.EstablecerEnfatizado(false);
                conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
                conector.Feed(1);
                conector.TextoSegunPaginaDeCodigos(2, "cp850", "CENTRO DE FORMACIÓN AGROINDUSTRIAL\n")
                conector.EscribirTexto("Nit 899.99934-1\n");
                conector.DeshabilitarElModoDeCaracteresChinos();
                // Recuerda que si tu impresora soporta acentos sin configuración adicional solo debes invocar a EscribirTExto
                conector.TextoSegunPaginaDeCodigos(2, "cp850", "Producción de Centro - SENA Empresa\n");
                conector.EscribirTexto("La Angostura\n");
                conector.EscribirTexto("Art 17 Decreto 1001 de 1997\n");
                conector.TextoSegunPaginaDeCodigos(2, "cp850", "Factura de venta N°: 117\n");
                conector.EscribirTexto("------------------------------------------------\n");
                conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA);
                conector.EstablecerEnfatizado(true);
                conector.EscribirTexto("Fecha/Hora:    ");
                conector.EstablecerEnfatizado(false);
                conector.TextoSegunPaginaDeCodigos(2, "cp850", "2021-02-08 16:57:55\n");
                conector.EstablecerEnfatizado(true);
                conector.EscribirTexto("Cliente:       ");
                conector.EstablecerEnfatizado(false);
                conector.TextoSegunPaginaDeCodigos(2, "cp850", "PUNTO DE VENTA\n");
                conector.EstablecerEnfatizado(true);
                conector.EscribirTexto("Documento:     ");
                conector.EstablecerEnfatizado(false);
                conector.TextoSegunPaginaDeCodigos(2, "cp850", "1234567890\n");
                conector.EstablecerEnfatizado(true);
                conector.EscribirTexto("Atendido por:  ");
                conector.EstablecerEnfatizado(false);
                conector.TextoSegunPaginaDeCodigos(2, "cp850", "María Sanchez Nuñez\n");
                conector.EscribirTexto("------------------------------------------------\n");
                conector.EscribirTexto("#| Producto         | Cant | V. Unit | SubTotal\n")
                conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA);
                conector.EscribirTexto("1|Yogurt de fresa   | 2    | $1.000  | $2.000\n");
                conector.EscribirTexto("------------------------------------------------\n");
                conector.EscribirTexto("                           | TOTAL:  | $2.000\n");
                conector.EscribirTexto("------------------------------------------------\n");
                conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
                conector.TextoSegunPaginaDeCodigos(2, "cp850", "Muchas gracias por su compra\n");
                conector.TextoSegunPaginaDeCodigos(2, "cp850", "¡Vuelva Pronto!");
                conector.Feed(4);
                conector.Corte(1);
                const imprimirBtn = document.getElementById('imprimirBtn');
                imprimirBtn.addEventListener('click', async (event) => {
                    event.preventDefault();

                    await conector.imprimirEn("<?php echo $nombreImpresora; ?>");

                    // Redireccionar al usuario a la vista del botón
                    window.location.href = "{{ route('cefa.ptventa.ticket') }}";
                });
            

        });
    </script>
</body>

</html>
